<?php
/**
 * General Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_general_panel' ) ) :

    /**
     * General Panel
     */
    function travel_booking_pro_customize_register_general_panel( $wp_customize ) {
    	
        $wp_customize->add_panel( 'general_settings', array(
            'title'      => __( 'General Settings', 'travel-booking-pro' ),
            'priority'   => 100,
            'capability' => 'edit_theme_options',
        ) );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_panel' );