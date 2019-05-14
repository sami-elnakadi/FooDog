<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php ruby_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'ruby-featured', array( 'class' => 'featured-image' ) ); ?>
	</div><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php ruby_archive_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ruby_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
