<?php
class Post extends Model{

  public function savePost($post)
  {
    $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
    $this->db->bind('user_id', $post->user_id);
    $this->db->bind('title', $post->title);
    $this->db->bind('body', $post->body);
    return $this->db->rowCount();
  }

}