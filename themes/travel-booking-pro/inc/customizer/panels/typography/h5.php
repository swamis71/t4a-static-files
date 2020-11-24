<?php
/**
 * H5 Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_h5' ) ) :

    /**
     * Content H5 font options
     */
    function travel_booking_pro_customize_register_typography_h5( $wp_customize ) {
        
        /** H5 Typography Settings */
        $wp_customize->add_section( 'h5_section', array(
            'title'      => __( 'H5 Settings (Content)', 'travel-booking-pro' ),
            'priority'   => 27,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** H5 Font */
        $wp_customize->add_setting( 'h5_font', array(
    		'default' => array(                         // Default font styles				
    			'font-family' => 'Lato',
    			'variant'     => '700',
    		),
    		'sanitize_callback' => array( 'Travel_Booking_Pro_Fonts', 'sanitize_typography' )
    	) );

    	$wp_customize->add_control( 
            new Travel_Booking_Pro_Typography_Control( 
                $wp_customize, 
                'h5_font', 
                array(
            		'label'   => __( 'H5 Font', 'travel-booking-pro' ),
            		'section' => 'h5_section',		
            	) 
             ) 
        );
            
        /** H5 Font Size */
        $wp_customize->add_setting( 'h5_font_size', array(
            'default'           => 18,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'h5_font_size',
    			array(
    				'section' => 'h5_section',
    				'label'	  => __( 'H5 Font Size', 'travel-booking-pro' ),
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
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_h5' );