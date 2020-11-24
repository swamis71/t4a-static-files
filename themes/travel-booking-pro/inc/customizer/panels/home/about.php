<?php
/**
 * About Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_about_section' ) ) :

    /**
    * Frontpage About Section
    */
    function travel_booking_pro_customize_register_about_section( $wp_customize ) {

        /** About section */
        $wp_customize->add_section(
            'frontpage_widget_about_settings',
            array(
                'title'    => esc_html__( 'About Widget', 'travel-booking-pro' ),
                'priority' => 30,
                'panel'    => 'home_page_setting',
            )
        );

        // Frontpage about readmore button label.
        $wp_customize->add_setting(
            'about_widget_readmore_text',
            array(
                'default'           => __( 'Read More', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field', 
                'transport'         => 'postMessage'
            )
        );
            
        $wp_customize->add_control(
            'about_widget_readmore_text',
            array(
                'section'     => 'frontpage_widget_about_settings',
                'priority'    => 100,
                'label'       => esc_html__( 'Readmore Text', 'travel-booking-pro' ),
            )
        );

         $wp_customize->selective_refresh->add_partial( 'about_widget_readmore_text', array(
            'selector' => '.intro-section .btn-holder a.primary-btn.btn-readmore',
            'render_callback' => 'travel_booking_pro_get_about_section_readmore_btn_label',
        ) );

        // Frontpage about link.
        $wp_customize->add_setting(
            'about_widget_readmore_link',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw' 
            )
        );
            
        $wp_customize->add_control(
            'about_widget_readmore_link',
            array(
                'section'  => 'frontpage_widget_about_settings',
                'priority' => 110,
                'label'    => esc_html__( 'Readmore Link', 'travel-booking-pro' ),
                'type'     => 'url'
            )
        );

        $frontpage_about_section = $wp_customize->get_section( 'sidebar-widgets-about' );
        if ( ! empty( $frontpage_about_section ) ) {
            $wp_version = get_bloginfo( 'version' );

            if ( version_compare( $wp_version, '4.7', '>=' ) ) {
                $frontpage_about_section->panel = 'home_page_setting';
            } else {
                $frontpage_about_section->panel = '';
            }
            $frontpage_about_section->priority = 20;
            $wp_customize->get_control( 'about_widget_readmore_text' )->section  = 'sidebar-widgets-about';
            $wp_customize->get_control( 'about_widget_readmore_link' )->section  = 'sidebar-widgets-about';
        }
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_about_section' );