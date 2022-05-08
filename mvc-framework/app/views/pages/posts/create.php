<?php require APPROOT . '/views/inc/header.php';?>
<div class="container mt-6" style="min-height: 100vh;">
  <h1 class="is-size-1">
    <?= $data['page_title'] ?>
  </h1>
   <form method="POST" action="<?= URLROOT ?>/posts/create">
   <!-- I think fields should be included as a partial or helper function -->
    <div class="field">
      <label class="label">Title</label>
      <div class="control has-icons-left has-icons-right">
        <input
          class="input <?= $data['title_error'] ? 'is-danger' : null ?>"
          type="text"
          name="title"
          placeholder="Title input"
          value="<?= $data['title'] ?>"
        >
        <span class="icon is-small is-left">
          <i class="fas fa-pencil"></i>
        </span>
        <?php if($data['title_error']): ?>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
        <?php endif; ?>
      </div>
      <?php if($data['title_error']): ?>
      <p class="help is-danger"><?= $data['title_error'] ?></p>
      <?php endif ?>
    </div>
    <div class="field">
      <label class="label">Content</label>
      <div class="control has-icons-left has-icons-right">
        <textarea
          style="width:100%;"
          class="textarea <?= $data['body_error'] ? 'is-danger' : null ?>"
          name="body"
          rows="5"
         ><?= $data['body'] ?></textarea>
        <span class="icon is-small is-left">
          <i class="fas fa-pencil"></i>
        </span>
        <?php if($data['body_error']): ?>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
        <?php endif; ?>
      </div>
      <?php if($data['body_error']): ?>
      <p class="help is-danger"><?= $data['body_error'] ?></p>
      <?php endif ?>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <input type="submit" class="button is-link" value="Save post">
      </div>
      <div class="control">
        <a class="button is-link is-light" href="<?= URLROOT ?>">Cancel</a>
      </div>
    </div>
   </form>
<?php require APPROOT . '/views/inc/footer.php';?>