<?php ob_start() ?>
<div class="blog-post">
  <h2 class="blog-post-title"><!-- TODO: title --><?php echo htmlentities($post['title']);?></h2>
  <p class="blog-post-meta"><!-- TODO: date and author -->
    <?php echo htmlentities(date('M D Y',$post['date']));?> by <?php echo htmlentities($post['author']);?>
  </p>
  <!-- TODO: blog body -->
  <?php echo htmlentities($post['body']);?>
</div><!-- /.blog-post -->
<div class="blog-comment">
  <h3>Comments</h3>
  <form id="commentform" action="http://blog/stage-5/index.php/comment_action?post_id=<?php echo $id;?>" method="post">
    <textarea placeholder="comment..." rows=5 cols=50 name="comment_text" id="commentid"></textarea>
    <br>
    <input type="number" value="<?php echo $id;?>" id="postid" hidden/>
    <br>
    <div id="button_loader" >
      <input type="submit" value="submit" class="moveleft">
      <div id="loader" class="moveleft">
        <img src="http://blog/stage-5/img/loader.gif" width=100/>
      </div>
    </div>
  </form>
  <div class="boxcomment">
    <?php foreach($comments as $comment):?>
    <p>
    <span style="color: blue"><?php echo htmlentities($comment['uname']);?></span>
    <br>
    commented on : <span class="comment"><?php echo htmlentities($comment['date']);?></span>
    <br> 
    "<?php echo htmlentities($comment['comment']);?>"
    </p>
  <?php endforeach;?>
  </div>
</div>
<?php $content = ob_get_clean() ?>

<?php include 'templates/layout.tpl.php' ?>
