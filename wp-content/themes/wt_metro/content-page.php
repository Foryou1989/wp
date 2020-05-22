<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package  WellThemes
 * @file     content-page.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( wt_get_option( 'wt_show_page_meta' ) == 1 ){ ?>
			<div class="entry-meta">
				<span class="date"><?php the_time('F j, Y'); ?> </span>
				<?php if ( wt_get_option( 'wt_show_page_comments' ) == 1 ){ ?>
					<span class="comments"><?php comments_popup_link( __('no comments', 'wellthemes'), __( '1 comment', 'wellthemes'), __('% comments', 'wellthemes')); ?></span>
				<?php } ?>			
			</div><!-- /entry-meta -->	
		<?php } ?>			
	</header><!-- /entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'wellthemes' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- /entry-content -->
	
	<footer class="entry-footer">
		
		<div class="entry-tags">
			<?php the_tags('' , ''); ?> 
		</div>
		
		<?php if ( wt_get_option( 'wt_show_page_author_info' ) == 1 ) { ?>
			<div class="entry-author">				
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
				</div><!-- /author-avatar -->				
				<div class="author-description">
					<h4><?php printf( __( 'About %s', 'wellthemes' ), get_the_author() ); ?></h4>
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wellthemes' ), get_the_author() ); ?>
						</a>
					</div><!-- /author-link	-->
				</div><!-- /author-description -->
			</div><!-- /author-info -->
		
		<?php } //endif; ?>
				
	</footer><!-- /entry-footer -->
	<?php if ( wt_get_option( 'wt_show_page_comments' ) == 1 ) { ?>
		<?php comments_template( '', true ); ?>
	<?php } ?>
</article><!-- /post-<?php the_ID(); ?> -->