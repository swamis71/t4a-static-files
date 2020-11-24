<?php
/**
 * H3 Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h3' ) ) :

    /**
     * Content H3 font options
     */
    function travel_booking_pro_customize_register_typography_h3( $wp_customize ) {
        
        /** H3 Typography Settings */
        $wp_customize->add_section( 'h3_section', array(
            'title'      => __( 'H3 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 25,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H3 Font */
        $wp_customize->add_setting( 'h3_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h3_font', 
                array(
            		'label'   => __( 'H3 Font', 'travel-booking-pro' ),
            		'section' => 'h3_section',		
            	) 
             ) 
        );
            
        /** H3 Font Size */
        $wp_customize->add_setting( 'h3_font_size', array(
            'default'           => 20,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h3_font_size',
    			array(
    				'section' => 'h3_section',
    				'label'	  => __( 'H3 Font Size', 'travel-booking-pro' ),
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
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h3' );