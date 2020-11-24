<?php
/**
 * Performance Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_general_performance' ) ) :

    /**
     * Performance Settings 
     */
    function travel_booking_pro_customize_register_general_performance( $wp_customize ) {
        
        $wp_customize->add_section(
            'performance_settings',
            array(
                'title'      => __( 'Performance Settings', 'travel-booking-pro' ),
                'priority'   => 110,
                'capability' => 'edit_theme_options',
            )
        );
        
        /** Lazy Load */
        $wp_customize->add_setting(
            'ed_lazy_load',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_lazy_load',
    			array(
    				'section'		=> 'performance_settings',
    				'label'			=> __( 'Lazy Load', 'travel-booking-pro' ),
    				'description'	=> __( 'Enable lazy loading of featured images.', 'travel-booking-pro' ),
    			)
    		)
    	);
        
        /** Lazy Load Content Images */
        $wp_customize->add_setting(
            'ed_lazy_load_cimage',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_lazy_load_cimage',
    			array(
    				'section'		=> 'performance_settings',
    				'label'			=> __( 'Lazy Load Content Images', 'travel-booking-pro' ),
    				'description'	=> __( 'Enable lazy loading of images inside page/post content.', 'travel-booking-pro' ),
    			)
    		)
    	);
        
        /** Defer JavaScript */
        $wp_customize->add_setting(
            'ed_defer',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_defer',
    			array(
    				'section'		=> 'performance_settings',
    				'label'			=> __( 'Defer JavaScript', 'travel-booking-pro' ),
    				'description'	=> __( 'Adds "defer" attribute to sript tags to improve page download speed.', 'travel-booking-pro' ),
    			)
    		)
    	);
        
        /** Sticky Header */
        $wp_customize->add_setting(
            'ed_ver',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_ver',
    			array(
    				'section'		=> 'performance_settings',
    				'label'			=> __( 'Remove ver parameters', 'travel-booking-pro' ),
    				'description'	=> __( 'Enable to remove "ver" parameter from CSS and JS file calls.', 'travel-booking-pro' ),
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_performance' );