<?php echo App::errors_for($comment); ?>
<?php echo Form::open(URL::to_create_comment(), 'POST'); ?>
  <?php echo Form::token(); ?>
  <?php echo Form::hidden('post_id', $comment->post_id); ?>
  <div class="field">
    <?php echo Form::label('username', 'Username'); ?>
    <?php echo Form::text('username', $comment->username); ?>
  </div>
  <div class="field">
    <?php echo Form::label('email', 'Email'); ?>
    <?php echo Form::text('email', $comment->email); ?>
  </div>
  <div class="field">
    <?php echo Form::label('content', 'Comment'); ?>
    <?php echo Form::textarea('content', $comment->content); ?>
  </div>
  <div class="actions">
    <?php echo Form::submit('Add Comment'); ?>
  </div>
<?php echo Form::close(); ?>
