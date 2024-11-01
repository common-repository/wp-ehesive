<?php

/**
 * eHESIVE
 *
 *
 * @link              https://www.ehesive.com/
 * @since             1.0.4
 * @package           Wp_Ehesive
 * @license           GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       eHESIVE
 * Plugin URI:        https://www.ehesive.com/
 * Description:       eHESIVE is where Advertisements stick and marketing campaigns reach targeted viewers beyond that of regional boundaries. 
 * Version:           1.0.4
 * Author:            eHesive
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-ehesive
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WP_EHESIVE_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-ehesive-activator.php
 */
function activate_wp_ehesive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-ehesive-activator.php';
	Wp_Ehesive_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-ehesive-deactivator.php
 */
function deactivate_wp_ehesive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-ehesive-deactivator.php';
	Wp_Ehesive_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_ehesive' );
register_deactivation_hook( __FILE__, 'deactivate_wp_ehesive' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-ehesive.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_ehesive() {

	$plugin = new Wp_Ehesive();
	$plugin->run();

}
run_wp_ehesive();