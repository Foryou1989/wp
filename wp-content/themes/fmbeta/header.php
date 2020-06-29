<!DOCTYPE html>
<html>
<head>
<title>
<?php yzipi_title();?>
</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
<?php
if (is_home()) {
  $description = get_option('yzipi_descriptions');
   $keywords = get_option('yzipi_keywords');
}
elseif (is_single()) {
   $description1 = get_post_meta($post->ID, "description", true);
   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
 
   $description = $description1 ? $description1 : $description2;
   
   $keywords = get_post_meta($post->ID, "keywords", true);
   if($keywords == '') {
      $tags = wp_get_post_tags($post->ID);    
      foreach ($tags as $tag ) {        
         $keywords = $keywords . $tag->name . ", ";    
      }
      $keywords = rtrim($keywords, ', ');
   }
}
elseif (is_page()) {
   $description1 = get_post_meta($post->ID, "description", true);
   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
 
   $description = $description1 ? $description1 : $description2;
   
   $keywords = get_post_meta($post->ID, "keywords", true);
   if($keywords == '') {
      $tags = wp_get_post_tags($post->ID);    
      foreach ($tags as $tag ) {        
         $keywords = $keywords . $tag->name . ", ";    
      }
      $keywords = rtrim($keywords, ', ');
   }
}
elseif (is_category()) {
   $description = single_cat_title('', false);
   $keywords = category_description();
}
elseif (is_tag()){
   $description = tag_description();
   $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<?php yzipi_sc(); wp_head(); ?>
</head>
<body>
<header class="header-web">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" title="<?php bloginfo('name'); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>Logo"></a>
    <ul class="nav-list">
    <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'top-menu')); ?>     
    </ul>
    <form id="search-form" method="get" class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
    <input class="text" type="text" name="s" placeholder="请输入..." value="<?php the_search_query(); ?>">   
    <input class="butto" value="搜索" type="submit">
    </form>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>
</header>
<!--header-web-->