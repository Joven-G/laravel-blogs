<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/style.css'); ?>" />
  <?php echo Asset::styles(); ?>
</head>
<body>
  <?php if (Auth::check()): ?>
    <div class="user-panel">
      <div class="container">
        <ul>
          <li>  
            Logged in as <strong><?php echo Auth::user()->username; ?></strong> 
            <?php echo HTML::link_to_logout('Logout'); ?>
          </li>
          <?php if (Auth::user()->is_editor()): ?>
          <li class="separator">|</li>
          <li><?php echo HTML::link_to_new_post('Add Post'); ?></li>
          <?php endif; ?>
          <?php if (Auth::user()->is_admin()): ?>
            <li class="separator">|</li>
            <li><?php echo HTML::link_to_new_category('Add Category'); ?></li>
            <li class="separator">|</li>
            <li><?php echo HTML::link_to_users('Manage Users'); ?></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>
  <div class="container">
    <h1>Laravel Powered Blog</h1>
    <div id="nav">
      <li><?php echo HTML::link_to_home('Home'); ?></li>
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
