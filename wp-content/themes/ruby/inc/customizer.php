<?php
/**
 * Ruby Theme Customizer
 *
 * @package Ruby
 */

/**
 * Pull all the categories into an array
 */
$ruby_options_categories = array();
$options_categories_obj = get_categories();
foreach ( $options_categories_obj as $category ) {
	$ruby_options_categories[ $category->cat_ID ] = $category->cat_name;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ruby_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'		  => '.site-title a',
		'render_callback' => 'ruby_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'		  => '.site-description',
		'render_callback' => 'ruby_customize_partial_blogdescription',
	) );

	$wp_customize->selective_refresh->add_partial( 'ruby_custom_footer_text', array(
		'selector'		  => '.footer-copyright-text',
		'render_callback' => 'ruby_customize_partial_footer_text',
	) );
}
add_action( 'customize_register', 'ruby_customize_register' );

/**
 * Options for Ruby Theme Customizer.
 */
function ruby_customizer( $wp_customize ) {

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'ruby_social_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_social_color', array(
		'label'			=> __( 'Header Social Icon Color', 'ruby' ),
		'description'	=> sprintf( __( 'Default used if no color is selected', 'ruby' ) ),
		'section'		=> 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_header_bg_color', array(
		'default'			=> '#f9f9f9',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_header_bg_color', array(
		'label'   => __( 'Header Background Color', 'ruby' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_bg_color', array(
		'default'			=> '#fff',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_bg_color', array(
		'label'			=> __( 'Header Menu Background Color', 'ruby'),
		'description'	=> __( 'Default used if no color is selected', 'ruby' ),
		'section'		=> 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_link_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_link_color', array(
		'label'			=> __( 'Header Menu Item Color', 'ruby' ),
		'description'	=> __( 'Link color', 'ruby' ),
		'section'		=> 'colors'
	) ) );

	$wp_customize->add_setting('ruby_nav_item_hover_color', array(
		'default'			=> '#242424',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_item_hover_color', array(
		'label'		  => __( 'Header Menu Item Hover Color', 'ruby' ),
		'description' => __( 'Link Hover color', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_dropdown_bg_color', array(
		'default'			=> '#fff',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_dropdown_bg_color', array(
		'label'		  => __( 'Header Menu Dropdown Background Color', 'ruby' ),
		'description' => __( 'Background of dropdown item hover color', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_dropdown_item_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_dropdown_item_color', array(
		'label'		  => __( 'Header Menu Dropdown Item Color', 'ruby' ),
		'description' => __( 'Dropdown Item Color', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_dropdown_item_hover_color', array(
		'default'			=> '#242424',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_dropdown_item_hover_color', array(
		'label'		  => __( 'Header Menu Dropdown Item Hover Color', 'ruby' ),
		'description' => __( 'Dropdown Item Hover Color', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_nav_dropdown_bg_hover_color', array(
		'default'			=> '#fff',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_nav_dropdown_bg_hover_color', array(
		'label'		  => __( 'Header Menu Dropdown Item Background Hover Color', 'ruby' ),
		'description' => __( 'Background of Dropdown Item Hover Color', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_main_body_typography_color', array(
		'default'			=> '#666',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_main_body_typography_color', array(
		'label'		  => __( 'Body Text Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_heading_color', array(
		'default'			=> '#c3512f',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_heading_color', array(
		'label'		  => __( 'Heading Color', 'ruby' ),
		'description' => __( 'Color for all Headings (h1-h6)', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_link_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_link_color', array(
		'label'		  => __( 'Link Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_link_hover_color', array(
		'default'			=> '#c3512f',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_link_hover_color', array(
		'label'		  => __( 'Link Hover Color', 'ruby'),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_footer_bg_color', array(
		'default'			=> '#242424',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_footer_bg_color', array(
		'label'   => __( 'Footer Background Color', 'ruby' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_footer_text_color', array(
		'default'			=> '#999',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_footer_text_color', array(
		'label'   => __( 'Footer Text Color', 'ruby' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_footer_link_color', array(
		'default'			=> '#dadada',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_footer_link_color', array(
		'label'   => __( 'Footer Link Color', 'ruby' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_social_footer_color', array(
		'default'			=> '#dadada',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_social_footer_color', array(
		'label'	      => __( 'Footer Social Icon Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'     => 'colors'
	) ) );

	$wp_customize->add_setting( 'ruby_cfa_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_cfa_color', array(
		'label'		  => __( 'Call For Action Text Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors',
	) ) );

	$wp_customize->add_setting( 'ruby_cfa_bg_color', array(
		'default'			=> '#fff',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_cfa_bg_color', array(
		'label'		  => __( 'Call For Action Background Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors',
	) ) );

	$wp_customize->add_setting( 'ruby_cfa_btn_border_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_cfa_btn_border_color', array(
		'label'		  => __( 'Call For Action Button Border Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors',
	) ) );

	$wp_customize->add_setting( 'ruby_cfa_btn_txt_color', array(
		'default'			=> '#808080',
		'sanitize_callback' => 'ruby_sanitize_hexcolor'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ruby_cfa_btn_txt_color', array(
		'label'		  => __( 'Call For Action Button Text Color', 'ruby' ),
		'description' => __( 'Default used if no color is selected', 'ruby' ),
		'section'	  => 'colors',
	) ) );

/**
 * Ruby Main Options Settings Panel
 */
$wp_customize->add_panel( 'ruby_main_options', array(
	'capability'  => 'edit_theme_options',
	'title'		  => __( 'Ruby Options', 'ruby' ),
	'description' => __( 'Panel to update ruby theme options', 'ruby' ), // Include html tags such as <p>.
	'priority'	  => 10 // Mixed with top-level-section hierarchy.
) );

	/**
	 * Ruby Header Options
	 */
	$wp_customize->add_section( 'ruby_header_options', array(
		'priority'    => 30,
		'title'	      => __( 'Header', 'ruby' ),
		'description' => __( 'This section configures theme header.', 'ruby' ),
		'panel'       => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_header_show', array(
		'default'			=> 'header-both',
		'sanitize_callback' => 'ruby_sanitize_radio_header'
	) );

	$wp_customize->add_control( 'ruby_header_show', array(
		'type'    => 'radio',
		'label'   => __( 'Show', 'ruby' ),
		'section' => 'ruby_header_options',
		'choices' => array(
			'header-logo'  => __( 'Header Logo Only', 'ruby' ),
			'header-text'  => __( 'Header Text Only', 'ruby' ),
			'header-both'  => __( 'Display Both', 'ruby' ),
			'disable-both' => __( 'Disable', 'ruby' )
		)
	) );

	$wp_customize->add_setting( 'ruby_left_header_text', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_strip_slashes'
	) );

	$wp_customize->add_control( 'ruby_left_header_text', array(
		'label'   => __( 'Left Header Text', 'ruby' ),
		'section' => 'ruby_header_options',
		'type'    => 'text'
	) );

	$wp_customize->add_setting( 'ruby_right_header_text', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_strip_slashes'
	) );

	$wp_customize->add_control( 'ruby_right_header_text', array(
		'label'   => __( 'Right Header Text', 'ruby' ),
		'section' => 'ruby_header_options',
		'type'    => 'text'
	) );

	$wp_customize->add_setting( 'ruby_fixed_navigation', array(
		'default'	    => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_fixed_navigation', array(
		'label'     => __( 'Make header nav menu fixed?', 'ruby' ),
		'section'   => 'ruby_header_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_social_icons_in_header', array(
		'default'			=> 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_social_icons_in_header', array(
		'label'     => __( 'Show social icons in the top header?', 'ruby' ),
		'section'   => 'ruby_header_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_woo_cart_in_menu', array(
		'default'			=> 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_woo_cart_in_menu', array(
		'label'     => __( 'Show woocommerce cart in nav menu?', 'ruby' ),
		'section'   => 'ruby_header_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_search_form_in_header', array(
		'default'			=> 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_search_form_in_header', array(
		'label'     => __( 'Show search form in the nav menu?', 'ruby' ),
		'section'   => 'ruby_header_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_logo_in_menu', array(
		'default'			=> 'site-title',
		'sanitize_callback' => 'ruby_sanitize_radio_logo',
	) );

	$wp_customize->add_control( 'ruby_logo_in_menu', array(
		'label'    => __( 'Display logo or site title in header nav menu.', 'ruby' ),
		'section'  => 'ruby_header_options',
		'settings' => 'ruby_logo_in_menu',
		'priority' => 10,
		'type'     => 'radio',
		'choices'  => array(
			'logo'	     => __( 'Show logo in nav menu', 'ruby' ),
			'site-title' => __( 'Show site title in nav menu', 'ruby' ),
			'none'	     => __( 'Hide logo and site title in nav menu', 'ruby' ),
		),
	) );

	/**
	 * Ruby Footer Options
	 */
	$wp_customize->add_section( 'ruby_footer_options', array(
		'title'    => __( 'Footer', 'ruby' ),
		'priority' => 31,
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_custom_footer_text', array(
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_strip_slashes'
	) );

	$wp_customize->add_control( 'ruby_custom_footer_text', array(
		'label'	      => __( 'Footer information', 'ruby' ),
		'description' => __( 'Copyright text in footer', 'ruby' ),
		'section'     => 'ruby_footer_options',
		'type'        => 'text'
	) );

	/* Add setting for scroll to top button toggle */
	$wp_customize->add_setting( 'ruby_scroll_to_top', array(
		'default'	    => 1,
		'transport'	    => 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_scroll_to_top', array(
		'label'     => __( 'Show scroll to top?', 'ruby' ),
		'section'   => 'ruby_footer_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_show_footer_social_icons', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_show_footer_social_icons', array(
		'label'     => __( 'Show footer social icons?', 'ruby' ),
		'section'   => 'ruby_footer_options',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	/**
	 * Ruby Typography Options
	 */
	$wp_customize->add_section( 'ruby_typography_options', array(
		'title'    => __( 'Typography', 'ruby' ),
		'priority' => 32,
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_main_body_typography_size', array(
		'default'	    => '14px',
		'transport'	    => 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_typo_size'
	) );

	$wp_customize->add_control( 'ruby_main_body_typography_size', array(
		'label'   => __( 'Body Text Size', 'ruby' ),
		'section' => 'ruby_typography_options',
		'type'    => 'select',
		'choices' => array(
				'6px'  => __( '6px', 'ruby' ),
				'10px' => __( '12px', 'ruby' ),
				'12px' => __( '12px', 'ruby' ),
				'14px' => __( '14px', 'ruby' ),
				'15px' => __( '15px', 'ruby' ),
				'16px' => __( '16px', 'ruby' ),
				'18px' => __( '18px', 'ruby' ),
				'20px' => __( '20px', 'ruby' ),
				'24px' => __( '24px', 'ruby' ),
				'28px' => __( '28px', 'ruby' ),
				'32px' => __( '32px', 'ruby' ),
				'36px' => __( '36px', 'ruby' ),
				'42px' => __( '42px', 'ruby' ),
				'48px' => __( '48px', 'ruby' )
		)
	) );

	$wp_customize->add_setting( 'ruby_main_body_typography_face', array(
		'default'	    => 'Roboto, sans-serif',
		'transport'	    => 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_typo_face'
	) );

	$wp_customize->add_control( 'ruby_main_body_typography_face', array(
		'label'   => __( 'Body Text Font', 'ruby' ),
		'section' => 'ruby_typography_options',
		'type'    => 'select',
		'choices' => array(
			'Roboto, sans-serif'=> __( 'Roboto, sans-serif', 'ruby' ),
			'Arial'				=> __( 'Arial', 'ruby' ),
			'Verdana, Geneva'   => __( 'Verdana, Geneva', 'ruby' ),
			'Trebuchet'			=> __( 'Trebuchet', 'ruby' ),
			'Georgia'			=> __( 'Georgia', 'ruby' ),
			'Times New Roman'   => __( 'Times New Roman', 'ruby' ),
			'Tahoma, Geneva'    => __( 'Tahoma, Geneva', 'ruby' ),
			'Open Sans'			=> __( 'Open Sans', 'ruby' ),
			'Palatino'			=> __( 'Palatino', 'ruby' ),
			'Helvetica'			=> __( 'Helvetica', 'ruby' ),
			'Helvetica Neue, Helvetica, Arial, sans-serif' => __( 'Helvetica Neue, Helvetica, Arial, sans-serif', 'ruby' )
			)
	) );

	$wp_customize->add_setting( 'ruby_main_body_typography_style', array(
		'default'	        => 'normal',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_typo_style'
	) );

	$wp_customize->add_control ('ruby_main_body_typography_style', array(
		'label'      => __( 'Body Text Style', 'ruby' ),
		'section'    => 'ruby_typography_options',
		'type'       => 'select',
		'choices'    => array(
			'normal' => __( 'Normal', 'ruby' ),
			'bold'   => __( 'Bold', 'ruby' )
			)
	) );

	/**
	 * Ruby Content Options
	 */
	$wp_customize->add_section( 'ruby_content_section' , array(
		'title'      => __( 'Content Options', 'ruby' ),
		'priority'   => 33,
		'panel'      => 'ruby_main_options'
	) );

	/* Add setting for excerpts/full posts toggle */
	$wp_customize->add_setting( 'ruby_excerpts', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_excerpts', array(
		'label'     => __( 'Show post excerpts?', 'ruby' ),
		'section'   => 'ruby_content_section',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_excerpts_length', array(
		'default'           => 65,
		'sanitize_callback' => 'ruby_sanitize_excerpt_length'
	) );

	$wp_customize->add_control( 'ruby_excerpts_length', array(
		'label'    => __( 'Post Excerpt Length', 'ruby' ),
		'section'  => 'ruby_content_section',
		'priority' => 10,
		'type'     => 'select',
		'choices'  => array(
			'15'  => __( '15', 'ruby' ),
			'25'  => __( '25', 'ruby' ),
			'35'  => __( '35', 'ruby' ),
			'45'  => __( '45', 'ruby' ),
			'55'  => __( '55', 'ruby' ),
			'65'  => __( '65', 'ruby' ),
			'75'  => __( '75', 'ruby' ),
			'85'  => __( '85', 'ruby' ),
			'95'  => __( '95', 'ruby' ),
			'105' => __( '105', 'ruby' ),
			'115' => __( '115', 'ruby' ),
			'125' => __( '125', 'ruby' ),
			'135' => __( '135', 'ruby' ),
			'145' => __( '145', 'ruby' )
		)
	) );

	$wp_customize->add_setting( 'ruby_page_comments', array(
		'default'			=> 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ruby_page_comments', array(
		'label'    => __( 'Display Comments on Static Pages?', 'ruby' ),
		'section'  => 'ruby_content_section',
		'priority' => 20,
		'type'     => 'checkbox',
	) );

	/**
	 * Ruby Layout Options
	 */
	$wp_customize->add_section( 'ruby_layout_options', array(
		'priority' => 34,
		'title'    => __( 'Layout Options', 'ruby' ),
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_default_site_layout', array(
		'default'			=> 'wide-layout',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_radio_layout'
	) );

	$wp_customize->add_control( new Ruby_Layout_Picker_Custom_Control( $wp_customize, 'ruby_default_site_layout', array(
		'description' => __( 'This will set the default site layout style.', 'ruby' ),
		'section'     => 'ruby_layout_options',
		'type'        => 'radio-image',
		'settings'    => 'ruby_default_site_layout',
		'choices'     => array(
			'wide-layout'  => __( 'Wide Layout', 'ruby' ),
			'boxed-layout' => __( 'Boxed Layout', 'ruby' )
		)
	) ) );

	$wp_customize->add_setting( 'ruby_default_layout', array(
		'default'			=> 'right-sidebar',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'ruby_sanitize_radio_layout'
	) );

	$wp_customize->add_control( new Ruby_Layout_Picker_Custom_Control( $wp_customize, 'ruby_default_layout', array(
		'description' => __( 'This will set the default sidebar layout style. However, you can choose different layout for each page via page editor', 'ruby' ),
		'section'     => 'ruby_layout_options',
		'type'        => 'radio-image',
		'settings'    => 'ruby_default_layout',
		'choices'     => array(
			'right-sidebar'		=> __( 'Right Sidebar', 'ruby' ),
			'left-sidebar'		=> __( 'Left Sidebar', 'ruby' ),
			'no-sidebar'		=> __( 'No Sidebar', 'ruby' ),
			'no-sidebar-full-width' => __( 'No Sidebar, Full Width', 'ruby' )
		)
	) ) );

	/**
	 * Ruby Slider Options
	 */
	$wp_customize->add_section( 'ruby_slider_options', array(
		'title'    => __('Slider options', 'ruby' ),
		'priority' => 36,
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_slider_checkbox', array(
		'default'			=> 0,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_slider_checkbox', array(
		'label'    => __( 'Check if you want to enable slider', 'ruby' ),
		'section'  => 'ruby_slider_options',
		'priority' => 5,
		'type'     => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_slider_categories', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_slidecat'
	) );

	global $ruby_options_categories;
	$wp_customize->add_control( 'ruby_slider_categories', array(
		'label'       => __( 'Slider Category', 'ruby' ),
		'section'     => 'ruby_slider_options',
		'type'        => 'select',
		'description' => __( 'Select a category for the featured post slider', 'ruby' ),
		'choices'     => $ruby_options_categories
	) );

	$wp_customize->add_setting( 'ruby_slider_orderby', array(
		'default'			=> 'date',
		'sanitize_callback' => 'ruby_sanitize_slide_orderby'
	) );

	$wp_customize->add_control( 'ruby_slider_orderby', array(
		'label'       => __( 'Slider Order', 'ruby' ),
		'section'     => 'ruby_slider_options',
		'type'        => 'select',
		'description' => __( 'Select a post order for the slider', 'ruby' ),
		'choices'     => array(
			'date'		=> __( 'date', 'ruby' ),
			'ID'		=> __( 'ID', 'ruby' ),
			'author'	=> __( 'author', 'ruby' ),
			'title'		=> __( 'title', 'ruby' ),
			'name'		=> __( 'name', 'ruby' ),
			'modified'	=> __( 'modified', 'ruby' ),
			'rand'		=> __( 'rand', 'ruby' ),
			'comment_count'	=> __( 'comment_count', 'ruby' ),
			'menu_order'	=> __( 'menu_order', 'ruby' )
		)
	) );

	$wp_customize->add_setting( 'ruby_slider_order', array(
		'default'			=> 'DESC',
		'sanitize_callback' => 'ruby_sanitize_slide_order'
	) );

	$wp_customize->add_control( 'ruby_slider_order', array(
		'section'  => 'ruby_slider_options',
		'type'     => 'select',
		'choices'  => array(
			'ASC'  => __( 'ASC', 'ruby' ),
			'DESC' => __( 'DESC', 'ruby' )
		)
	) );

	$wp_customize->add_setting( 'ruby_slider_number', array(
		'default'			=> 3,
		'sanitize_callback' => 'ruby_sanitize_number'
	) );

	$wp_customize->add_control( 'ruby_slider_number', array(
		'label'       => __( 'Number of slide items', 'ruby' ),
		'section'     => 'ruby_slider_options',
		'description' => __( 'Enter the number of slide items', 'ruby' ),
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_slider_use_pages', array(
		'default'           => 0,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_slider_use_pages', array(
		'label'       => __( 'Use pages for the slider?', 'ruby' ),
		'description' => __( 'Use slider_link in the page custom field', 'ruby' ),
		'section'     => 'ruby_slider_options',
		'type'        => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_slider_hide_text', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_slider_hide_text', array(
		'label'     => __( 'Show slider text?', 'ruby' ),
		'section'   => 'ruby_slider_options',
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_slider_home_page', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_slider_home_page', array(
		'label'     => __( 'Show slider only on home page?', 'ruby' ),
		'section'   => 'ruby_slider_options',
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_slider_exclude_post', array(
		'default'           => 0,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_slider_exclude_post', array(
		'label'     => __( 'Hide slider posts from posts listings pages?', 'ruby' ),
		'section'   => 'ruby_slider_options',
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_hide_slider_cat', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_hide_slider_cat', array(
		'label'     => __( 'Hide slider category on posts?', 'ruby' ),
		'section'   => 'ruby_slider_options',
		'type'      => 'checkbox'
	) );

	/**
	 * Ruby Action Options
	 */
	$wp_customize->add_section( 'ruby_action_options', array(
		'title'    => __( 'Action Buttons', 'ruby' ),
		'priority' => 37,
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_cfa_text', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_strip_slashes'
	) );

	$wp_customize->add_control( 'ruby_cfa_text', array(
		'label'       => __( 'Header CFA Text', 'ruby' ),
		'description' => __( 'Enter the text for Call For Action section', 'ruby' ),
		'section'     => 'ruby_action_options',
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_cfa_button', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_nohtml'
	) );

	$wp_customize->add_control( 'ruby_cfa_button', array(
		'label'       => __( 'Header CFA Button Text', 'ruby' ),
		'section'     => 'ruby_action_options',
		'description' => __( 'Enter the text for Call For Action button', 'ruby' ),
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_cfa_link', array(
		'default'			=> '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( 'ruby_cfa_link', array(
		'label'       => __( 'Header CFA Button Link', 'ruby' ),
		'section'     => 'ruby_action_options',
		'description' => __( 'Enter the link for Call For Action button', 'ruby' ),
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_cfa_home_page', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_cfa_home_page', array(
		'label'     => __( 'Show header CFA only on home page?', 'ruby' ),
		'section'   => 'ruby_action_options',
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'ruby_footer_cfa_text', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_strip_slashes'
	));

	$wp_customize->add_control( 'ruby_footer_cfa_text', array(
		'label'       => __( 'Footer CFA Text', 'ruby' ),
		'description' => __( 'Enter the text for Call For Action section', 'ruby' ),
		'section'     => 'ruby_action_options',
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_footer_cfa_button', array(
		'default'			=> '',
		'sanitize_callback' => 'ruby_sanitize_nohtml'
	) );

	$wp_customize->add_control( 'ruby_footer_cfa_button', array(
		'label'       => __( 'Footer CFA Button Title', 'ruby' ),
		'section'     => 'ruby_action_options',
		'description' => __( 'Enter the text for Call For Action button', 'ruby' ),
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_footer_cfa_link', array(
		'default'			=> '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( 'ruby_footer_cfa_link', array(
		'label'       => __( 'Footer CFA Button Link', 'ruby' ),
		'section'     => 'ruby_action_options',
		'description' => __( 'Enter the link for Call For Action button', 'ruby' ),
		'type'        => 'text'
	) );

	$wp_customize->add_setting( 'ruby_footer_cfa_home_page', array(
		'default'           => 1,
		'sanitize_callback' => 'ruby_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'ruby_footer_cfa_home_page', array(
		'label'     => __( 'Show footer CFA only on home page?', 'ruby' ),
		'section'   => 'ruby_action_options',
		'type'      => 'checkbox'
	) );

	/**
	 * Ruby Home Page Options
	 */
	$wp_customize->add_section( 'ruby_home_page_options', array(
		'priority' => 38,
		'title'    => __( 'Home Page Options', 'ruby' ),
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_front_page_category', array(
		'default'			=> array(),
		'sanitize_callback' => 'ruby_sanitize_multiselect'
	) );

	$wp_customize->add_control( new ruby_Customize_Control_Multi_Select_Category( $wp_customize, 'ruby_front_page_category', array(
		'description' => __( 'You may select multiple categories by holding down the CTRL (Windows) or cmd (Mac).', 'ruby' ),
		'section'     => 'ruby_home_page_options',
		'priority'    => 10,
		'type'        => 'multi-select-cat'
	) ) );

	/**
	 * Ruby Important Links Options
	 */
	$wp_customize->add_section( 'ruby_important_links', array(
		'priority' => 5,
		'title'    => __( 'Support and Documentation', 'ruby' ),
		'panel'    => 'ruby_main_options'
	) );

	$wp_customize->add_setting( 'ruby_imp_links', array(
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new Ruby_Important_Links( $wp_customize, 'ruby_imp_links', array(
		'section' => 'ruby_important_links',
		'type'    => 'ruby-important-links'
	) ) );

}
add_action( 'customize_register', 'ruby_customizer' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ruby_customize_preview_js() {
	wp_enqueue_script( 'ruby-customizer', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'ruby_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function ruby_customize_controls_js() {
	wp_enqueue_script( 'ruby-customizer-controls', trailingslashit( get_template_directory_uri() ) . 'js/customizer-controls.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'ruby-customizer-style', trailingslashit( get_template_directory_uri() ) . 'css/customizer-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'ruby_customize_controls_js' );

/**
 * Adds sanitization callback function: colors
 * @package ruby
 */
function ruby_sanitize_hexcolor( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
		return '#' . $unhashed;
	}
	return $color;
}

/**
 * Adds sanitization callback function: text
 * @package ruby
 */
function ruby_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Number
 * @package ruby
 */
function ruby_sanitize_number( $input ) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Adds sanitization callback function: Slider Category
 * @package ruby
 */
function ruby_sanitize_slidecat( $input ) {
	global $ruby_options_categories;
	if ( array_key_exists( $input, $ruby_options_categories ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Slider Order by
 * @package ruby
 */
function ruby_sanitize_slide_orderby( $input ) {
	$orderby = array(
			'date'		=> 'date',
			'ID'		=> 'ID',
			'author'	=> 'author',
			'title'		=> 'title',
			'name'		=> 'name',
			'modified'	=> 'modified',
			'rand'		=> 'rand',
			'comment_count' => 'comment_count',
			'menu_order'	=> 'menu_order'
		    );
	if ( array_key_exists( $input, $orderby ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Slider Order
 * @package ruby
 */
function ruby_sanitize_slide_order( $input ) {
	$order = array(
			'ASC'  => 'ASC',
			'DESC' => 'DESC'
		);
	if ( array_key_exists( $input, $order ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package ruby
 */
function ruby_sanitize_strip_slashes( $input ) {
	return wp_kses_stripslashes( $input );
}

/**
 * Adds sanitization callback function: Nohtml
 * @package ruby
 */
function ruby_sanitize_nohtml( $input ) {
	return wp_filter_nohtml_kses( $input );
}

/**
 * Sanitzies checkbox for WordPress customizer
 */
function ruby_sanitize_checkbox( $input ) {
	$output = ( $input ) ? 1 : 0;
	return $output;
}

/**
 * Adds sanitization callback function: Radio Logo
 * @package ruby
 */
function ruby_sanitize_radio_logo( $input ) {
	if ( array_key_exists( $input, array(
				'logo'	     => 'Show logo in nav menu',
				'site-title' => 'Show site title in nav menu',
				'none'	     => 'Hide logo and site title in nav menu' ) ) ) {
		return $input;
	} else {
		return '';
	}
}


/**
 * Adds sanitization callback function: Radio Header
 * @package ruby
 */
function ruby_sanitize_radio_header( $input ) {
	if ( array_key_exists( $input, array(
				'header-logo'  => 'Header Logo Only',
				'header-text'  => 'Header Text Only',
				'header-both'  => 'Display Both',
				'disable-both' => 'Disable' ) ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Radio Layout
 * @package ruby
 */
function ruby_sanitize_radio_layout( $input ) {
	if ( array_key_exists( $input, array(
			'no-sidebar' 		=> 'No Sidebar',
			'no-sidebar-full-width' => 'No Sidebar, Full Width',
			'left-sidebar' 		=> 'Left Sidebar',
			'right-sidebar' 	=> 'Right Sidebar',
			'wide-layout' 		=> 'Wide Layout',
			'boxed-layout'		=> 'Boxed Layout') ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Multiple Checkbox
 * @package ruby
 */
function ruby_sanitize_multiple_checkbox( $values ) {
	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
	return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Adds sanitization callback function: Multiselect
 * @package ruby
 */
function ruby_sanitize_multiselect( $values ) {
	$multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
	return ! empty( $multi_values ) ? array_map( 'ruby_sanitize_text', $multi_values ) : array();
}

/**
 * Adds sanitization callback function: Typography Size
 * @package ruby
 */
function ruby_sanitize_typo_size( $input ) {
	if ( array_key_exists( $input, array(
				'6px'  => '6px',
				'10px' => '10px',
				'12px' => '12px',
				'14px' => '14px',
				'15px' => '15px',
				'16px' => '16px',
				'18px' => '18px',
				'20px' => '20px',
				'24px' => '24px',
				'28px' => '28px',
				'32px' => '32px',
				'36px' => '36px',
				'42px' => '42px',
				'48px' => '48px' ) ) ) {
		return $input;
	} else {
		return '14px';
	}
}

/**
 * Adds sanitization callback function: Typography Face
 * @package ruby
 */
function ruby_sanitize_typo_face( $input ) {
	if ( array_key_exists( $input, array(
				'Roboto, sans-serif' => 'Roboto, sans-serif',
				'Arial'			  => 'Arial',
				'Verdana, Geneva' => 'Verdana, Geneva',
				'Trebuchet'		  => 'Trebuchet',
				'georgia'	      => 'Georgia',
				'Times New Roman' => 'Times New Roman',
				'Tahoma, Geneva'  => 'Tahoma, Geneva',
				'Open Sans'	      => 'Open Sans',
				'Palatino'	      => 'Palatino',
				'Helvetica'	      => 'Helvetica',
				'Helvetica Neue, Helvetica, Arial, sans-serif' => 'Helvetica Neue, Helvetica, Arial, sans-serif'
				) ) ) {
		return $input;
	} else {
		return 'Roboto, sans-serif';
	}
}

/**
 * Adds sanitization callback function: Excerpt Length
 * @package ruby
 */
function ruby_sanitize_excerpt_length( $input ) {
	if ( array_key_exists( $input, array(
					'15'  => '15',
					'25'  => '25',
					'35'  => '35',
					'45'  => '45',
					'55'  => '55',
					'65'  => '65',
					'75'  => '75',
					'85'  => '85',
					'95'  => '95',
					'105' => '105',
					'115' => '115',
					'125' => '125',
					'135' => '135',
					'145' => '145'
				) ) ) {
		return $input;
	} else {
		return '55';
	}
}

/**
 * Adds sanitization callback function: Typography Style
 * @package ruby
 */
function ruby_sanitize_typo_style( $input ) {
	if ( array_key_exists( $input, array( 'normal' => 'Normal','bold' => 'Bold' ) ) ) {
		return $input;
	} else {
		return 'normal';
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @see ruby_customize_register()
 *
 * @return void
 */
function ruby_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see ruby_customize_register()
 *
 * @return void
 */
function ruby_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site footer copyright text for the selective refresh partial.
 *
 * @see ruby_customize_register()
 *
 * @return void
 */
function ruby_customize_partial_footer_text() {
	echo wp_kses_post( do_shortcode( get_theme_mod( 'ruby_custom_footer_text', get_bloginfo( 'name', 'display' ) . ' - &copy; ' . date_i18n( __( 'Y', 'ruby' ) ) . __( '. All Rights Reserved.&lrm;', 'ruby' ) ) ) );
}


if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Class to create a Ruby important links
	 */
	class Ruby_Important_Links extends WP_Customize_Control {

		public $type = "ruby-important-links";

		public function render_content() { ?>

			<div class="inside">
				<p><b><a href="<?php echo esc_url( 'http://freewptp.com/themes/ruby/' ); ?>" target="_blank"><?php esc_html_e('Ruby Theme Documentation','ruby'); ?></a></b></p>
				<p><?php _e( 'If you have <b>support questions</b> then best way to contact us is via', 'ruby' ) ?> <a href="<?php echo esc_url( 'http://freewptp.com/forums/' ); ?>" target="_blank"><?php esc_html_e('Free WP TP support forum','ruby') ?></a>.</p>
				<p><?php esc_html_e( 'If you like this theme, we\'d appreciate any of the following:', 'ruby' ) ?></p>
				<ul>
					<li><a class="button" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/ruby' ); ?>" target="_blank"><?php printf( esc_html__( 'Rate this Theme', 'ruby' ) ); ?></a></li>
					<li><a class="button" href="<?php echo esc_url( 'https://www.facebook.com/freewptp/' ); ?>" target="_blank"><?php printf( esc_html__( 'Like on Facebook', 'ruby' ) ); ?></a></li>
					<li><a class="button" href="<?php echo esc_url( 'https://twitter.com/freewptp/' ); ?>" target="_blank"><?php printf( esc_html__( 'Follow on Twitter', 'ruby' ) ); ?></a></li>
				</ul>
			</div><?php
		}

	}


	/**
	 * Multi Select category customize control class.
	 *
	 * @access public
	 */
	class ruby_Customize_Control_Multi_Select_Category extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @access public
		 * @var    string
		 */
		public $type = 'multi-select-cat';

		/**
		 * Displays the control content.
		 *
		 * @access public
		 * @return void
		 */
		public function render_content() { ?>

			<label for="frontpage_posts_cats"><b><?php esc_html_e( 'Home Page Posts Categories:', 'ruby' ); ?></b></label>
			<small><?php esc_html_e( 'Only posts that belong to the categories selected here will be displayed on the front page.', 'ruby' ); ?></small><br><br><?php

			$options = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

			<select <?php $this->link(); ?> name="ruby_theme_options[front_page_category][]" id="frontpage_posts_cats" multiple="multiple" class="select-multiple" style="width: 100%;">
				<option value="0" <?php if ( empty( $options ) ) { selected( true, true ); } ?>><?php esc_html_e( '--Disabled--', 'ruby' ); ?></option><?php

				$categories = get_categories();
				foreach ( $categories as $category) :?>
				<option value="<?php echo esc_attr( $category->cat_ID ); ?>" <?php if ( in_array( $category->cat_ID, $options, true ) ) { echo 'selected="selected"'; }?>><?php echo esc_html( $category->cat_name ); ?></option><?php
				endforeach; ?>
			</select><br />

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		<?php
		}
	}


	/**
	 * Class to create a custom layout control
	 */
	class Ruby_Layout_Picker_Custom_Control extends WP_Customize_Control {

		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'radio-image';

		/**
		 * Render the control to be displayed in the Customizer.
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}

			$name = $this->id;
			$images = array(
				'no-sidebar' 		=> trailingslashit( get_template_directory_uri() ) . 'images/no-sidebar.png',
				'no-sidebar-full-width' => trailingslashit( get_template_directory_uri() ) . 'images/no-sidebar-fullwidth.png',
				'left-sidebar' 		=> trailingslashit( get_template_directory_uri() ) . 'images/left-sidebar.png',
				'right-sidebar'		=> trailingslashit( get_template_directory_uri() ) . 'images/right-sidebar.png',
				'wide-layout'		=> trailingslashit( get_template_directory_uri() ) . 'images/wide-layout.png',
				'boxed-layout'		=> trailingslashit( get_template_directory_uri() ) . 'images/boxed-layout.png'
			)?>

			<span class="customize-control-title">
				<?php echo $this->label; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</span>
			<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
				 <?php foreach ( $this->choices as $value => $label ) : ?>
				<label for="<?php echo esc_attr( $this->id . '[' . $value . ']' ); ?>">
							<img src="<?php echo esc_url( $images[ $value ] ); ?>" alt="<?php echo esc_attr( $value ); ?>" >
							<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $this->id . '[' . $value . ']' ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<span class='radio-text'><?php echo esc_html( $label ); ?></span>
						</label>
				 <?php endforeach; ?>
			</div><?php
		}
	}

	/**
	 * Class to create a multiple checkbox control
	 */
	class Ruby_Multiple_Checkbox_Control extends WP_Customize_Control {

		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'checkbox-multiple';

		/**
		 * Render the control to be displayed in the Customizer.
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			?>

			<span class="customize-control-title">
				<?php echo $this->label; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			</span>
			<?php $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

			<ul>
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
							<?php echo esc_html( $label ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		<?php
		}
	}
}
