<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class='comments'>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-md-6 col-12 pb-4" >
          <h1 class="comments">Comments</h1>
          <div id="commentsList">
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
          <div id="status"></div>
          <?php echo form_open('comments/create'); ?>
          <div class="form-group">
            <h4>Leave a comment</h4>
            <label for="message">Message</label>
            <textarea name="comment_body" id="body_text" cols="30" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="nickname">Name</label>
            <input type="text" name="comment_nickname" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="comment_email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <?php echo form_submit(array('id' => 'submit', 'value' => 'Post Comment', 'class' => 'btn')); ?>
          </div>
          <?php echo form_close(); ?>
        </div>
        <div id='pagination' class="comment-pagination"></div>
      </div>
    </div>
  </section>

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/comment.js"></script>

</body>
</html>
