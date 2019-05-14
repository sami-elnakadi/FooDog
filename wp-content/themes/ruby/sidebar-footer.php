<?php
/**
 * The Sidebar widget area for footer.
 *
 * @package Ruby
 */

	$footer_widget_1 = is_active_sidebar( 'footer-widget-1' );
	$footer_widget_2 = is_active_sidebar( 'footer-widget-2' );
	$footer_widget_3 = is_active_sidebar( 'footer-widget-3' );

	// If footer widget areas do not have widget let's bail.
	if ( ! $footer_widget_1 && ! $footer_widget_2 && ! $footer_widget_3 ) {
		return;
	}

	// If we made it this far we must have widgets.
	?>
	<div class="footer-widget-inner">
		<div class="container">
			<div class="row">
				<aside class="footer-widget-area widget-area">
					<?php if ( $footer_widget_1 ) : ?>
					<div class="col-sm-4 footer-widget" role="complementary">
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					</div><!-- .widget-area .first -->
					<?php endif; ?>

					<?php if ( $footer_widget_2 ) : ?>
					<div class="col-sm-4 footer-widget" role="complementary">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>
					</div><!-- .widget-area .second -->
					<?php endif; ?>

					<?php if ( $footer_widget_3 ) : ?>
					<div class="col-sm-4 footer-widget" role="complementary">
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>
					</div><!-- .widget-area .third -->
					<?php endif; ?>
				</aside><!-- .footer-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .footer-widget-inner -->