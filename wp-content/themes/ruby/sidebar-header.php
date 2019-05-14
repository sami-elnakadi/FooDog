<?php
/**
 * The Sidebar widget area for header.
 *
 * @package Ruby
 */

	$header_widget_1 = is_active_sidebar( 'header-widget-1' );
	$header_widget_2 = is_active_sidebar( 'header-widget-2' );
	$header_widget_3 = is_active_sidebar( 'header-widget-3' );

	// If header widget areas do not have widget let's bail.
	if ( ! $header_widget_1 && ! $header_widget_2 && ! $header_widget_3 ) {
		return;
	}

	// If we made it this far we must have widgets.
	?>
	<div class="header-widget-inner widget-area">
		<div class="container">
			<div class="row">
				<aside class="header-widget-area">
					<?php if ( $header_widget_1 ) : ?>
					<div class="col-sm-4 header-widget" role="complementary">
						<?php dynamic_sidebar( 'header-widget-1' ); ?>
					</div><!-- .widget-area .first -->
					<?php endif; ?>

					<?php if ( $header_widget_2 ) : ?>
					<div class="col-sm-4 header-widget" role="complementary">
						<?php dynamic_sidebar( 'header-widget-2' ); ?>
					</div><!-- .widget-area .second -->
					<?php endif; ?>

					<?php if ( $header_widget_3 ) : ?>
					<div class="col-sm-4 header-widget" role="complementary">
						<?php dynamic_sidebar( 'header-widget-3' ); ?>
					</div><!-- .widget-area .third -->
					<?php endif; ?>
				</aside><!-- .header-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .header-widget-inner -->