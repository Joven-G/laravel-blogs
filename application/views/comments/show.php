<div class="comment">
  <div class="header">
    <?php echo App::gravatar_for($comment->email); ?>
    <?php echo $comment->username; ?>
  </div>
  <div class="content">
    <?php echo HTML::entities($comment->content); ?>
  </div>
</div>
