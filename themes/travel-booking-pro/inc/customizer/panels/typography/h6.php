<?php
/**
 * H6 Typography Options
 *
 * @package Travel_Agency_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h6' ) ) :

    /**
     * Content H5 font options
     */
    function travel_booking_pro_customize_register_typography_h6( $wp_customize ) {
        
        /** H6 Typography Settings */
        $wp_customize->add_section( 'h6_section', array(
            'title'      => __( 'H6 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 28,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H6 Font */
        $wp_customize->add_setting( 'h6_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h6_font', 
                array(
            		'label'   => __( 'H6 Font', 'travel-booking-pro' ),
            		'section' => 'h6_section',		
            	) 
             ) 
        );
        
        /** H6 Font Size */
        $wp_customize->add_setting( 'h6_font_size', array(
            'default'           => 18,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h6_font_size',
    			array(
    				'section' => 'h6_section',
    				'label'	  => __( 'H6 Font Size', 'travel-booking-pro' ),
    				'choices' => array(
    					'min' 	=> 10,
    					'max' 	=> 40,
    					'step'	=> 1,
    				)
    			)
    		)
    	);        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h6' );