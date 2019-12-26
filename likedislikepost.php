<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              I
 * @since             1.0.0
 * @package           Likedislikepost
 *
 * @wordpress-plugin
 * Plugin Name:       likeDislikePost
 * Plugin URI:        google.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            I
 * Author URI:        I
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       likedislikepost
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LIKEDISLIKEPOST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-likedislikepost-activator.php
 */
function activate_likedislikepost() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-likedislikepost-activator.php';
	Likedislikepost_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-likedislikepost-deactivator.php
 */
function deactivate_likedislikepost() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-likedislikepost-deactivator.php';
	Likedislikepost_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_likedislikepost' );
register_deactivation_hook( __FILE__, 'deactivate_likedislikepost' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-likedislikepost.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_likedislikepost() {

	$plugin = new Likedislikepost();
	$plugin->run();

}
run_likedislikepost();
