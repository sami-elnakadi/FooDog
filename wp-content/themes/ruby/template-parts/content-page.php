<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="post-thumbnail">
		<?php
		$thumbnail_size = 'ruby-featured';

		if ( 'col-sm-12 col-md-12' == ruby_primary_content_bootstrap_classes() ) {
			$thumbnail_size = 'ruby-single-featured';
		}
		the_post_thumbnail( $thumbnail_size, array( 'class' => 'single-featured' ) );
		?>
	</div><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php ruby_single_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'ruby' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
