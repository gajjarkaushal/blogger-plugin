<?php
/**
 * Plugin Name: Blogger Plugin
 * Plugin URI: mail:gajjarkaushal1@gmail.com
 * Description: User will post contents, photo,video, comments
 * Version: 1.0 Beta
 * Author: Kaushal Gajjar
 * Author URI: mail:gajjarkaushal1@gmail.com
 * Developer: Gajjar Kaushal	
 * Developer 
 * Text Domain: wp_blogger
 * Domain Path: /languages
 * Copyright: &copy; 2020-2021 Kaushal Gajjar    
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'WPBLG_NAME','Bloggers' );
define( 'WPBLG_REQUIRED_PHP_VERSION', '5.3' );       // because of get_called_class()
define( 'WPBLG_REQUIRED_WP_VERSION',  '3.1' );       // because of esc_textarea()
define( 'WPBLG_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPBLG_URL', plugin_dir_url( __FILE__ ) );
define( 'WPBLG_TEMPLATES', WPBLG_DIR.'templates/' );
define( 'WPBLG_CLS', WPBLG_DIR.'classes/' );
define( 'WPBLG_INC', WPBLG_DIR.'includes/' );
define( 'WPBLG_VIEW', WPBLG_DIR.'views/' );
define( 'WPBLG_ASSETS',WPBLG_URL.'assets/' );


add_action('plugins_loaded', 'wpblg_plugins_loaded'); 
function wpblg_plugins_loaded() {
	load_plugin_textdomain( 'wp_blogger', false, WPBLG_DIR.'/languages/' );  
}

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
if( !function_exists('wpblg_requirements_check') ){
	function wpblg_requirements_check() {
		global $wp_version;		
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );		// to get is_plugin_active() early	
		if ( version_compare( PHP_VERSION, WPBLG_REQUIRED_PHP_VERSION, '<' ) ) {
			return false;
		}	
		if ( version_compare( $wp_version, WPBLG_REQUIRED_WP_VERSION, '<' ) ) {
			return false;
		}				
		return true;
	}
}
/**
 * Prints an error that the system requirements weren't met.
 */
function wpblg_requirements_error() {
	global $wp_version;
	require_once( WPBLG_VIEW . 'requirements-error.php' );
}

/**
*If the verified PHP version is correct then the Galaxy requirements check() function will be called.
**/
if (wpblg_requirements_check()) {

	require_once( WPBLG_CLS . 'wpblg_init.php' );

}else{
	add_action( 'admin_notices', 'wpblg_requirements_error' );
}
?>