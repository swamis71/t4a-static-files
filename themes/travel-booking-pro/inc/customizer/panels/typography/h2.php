<?php
/**
 * H2 Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h2' ) ) :

    /**
     * Content H2 font options
     */
    function travel_booking_pro_customize_register_typography_h2( $wp_customize ) {
        
        /** H2 Typography Settings */
        $wp_customize->add_section( 'h2_section', array(
            'title'      => __( 'H2 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 24,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H2 Font */
        $wp_customize->add_setting( 'h2_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h2_font', 
                array(
            		'label'   => __( 'H2 Font', 'travel-booking-pro' ),
            		'section' => 'h2_section',		
            	) 
             ) 
        );
        
        /** H2 Font Size */
        $wp_customize->add_setting( 'h2_font_size', array(
            'default'           => 40,
            'sanitize_callback' => 'travel_agency_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h2_font_size',
    			array(
    				'section' => 'h2_section',
    				'label'	  => __( 'H2 Font Size', 'travel-booking-pro' ),
    				'choices' => array(
    					'min' 	=> 20,
    					'max' 	=> 70,
    					'step'	=> 1,
    				)
    			)
    		)
    	);        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h2' );