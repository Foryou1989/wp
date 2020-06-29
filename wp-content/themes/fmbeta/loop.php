   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
      
   <section class="list">
   
       <h2 class="<?php if ( has_post_thumbnail() ) { ?> mecctitle<?php } else {?>mucctitle<?php } ?> ">
	   
	   
	   <a href="<?php the_permalink() ?>" target="_blank">
      <?php the_title();  ?>
      </a> </h2>
	  
     <?php if ( has_post_thumbnail() ) { ?>
  <span class="titleimg "> <a href="<?php the_permalink() ?>" target="_blank">
  <?php the_post_thumbnail('thumbnail'); ?>
  </a>
  
   </span>
  <?php } else {?>
  <?php } ?>
   
    <time  class="<?php if ( has_post_thumbnail() ) { ?> <?php } else {?>tebe<?php } ?>">
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
