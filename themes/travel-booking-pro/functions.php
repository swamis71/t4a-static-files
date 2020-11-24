<?php
/**
 * Travel Booking Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Booking_Pro
 */

//define theme version
if ( ! defined( 'TRAVEL_BOOKING_PRO_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();	
	define ( 'TRAVEL_BOOKING_PRO_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Custom Post Type
 */
require get_template_directory() . '/inc/cpt/cpt.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/cpt/metabox.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom Functions
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer Custom controls.
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/customizer/partials.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography-functions.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';     

/**
 * Load theme updater
 */
require get_template_directory() . '/updater/theme-updater.php';

/**
 * Performance
*/
require get_template_directory() . '/inc/performance.php';

/**
 * Demo Import
*/
require get_template_directory() . '/inc/import-hooks.php';

if( travel_booking_pro_is_tbt_activated() ){
	/**
	 * Modify filter hooks of WPTEC plugin.
	 */
	require get_template_directory() . '/inc/wptec-filters.php';
}

if ( travel_booking_pro_is_woocommerce_activated() ) :
	/**
	 * Load woocommerce
	 */
	require get_template_directory() . '/inc/woocommerce-functions.php';
endif;
