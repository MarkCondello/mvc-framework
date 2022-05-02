<?php
class Login extends Controller {
  public function __construct()
  {
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
        "title"=> "Login",
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
            session_start();
            $_SESSION['authed_user'] = $verifiedUsersEmail->email;
            $_SESSION['flash_message_class'] = 'is-primary';
            $_SESSION['flash_message'] = 'You successfully logged in.';
            // Add flash message to session and redirect to the your post page which is a protected area
            header('Location: ' . URLROOT . '/posts');
          } else {
            $data['password_error'] = 'The password for the email you provided is not correct.';
          }
        } else {
          $data['email_error'] = 'The email you provided is not registered in our system.';
        }
      }
    } else {
      $data = [
        "title"=> "Login",
        'email' => '',
        'email_error' => '',
        'password' => '',
        'password_error' => '',
      ];
    }
    $this->view("pages/login", $data);
  }
}

