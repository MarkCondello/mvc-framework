<?php require APPROOT . '/views/inc/header.php';?>
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
<?php require APPROOT . '/views/inc/footer.php';?>