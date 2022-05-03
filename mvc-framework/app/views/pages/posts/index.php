<?php require APPROOT . '/views/inc/header.php'; 
include APPROOT . '/views/inc/notification.php';
include APPROOT . '/views/inc/nav.php'; ?>
<div class="container">
  <h1><?= $data['page_title']; ?></h1>
  <?php
  if (isset($data['usersPosts'])): ?>
  <hr>
  <h3>Past Posts:</h3>
  <ul>
    <?php foreach($data['posts'] as $post):?>
      <li><?= $post->title . ' - ' . $post->body . ' On: ' . $post->created_at ?></li>
      <?php endforeach ?>
    </ul>
    <? else: ?>
      <a href="<?= URLROOT ?>/posts/create" class="button is-link">Create A Post</a>
    <? endif;?>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>