<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
  <?php echo Asset::styles(); ?>
</head>
<body>
  <div class="topbar">
    <div class="topbar-inner">
      <div class="container">
        <h3><a class="brand" href="">Laravel Blog</a></h3>
        <ul class="nav">
          <li><a href="#">Sign In</a></li>
          <li><a href="#">Latest</a></li>
        </ul>
        <?php echo $content; ?>
      </div><!-- end of container div -->
    </div><!-- end of topbar-inner div -->
    <?php echo Asset::scripts(); ?>
  </div><!-- end of topbar div -->
</body>
</html>
