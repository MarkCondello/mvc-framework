<?php require APPROOT . '/views/inc/header.php'; 
// 
?>
<div class="container  mt-6" style="min-height: 100vh;">
  <h1><?= $data['page_title']; ?></h1>
  <?php
  if (isset($data['usersPosts'])): ?>
  <hr>
  <h3>Past Posts:</h3>
  <a href="<?= URLROOT ?>/posts/create" class="button is-link">Create Another Post</a>
  <ul>
    <?php foreach($data['usersPosts'] as $post):?>
      <li class="is-flex">
        <div>
          <?= $post->title . ' - ' . $post->body . ' On: ' . $post->created_at ?>
        </div>
        <menu>
          <a href="<?= URLROOT ?>/posts/update/<?= $post->id ?>">Update post</a>
          <form action="<?= URLROOT ?>/posts/delete/" method="POST">
            <input type="hidden" value="<?= $post->id ?>" name="post_id"/>
            <button>Delete post</button>
          </form>
        </menu>
      </li>
    <?php endforeach ?>
    </ul>
    <? else: ?>
      <a href="<?= URLROOT ?>/posts/create" class="button is-link">Create A Post</a>
    <? endif;?>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>