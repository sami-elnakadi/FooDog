<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="main-content-area">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ruby
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php $site_layout = get_theme_mod( 'ruby_default_site_layout', 'wide-layout' ); ?>
	<div id="page" class="hfeed site <?php if ( 'boxed-layout' === $site_layout ) { echo 'container'; } ?>">
		<?php if ( 'boxed-layout' === $site_layout ) { ?>
			<div class="row">
		<?php } ?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ruby' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php
			$has_social_nav_menu = has_nav_menu( 'social-menu' );
			$social_icons_in_header = get_theme_mod( 'ruby_social_icons_in_header', 1 );
			$has_header_nav_menu = has_nav_menu( 'header' );
		?>
		<?php if ( ( $has_social_nav_menu && $social_icons_in_header ) || $has_header_nav_menu ) {?>
		<div class="header-top-nav">
			<div class="container">
				<div class="row">
					<div class="social-icons col-sm-6">
						<?php if ( $social_icons_in_header ) {
							ruby_social_icons();
						} ?>
					</div><!-- .social-icons -->
					<nav id="top-navigation" class="main-navigation col-sm-6" role="navigation">
						<?php if( $has_header_nav_menu ){
							ruby_top_menu(); // Top navigation
						} ?>
					</nav><!-- #top-navigation -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .header-top-nav -->
		<?php } ?>

			<?php	$header_show = get_theme_mod( 'ruby_header_show', 'header-both' );
			
				$custom_logo = '';
				if ( function_exists( 'get_custom_logo' ) ) {
					$custom_logo = get_custom_logo();
				}

				if ( $header_show != 'disable-both' ){ ?>
					<div class="container logo-wrapper">
						<div class="row">
							<div class="col-xs-12">
								<?php if ( ( $header_show == 'header-logo' || $header_show == 'header-both' ) && $custom_logo != '' ) { ?>
									<div id="logo">
										<?php echo $custom_logo; ?>
									</div><!-- end of #logo -->
								<?php }

								if ( $header_show == 'header-text' || $header_show == 'header-both' ) { ?>
									<div class="site-branding">
										<?php if ( is_front_page() && is_home() ) : ?>
											<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php else : ?>
											<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php endif;
										$description = get_bloginfo( 'description', 'display' );
										if ( $description || is_customize_preview() ) : ?>
											<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
										<?php
										endif; ?>
									</div><!-- .site-branding -->
								<?php
								} else { ?>
									<h1 class="site-title screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
								<?php } ?>
							</div><!-- .col-xs-12 -->
						</div><!-- .row -->
					</div>
				<?php
				}
				$left_header_text = get_theme_mod( 'ruby_left_header_text', '' );
				$right_header_text = get_theme_mod( 'ruby_right_header_text', '' );

				if ( $left_header_text != '' || $right_header_text != '' ) { ?>
					<div class="header-text-wrapper">
						<div class="container">
							<div class="row">
								<div class="col-sm-6">
									<div class="left-header-text header-text">
										<?php echo wp_kses_post( do_shortcode( $left_header_text ) ); ?>
									</div>
								</div><!-- .left-header-tex -->
								<div class="col-sm-6">
									<div class="right-header-text header-text">
										<?php echo wp_kses_post( do_shortcode( $right_header_text ) ); ?>
									</div><!-- .right-header-tex -->
								</div>
							</div><!-- .row -->
						</div><!-- .container -->
					</div><!-- .header-text-wrapper -->
				<?php }

			if ( has_custom_header() ) :?>
				<div class="header-img-wrapper">
					<?php the_custom_header_markup(); ?>
				</div><!-- .header-img-wrapper -->
			<?php endif;
			$fixed_navigation = get_theme_mod( 'ruby_fixed_navigation', 1 );
			?>
			<div class="header-nav-wrapper <?php if ( $fixed_navigation ){ echo 'm-fix'; } ?>">
				<div class="container">
					<div class="row">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<button id="menu-toggle" class="menu-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse"><?php _e( 'Menu', 'ruby' ); ?></button>
							<?php
							$logo_in_menu = get_theme_mod( 'ruby_logo_in_menu', 'logo' );
							if ( $logo_in_menu != 'none' ){ ?>
								<div class="col-sm-2">
									<?php if ( $logo_in_menu == 'logo' ) {
											if ( $custom_logo != '' ) {
												echo $custom_logo;
											}
										}
										if ( $logo_in_menu == 'site-title' ) { ?>
											<a class="logo-site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									<?php	} ?>
								</div>
								<div class="col-sm-10">
							<?php } else { ?>
								<div class="col-sm-12">
							<?php }
								ruby_header_menu();// Main navigation
							?>
								</div>
						</nav><!-- #site-navigation -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .header-nav-wrapper -->

		<?php ruby_header_slider(); ?>
		<?php ruby_call_for_action( 'header' ); ?>

 	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
		<?php get_sidebar( 'header' ); ?>

		<div class="container main-content-area">

			    <?php if ( function_exists( 'bcn_display' ) ) { ?>
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
						<?php bcn_display(); ?>
					</div>
			    <?php } ?>

				<div class="row">