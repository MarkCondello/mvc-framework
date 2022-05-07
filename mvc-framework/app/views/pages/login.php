<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container mt-6" style="min-height: 100vh;">
  <h1 class="is-size-1"><?= $data['page_title']; ?></h1>
   <form method="POST" action="<?= URLROOT ?>/login">
    <div class="field">
      <label class="label">Email</label>
      <div class="control has-icons-left has-icons-right">
        <input
          class="input <?= $data['email_error'] ? 'is-danger' : null ?>"
          type="email"
          name="email"
          placeholder="Email input"
          value="<?= $data['email'] ?>"
        >
        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
        <?php if($data['email_error']): ?>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
        <?php endif; ?>
      </div>
      <?php if($data['email_error']): ?>
      <p class="help is-danger"><?= $data['email_error'] ?></p>
      <?php endif ?>
    </div>
    <div class="field">
      <label class="label">Password</label>
      <div class="control has-icons-left has-icons-right">
      <input
          class="input <?= $data['password_error'] ? 'is-danger' : null ?>"
          type="password"
          name="password"
          placeholder="Password"
          value="<?= $data['password'] ?>"
        >
        <span class="icon is-small is-left">
          <i class="fas fa-key"></i>
        </span>
        <?php if($data['password_error']): ?>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
        <?php endif; ?>
      </div>
      <?php if($data['password_error']): ?>
      <p class="help is-danger"><?= $data['password_error'] ?></p>
      <?php endif ?>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <input type="submit" class="button is-link" value="Login">
      </div>
      <div class="control">
        <a class="button is-link is-light" href="<?= URLROOT ?>">Cancel</a>
      </div>
    </div>
  </form>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>