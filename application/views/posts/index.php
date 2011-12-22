<div class="page-header">
  <h1>Posts <small>Viewing all posts</small></h1>
</div><!-- end of page-header div -->

<?php foreach ($posts->results as $post): ?>
      <h3><?php echo HTML::entities($post->title); ?></h3>
      <div class="author">By: <strong><?php echo $post->user->username; ?></strong></div>
      <div class="category">Published under: <strong><?php echo $post->category->name; ?></strong></div>
      <br />
      <?php echo HTML::entities($post->content); ?>
      <?php echo HTML::link(URL::to_show_post(array($post->id)), 'More'); ?>
      <br />
      <?php endforeach; ?>
      <?php echo $posts->links(); ?>