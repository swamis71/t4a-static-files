<?php
/**
 * Footer Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_footer' ) ) :
    
    /**
     * Footer Section
     */
    function travel_booking_pro_customize_register_footer( $wp_customize ) {
        
        $wp_customize->add_section(
            'footer_settings',
            array(
                'title'      => __( 'Footer Settings', 'travel-booking-pro' ),
                'priority'   => 500,
                'capability' => 'edit_theme_options',
            )
        );
        
        /** Footer background image */
        $wp_customize->add_setting(
            'footer_bg_image', 
            array(
                'default'           => get_template_directory_uri() .'/images/bg-footer.jpg', 
                'sanitize_callback' => 'travel_booking_pro_sanitize_image'
            )
        );
     
        $wp_customize->add_control( 
            new WP_Customize_Image_Control(
                $wp_customize, 
                'footer_bg_image', 
                array(
                    'label'    => __( 'Footer Background Image', 'travel-booking-pro' ),
                    'section'  => 'footer_settings',
                )
            )
        );

        /** Footer Copyright */
        $wp_customize->add_setting(
            'footer_copyright',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'footer_copyright',
            array(
                'label'   => __( 'Footer Copyright', 'travel-booking-pro' ),
                'section' => 'footer_settings',
                'type'    => 'textarea',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
            'selector' => '.footer-b .copyright',
            'render_callback' => 'travel_booking_pro_get_footer_copyright',
        ) );

        /** Hide Author Link */
        $wp_customize->add_setting(
            'ed_author_link',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_author_link',
                array(
                    'section' => 'footer_settings',
                    'label'   => __( 'Hide Author Link', 'travel-booking-pro' ),
                )
            )
        );
        
        /** Hide WordPress Link */
        $wp_customize->add_setting(
            'ed_wp_link',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_wp_link',
                array(
                    'section' => 'footer_settings',
                    'label'   => __( 'Hide WordPress Link', 'travel-booking-pro' ),
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_footer' );