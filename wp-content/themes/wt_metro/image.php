<?php
/**
 * The template for displaying image attachments.
 *
 * @package  WellThemes
 * @file     image.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
<?php get_header(); ?>
<section id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>

							<div class="entry-meta">
								<span class="date"><?php the_time('F j, Y'); ?> </span>
								 
								<span class="image-link"><?php _e('Original Image size: ', 'wellthemes'); ?>
									<?php
										$metadata = wp_get_attachment_metadata();
										printf( __( '<a href="%3$s" rel="lightbox">%1$s &times; %2$s</a>', 'wellthemes' ),
											$metadata['width'],
											$metadata['height'],
											esc_url( wp_get_attachment_url() )										
										);
									?>							
								</span>								
							</div><!-- /entry-meta -->

						</header><!-- /entry-header -->

						<div class="entry-content">

							<div class="entry-attachment">
								<div class="attachment">
									<?php
										/**
										* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
										* or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
										*/
										$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
										foreach ( $attachments as $k => $attachment ) {
											if ( $attachment->ID == $post->ID )
												break;
										}
										$k++;
	
										// If there is more than 1 attachment in a gallery
										if ( count( $attachments ) > 1 ) {
											if ( isset( $attachments[ $k ] ) )
												// get the URL of the next image attachment
												$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
											else
												// or get the URL of the first image attachment
												$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
										} else {
												// or, if there's only 1 image, get the URL of the image
												$next_attachment_url = wp_get_attachment_url();
										}
									?>
									
									<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'twentyeleven_attachment_size', 848 );
									echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
									?></a>

									<?php if ( ! empty( $post->post_excerpt ) ) : ?>
									<div class="entry-caption">
										<?php the_excerpt(); ?>
									</div>
									<?php endif; ?>
								</div><!-- /attachment -->

							</div><!-- /entry-attachment -->

							<div class="entry-description">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'wellthemes' ) . '</span>', 'after' => '</div>' ) ); ?>
							</div><!-- /entry-description -->
							

						</div><!-- /entry-content -->
						
						<nav id="nav-single">
							<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous' , 'wellthemes' ) ); ?></span>
							<span class="nav-next"><?php next_image_link( false, __( 'Next &rarr;' , 'wellthemes' ) ); ?></span>
						</nav><!-- /nav-single -->
						
						<div class="image-post-link">
							<a href="<?php echo get_permalink($post->post_parent) ?>" title="<?php printf( __( 'Return to %s', 'wellthemes' ), esc_html( get_the_title($post->post_parent), 1 ) ) ?>" rev="attachment"><?php echo get_the_title($post->post_parent) ?></a>
						</div>
								
						<footer class="entry-footer">
						</footer>
				</article><!-- /post-<?php the_ID(); ?> -->

				<?php if ( wt_get_option( 'wt_show_img_comments' ) == 1 ) { ?>
					<?php comments_template( '', true ); ?>	
				<?php } ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- /content -->	
</section><!-- /primary -->	
<?php get_sidebar('left'); ?>		
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>