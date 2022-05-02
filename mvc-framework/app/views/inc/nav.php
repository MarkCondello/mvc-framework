<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <!-- <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a> -->
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="<?= URLROOT ?>">
        Home
      </a>
      <a class="navbar-item"  href="<?= URLROOT . '/pages/about'?>">
        About
      </a>
<!-- 
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div> -->
    </div>
<?php // var_dump($_SESSION['authed_user']) ?>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <?php if (!$_SESSION['authed_user']): ?>
          <a class="button is-primary" href="<?= URLROOT . '/register' ?>">
            <strong>Register</strong>
          </a>
          <a class="button is-light" href="<?= URLROOT . '/login' ?>">
            Log in
          </a>
          <?php else: ?>
            <a class="button is-light" href="<?= URLROOT . '/logout' ?>">
            Log out
          </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</nav>