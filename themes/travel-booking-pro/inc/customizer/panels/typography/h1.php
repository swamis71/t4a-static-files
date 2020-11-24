<?php
/**
 * H1 Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h1' ) ) :

    /**
     * Content H1 font options
     */
    function travel_booking_pro_customize_register_typography_h1( $wp_customize ) {
        
        /** H1 Typography Settings */
        $wp_customize->add_section( 'h1_section', array(
            'title'      => __( 'H1 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 23,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H1 Font */
        $wp_customize->add_setting( 'h1_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h1_font', 
                array(
            		'label'   => __( 'H1 Font', 'travel-booking-pro' ),
            		'section' => 'h1_section',		
            	) 
             ) 
        );
        
        /** H1 Font Size */
        $wp_customize->add_setting( 'h1_font_size', array(
            'default'           => 38,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h1_font_size',
    			array(
    				'section' => 'h1_section',
    				'label'	  => __( 'H1 Font Size', 'travel-booking-pro' ),
    				'choices' => array(
    					'min' 	=> 25,
    					'max' 	=> 75,
    					'step'	=> 1,
    				)
    			)
    		)
    	);        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h1' );