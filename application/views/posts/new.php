<div class="box">
  <h3>Create Post</h3>
  <?php echo App::errors_for($post); ?>
  <?php echo Form::open(URL::to_create_post(), 'POST'); ?>
    <?php echo Form::token(); ?>
    <div class="field">
      <?php echo Form::label('title', 'Title'); ?>
      <?php echo Form::text('title', $post->title); ?>
    </div>

    <div class="field">
      <?php echo Form::label('category_id', 'Category'); ?>
      <?php echo Form::select('category_id', App::as_list($categories, 'id', 'name')); ?>
    </div>

    <div class="field">
      <?php echo Form::label('content', 'Content'); ?>
      <?php echo Form::textarea('content', $post->content); ?>
    </div>

    <div class="actions">
      <?php echo Form::submit('Create'); ?>
      <?php echo HTML::link_to_home('Cancel'); ?>
    </div>
  <?php echo Form::close(); ?>
</div>

