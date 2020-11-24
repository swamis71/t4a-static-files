<?php
/**
 * Color Scheme Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_color_scheme' ) ) : 

    /**
     * Color Scheme
     */
    function travel_booking_pro_customize_register_color_scheme( $wp_customize ) {

        // Move default color section to appearance panel
        $wp_customize->get_section( 'colors' )->panel = 'appearance_settings';
        $wp_customize->get_control( 'background_color' )->section   = 'color_scheme_section';

        $wp_customize->add_section(
            'color_scheme_section',
            array(
                'title'      => __( 'Color Scheme', 'travel-booking-pro' ),
                'priority'   => 20,
                'capability' => 'edit_theme_options',
                'panel' => 'appearance_settings'
            )
        );
        
        /** Primary Color Scheme */
        $wp_customize->add_setting( 
            'primary_color', 
            array(
                'default'           => '#5c7cfb',
                'sanitize_callback' => 'sanitize_hex_color'
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'primary_color', 
                array(
                    'label'   => __( 'Priamry Color', 'travel-booking-pro' ),
                    'section' => 'color_scheme_section',                
                )
            )
        );
           
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_color_scheme' );