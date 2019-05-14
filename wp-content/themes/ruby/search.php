<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Ruby
 */

get_header(); ?>

<div id="primary" class="content-area <?php echo ruby_primary_content_bootstrap_classes(); ?>">
	<main id="main" class="site-main" role="main">

	<?php
	if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'ruby' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );

		endwhile;

		ruby_the_posts_pagination();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php

ruby_get_sidebar();

get_footer();
