<?php
include APPROOT . '/utils/helpers.php';

class Posts extends Controller {
  // TODo: I assume that I need to set these error items so that when a post/save is made, we can redirect and pass these private values tp them. RON
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
        $data = [
          'page_title' => 'Here are your posts ' . $user->name,
          'usersPosts' => $usersPosts,
        ];
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
      die('Reached POST on create posts controller');

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $post = (object)[
        'user_id' => $_POST['user_id'],
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
        //do a second check for string lengths
        $savedPost = $this->postModel->savePost($post);
        if($savedPost) {
          // Set success flashMessage
          setFlashMessage($post->title . ' was created succesfully', 'is-success');
          header('Location: ' . URLROOT . '/posts');
        } 
        else {
          // ToDo: Add error flash message to session
    
        }
      } 
    }
    $data = [
      'page_title' => "Create a new post",
      'user' => $user,
    ];
    $this->view("pages/posts/create", $data);
  }
 
  //  ToDo Ron
  public function update($params)
  {
    $data = [];
    $this->view("pages/posts/create", $data);
  }
}