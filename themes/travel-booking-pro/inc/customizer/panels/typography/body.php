<?php
/**
 * Body Typography Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_typography_body' ) ) :

    /**
     * Body typography options
     */
    function travel_booking_pro_customize_register_typography_body( $wp_customize ) {

        /** Body Settings */
        $wp_customize->add_section( 'typography_body_section', array(
            'title'      => __( 'Body Settings', 'travel-booking-pro' ),
            'priority'   => 11,
            'capability' => 'edit_theme_options',
            'panel'      => 'typography_settings'
        ) );
        
        /** Primary Font */
        $wp_customize->add_setting(
    		'primary_font',
    		array(
    			'default'			=> 'Lato',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'primary_font',
        		array(
                    'label'	      => __( 'Primary Font', 'travel-booking-pro' ),
                    'description' => __( 'Primary font of the site.', 'travel-booking-pro' ),
        			'section'     => 'typography_body_section',
        			'choices'     => travel_booking_pro_get_all_fonts(),	
         		)
    		)
    	);
        
        /** Body Font Size */
        $wp_customize->add_setting( 'font_size', array(
            'default'           => 20,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Slider_Control( 
    			$wp_customize,
    			'font_size',
    			array(
    				'section' => 'typography_body_section',
    				'label'	  => __( 'Font Size', 'travel-booking-pro' ),
    				'choices' => array(
    					'min' 	=> 10,
    					'max' 	=> 35,
    					'step'	=> 1,
    				)
    			)
    		)
    	);
        
        /** Body Color */
        $wp_customize->add_setting( 'body_color', array(
            'default'           => '#333333',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'body_color', 
                array(
                    'label'   => __( 'Body Color', 'travel-booking-pro' ),
                    'section' => 'typography_body_section',                
                )
            )
        );
            
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_typography_body' );