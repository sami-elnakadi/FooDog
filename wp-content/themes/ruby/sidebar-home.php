<?php
/**
 * The Sidebar widget area for home page.
 *
 * @package Ruby
 */

	$home_widget_1 = is_active_sidebar( 'home-widget-1' );
	$home_widget_2 = is_active_sidebar( 'home-widget-2' );
	$home_widget_3 = is_active_sidebar( 'home-widget-3' );

	// If home widget areas do not have widget let's bail.
	if ( ! $home_widget_1 && ! $home_widget_2 && ! $home_widget_3 ) {
		return;
	}

	// If we made it this far we must have widgets.
	?>
	<div class="home-widget-inner">
		<div class="container">
			<div class="row">
				<aside class="home-widget-area widget-area">
					<?php if ( $home_widget_1 ) : ?>
					<div class="col-sm-4 home-widget" role="complementary">
						<?php dynamic_sidebar( 'home-widget-1' ); ?>
					</div><!-- .widget-area .first -->
					<?php endif; ?>

					<?php if ( $home_widget_2 ) : ?>
					<div class="col-sm-4 home-widget" role="complementary">
						<?php dynamic_sidebar( 'home-widget-2' ); ?>
					</div><!-- .widget-area .second -->
					<?php endif; ?>

					<?php if ( $home_widget_3 ) : ?>
					<div class="col-sm-4 home-widget" role="complementary">
						<?php dynamic_sidebar( 'home-widget-3' ); ?>
					</div><!-- .widget-area .third -->
					<?php endif; ?>
				</aside><!-- .home-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .home-widget-inner -->