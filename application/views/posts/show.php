<h2><?php echo HTML::entities($post->title); ?></h2>
<div class="box">
  <div class="author">
    By: <strong><?php echo $post->user->username; ?></strong>
  </div>
  <div class="category">
    Published as: <strong><?php echo $post->category->name; ?></strong> 
  </div>
  <div class="content">
    <?php echo HTML::entities($post->content); ?>
  </div>
</div>

<div class="box comments">
  <?php if($post->comments): ?>
    <?php foreach($post->comments as $comment): ?>
    <div class="comment">
      <div class="header">
        <?php echo App::gravatar_for($comment->email); ?>
      </div>
      <div class="content">
        <i>Commented by: <?php echo $comment->username; ?></i><br/>
        <?php echo HTML::entities($comment->content); ?>
      </div>
    </div>
    <br class="clear" />
    <?php endforeach; ?>
  <?php else: ?>
    <h3>No Comments Yet</h3>
  <?php endif; ?>
</div>

<div class="box comment-form">
  <?php echo Form::open(URL::to_create_comment(), 'POST'); ?>
    <?php echo Form::token(); ?>
    <?php echo Form::hidden('post_id', $post->id); ?>
    <div class="field">
      <?php echo Form::label('username', 'Username'); ?>
      <?php echo Form::text('username'); ?>
    </div>
    <div class="field">
      <?php echo Form::label('email', 'Email'); ?>
      <?php echo Form::text('email'); ?>
    </div>
    <div class="field">
      <?php echo Form::label('content', 'Comment'); ?>
      <?php echo Form::textarea('content'); ?>
    </div>
    <div class="actions">
      <?php echo Form::submit('Add Comment'); ?>
    </div>
  <?php echo Form::close(); ?>
</div>
