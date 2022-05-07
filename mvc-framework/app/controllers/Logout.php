<?php
include APPROOT . '/utils/helpers.php';

class Logout extends Controller {
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }
  public function index()
  {
    session_start();
    setFlashMessage($_SESSION["authed_user"] . ' has been logged out', 'is-primary');
    unset($_SESSION["authed_user"]);
    header('Location: ' .  URLROOT . '/login');
  }
}