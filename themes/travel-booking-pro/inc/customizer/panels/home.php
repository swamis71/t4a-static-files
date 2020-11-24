<?php
/**
 * Front Page Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_frontpage_panel' ) ){

    /** 
     * Front Page Panel
    */                                       
    function travel_booking_pro_customize_register_frontpage_panel( $wp_customize ) {

        /** Front Page Settings */
        $wp_customize->add_panel( 'home_page_setting', array(
            'title'      => __( 'Front Page Settings', 'travel-booking-pro' ),
            'priority'   => 50,
            'capability' => 'edit_theme_options',
        ) );
          
    }
}
add_action( 'customize_register', 'travel_booking_pro_customize_register_frontpage_panel' );