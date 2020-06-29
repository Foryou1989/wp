<?php
/*
Template Name: 搜索页
*/
?>
<?php get_header(); ?>
<div id="container-page">
<?php get_sidebar(); ?>
  <article class="box">
 <h2 class="searchtitle">搜索关键字：
    <?php
  /* Search Count */ 
  $allsearch = new WP_Query("s=$s&showposts=-1");
  $key = wp_specialchars($s, 1);
  $count = $allsearch->post_count;
  echo '<font color="#f37800">' . $key . '</font>，';
  echo '搜索到 <font color="#f37800">' . $count . ' </font>条结果';
  wp_reset_query(); ?>
  </h2>
<?php include 'loop.php';?> 
</div>
<?php get_footer(); ?>
