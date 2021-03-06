<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package  WellThemes
 * @file     content-single.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( wt_get_option( 'wt_show_post_nav' ) == 1 ) { ?>
			<div class="post-nav">
				<?php previous_post_link( '<div class="prev"><div class="wrap">%link</div></div>', '%title' ); ?>
				<?php next_post_link( '<div class="next"><div class="wrap">%link</div></div>', '%title' ); ?>
			</div>
		<?php } ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">			
			<span class="date"><?php the_time('F j, Y'); ?> </span>
			<span class="author"><?php the_author_posts_link(); ?></span>
			<span class="category"><?php the_category(', ' ); ?></span>
			<?php if ( comments_open() ) : ?>
				<span class="comments"><?php comments_popup_link( __('No comments', 'wellthemes'), __( '1 comment', 'wellthemes'), __('% comments', 'wellthemes')); ?></span>		
			<?php endif; ?>	
		</div><!-- /entry-meta -->		
	</header><!-- /entry-header -->
	
	<div class="entry-content">	
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'wellthemes' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- /entry-content -->

	<footer class="entry-footer">
		
		<div class="entry-tags">
			<?php the_tags('' , ''); ?> 
		</div>
		
	</footer><!-- /entry-footer -->
	
</article><!-- /post-<?php the_ID(); ?> -->

<?php //if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : ?>
		<?php if ( wt_get_option( 'wt_show_author_info' ) == 1 ) { ?>
			<div class="entry-author">	
				<h3 class="title"><?php printf( __( 'About %s', 'wellthemes' ), get_the_author() ); ?></h3>
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
				</div><!-- /author-avatar -->				
				<div class="author-description">					
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wellthemes' ), get_the_author() ); ?>
						</a>
					</div><!-- /author-link	-->
				</div><!-- /author-description -->
			</div><!-- /author-info -->
		
		<?php } //endif; ?>
			
		<?php
			if ( wt_get_option( 'wt_show_related_posts' ) == 1 ) { 
				get_template_part( 'includes/related-posts' );
			}
		?>
