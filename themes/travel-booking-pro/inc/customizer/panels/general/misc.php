<?php
/**
 * Miscellaneous Settings
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_general_misc' ) ) :
    
    /**
     * Add miscellaneous controls
     */
    function travel_booking_pro_customize_register_general_misc( $wp_customize ) {

        /** Miscellaneous Settings */
        $wp_customize->add_section(
            'misc_settings',
            array(
                'title'    => __( 'Misc Settings', 'travel-booking-pro' ),
                'priority' => 80,
                'panel'    => 'general_settings',
            )
        );
        
        /** Admin Bar */
        $wp_customize->add_setting(
            'ed_adminbar',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_adminbar',
                array(
                    'section'       => 'misc_settings',
                    'label'         => __( 'Admin Bar', 'travel-booking-pro' ),
                    'description'   => __( 'Disable to hide Admin Bar in frontend when logged in.', 'travel-booking-pro' ),
                )
            )
        );
        
        /** Sticky Header */
        $wp_customize->add_setting(
            'ed_sticky_header',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_sticky_header',
                array(
                    'section'       => 'misc_settings',
                    'label'         => __( 'Sticky Header', 'travel-booking-pro' ),
                    'description'   => __( 'Enable to stick header at top.', 'travel-booking-pro' ),
                )
            )
        );

        /** Scroll to top */
        $wp_customize->add_setting( 'ed_scroll_to_top', array(
            'default'           => true,
            'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
        ) );

        $wp_customize->add_control( 
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_scroll_to_top', 
                array(
                    'label'             => __( 'Enable Scroll to Top.', 'travel-booking-pro' ),
                    'section'           => 'misc_settings',
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_misc' );