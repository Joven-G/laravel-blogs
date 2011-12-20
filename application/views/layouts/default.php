<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/style.css'); ?>" />
  <?php echo Asset::styles(); ?>
</head>
<body>
  <ul>
    <li><?php echo HTML::link_to_new_posts('Add Post'); ?></li>\
  </ul>
  <div class="container">
    <h1>Laravel Powered Blog</h1>
    <div id="nav">
      <li><?php echo HTML::link_to_posts('Posts'); ?></li>
      <li class="separator">|</li>
      <?php if ( ! Auth::check()): ?>
      <li class="separator">|</li>
      <li><?php echo HTML::link_to_login('Login'); ?></li>
      <?php endif; ?>
    </div>
    <?php echo App::flash_notice(); ?>
    <?php echo App::flash_success(); ?>
    <?php echo App::flash_error(); ?>
    <?php echo $content; ?>
  </div>
  <?php echo Asset::scripts(); ?>
</body>
</html>
