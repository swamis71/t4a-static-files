<?php
/**
 * About Page Template Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_about_page_panel' ) ){

    /** 
     * About Page Template Panel
    */                                       
    function travel_booking_pro_customize_register_about_page_panel( $wp_customize ) {

        /** About Page Template Settings */
        $wp_customize->add_panel( 'about_page_setting', array(
            'title'      => __( 'About Page Template Settings', 'travel-booking-pro' ),
            'priority'   => 60,
            'capability' => 'edit_theme_options',
        ) );
          
    }
}
add_action( 'customize_register', 'travel_booking_pro_customize_register_about_page_panel' );