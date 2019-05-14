<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php ruby_posted_on(); ?>
		</div><!-- .entry-meta -->
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

	<footer class="entry-footer">
		<?php ruby_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
