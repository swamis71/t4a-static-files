<?php
/**
 * Team Page Template Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_team_page_panel' ) ){

    /** 
     * Team Page Template Panel
    */                                       
    function travel_booking_pro_customize_register_team_page_panel( $wp_customize ) {

        /** Team Page Template Settings */
        $wp_customize->add_panel( 'team_page_setting', array(
            'title'      => __( 'Team Page Template Settings', 'travel-booking-pro' ),
            'priority'   => 80,
            'capability' => 'edit_theme_options',
        ) );
          
    }
}
add_action( 'customize_register', 'travel_booking_pro_customize_register_team_page_panel' );