<?php
class Logout extends Controller {
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }
  public function index()
  {
    session_start();
    unset($_SESSION["authed_user"]);
    header('Location: ' .  URLROOT . '/login');
  }
}