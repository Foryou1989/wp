<?php

/**
Archive Template:ART
**/

/*
 * Category pages section display - posts with excerpt and thumbs.
 * @package WordPress - Themonic Framework
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 */

get_header(); ?>
<div id="container-page">
 <?php get_sidebar(); ?>
  <article class="box">
   <?php include 'loop.php';?>
</div>
<!--Container End-->
<?php get_footer(); ?>
