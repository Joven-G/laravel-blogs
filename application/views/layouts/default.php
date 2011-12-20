<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" type="text/css" href="<?php echo URL::to_asset('css/style.css'); ?>" />
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
  <?php echo Asset::styles(); ?>
</head>
<body>
  <div class="topbar">
    <div class="fill">
      <div class="topbar-inner">
        <div class="container">
          <h3><a class="brand" href="">Laravel Blog</a></h3>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Sign In</a></li>
          </ul>
          <form action="" class="pull-right">
            <input class="input-small" type="text" placeholder="Username">
            <input class="input-small" type="password" placeholder="Password">
            <button class="btn" type="submit">Sign in</button>
          </form>
        </div><!-- end of container div -->
      </div><!-- end of topbar-inner div -->
  </div><!-- end of topbar div -->
  <div class="container">
    <div class="content">
      <?php echo $content; ?>
    </div><!-- end of content div-->
  </div><!-- end of container -->
  <?php echo Asset::scripts(); ?>
</body>
</html>
