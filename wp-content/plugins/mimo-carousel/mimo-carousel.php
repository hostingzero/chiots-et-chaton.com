<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://mimo.media
 * @since             1.0.0
 * @package           Mimo_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Mimo Carousel
 * Plugin URI:        http://mimo.studio
 * Description:       Create custom Carousels for your posts and custom taxonomies
 * Version:           1.3.5
 * Author:            mimothemes
 * Author URI:        http://mimo.studio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mimo-carousel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mimo-carousel-activator.php
 */
function activate_mimo_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimo-carousel-activator.php';
	Mimo_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mimo-carousel-deactivator.php
 */
function deactivate_mimo_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimo-carousel-deactivator.php';
	Mimo_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mimo_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_mimo_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mimo-carousel.php';

/*Mimp The addons inclusions */

if( ! class_exists('Taxonomy_Core') ) require_once( plugin_dir_path( __FILE__ ) . 'includes/Taxonomy_Core/Taxonomy_Core.php' );
if( ! class_exists('CPT_Core') ) require_once( plugin_dir_path( __FILE__ ) . 'includes/CPT_Core/CPT_Core.php' );
if( ! class_exists('CMB2') ) require_once( plugin_dir_path( __FILE__ ) . '/includes/CMB2/init.php' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/widgets/mimo-widget-carousel.php' );
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mimo_carousel() {

	$plugin = new Mimo_Carousel();
	$plugin->run();

}
run_mimo_carousel();
