<?php
include APPROOT . '/utils/helpers.php';

class Posts extends Controller {
  // TODo: I assume that I need to set these error items so that when a post/save is made, we can redirect and pass these private values to them. RON
  private $titleError = null;
  private $bodyError = null;

  public function __construct()
  {    
    session_start();
    $this->userModel = $this->model('User');
    $this->postModel = $this->model('Post');
  }
  public function index()
  {      
    $user = $this->userModel->getUserByEmail($_SESSION['authed_user']);
    if ($user) {
      $data = [];
      $flashMessageData = getFlashMessage();
      if ($flashMessageData) {
        $data = array_merge($data, $flashMessageData);
      }
      $usersPosts = $this->userModel->getUsersPosts($user->id);
      if (count($usersPosts) < 1) {
        $data['page_title'] = 'You have no posts '  . $user->name;
      } else {
        $dataWithPosts = [
          'page_title' => 'Here are your posts ' . $user->name,
          'usersPosts' => $usersPosts,
        ];
        $data = array_merge($data, $dataWithPosts);
      }
      $this->view("pages/posts/index", $data);
    } else {
      setFlashMessage('User could not be verified...', 'is-danger');
      logoutUser();
    }
  }
  public function create()
  {
    $user = $this->userModel->getUserByEmail($_SESSION['authed_user']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // die('Reached POST on create posts controller');
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $post = (object)[
        'user_id' => $user->id,
        'title' => $_POST['title'],
        'body' => $_POST['body'],
      ];
      $data = [
        'title' => $post->title ?? '',
        'title_error' => $post->title ? '' : 'The title field is required.',
        'body' => $post->body ?? '',
        'body_error' => $post->body ? '' : 'The body field is required.',
      ];
      if (empty($data['title_error']) && empty($data['body_error'])) {
        //Todo: add a second check for string lengths
        if(strlen($post->title) < 4) {
          $data['title_error'] = 'The title must be more than 4 characters.';
        }
        if(strlen($post->body) < 10) {
          $data['body_error'] = 'The content must be more than 10 characters.';
        }
        if (empty($data['title_error']) && empty($data['body_error'])) {
          $savedPost = $this->postModel->savePost($post);
          if($savedPost) {
            // Set success flashMessage
            setFlashMessage($post->title . ' was created succesfully', 'is-success');
            header('Location: ' . URLROOT . '/posts');
          } 
          else {
            // ToDo: Test error flash message to session
            setFlashMessage('There was an issue saving your post.', 'is-danger');
            header('Location: ' . URLROOT . '/posts');
          }
        }
      } 
    } else {
      $data = [
        'page_title' => "Create a new post",
      ];
    }
    $this->view("pages/posts/create", $data);
  }
 
  //  ToDo Ron
  public function update($params)
  {

    $postData = $this->postModel->getPostById($params);
    $data = [
      'page_title' => 'Edit ' . $postData->title,
    ];
    $data = array_merge($data, $postData);

    // die('FROM UPDATE METHOD: '. var_dump($postData));
    $this->view("pages/posts/create", $data);
  }
}