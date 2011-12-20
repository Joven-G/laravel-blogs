<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/style.css'); ?>" />
  <?php echo Asset::styles(); ?>
</head>
<body>
  <div class="container">
    <h1>Laravel Powered Blog</h1>
    <div id="nav">
      <li class="separator">|</li>
      <?php if ( ! Auth::check()): ?>
      <li class="separator">|</li>
      <?php endif; ?>
    </div>
    <?php echo $content; ?>
  </div>
  <?php echo Asset::scripts(); ?>
</body>
</html>
