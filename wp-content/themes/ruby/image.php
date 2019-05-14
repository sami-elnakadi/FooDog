<?php
/**
 * The template for displaying image attachments
 *
 * @package Ruby
 */

get_header(); ?>

<div id="primary" class="content-area <?php echo ruby_primary_content_bootstrap_classes(); ?>">
	<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<nav id="image-navigation" class="navigation">
				<div class="nav-links">
					<div class="nav-previous"><i class="fa fa-chevron-left"></i> <?php previous_image_link( false, __( 'Previous Image', 'ruby' ) ); ?></div>
					<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'ruby' ) ); ?> <i class="fa fa-chevron-right"></i></div>
				</div><!-- .nav-links -->
			</nav><!-- #image-navigation -->

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">

				<div class="entry-attachment">
					<?php
					/**
					 * Filter the default ruby image attachment size.
					 *
					 * @param string $image_size Image size. Default 'large'.
					 */
					$image_size = apply_filters( 'ruby_attachment_size', 'large' );

					echo wp_get_attachment_image( get_the_ID(), $image_size );

					if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
					<?php endif; ?>
					
				</div><!-- .entry-attachment -->

				<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ruby' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ruby' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php
				// Retrieve attachment metadata.
				$metadata = wp_get_attachment_metadata();
				if ( $metadata ) {
					printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
						esc_html_x( 'Full size', 'Used before full size attachment link.', 'ruby' ),
						esc_url( wp_get_attachment_url() ),
						absint( $metadata['width'] ),
						absint( $metadata['height'] )
					);
				}

				ruby_entry_footer();
				?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->

		<?php
			// Parent post navigation.
			ruby_the_post_pagination();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		// End the loop.
		endwhile;?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php

ruby_get_sidebar();

get_footer();
