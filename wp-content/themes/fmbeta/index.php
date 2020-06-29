<?php get_header(); ?>
<div id="container-page" class="clearfix">

  <?php get_sidebar(); ?>
  <article class="box">
   <?php if (is_home ()&&!is_paged() )
{?>
<!--幻灯片-->
<div class="hmFocus">
<div class="swiper-container autoImg">
    <div class="swiper-wrapper">
              <div class="swiper-slide"> <a href="<?php echo get_option('gardenl_huan2s'); ?>"target="_blank"><img src="<?php echo get_option('gardenl_huan1s'); ?>" 　alt=""></a></div>
		      <div class="swiper-slide">  <a href="<?php echo get_option('gardenl_huan4s'); ?>" target="_blank"><img src="<?php echo get_option('gardenl_huan3s'); ?>" alt=""></a></div>
			  <div class="swiper-slide">  <a href="<?php echo get_option('gardenl_huan5s'); ?>" target="_blank"><img src="<?php echo get_option('gardenl_huan5s'); ?>" alt=""></a></div>
    </div>
    <div class="swiper-pagination"></div>
</div>
</div>
<script language="javascript">
var swiper = new Swiper('.hmFocus .swiper-container', {
	pagination: '.swiper-pagination',
	loop: true,
	autoplay: 5500,
	paginationClickable: true
});
</script>

	
	 <?php } ?>
      <?php 

	  if (have_posts()) : while (have_posts()) : the_post(); ?>
      
   <section class="list">
   
       <h2 class="<?php if ( has_post_thumbnail() ) { ?> mecctitle<?php } else {?>mucctitle<?php } ?>  ">
	   
	   
	   <a href="<?php the_permalink() ?>" target="_blank">
      <?php the_title();  ?>
      </a> </h2>
	  
     <?php if ( has_post_thumbnail() ) { ?>
  <span class="titleimg"> <a href="<?php the_permalink() ?>" target="_blank">
  <?php the_post_thumbnail('thumbnail'); ?>
  </a>
 
   </span>
  <?php } else {?>
  <?php } ?>
   
    <time  class="<?php if ( has_post_thumbnail() ) { ?> <?php } else {?>tebe<?php } ?> ">
    <?php the_time('Y.m.d');?>
		 <?php if ( in_category( '132' )) {  
   echo '&nbsp;<span class="zan">Hot</span>';  
}?> 　		
    </time>

  <div class="<?php if ( has_post_thumbnail() ) { ?> zaiyao<?php } else {?>zuiyao<?php } ?>">
    <?php the_excerpt(); ?>
  </div>
</section>
      <?php endwhile;?>
      <?php endif; ?>
	  
 </article>	  

   <div id="post-read-more">  
    <?php next_posts_link('看更多',''); ?>  
</div>  


</div>
<?php get_footer(); ?>
