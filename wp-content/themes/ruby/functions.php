<?php
/**
 * Ruby functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ruby
 */

if ( ! function_exists( 'ruby_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ruby_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ruby, use a find and replace
	 * to change 'ruby' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ruby', trailingslashit( get_template_directory() ) . 'languages' );

	if ( is_child_theme() ) {
		load_child_theme_textdomain( 'ruby', trailingslashit( get_stylesheet_directory() ) . 'languages' );
	}

	/**
	 * Adds default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Register new image sizes
	 */
	add_image_size( 'ruby-slider', 1920, 600, true );
	add_image_size( 'ruby-featured', 730, 400, true );
	add_image_size( 'ruby-single-featured', 1110, 600, true );

	/**
	 * Registers navigation menus
	 */
	register_nav_menus( array(
		'header'      => esc_html__( 'Top Header Menu', 'ruby' ),
		'primary'     => esc_html__( 'Primary Menu', 'ruby' ),
		'footer'      => esc_html__( 'Footer Menu', 'ruby' ),
		'social-menu' => esc_html__( 'Social Menu', 'ruby' )
	) );

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Set up the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'ruby_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );

	/**
	 * Enable support for WooCommerce.
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * Apply theme's stylesheet to the visual editor.
	 */
	add_editor_style( 'css/editor-style.css' );

	/**
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo' );

	/**
	 * Add theme support for selective refresh for widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // ruby_setup
add_action( 'after_setup_theme', 'ruby_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ruby_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ruby_content_width', 640 );
}
add_action( 'after_setup_theme', 'ruby_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ruby_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'ruby' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Displays on the right side of the page', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'ruby' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Displays on the left side of the page', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area 1', 'ruby' ),
		'id'            => 'header-widget-1',
		'description'   => __( 'Displays in the header', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area 2', 'ruby' ),
		'id'            => 'header-widget-2',
		'description'   => __( 'Displays in the header', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area 3', 'ruby' ),
		'id'            => 'header-widget-3',
		'description'   => __( 'Displays in the header', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Widget Area 1', 'ruby' ),
		'id'            => 'home-widget-1',
		'description'   => __( 'Displays on the Home Page', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Widget Area 2', 'ruby' ),
		'id'            => 'home-widget-2',
		'description'   => __( 'Displays on the Home Page', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Widget Area 3', 'ruby' ),
		'id'            => 'home-widget-3',
		'description'   => __( 'Displays on the Home Page', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 1', 'ruby' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Displays in the footer', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 2', 'ruby' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Displays in the footer', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area 3', 'ruby' ),
		'id'            => 'footer-widget-3',
		'description'   => __( 'Displays in the footer', 'ruby' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'ruby_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function ruby_scripts() {

	$deps = array( 'jquery' );

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap.min.css' );

	// Add slider CSS only if the slider is enabled
	if ( get_theme_mod( 'ruby_slider_checkbox', 0 ) && ( get_theme_mod( 'ruby_slider_home_page', 1 ) == 0 || ( is_home() || is_front_page() ) ) ) {
		wp_enqueue_style( 'flexslider', trailingslashit( get_template_directory_uri() ) . 'css/flexslider.min.css' );
	}

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'font-awesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' );

	if ( get_theme_mod( 'ruby_main_body_typography_face', 'Roboto, sans-serif' ) == 'Roboto, sans-serif' ){
		// Add Google Fonts
		wp_enqueue_style( 'ruby-google-fonts', '//fonts.googleapis.com/css?family=Roboto:400,700,700italic,300,400italic,500,300italic,100italic,100,500italic' );
	}

	// Add theme stylesheet
	wp_enqueue_style( 'ruby-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod( 'ruby_slider_checkbox', 0 ) && ( get_theme_mod( 'ruby_slider_home_page', 1 ) == 0 || ( is_home() || is_front_page() ) ) ) {
		// Add slider JS only if the slider is enabled
		wp_enqueue_script( 'flexslider', trailingslashit( get_template_directory_uri() ) . 'js/flexslider.min.js', array( 'jquery' ), '20140222', true );

		array_push( $deps, 'flexslider' );
	}

	// HTML5 Shiv
	wp_enqueue_script( 'html5shiv', trailingslashit( get_template_directory_uri() ) . 'js/html5shiv.min.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Respond js
	wp_enqueue_script( 'respond', trailingslashit( get_template_directory_uri() ) . 'js/respond.min.js' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	// Add custom theme script
	wp_enqueue_script( 'ruby-custom-js', trailingslashit( get_template_directory_uri() ) . 'js/custom.js', $deps, '20120206', true );

	// Add custom inline stylesheet
	$custom_css = '/** ' . get_bloginfo( 'name' ) . ' Custom CSS Styles **/' . "\n";

	$custom_css .= 'body { font-family: ' . esc_attr( get_theme_mod( 'ruby_main_body_typography_face', "Roboto, sans-serif" ) ) . '; font-size:' . esc_attr(  get_theme_mod( 'ruby_main_body_typography_size', '14px' ) ) . '; font-weight: ' . esc_attr(  get_theme_mod( 'ruby_main_body_typography_style', '400' ) ) . '; color:'.esc_attr(  get_theme_mod( 'ruby_main_body_typography_color', '#666' ) ) . ';}';
	$custom_css .= '.site-header { background-color:' . esc_attr(  get_theme_mod( 'ruby_header_bg_color', '#f9f9f9' ) ) . ';}';
	$custom_css .= '.header-top-nav, .header-nav-wrapper, .search-menu .search-form { background-color:' . esc_attr(  get_theme_mod( 'ruby_nav_bg_color', '#fff' ) ) . ';}';
	$custom_css .= '.main-navigation .navbar-nav a, #site-navigation li.dropdown:before, .main-navigation li.menu-item.search-menu { color:' . esc_attr(  get_theme_mod( 'ruby_nav_link_color', '#808080' ) ) . ';}';
	$custom_css .= '.main-navigation ul > li:hover > a, .main-navigation ul > .current_page_item > a, .main-navigation ul > .current-menu-item > a, .main-navigation ul > .current_page_ancestor > a, .main-navigation ul > .current-menu-ancestor > a, .site-header .social-icons ul li a:hover { color:' . esc_attr(  get_theme_mod( 'ruby_nav_item_hover_color', '#242424' ) ) . ';}';
	$custom_css .= '.main-navigation .nav li ul a { background-color:' . esc_attr(  get_theme_mod( 'ruby_nav_dropdown_bg_color', '#fff' ) ) . ';}';
	$custom_css .= '.main-navigation .navbar-nav li ul a { color:' . esc_attr(  get_theme_mod( 'ruby_nav_dropdown_item_color', '#808080' ) ) . ';}';
	$custom_css .= '.main-navigation li ul li:hover > a, .main-navigation li ul .current_page_item > a, .main-navigation li ul .current-menu-item > a, .main-navigation li ul .current_page_ancestor > a, .main-navigation li ul .current-menu-ancestor > a { color:' . esc_attr(  get_theme_mod( 'ruby_nav_dropdown_item_hover_color', '#242424' ) ) . '; background-color:' . esc_attr(  get_theme_mod( 'ruby_nav_dropdown_bg_hover_color', '#fff' ) ) . ';}';
	$custom_css .= 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h2.entry-title a, h3 a, h4 a, h5 a, h6 a { color:' . esc_attr(  get_theme_mod( 'ruby_heading_color', '#c3512f' ) ) . ';}';
	$custom_css .= '.site-content a { color:' . esc_attr(  get_theme_mod( 'ruby_link_color', '#808080' ) ) . ';}';
	$custom_css .= '.site-content a:hover { color:' . esc_attr(  get_theme_mod( 'ruby_link_hover_color', '#c3512f' ) ) . ';}';
	$custom_css .= '.site-header .social-icons ul li a { color:' . esc_attr(  get_theme_mod( 'ruby_social_color', '#808080' ) ) . ';}';
	$custom_css .= '.site-footer { color:' . esc_attr(  get_theme_mod( 'ruby_footer_text_color', '#999' ) ) . ';}';
	$custom_css .= '.site-footer .site-info { background-color:' . esc_attr(  get_theme_mod( 'ruby_footer_bg_color', '#242424' ) ) . '; color:' . esc_attr(  get_theme_mod( 'ruby_footer_text_color', '#999' ) ) . ';}';
	$custom_css .= '.site-footer a { color:' . esc_attr(  get_theme_mod( 'ruby_footer_link_color', '#dadada' ) ) . ';}';
	$custom_css .= '.site-footer .social-icons ul li a { color:' . esc_attr(  get_theme_mod( 'ruby_social_footer_color', '#dadada' ) ) . ';}';
	$custom_css .= '.cfa-text { color:' . esc_attr(  get_theme_mod( 'ruby_cfa_color', '#808080' ) ) . ';}';
	$custom_css .= '.cfa { background:' . esc_attr(  get_theme_mod( 'ruby_cfa_bg_color', '#fff' ) ) . ';}';
	$custom_css .= 'a.cfa-button {  border-color:' . esc_attr(  get_theme_mod( 'ruby_cfa_btn_border_color', '#808080' ) ) . '; color:' . esc_attr(  get_theme_mod( 'ruby_cfa_btn_txt_color', '#808080' ) ) . ';}';

	wp_add_inline_style( 'ruby-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ruby_scripts' );

/**
 * Implement the Custom Header feature.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';

/**
 * Custom template tags for the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Load custom nav walker
 */
require trailingslashit( get_template_directory() ) . 'inc/navwalker.php';

/**
 * Metabox additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/metaboxes.php';



if ( ! function_exists( 'ruby_custom_excerpt_length' ) ) {
/**
 * Sets the post excerpt length.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function ruby_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	$length = absint( get_theme_mod( 'ruby_excerpts_length', $length ) );
	return $length;
}
}

/**
 * Returns a "Continue Reading" link for excerpts
 */
function ruby_continue_reading( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	return '&hellip; ';
}
add_filter( 'excerpt_more', 'ruby_continue_reading' );

if ( ! function_exists( 'ruby_get_sidebar' ) ) {
/**
 * Function to display different set sidebar for the single post, single page, archive page, index page etc.
 */
function ruby_get_sidebar() {

	global $post;
	$layout = '';

	if ( is_singular() && $post ) {
		$layout = get_post_meta( $post->ID, 'ruby_sidebarlayout', true );
	}

	if ( empty( $layout ) || 'default' == $layout ) {
		$layout = get_theme_mod( 'ruby_default_layout', 'right-sidebar' );
	}

	if ( 'left-sidebar' == $layout ) {
		get_sidebar( 'left' );
	} elseif ( 'right-sidebar' == $layout ) {
		get_sidebar();
	}
}
}

/**
 * WooCommerce
 *
 * Unhook/Hook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function ruby_woocommerce_wrapper() { ?>
	<div id="primary" class="content-area <?php echo ruby_primary_content_bootstrap_classes(); ?>">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php }

function ruby_woocommerce_wrapper_end() { ?>
			</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php }

add_action( 'woocommerce_before_main_content', 'ruby_woocommerce_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'ruby_woocommerce_wrapper_end', 10 );
