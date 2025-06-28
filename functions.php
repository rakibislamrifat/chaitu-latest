<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


function create_userinformation_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'userinformation';
    $charset_collate = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        dob DATE NOT NULL,
        address TEXT NOT NULL,
        region VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE
    ) $charset_collate;";
    dbDelta($sql);
}
add_action('after_switch_theme', 'create_userinformation_table');function custom_user_avatar_shortcode() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $avatar = get_avatar( $current_user->ID, 40 ); // 40 is the size
        $profile_url = get_edit_profile_url( $current_user->ID );

        return '<a href="' . esc_url($profile_url) . '">' . $avatar . '</a>';
    } else {
        return '<a href="/login">Login</a> | <a href="/register">Sign Up</a>';
    }
}
add_shortcode('user_avatar', 'custom_user_avatar_shortcode');