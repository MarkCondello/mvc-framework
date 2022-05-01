<?php
class Posts extends Controller {
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }
  public function index()
  {
    // verify the user again
    //redirect to login if they are not registered
    $data = [
      'title' => 'Your Posts'
      //get the users posts by email
    ];

    $this->view("pages/posts", $data);

  }
}