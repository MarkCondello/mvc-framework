<?php
class Register extends Controller {
  public function __construct()
  {
    $this->userModel = $this->model('User'); // demo Model for gathering data
  }
  public function index($params = null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user = (object)[
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password'],
      ];
      $data = [
        "title"=> "Register",
        'name' => $user->name ?? '',
        'name_error' => $user->name ? '' : 'The name field is required.',
        'email' => $user->email ?? '',
        'email_error' => $user->email ? '' : 'The email field is required.',
        'password' => $user->password ?? '',
        'password_error' => $user->password ? '' : 'The password field is required.',
        'confirm_password' => $user->confirm_password ?? '',
      ];
      $existingUser = $this->userModel->getUserByEmail($user->email);
      if($existingUser) {
        $data['email_error'] = 'That email address is already used.';
      }

      if (! $user->confirm_password) {
        $data['confirm_password_error'] = 'The confirm password field is required.';
      }
      if ($user->confirm_password !== $user->password) {
        $data['confirm_password_error'] = 'The confirm password must match the password field.';
      }
      if (empty($data['name_error'])
      && empty($data['email_error'])
      && empty($data['password_error'])
      && empty($data['confirm_password_error'])) {
      
        $result = $this->userModel->saveUser($user);
        if($result) {
          // Show flash message and redirect to the post page which is a protected area
        } else {
          // Show error flash message
        }
      }

    } else {
      $data = [
        "title"=> "Register",
        'name' => '',
        'name_error' => '',
        'email' => '',
        'email_error' => '',
        'password' => '',
        'password_error' => '',
        'confirm_password' => '',
        'confirm_password_error' => '',
      ];
    }
    $this->view("pages/register", $data);
      // echo " with the about action. Params passed are: " . $params;
  }

    // public function login(){

    //      $data = [
    //     ];
    // }
}