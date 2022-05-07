<?php
if (isset($data['flash_message']) && isset($data['flash_message_class'])) : ?>
<div class="notification
 <?= $data['flash_message_class'] ?>">
  <button class="delete"></button>
  <?= $data['flash_message'] ?>
</div>
<?php endif; ?>