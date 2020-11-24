<?php
/**
 * Header Layout Settings
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_layout_header' ) ) :
    /**
     * Add header layout controls
     */
    function travel_booking_pro_customize_register_layout_header( $wp_customize ) {

        /** Header Layout Settings */
        $wp_customize->add_section(
            'header_layout_section',
            array(
                'title'    => __( 'Header Layout', 'travel-booking-pro' ),
                'priority' => 10,
                'panel'    => 'layout_settings',
            )
        );
        
        /** Header layout */
        $wp_customize->add_setting( 
            'header_layout', 
            array(
                'default'           => 'one',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Image_Control(
    			$wp_customize,
    			'header_layout',
    			array(
    				'section'	  => 'header_layout_section',
    				'label'		  => __( 'Header Layout', 'travel-booking-pro' ),
    				'description' => __( 'Choose the layout of the header for your site.', 'travel-booking-pro' ),
    				'choices'	  => array(
    					'one'   => get_template_directory_uri() . '/images/layouts/header-one.png',
    					'two'   => get_template_directory_uri() . '/images/layouts/header-two.png',
                        'three' => get_template_directory_uri() . '/images/layouts/header-three.png',
                        'four'  => get_template_directory_uri() . '/images/layouts/header-four.png',
                        'five'  => get_template_directory_uri() . '/images/layouts/header-five.png',
    				)
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_layout_header' );