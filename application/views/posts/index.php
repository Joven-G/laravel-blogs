<div class="page-header">
  <h1>Posts <small>Viewing all posts</small></h1>
</div>

<?php foreach ($posts->results as $post): ?>
<div class="post_box">
  <div class="page-header">
  <h3><?php echo HTML::entities($post->title); ?></h3>
  <div class="author">By: <strong><?php echo $post->user->username; ?></strong></div>
  <div class="category">
    Published under: <strong><?php echo $post->category->name; ?></strong>
  </div>
  <div class="content"><?php echo HTML::entities($post->content); ?></div>
  <?php echo HTML::link(URL::to_show_post(array($post->id)), 'More'); ?>
</div>
<?php endforeach; ?>
<?php echo $posts->links(); ?>
