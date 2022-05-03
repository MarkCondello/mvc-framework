<?php
if (isset($data['flashMessage']) && isset($data['flashMessageClass'])) : ?>
<div class="notification
 <?= $data['flashMessageClass'] ?>">
  <button class="delete"></button>
  <?= $data['flashMessage'] ?>
</div>
<?php endif; ?>
<!-- is-primary
is-danger
-->