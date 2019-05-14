<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ruby
 */


if ( ! function_exists( 'ruby_header_slider' ) ) :
/**
 * Featured image slider, displayed in the header
 */
function ruby_header_slider() {
	if ( get_theme_mod( 'ruby_slider_checkbox', 0 ) && ( get_theme_mod( 'ruby_slider_home_page', 1 ) == 0 || ( is_home() || is_front_page() ) ) ) {

		$count = get_theme_mod( 'ruby_slider_number', 3 );
		$slidecat = get_theme_mod( 'ruby_slider_categories', '' );
		$use_pages = get_theme_mod( 'ruby_slider_use_pages', 0 );
		$slide_orderby = get_theme_mod( 'ruby_slider_orderby', 'date' );
		$slide_order = get_theme_mod( 'ruby_slider_order', 'DESC' );

		$args = array( 'posts_per_page' => $count, 'ignore_sticky_posts' => 1, 'orderby' => $slide_orderby, 'order' => $slide_order );

		if ( $use_pages ) {
			$args = array_merge( $args, array( 'post_type' => 'page', 'meta_key' => 'slider_link' ) );
		} else {
			$args = array_merge( $args, array( 'cat' => $slidecat ) );
		}

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) { ?>
			<div class="flexslider">
				<ul class="slides">
				<?php while ( $query->have_posts() ) { $query->the_post();

					$slider_link = get_post_meta( get_the_ID(), 'slider_link', true );
					$slider_link =   ! empty( $slider_link ) ? $slider_link : get_permalink();
					echo '<li>';
					if ( has_post_thumbnail() ) :
						echo '<a href="'. esc_url( $slider_link ) .'">' . get_the_post_thumbnail( get_the_ID(), 'ruby-slider' ) . '</a>';
					endif;

					if ( get_theme_mod( 'ruby_slider_hide_text', 1 ) ) {
						echo '<div class="flex-caption">';
						if ( get_the_title() != '' ) {
							echo '<h2 class="entry-title">'. get_the_title().'</h2>';
						}
						if ( get_the_excerpt() != '' ) {
							echo '<div class="excerpt">' . get_the_excerpt() .'</div>';
						}
						echo '</div>';
					}
					echo '</li>';
				} ?>
				</ul>
			</div>
		<?php
		}
		wp_reset_postdata();
	}
}
endif;

if ( ! function_exists( 'ruby_exclude_slider_cat' ) ) {
/**
 * Exclude slider category from displaying
 */
function ruby_exclude_slider_cat( $terms ) {

	$slidecat = get_theme_mod( 'ruby_slider_categories', '' );
	if ( get_theme_mod( 'ruby_slider_checkbox', 0 ) && $slidecat != '' ) {
		if ( ! empty( $terms ) && is_array( $terms )) {
			foreach ( $terms as $key => $term ) {
				if ( $term->term_id == $slidecat ) {
					unset( $terms[ $key ] );
				}
			}
		}
	}

	return $terms;
}
}

/**
 * Add Bootstrap classes to table
 */
function ruby_add_custom_table_class( $content ) {
	return preg_replace( '/(<table) ?(([^>]*)class="([^"]*)")?/', '$1 $3 class="$4 table table-hover" ', $content );
}
add_filter( 'the_content', 'ruby_add_custom_table_class' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ruby_body_classes( $classes ) {

	global $post;

	if ( is_singular() && $post ) {
		$layout = get_post_meta( $post->ID, 'ruby_sidebarlayout', true );
	}

	if ( empty( $layout ) || $layout == 'default' ) {
		$layout = get_theme_mod( 'ruby_default_layout', 'right-sidebar' );
	}

	switch ( $layout ) {
		case 'left-sidebar':
			$classes[] = 'left-sidebar-template';
			break;
		case 'right-sidebar':
			$classes[] = 'right-sidebar-template';
			break;
		case 'no-sidebar-full-width':
			$classes[] = 'full-width-template';
			break;
		case 'no-sidebar':
			$classes[] = 'no-sidebar-template';
			break;
	}

	if ( is_page_template( 'templates/page-fullwidth.php' ) ) {
		$classes[] = 'full-width-template';
	}

	// Adds a class of group-ruby to rubys with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-ruby';
	}

	return $classes;
}
add_filter( 'body_class', 'ruby_body_classes' );

if ( ! function_exists( 'ruby_primary_content_bootstrap_classes' ) ) {
/**
 * Add Bootstrap classes to the primary content area.
 */
function ruby_primary_content_bootstrap_classes() {

	global $post;
	$layout = '';

	if ( is_singular() && $post ) {
		$layout = get_post_meta( $post->ID, 'ruby_sidebarlayout', true );
	}

	if ( empty( $layout ) || 'default' == $layout ){
		$layout = get_theme_mod( 'ruby_default_layout', 'right-sidebar' );
	}

	if ( is_page_template( 'templates/page-fullwidth.php' ) || 'no-sidebar-full-width' == $layout ) {
		return 'col-sm-12 col-md-12';
	}
	return 'col-sm-12 col-md-8';
}
} // ruby_primary_content_bootstrap_classes


if ( ! function_exists( 'ruby_top_menu' ) ) {
/**
 * Top header menu (should you choose to use one)
 */
function ruby_top_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'theme_location'    => 'header',
		'depth'             => 1,
		'container'         => 'div',
		'container_class'   => 'top-menu-container pull-right',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'Ruby_Bootstrap_Navwalker::fallback',
		'walker'            => new Ruby_Bootstrap_Navwalker()
	));
} /* end header menu */
}

if ( ! function_exists( 'ruby_header_menu' ) ) {
/**
 * Header menu (should you choose to use one)
 */
function ruby_header_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'theme_location'    => 'primary',
		'depth'             => 6,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-toggleable-xs navbar-ex1-collapse',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'Ruby_Bootstrap_Navwalker::fallback',
		'walker'            => new Ruby_Bootstrap_Navwalker()
	));
} /* end header menu */
}

if ( ! function_exists( 'ruby_footer_menu' ) ) {
/**
 * Footer menu (should you choose to use one)
 */
function ruby_footer_menu() {
	// display the WordPress Custom Menu if available
	wp_nav_menu(array(
		'theme_location'    => 'footer',
		'depth'             => 1,
		'container'         => 'div',
		'container_class'   => 'footer-menu-container',
		'menu_class'        => 'nav navbar-nav'
	));
} /* end footer menu */
}

if ( ! function_exists( 'ruby_social_icons' ) ) {
/**
 * Display social links in footer and widgets
 *
 * @package ruby
 */
function ruby_social_icons(){
	if ( has_nav_menu( 'social-menu' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'social-menu',
				'container'       => 'nav',
				'container_class' => 'social-icons',
				'menu_class'      => 'social-menu',
				'depth'           => 1,
				'fallback_cb'     => '',
				'link_before'     => '<i class="social_icon fa"><span>',
				'link_after'      => '</span></i>'
			)
		  );
	}
}
}

/**
 * Place a search icon and a cart icon with number of items and total cost in the menu bar.
 */
function ruby_woomenucart( $menu, $args ) {

	// Check if WooCommerce is active and if active then add a new item to a menu assigned to Primary Navigation Menu location
	if ( ( class_exists( 'WooCommerce' ) || in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) && 'primary' == $args->theme_location && get_theme_mod('ruby_woo_cart_in_menu', 1 ) ){

		global $woocommerce;

		if ( $woocommerce->cart->cart_contents_count ) {
			$menu_item = '<li class="menu-item"><a class="woo-cart-menu" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '">';
		} else {
			$menu_item = '<li class="menu-item"><a class="woo-cart-menu" href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">';
		}

		$menu_item .= '<span class="woocommerce-cart-items">' . $woocommerce->cart->cart_contents_count.' <i class="fa fa-shopping-cart"></i></span> - '. $woocommerce->cart->get_cart_total();
		$menu_item .= '</a></li>';

		$menu .= $menu_item;

	}

	// Adds a serach form to a menu assigned to Primary Navigation Menu location
	if ( 'primary' == $args->theme_location && get_theme_mod( 'ruby_search_form_in_header', 1 ) ) {

		$menu_item = '<li class="menu-item search-menu"><span><i class="fa fa-search"></i></span>';

		$menu_item .= get_search_form( false ) . '</li>';

		$menu .= $menu_item;
	}

	return $menu;

}
add_filter( 'wp_nav_menu_items', 'ruby_woomenucart', 10, 2 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function ruby_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ruby_page_menu_args' );


/**
 * Password protected post form using Boostrap classes
 */
function ruby_boostrap_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">
		<div class="row">
		<div class="col-lg-10">
		<p>' . esc_html__( "This post is password protected. To view it please enter your password below:" ,'ruby' ) . '</p>
		<label for="' . $label . '">' . esc_html__( "Password:" ,'ruby' ) . ' </label>
		<div class="input-group">
		<input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
		<span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="' . esc_attr__( "Submit",'ruby' ) . '">' . esc_html__( "Submit" , 'ruby' ) . '</button>
		</span>
		</div>
		</div>
		</div>
		</form>';
	return $o;
}
add_filter( 'the_password_form', 'ruby_boostrap_password_form' );

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function ruby_caption( $output, $attr, $content ) {
	if ( is_feed() ) {
		return $output;
	}

	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	);

	$attr = shortcode_atts( $defaults, $attr );

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ( $attr['width'] < 1 || empty( $attr['caption'] ) ) {
		return $content;
	}

	// Set up the attributes for the caption <figure>
	$attributes  = ( ! empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
	$attributes .= ' style="width: ' . ( esc_attr( $attr['width'] ) + 10 ) . 'px"';

	$output  = '<figure' . $attributes . '>';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}
add_filter( 'img_caption_shortcode', 'ruby_caption', 10, 3 );

/**
 * Move comment form default fields to bottom.
 */
function ruby_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'ruby_move_comment_field_to_bottom' );


/**
 * Marks Posts/Pages as Untiled when no title is used
 */
function ruby_title( $title ) {
	if ( $title == '' ) {
		return __( 'Untitled:' ,'ruby' );
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'ruby_title' );


/**
 * Customize the PageNavi HTML before it is output to support bootstrap
 */
function ruby_wp_pagenavi_bootstrap_markup( $html ) {
	$out = '';

	//wrap a's and span's in li's
	$out = str_replace( "<div", "", $html );
	$out = str_replace( "class='wp-pagenavi'>", "", $out );
	$out = str_replace( "<a", "<li><a", $out );
	$out = str_replace( "</a>", "</a></li>", $out );
	$out = str_replace( "<span", "<li><span", $out );
	$out = str_replace( "</span>", "</span></li>", $out );
	$out = str_replace( "</div>", "", $out );

	return '<ul class="pagination pagination-centered wp-pagenavi-pagination">' . $out . '</ul>';
}
add_filter( 'wp_pagenavi', 'ruby_wp_pagenavi_bootstrap_markup' );


if ( ! function_exists( 'ruby_scroll_to_top' ) ) {
/**
 * Displays scroll to top button in the footer
 */
function ruby_scroll_to_top() {
	if ( get_theme_mod( 'ruby_scroll_to_top', 1 ) ) { ?>
		<div class="scroll-to-top">
			<i class="fa fa-angle-up"></i>
		</div><!-- .scroll-to-top -->
	<?php }
}
}

/**
 * function to show the footer info, copyright information
 */
function ruby_footer_info() {
	printf( esc_html__( '%1$s Theme Powered by %2$s', 'ruby' ) , '<a href="http://freewptp.com/themes/ruby/" target="_blank">Ruby</a>', '<a href="https://wordpress.org" target="_blank">WordPress</a>' );
}

/**
 * Alter the query for the main loop
 *
 * @uses pre_get_posts hook
 */
function ruby_alter_main_loop( $query ) {

	if ( ! is_admin() && $query->is_main_query() ) {

		$cats = get_theme_mod( 'ruby_front_page_category', array() );

		if ( ! in_array( '0', $cats, true ) ) {
			if ( $query->is_home() ) {
				$query->query_vars['category__in'] = $cats;
			}
		}

		if ( get_theme_mod( 'ruby_slider_checkbox', 0 ) && get_theme_mod( 'ruby_slider_exclude_post', 0 ) ) {
			$slidecat = get_theme_mod( 'ruby_slider_categories', '' );
			if ( $slidecat != '' ) {
				$query->query_vars['category__not_in'] = $slidecat;
			}
		}
	}
}
add_action( 'pre_get_posts','ruby_alter_main_loop' );


if ( ! function_exists( 'ruby_header_call_for_action' ) ) {
/**
 * Displays call for action text and button in the header and footer
 */
function ruby_call_for_action( $location ) {

	 if ( ( get_theme_mod( 'ruby_cfa_home_page', 1 ) && $location == 'header' ) || ( get_theme_mod( 'ruby_footer_cfa_home_page', 1 ) && $location == 'footer' ) ) {
		 if ( ! is_home() || ! is_front_page() ) {
			 return;
		 }
	 }

	$ruby_cfa_text = '';
	$ruby_cfa_button = '';
	$ruby_cfa_link = '';

	if ( $location == 'header' ) {
		$ruby_cfa_text = get_theme_mod( 'ruby_cfa_text', '' );
		$ruby_cfa_button = get_theme_mod( 'ruby_cfa_button', '' );
		$ruby_cfa_link = get_theme_mod( 'ruby_cfa_link', '' );
	} elseif ( $location == 'footer' ) {
		$ruby_cfa_text = get_theme_mod( 'ruby_footer_cfa_text', '' );
		$ruby_cfa_button = get_theme_mod( 'ruby_footer_cfa_button', '' );
		$ruby_cfa_link = get_theme_mod( 'ruby_footer_cfa_link', '' );
	}

	if ( $ruby_cfa_text != '' || $ruby_cfa_button != '' ) {

		echo '<div class="cfa"><div class="container"><div class="row">';

		if ( $ruby_cfa_text != '' ) {
			$has_btn = '';
			if ( $ruby_cfa_button != '' ) {
				$has_btn = 'has-btn';
			}
			echo '<div class="col-sm-8 ' . $has_btn . '">';
			if ( $ruby_cfa_text != '' ) {
				echo '<span class="cfa-text">' . wp_kses_post( $ruby_cfa_text ) . '</span>';
			}
			echo '</div>';
		}

		if ( $ruby_cfa_button != '' ) {

			echo '<div class="col-sm-4">';
			if ( $ruby_cfa_button != '') {
				echo '<a class="btn cfa-button" href="' . esc_url( $ruby_cfa_link ) . '">' . wp_kses_post( $ruby_cfa_button ) . '</a>';
			}
			echo '</div>';
		}
		echo '</div></div></div>';
	}
}
}
