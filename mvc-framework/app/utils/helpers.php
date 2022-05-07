<?php

function getFlashMessage() {
  if(isset($_SESSION['flash_message']) && isset($_SESSION['flash_message_class'])) {
    $data['flash_message'] = $_SESSION['flash_message'];
    $data['flash_message_class'] = $_SESSION['flash_message_class'];
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_message_class']);
    return $data;
  }
}

function setFlashMessage($message = '', $messageClass = 'is-primary') {
  $_SESSION['flash_message'] = $message;
  $_SESSION['flash_message_class'] = $messageClass;
}

function logoutUser () {
  unset($_SESSION["authed_user"]);
  header('Location: ' . URLROOT . '/login');
}