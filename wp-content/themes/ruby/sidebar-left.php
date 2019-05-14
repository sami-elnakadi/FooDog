<?php
/**
 * The left sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ruby
 */
?>
<aside id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">
	<div class="well">
		<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) {
			dynamic_sidebar( 'sidebar-2' );
		} else {
			echo '<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Add widgets in the widget area.', 'ruby' ) . '</a>';
		}
		?>
	</div><!-- .well -->
</aside><!-- #secondary -->
