
<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">　" 马上登录 "　</a> 发表自已的想法!</p>
  
  <?php else : ?>
  
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" >
    <textarea name="comment" id="comment"  rows="3" tabindex="5" placeholder="你有什么要说的 ..." ></textarea>
    <input name="submit" type="submit" id="submit" tabindex="2" value="回复" />
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>

<?php   
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))   
        die ('Please do not load this page directly. Thanks!');   
?>


<?php if ( have_comments() ) : ?>
<ol id="comment">
  <?php wp_list_comments('type=comment&callback=cleanr_theme_comment'); ?>
</ol>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<div id="respond">
<!-- If comments are closed. -->
<p>已关闭回复!</p>
</div>
<?php endif; ?>
<?php endif; ?>