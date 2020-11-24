<?php
/**
 * Header Settings
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_header_section' ) ) :
    /**
     * Header Section
     */
    function travel_booking_pro_customize_register_header_section( $wp_customize ) {
    	        
        $wp_customize->add_section( 'header_section', array(
            'title'    => __( 'Header Settings', 'travel-booking-pro' ),
            'priority' => 10,
            'panel'    => 'general_settings',
        ) );
        
        /** Enable/Disable Search Form */
        $wp_customize->add_setting(
            'ed_header_search',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
        		'ed_header_search',
        		array(
        			'section'	  => 'header_section',
        			'label'		  => __( 'Search Form', 'travel-booking-pro' ),
        			'description' => __( 'Enable to show search form in header.', 'travel-booking-pro' ),
        		)	
            )	
    	);

        /** Phone number  */
        $wp_customize->add_setting(
            'header_phone',
            array(
                'default'           => __( '+0-000-000-0000', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'header_phone', array(
            'selector' => '.header-t .container a.tel-link',
            'render_callback' => 'travel_booking_pro_header_phone_selective_refresh',
        ) );
        
        $wp_customize->add_control(
            'header_phone',
            array(
                'label'           => __( 'Phone Number', 'travel-booking-pro' ),
                'description'     => __( 'Add phone number in header.', 'travel-booking-pro' ),
                'section'         => 'header_section',
                'type'            => 'text',
            )
        );

        $default_social = array(
            array(
                'font'          => 'fa fa-facebook',
                'link'          => 'https://www.facebook.com/',                        
            ),
            array(
                'font'          => 'fa fa-twitter',
                'link'          => 'https://twitter.com/',
            ),
            array(
                'font'          => 'fa fa-youtube-play',
                'link'          => 'https://www.youtube.com/',
            ),
            array(
                'font'          => 'fa fa-instagram',
                'link'          => 'https://www.instagram.com/',
            ),
            array(
                'font'          => 'fa fa-google-plus-circle',
                'link'          => 'https://plus.google.com',
            ),
            array(
                'font'          => 'fa fa-odnoklassniki',
                'link'          => 'https://ok.ru/',
            ),
            array(
                'font'          => 'fa fa-vk',
                'link'          => 'https://vk.com/',
            ),
            array(
                'font'          => 'fa fa-xing',
                'link'          => 'https://www.xing.com/',
            )
        );

        /** Enable Social Links */
        $wp_customize->add_setting( 
            'ed_header_social_links', 
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_header_social_links',
                array(
                    'section'     => 'header_section',
                    'label'       => __( 'Enable Social Links', 'travel-booking-pro' ),
                    'description' => __( 'Enable to show social links at header.', 'travel-booking-pro' ),
                )
            )
        );
        
        $wp_customize->add_setting( 
            new Travel_Booking_Pro_Repeater_Setting( 
                $wp_customize, 
                'header_social_links', 
                array(
                    'default' => $default_social,
                    'sanitize_callback' => array( 'Travel_Booking_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Control_Repeater(
                $wp_customize,
                'header_social_links',
                array(
                    'section' => 'header_section',               
                    'label'   => __( 'Social Links', 'travel-booking-pro' ),
                    'fields'  => array(
                        'font' => array(
                            'type'        => 'font',
                            'label'       => __( 'Font Awesome Icon', 'travel-booking-pro' ),
                            'description' => __( 'Example: fa-bell', 'travel-booking-pro' ),
                        ),
                        'link' => array(
                            'type'        => 'url',
                            'label'       => __( 'Link', 'travel-booking-pro' ),
                            'description' => __( 'Example: http://facebook.com', 'travel-booking-pro' ),
                        )
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'links', 'travel-booking-pro' ),
                        'field' => 'link'
                    ),
                    'active_callback' => 'travel_booking_pro_header_section_ac',                 
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_header_section' );

if ( ! function_exists( 'travel_booking_pro_header_section_ac' ) ) :
    /**
     * Active Callback
     */
    function travel_booking_pro_header_section_ac( $control ){

        $ed_social_links   = $control->manager->get_setting( 'ed_header_social_links' )->value();

        $control_id    = $control->id;

        // Phone number, Address, Email and Custom Link controls
        if ( $control_id == 'header_phone'  && $ed_header_details ) return true;

        // Social links
        if ( $control_id == 'header_social_links'  && $ed_social_links ) return true;

        return false;
    }
endif;