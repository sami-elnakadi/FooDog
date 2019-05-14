<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

get_header(); ?>

<div id="primary" class="content-area <?php echo ruby_primary_content_bootstrap_classes(); ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( get_theme_mod( 'ruby_page_comments', 1 ) ) :
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php

ruby_get_sidebar();

get_footer();
