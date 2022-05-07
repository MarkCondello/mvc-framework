<?php
include APPROOT . '/utils/helpers.php';

class Login extends Controller {
  public function __construct()
  {
    session_start();
    $this->userModel = $this->model('User');
  }
  public function index()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user = (object)[
        'email' => $_POST['email'],
        'password' => $_POST['password'],
      ];
      $data = [
        "page_title"=> "Login",
        'email' => $user->email ?? '',
        'email_error' => $user->email ? '' : 'The email field is required.',
        'password' => $user->password ?? '',
        'password_error' => $user->password ? '' : 'The password field is required.',
      ];
      if (empty($data['email_error']) && empty($data['password_error'])) {
        $verifiedUsersEmail = $this->userModel->getUserByEmail($user->email);
        if ($verifiedUsersEmail) {
          $verifiedUsersEmailAndPassword = $this->userModel->getUserByEmailAndPassword($user->email, $user->password);
          if($verifiedUsersEmailAndPassword) {
            $_SESSION['authed_user'] = $verifiedUsersEmail->email;
            $_SESSION['flash_message_class'] = 'is-primary';
            $_SESSION['flash_message'] = 'You successfully logged in.';
            header('Location: ' . URLROOT . '/posts');
          } else {
            $data['password_error'] = 'The password entered is invalid.';
          }
        } else {
          $data['email_error'] = 'The email you provided is not registered in our system.';
        }
      }
    } else {
      $data = [];
      $flashMessage = getFlashMessage();
      if ($flashMessage) {
        $data = array_merge($data, $flashMessage);
      }
      $fieldData = [
        "title"=> "Login",
        'email' => '',
        'email_error' => '',
        'password' => '',
        'password_error' => '',
      ];
      $data = array_merge($fieldData, $data);
    }
    $this->view("pages/login", $data);
  }
}

