<?php
/**
 * Template for displaying search forms in Ruby
 *
 * @package Ruby
 */
?>

<form role="search" method="get" class="search-form clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'ruby' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'ruby' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<label>
		<span class="fa fa-search"></span>
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'ruby' ); ?>" />
	</label>
</form>
