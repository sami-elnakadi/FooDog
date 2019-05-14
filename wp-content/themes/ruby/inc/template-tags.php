<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ruby
 */

if ( ! function_exists( 'ruby_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ruby_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'ruby' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'ruby' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'ruby_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ruby_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$hide_slider_cat = get_theme_mod( 'ruby_hide_slider_cat', 1 );
		if ( $hide_slider_cat ) {
			add_filter('get_the_terms', 'ruby_exclude_slider_cat');
		}
		$categories_list = get_the_category_list( esc_html__( ', ', 'ruby' ) );
		if ( $hide_slider_cat ) {
			remove_filter('get_the_terms', 'ruby_exclude_slider_cat');
		}
		if ( $categories_list && ruby_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ruby' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ruby' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ruby' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ruby' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'ruby' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'ruby_categorized_blog' ) ) {
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ruby_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'ruby_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ruby_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ruby_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ruby_categorized_blog should return false.
		return false;
	}
}
}

/**
 * Flush out the transients used in ruby_categorized_blog.
 */
function ruby_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ruby_categories' );
}
add_action( 'edit_category', 'ruby_category_transient_flusher' );
add_action( 'save_post', 'ruby_category_transient_flusher' );


if ( ! function_exists( 'ruby_single_content' ) ) {
/**
 * Displays content for single post or page
 */
function ruby_single_content() {

	the_content();

	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'ruby' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ruby' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) );
}
}


if ( ! function_exists( 'ruby_archive_content' ) ) {
/**
 * Displays content for archive page like search, category, tags etc.
 */
function ruby_archive_content() {

	if ( get_theme_mod( 'ruby_excerpts', 1 ) ) {
		add_filter( 'excerpt_length', 'ruby_custom_excerpt_length', 999 );
		the_excerpt(); ?>
		<p><a class="read-more" href="<?php the_permalink(); ?>" ><?php esc_html_e( 'Read More', 'ruby' ); ?></a></p>
		<?php remove_filter( 'excerpt_length', 'ruby_custom_excerpt_length', 999 );
	} else {

		the_content( sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Read More', 'ruby' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );
	}

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ruby' ),
		'after'  => '</div>',
	) );
}
}

if ( ! function_exists( 'ruby_the_posts_pagination' ) ) {
/**
 * Handles posts pagination
 */
function ruby_the_posts_pagination() {

	if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'infinite-scroll' ) ) {
		if ( function_exists('wp_pagenavi') ) {
			wp_pagenavi();
		} else {
			the_posts_pagination( array(
				'prev_text' => '<i class="fa fa-chevron-left"></i> ' . __( 'Newer posts', 'ruby' ),
				'next_text' => __( 'Older posts', 'ruby' ) . ' <i class="fa fa-chevron-right"></i>'
			) );
		}
	}
}
}

if ( ! function_exists( 'ruby_the_post_pagination' ) ) {
/**
 * Handles single post pagination
 */
function ruby_the_post_pagination() {

	the_post_navigation(array(
		'prev_text' => '<i class="fa fa-chevron-left"></i> %title',
		'next_text' => '%title <i class="fa fa-chevron-right"></i>'
	));
}
}