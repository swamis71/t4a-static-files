<?php
/**
 * H4 Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h4' ) ) :

    /**
     * Content H4 font options
     */
    function travel_booking_pro_customize_register_typography_h4( $wp_customize ) {
        
        /** H4 Typography Settings */
        $wp_customize->add_section( 'h4_section', array(
            'title'      => __( 'H4 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 26,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H4 Font */
        $wp_customize->add_setting( 'h4_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h4_font', 
                array(
            		'label'   => __( 'H4 Font', 'travel-booking-pro' ),
            		'section' => 'h4_section',		
            	) 
             ) 
        );
        
        /** H4 Font Size */
        $wp_customize->add_setting( 'h4_font_size', array(
            'default'           => 18,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h4_font_size',
    			array(
    				'section' => 'h4_section',
    				'label'	  => __( 'H4 Font Size', 'travel-booking-pro' ),
    				'choices' => array(
    					'min' 	=> 10,
    					'max' 	=> 50,
    					'step'	=> 1,
    				)
    			)
    		)
    	);
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h4' );