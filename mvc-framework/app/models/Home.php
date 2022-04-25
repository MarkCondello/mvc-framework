<?php 
class Home {
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getUsers()  // demo method for gathering data
  {
    $this->db->query("SELECT * FROM users");
    return $this->db->resultSet();
  }
 }