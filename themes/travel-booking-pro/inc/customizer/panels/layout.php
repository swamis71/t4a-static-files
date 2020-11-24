<?php
/**
 * Layout Panel
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_layout_panel' ) ) :
	
	/**
	 * Add layout panel
	 */
	function travel_booking_pro_customize_register_layout_panel( $wp_customize ) {

	    $wp_customize->add_panel( 'layout_settings', array(
	        'title'          => __( 'Layout Settings', 'travel-booking-pro' ),
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	    ) );
	    
	}
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_layout_panel' );