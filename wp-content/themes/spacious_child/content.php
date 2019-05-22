<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_sticky() && is_home() ) : ?>
			<i class="fa fa-thumb-tack" aria-hidden="true"></i>
		<?php
		endif;

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php ruby_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php echo do_shortcode("[pt_view id=121f795ft7]"); ?>
	
	<footer class="entry-footer">
		<?php ruby_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
