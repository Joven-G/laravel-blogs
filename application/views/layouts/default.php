<!doctype html>
<html>
<head>
  <title>The Laravel Playground</title>
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
  <?php echo Asset::styles(); ?>
</head>
<body>
  <div class="container">
    <h1>Laravel Powered Blog</h1>
    <div id="nav">
    </div>
    <?php echo $content; ?>
  </div>
  <?php echo Asset::scripts(); ?>
</body>
</html>
