<?php
class Posts extends Controller {
  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->postModel = $this->model('User');
  }
  public function index()
  {
    session_start();
    $user = $this->userModel->getUserByEmail($_SESSION['authed_user']);
    if ($user) {
      // This should be added to a helper function
      if(isset($_SESSION['flash_message']) && isset($_SESSION['flash_message'])) {
        $data['flashMessageClass'] = $_SESSION['flash_message_class'];
        $data['flashMessage'] = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_message_class']);
      }

      $usersPosts = $this->userModel->getUsersPosts($user->id);
      if (count($usersPosts) < 1) {
        $data['title'] = 'You have no posts '  . $user->name;
      } else {
        $data = [
          'title' => 'Here are your posts ' . $user->name,
          'usersPosts' => $usersPosts,
        ];
      }
      $this->view("pages/posts/index", $data);
    } else {
      // Add flash message to session and redirect to the your post page which is a protected area
      header('Location: ' . URLROOT . '/login');
    }
  }
  public function create()
  {
    $data = [];
    $this->view("pages/posts/create", $data);
  }
}