<?php require APPROOT.'/views/inc/header.php';?>
<?php include(APPROOT.'/views/inc/nav.php'); ?>
<div class="container">

<h1><?= $data['title']; ?></h1>
 <small><a href="<?= $data['link'] ?>" target="_blank"><?= $data['description']; ?></a></small>
<?php
  if (count($data['users'])): ?>
  <hr>
  <h3>Existing Users:</h3>
  <ul>
    <?php foreach($data['users'] as $user):?>
    <li><?= $user->name . ' - ' . $user->email . ' Joined since: ' . $user->created_at ?></li>
    <?php endforeach ?>
  </ul>
 <? endif;?>

 <?php
  if (count($data['posts'])): ?>
  <hr>
  <h3>Past Posts:</h3>
  <ul>
    <?php foreach($data['posts'] as $post):?>
    <li><?= $post->title . ' - ' . $post->body . ' On: ' . $post->created_at ?></li>
    <?php endforeach ?>
  </ul>
 <? endif;?>
   
</div>
<?php require APPROOT . '/views/inc/footer.php';?>