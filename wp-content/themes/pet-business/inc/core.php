<?php
/**
 * Core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Pet Business 1.0.0
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Pet Business 1.0.0
 */
function pet_business_get_theme_options() {
  $pet_business_default_options = pet_business_get_default_theme_options();

  return array_merge( $pet_business_default_options , get_theme_mod( 'pet_business_theme_options', $pet_business_default_options ) ) ;
}

/**
 * Load admin custom styles
 * 
 */
function pet_business_load_admin_style() {
    wp_register_style( 'pet_business_admin_css', get_template_directory_uri() . '/assets/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'pet_business_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'pet_business_load_admin_style' );

/**
 * Add breadcrumb functions.
 */
require get_template_directory() . '/inc/breadcrumb-class.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/sections/sections.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';


/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

if ( class_exists( 'CatchThemesDemoImportPlugin' ) ) {
    /**
    * CT plugin demo importer compatibility.
    */
    require get_template_directory() . '/inc/demo-import.php';
}

/**
* Download webfonts locally.
*/
require get_template_directory() . '/inc/wptt-webfont-loader.php';

if ( class_exists( 'WooCommerce' ) ) {
    /**
     * Woocommerce
     */
    require get_template_directory() . '/inc/woocommerce.php';
}