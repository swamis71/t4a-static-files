<?php
/**
 * Travel Booking Pro Theme Customizer
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_remove_wptec_plugin_controls' ) ) :
    
    /**
     * Remove Controls from WP Travel Engine Complanion plugin
     */
    function travel_booking_pro_customize_register_remove_wptec_plugin_controls( $wp_customize ){

        $wp_customize->remove_control( 'ed_popular_section' );
        $wp_customize->remove_control( 'ed_feature_section' );
        $wp_customize->remove_control( 'ed_deal_section' );
        $wp_customize->remove_control( 'ed_destination_section' );
        $wp_customize->remove_control( 'ed_activities_section' );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_remove_wptec_plugin_controls' );

$travel_booking_pro_panels       = array( 'home', 'about', 'general', 'layout', 'team', 'typography', 'appearance' );
$travel_booking_pro_sections     = array( 'site-identity', 'contact-template', 'testimonial-template', 'single-trip', 'performance', 'footer' );
$travel_booking_pro_sub_sections = array(
    'home'       => array( 'banner', 'search', 'about', 'testimonial', 'blog', 'sort', 'onepage' ),
    'about'      => array( 'team', 'testimonial', 'sort' ),
    'team'       => array( 'core-member', 'our-team' ),
    'general'    => array( 'header', 'post-page', '404-page', 'seo', 'share', 'misc', 'sidebar' ),
    'appearance' => array( 'color-scheme', 'background' ),  
    'layout'     => array( 'general-sidebar-layout', 'header-layout', 'pagination' ),
    'typography' => array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
);

foreach( $travel_booking_pro_sections as $s ){
	require get_template_directory() . '/inc/customizer/sections/' . $s . '.php';
}

foreach( $travel_booking_pro_panels as $p ){
   require get_template_directory() . '/inc/customizer/panels/' . $p . '.php';
}

foreach( $travel_booking_pro_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require get_template_directory() . '/inc/customizer/panels/' . $k . '/' . $w . '.php';
    }
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Reset Theme Options
*/
require get_template_directory() . '/inc/customizer/customizer-reset/customizer-reset.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function travel_booking_pro_customize_preview_js() {
	wp_enqueue_style( 'travel-booking-pro-customizer', get_template_directory_uri() . '/inc/css/customizer.css', array(), TRAVEL_BOOKING_PRO_THEME_VERSION );
    custom_enqueue_script( 'travel-booking-pro-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview', 'customize-selective-refresh' ), '20151215', true );
}
add_action( 'customize_preview_init', 'travel_booking_pro_customize_preview_js' );

function travel_booking_pro_customizer_scripts() {

    wp_enqueue_style( 'travel-booking-pro-customize-css',get_template_directory_uri().'/inc/css/customize.css', TRAVEL_BOOKING_PRO_THEME_VERSION, 'screen' );
    custom_enqueue_script( 'travel-booking-pro-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), '20170404', true );

    $about_page_url   = travel_booking_pro_get_template_page_url( 'templates/about.php', 'page' );
    $contact_page_url = travel_booking_pro_get_template_page_url( 'templates/contact.php', 'page' );
    $team_page_url    = travel_booking_pro_get_template_page_url( 'templates/team.php', 'page' );
    $testimonial_page_url    = travel_booking_pro_get_template_page_url( 'templates/testimonial.php', 'page' );

    $array = array(
        'url1' => $about_page_url,
        'url2' => $contact_page_url,
        'url3' => $team_page_url,
        'url4' => $testimonial_page_url,
    );

    wp_localize_script( 'travel-booking-pro-customize', 'tb_customizer_data', $array );

}
add_action( 'customize_controls_enqueue_scripts', 'travel_booking_pro_customizer_scripts' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/section-notice/class-section-notice.php';

$config_customizer = array(
    'recommended_plugins' => array( 
       'travel-booking-toolkit' => array(
            'recommended' => true,
            'description' => sprintf( esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'travel-booking-pro' ), '<strong>Travel Booking Toolkit</strong>' ),
        ),
    ),
    'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'travel-booking-pro' ),
    'install_button_label'      => esc_html__( 'Install and Activate', 'travel-booking-pro' ),
    'activate_button_label'     => esc_html__( 'Activate', 'travel-booking-pro' ),
    'deactivate_button_label'   => esc_html__( 'Deactivate', 'travel-booking-pro' ),
);
Travel_Booking_Customizer_Notice::init( apply_filters( 'travel_booking_customizer_notice_array', $config_customizer ) );

Travel_Booking_Customizer_Section::get_instance();