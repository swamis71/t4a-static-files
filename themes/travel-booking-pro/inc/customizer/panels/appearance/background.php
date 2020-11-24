<?php
/**
 * General Background Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_general_background' ) ) :
    /**
     * Background options
     */
    function travel_booking_pro_customize_register_general_background( $wp_customize ) {
    	
        $wp_customize->get_section( 'background_image' )->panel   = 'appearance_settings';
        $wp_customize->get_section( 'background_image' )->title   = __( 'Background Settings', 'travel-booking-pro' );
        $wp_customize->get_control( 'background_image' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';
        $wp_customize->get_control( 'background_preset' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';
        $wp_customize->get_control( 'background_position' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';
        $wp_customize->get_control( 'background_size' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';
        $wp_customize->get_control( 'background_repeat' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';
        $wp_customize->get_control( 'background_attachment' )->active_callback = 'travel_booking_pro_body_bg_choice_ac';

        /** Body Background */
        $wp_customize->add_setting( 
            'body_bg', 
            array(
                'default'           => 'image',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio',
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Radio_Buttonset_Control(
                $wp_customize,
                'body_bg',
                array(
                    'section'     => 'background_image',
                    'label'       => __( 'Body Background', 'travel-booking-pro' ),
                    'description' => __( 'Choose body background as image or pattern.', 'travel-booking-pro' ),
                    'choices'     => array(
                        'image'   => __( 'Image', 'travel-booking-pro' ),
                        'pattern' => __( 'Pattern', 'travel-booking-pro' ),
                    ),
                    'priority'          => 5
                )
            )
        );

        /** Background Pattern */
        $wp_customize->add_setting( 'bg_pattern', array(
            'default'           => 'nobg',
            'sanitize_callback' => 'esc_attr'
        ) );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Image_Control(
    			$wp_customize,
    			'bg_pattern',
    			array(
    				'section'		  => 'background_image',
    				'label'			  => __( 'Background Pattern', 'travel-booking-pro' ),
    				'description'	  => __( 'Choose from any of 63 awesome background patterns for your site background.', 'travel-booking-pro' ),
    				'choices'         => travel_booking_pro_get_patterns(),
                    'active_callback' => 'travel_booking_pro_body_bg_choice_ac'
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_background' );


if ( ! function_exists( 'travel_booking_pro_body_bg_choice_ac' ) ) :
    /**
     * Active Callback for Body Background
     */
    function travel_booking_pro_body_bg_choice_ac( $control ){
        $body_bg    = $control->manager->get_setting( 'body_bg' )->value();
        $control_id = $control->id;
             
        if ( $control_id == 'background_image' && $body_bg == 'image' ) return true;
        if ( $control_id == 'background_preset' && $body_bg == 'image' ) return true;
        if ( $control_id == 'background_position' && $body_bg == 'image' ) return true;
        if ( $control_id == 'background_size' && $body_bg == 'image' ) return true;
        if ( $control_id == 'background_repeat' && $body_bg == 'image' ) return true;
        if ( $control_id == 'background_attachment' && $body_bg == 'image' ) return true;

        if ( $control_id == 'bg_pattern' && $body_bg == 'pattern' ) return true;
        
        return false;
    }
endif;