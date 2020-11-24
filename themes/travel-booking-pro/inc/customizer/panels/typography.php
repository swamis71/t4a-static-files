<?php
/**
 * Typography Options 
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_panel' ) ) :

	/**
	 * Typography panel
	 */
	function travel_booking_pro_customize_register_typography_panel( $wp_customize ) {
	    
	    $wp_customize->add_panel( 'typography_settings', array(
	        'title'          => __( 'Typography Settings', 'travel-booking-pro' ),
	        'priority'       => 40,
	        'capability'     => 'edit_theme_options',
	    ) );
	    
	}
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_panel' );                                                         