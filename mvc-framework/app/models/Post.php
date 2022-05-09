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

  public function getPostById($id)
  {
    $this->db->query('SELECT * FROM posts WHERE id = :id LIMIT 1');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function updatePostById($post, $id)
  {
    $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    $this->db->bind('title', $post->title);
    $this->db->bind('body', $post->body);
    $this->db->bind('id', $id);
    return $this->db->rowCount();
  }

  public function deletePostById($id)
  {
    $this->db->query('DELETE FROM posts WHERE id = :id');
    $this->db->bind('id', $id);
    return $this->db->rowCount();
  }

}