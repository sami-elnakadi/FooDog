<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ruby
 */

get_header(); ?>

<div id="primary" class="content-area <?php echo ruby_primary_content_bootstrap_classes(); ?>">
	<main id="main" class="site-main" role="main">

	<?php echo do_shortcode("[pt_view id=121f795ft7]"); ?>
	<b>Featured posts</b>
	<?php echo do_shortcode("[pt_view id=1d17acfe2a]"); ?>
	<b>Latest posts</b>
	<?php echo do_shortcode("[pt_view id=8fb4cb7yts]"); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php

ruby_get_sidebar();

get_footer();
