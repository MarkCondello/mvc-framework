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
    $data = [
      'page_title' => "Create a new post",
      'action' => URLROOT . '/posts/create',
    ];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = $this->processForm($data, 'save', 'was created succesfully');
    }
    $this->view("pages/posts/create", $data);
  }
 
  public function update($params)
  {
    $postData = $this->postModel->getPostById($params);
    $data = [
      'page_title' => 'Edit ' . $postData->title,
      'action' => URLROOT . "/posts/update/$postData->id",
    ];
    $data = array_merge($data, (array) $postData);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = $this->processForm($data, 'update', 'was updated succesfully', $postData->id);
    }
    $this->view("pages/posts/create", $data);
  }

  private function processForm($data, $modelMethod, $successMessage = '', $postId = null)
  {
    $user = $this->userModel->getUserByEmail($_SESSION['authed_user']);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $post = (object)[
      'user_id' => $user->id,
      'title' => $_POST['title'],
      'body' => $_POST['body'],
    ];
    $formData = [
      'title' => $post->title ?? '',
      'title_error' => $post->title ? '' : 'The title field is required.',
      'body' => $post->body ?? '',
      'body_error' => $post->body ? '' : 'The body field is required.',
    ];
    if (empty($formData['title_error']) && empty($formData['body_error'])) {
      if (strlen($post->title) < 5) {
        $formData['title_error'] = 'The title must be more than 4 characters.';
      }
      if (strlen($post->body) < 11) {
        $formData['body_error'] = 'The content must be more than 10 characters.';
      }
      if (empty($formData['title_error']) && empty($formData['body_error'])) {
        $savedPost = null;
        if ($modelMethod === 'save') {
          $savedPost = $this->postModel->savePost($post);
        } else if ($modelMethod === 'update') {
          $savedPost = $this->postModel->updatePostById($post, $postId);
        }
        if ($savedPost) {
          setFlashMessage($post->title . ' ' . $successMessage, 'is-success');
          header('Location: ' . URLROOT . '/posts');
        } 
        else {
          setFlashMessage('There was an issue saving your post.', 'is-danger');
          header('Location: ' . URLROOT . '/posts');
        }
      }
    }
    return array_merge($formData, $data);
  }

  public function delete()
  {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $postId = $_POST['post_id'];
    $post = $this->postModel->getPostById($postId);
    $deletedPost = $this->postModel->deletePostById($postId);
    if ($deletedPost) {
      setFlashMessage($post->title . ' was succesfully deleted...', 'is-success');
      header('Location: ' . URLROOT . '/posts');
    } else {
      setFlashMessage('There was an issue deleting your post.', 'is-danger');
      header('Location: ' . URLROOT . '/posts');
    }
  }
}