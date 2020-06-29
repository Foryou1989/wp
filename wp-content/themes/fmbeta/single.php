
<?php get_header(); ?>
<div id="container-page">
 <?php get_sidebar(); ?>
  <article class="box">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <h1 class="singletitle">
        <?php the_title(); ?>
      </h1>
<p class="p2">
        <?php the_time('Y.m.d'); ?> - <?php echo get_post_meta($post->ID,"author",true);?>
       	 <?php if ( in_category( '132' )) {  
   echo '&nbsp;<span class="zan">Hot</span>';  
}?> 
        </p>

    <div class="content-text">
      <?php the_content(); ?>
	  <?php if (in_category('47'))
{?><blockquote>


<dl class="zhuan">
<dt><img src="<?php bloginfo('template_directory'); ?>/images/zhuan.jpg"></dt>
<dd><strong><span style="color: #d7633e;">作者：卖砖头的小女孩</span></strong>，男扮女装，Web前端开发攻城狮，Adobe认证设计师，互联网运营策划师，国家指定低保低收入人士。曾就职于某易，之后一直堕落，现网上终日行乞……</dd>

</dl>
</blockquote> <?php
} else {?><?php } ?>
	   
	   <p style="text-align: center;"><strong>- END -</strong></p>
	   
	   <div class="bdf">
	   <div class="yue"><?php post_views(' ', ' '); ?></div>
	      <div class="post-like">
         <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>"><span class="count">
            <?php if( get_post_meta($post->ID,'bigfa_ding',true) ){            
                    echo get_post_meta($post->ID,'bigfa_ding',true);
                 } else {
                    echo '0';
                 }?></span>
        </a>
    </div>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/zan.js'></script>
</div>
	</div>
    <!--content_text-->
    <?php endwhile;?>
    <?php endif; ?>
	
					 <div class="comment" id="comments">
      <?php comments_template(); ?>
    </div>	
	
	    <div class="xianguan">

       <?php $rand_posts = get_posts('numberposts=1&orderby=rand');
foreach( $rand_posts as $post ) : ?>
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
		<?php endforeach; ?>
     
    </div>
    <!--相关文章-->
  </article>
 </div>
<?php get_footer(); ?>