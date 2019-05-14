<?php
/**
 * Ruby Meta Boxes
 *
 * @package Ruby
 */


/**
 * Add Meta Boxes.
 *
 * Add Meta box in page and post post types.
 */
function ruby_add_custom_box() {

	foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) {
		add_meta_box(
			'siderbar-layout',//Unique ID
			__( 'Select layout for this specific Page only ( Note: This setting only reflects if page Template is set as Default Template and Ruby Type Templates.)', 'ruby' ),//Title
			'ruby_sidebar_layout',//Callback function
			$post_type//show metabox in pages
		);
	}
}
add_action( 'add_meta_boxes', 'ruby_add_custom_box' );

/**
 * Saves sidebar layout options in global variable
 */
global $ruby_sidebar_layout;
$ruby_sidebar_layout = array(
	'default-sidebar' => array(
		'id'        => 'ruby_sidebarlayout',
		'value'     => 'default',
		'label'     => __( 'Default Layout Set in', 'ruby' ) . ' ' . '<a href="' . esc_url( home_url() ) . '/wp-admin/customize.php?return=' . esc_url( home_url() ) . '/wp-admin/themes.php&autofocus[section]=ruby_layout_options" target="_blank">' . esc_html__( 'Theme Settings', 'ruby' ) . '</a>',
		'thumbnail' => ' '
	),
	'no-sidebar' => array(
		'id'        => 'ruby_sidebarlayout',
		'value'     => 'no-sidebar',
		'label'     => __( 'No sidebar', 'ruby' ),
		'thumbnail' => trailingslashit( get_template_directory_uri() ) . 'images/no-sidebar.png'
	),
	'no-sidebar-full-width' => array(
		'id'        => 'ruby_sidebarlayout',
		'value'     => 'no-sidebar-full-width',
		'label'     => __( 'No sidebar, Full Width', 'ruby' ),
		'thumbnail' => trailingslashit( get_template_directory_uri() ) . 'images/no-sidebar-fullwidth.png'
	),
	'left-sidebar' => array(
		'id'        => 'ruby_sidebarlayout',
		'value'     => 'left-sidebar',
		'label'     => __( 'Left sidebar', 'ruby' ),
		'thumbnail' => trailingslashit( get_template_directory_uri() ) . 'images/left-sidebar.png'
	),
	'right-sidebar' => array(
		'id'        => 'ruby_sidebarlayout',
		'value'     => 'right-sidebar',
		'label'     => __( 'Right sidebar', 'ruby' ),
		'thumbnail' => trailingslashit( get_template_directory_uri() ) . 'images/right-sidebar.png'
	)
);


/**
 * Displays metabox for sidebar layout
 */
function ruby_sidebar_layout() {
	global $ruby_sidebar_layout, $post;
	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

	// Begin the field table and loop  ?>
	<table id="sidebar-metabox" class="form-table" width="100%">
		<tbody>
			<tr>
			<?php
			foreach ( $ruby_sidebar_layout as $field ) {
				$meta = get_post_meta( $post->ID, $field['id'], true );
				if ( empty( $meta ) ){
					$meta = 'default';
				}
				if ( ' ' == $field['thumbnail'] ): ?>
					<label class="description">
						<input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
					</label>
				<?php else: ?>
					<td>
						<label class="description">
						<span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" width="136" height="122" alt="" /></span></br>
						<input type="radio" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $meta ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $field['label'] ); ?>
						</label>
					</td>
				<?php endif;
			} // end foreach
			?>
			</tr>
		</tbody>
	</table><!-- #sidebar-metabox -->
	<?php
}


/**
 * Save the custom metabox data
 * @hooked to save_post hook
 */
function ruby_save_custom_meta( $post_id ) {
	global $ruby_sidebar_layout, $post;

	// Verify the nonce before proceeding.
	if ( ! isset( $_POST[ 'custom_meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) ) {
		return;
	}

	// Stop WP from clearing custom fields on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ('page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	foreach ( $ruby_sidebar_layout as $field ) {
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[ $field['id'] ];
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, sanitize_text_field( $field['id'] ), $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	} // end foreach
}
add_action( 'save_post', 'ruby_save_custom_meta' );
