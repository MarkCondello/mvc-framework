<?php
class Posts extends Controller {
  public function __construct()
  {
    // Can I put the session_start(); here for all methods and do user verification here as well?
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
        $data['page_title'] = 'You have no posts '  . $user->name;
      } else {
        $data = [
          'page_title' => 'Here are your posts ' . $user->name,
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
    session_start();
    $user = $this->userModel->getUserByEmail($_SESSION['authed_user']);
    $data = [
      'page_title' => "Create a new post",
      'user' => $user,
    ];
    $this->view("pages/posts/create", $data);
  }
  public function store()
  {
    // Process the form
    session_start();
    $data = [];
    header('Location: ' . URLROOT . '/pages/posts/index');
  }
  //  ToDo Ron
  public function update($params)
  {
    session_start();
    $data = [];
    $this->view("pages/posts/create", $data);
  }
}