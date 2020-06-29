<?php
/*
Template Name: 默认模板
*/
?>
<?php get_header(); ?>
  <article class="box-single">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
      <h1 class="pagetitle"><?php the_title(); ?></h1>

      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <!--content_text-->
    <?php endwhile;?>
    <?php endif; ?>
  </article>
<?php get_footer(); ?>