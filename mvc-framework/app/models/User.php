<?php
class User extends Model{

  public function saveUser($user)
  {
    $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $this->db->bind('name', $user->name);
    $this->db->bind('email', $user->email);
    $this->db->bind('password', $user->password);
    return $this->db->rowCount();
  }
  public function getUserByEmail($email)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind('email', $email);
    return $this->db->single();
  }
  public function getUserByEmailAndPassword($email, $password)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email AND password = :password');
    $this->db->bind('email', $email);
    $this->db->bind('password', $password);
    return $this->db->single();
  }

  public function getUsers()
  {
    $this->db->query("SELECT * FROM users");
    return $this->db->resultSet();
  }
}