<?php
/**
 * Contact Template Section
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_contact_template_section' ) ) :

    /**
     * Add contact template section controls
     */
    function travel_booking_pro_customize_register_contact_template_section( $wp_customize ) {

        /** Contact Section */
        $wp_customize->add_section(
            'contact_template_section',
            array(
                'title'    => __( 'Contact Template Settings', 'travel-booking-pro' ),
                'priority' => 70,
            )
        );
        $contact_form_info = sprintf( __( 'You can add contact form by adding shortcode in %1$sContact Page Template%2$s.', 'travel-booking-pro' ),'<b>', '</b>' );

        $wp_customize->add_setting( 'ct_contact_form_info',
            array(
                'default' => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control( 
            new Travel_Booking_Pro_Note_Control( 
            $wp_customize,
            'ct_contact_form_info', 
                array(
                    'label' => __( 'Contact Form Info.' , 'travel-booking-pro' ),
                    'section'     => 'contact_template_section',
                    'description' => $contact_form_info
                )
            )
        );

        /** Show google map */
        $wp_customize->add_setting(
            'ed_ct_google_map',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control(
                $wp_customize,
                'ed_ct_google_map',
                array(
                    'label'           => __( 'Show Google Map.', 'travel-booking-pro' ),
                    'description'     => __( 'Enable to show google map. If disabled contact template featured image will be used as fallback.', 'travel-booking-pro' ),
                    'section'         => 'contact_template_section',
                )            
            )
        );

        /** Enable Scrolling Wheel */
        $wp_customize->add_setting(
            'ed_map_scroll',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_map_scroll',
                array(
                    'section'         => 'contact_template_section',
                    'label'           => __( 'Enable Scrolling Wheel', 'travel-booking-pro' ),
                    'description'     => __( 'Zoom map on Scrolling.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_contact_template_ac'
                )
            )
        );
        
        /** Enable Map Controls */
        $wp_customize->add_setting(
            'ed_map_controls',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_map_controls',
                array(
                    'section'         => 'contact_template_section',
                    'label'           => __( 'Enable Map Controls', 'travel-booking-pro' ),
                    'description'     => __( 'Controls icons that appears above Map.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_contact_template_ac'
                )
            )
        );
        
        /** Enable Map Marker */
        $wp_customize->add_setting(
            'ed_map_marker',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_map_marker',
                array(
                    'section'         => 'contact_template_section',
                    'label'           => __( 'Enable Map Marker', 'travel-booking-pro' ),
                    'description'     => __( 'Marker icons that appears above Map.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_contact_template_ac'
                )
            )
        );
        
        /** Marker Title  */
        $wp_customize->add_setting(
            'marker_title',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'marker_title',
            array(
                'label'           => __( 'Marker Title', 'travel-booking-pro' ),
                'description'     => __( 'Enter the Marker Title.', 'travel-booking-pro' ),
                'section'         => 'contact_template_section',
                'active_callback' => 'travel_booking_pro_contact_template_ac'
            )
        );
        
        /** Google Map API Key  */
        $wp_customize->add_setting(
            'map_api',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'map_api',
            array(
                'label'       => __( 'Google Map API Key', 'travel-booking-pro' ),
                'description' => sprintf( __( 'Enter the google map api key here. You can get API key from %1$shere.%2$s', 'travel-booking-pro' ), '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">', '</a>' ),
                'section'     => 'contact_template_section',
                'active_callback' => 'travel_booking_pro_contact_template_ac'
            )
        );
        
        /** Latitude  */
        $wp_customize->add_setting(
            'latitude',
            array(
                'default'           => 27.7204766,
                'sanitize_callback' => 'travel_booking_pro_sanitize_number_floatval',
            )
        );
        
        $wp_customize->add_control(
            'latitude',
            array(
                'label'           => __( 'Latitude', 'travel-booking-pro' ),
                'description'     => __( 'Enter the Latitude of your location.', 'travel-booking-pro' ),
                'section'         => 'contact_template_section',
                'type'            => 'number',    
                'active_callback' => 'travel_booking_pro_contact_template_ac'                    
            )
        );
        
        /** Longitude  */
        $wp_customize->add_setting(
            'longitude',
            array(
                'default'           => 85.3389148,
                'sanitize_callback' => 'travel_booking_pro_sanitize_number_floatval',
            )
        );
        
        $wp_customize->add_control(
            'longitude',
            array(
                'label'       => __( 'Longitude', 'travel-booking-pro' ),
                'description' => __( 'Enter the Longitude of your location.', 'travel-booking-pro' ),
                'section'     => 'contact_template_section',
                'type'        => 'number',                        
                'active_callback' => 'travel_booking_pro_contact_template_ac'
            )
        );
        
        /** Zoom Level */
        $wp_customize->add_setting(
            'map_zoom',
            array(
                'default'           => 17,
                'sanitize_callback' => 'travel_booking_pro_sanitize_select'
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Slider_Control( 
                $wp_customize,
                'map_zoom',
                array(
                    'section' => 'contact_template_section',
                    'label'   => __( 'Zoom Level', 'travel-booking-pro' ),
                    'choices' => array(
                        'min'   => 1,
                        'max'   => 19,
                        'step'  => 1,
                    ),
                    'active_callback' => 'travel_booking_pro_contact_template_ac'
                )
            )
        );

        /** Contact Detail Note */
        $wp_customize->add_setting(
            'ct_details_notes',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Note_Control( 
                $wp_customize,
                'ct_details_notes',
                array(
                    'section'         => 'contact_template_section',
                    'description'     => sprintf( '<hr/><b>%1$s</b>', __( 'Contact Details.', 'travel-booking-pro' ) ),
                )
            )
        );

        /** Contact title */
        $wp_customize->add_setting(
            'ct_detail_title',
            array(
                'default'           => __( 'Contact Information', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'ct_detail_title',
            array(
                'section'         => 'contact_template_section',
                'label'           => __( 'Contact Details Title', 'travel-booking-pro' ),
            )
        );

        // Selective refresh for contact title.
        $wp_customize->selective_refresh->add_partial( 'ct_detail_title', array(
            'selector'            => '.page-template-contact .contact-info h3',
            'render_callback'     => 'travel_booking_pro_ct_detail_title_selective_refresh',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
        ) );

        /** Contact Phone  */
        $wp_customize->add_setting(
            'ct_phone',
            array(
                'default'           => __( '1-800-567-0123', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            'ct_phone',
            array(
                'label'           => __( 'Contact Phone', 'travel-booking-pro' ),
                'description'     => __( 'Enter the contact phone.', 'travel-booking-pro' ),
                'section'         => 'contact_template_section',
            )
        );

        /** Contact Address  */
        $wp_customize->add_setting(
            'ct_address',
            array(
                'default'           => __( '12 Street, New York City', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            'ct_address',
            array(
                'label'           => __( 'Contact Address', 'travel-booking-pro' ),
                'description'     => __( 'Enter the contact address.', 'travel-booking-pro' ),
                'section'         => 'contact_template_section',
                'type'            => 'textarea', 
            )
        );

        /** Contact Email  */
        $wp_customize->add_setting(
            'ct_email',
            array(
                'default'           => __( 'domain@email.com', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            'ct_email',
            array(
                'label'           => __( 'Contact Email', 'travel-booking-pro' ),
                'description'     => __( 'Enter the contact email.', 'travel-booking-pro' ),
                'section'         => 'contact_template_section',
            )
        );

        // Social media controls
        $wp_customize->add_setting( 
            new Travel_Booking_Pro_Repeater_Setting( 
                $wp_customize, 
                'ct_social_links', 
                array(
                    'default' => array(),
                    'sanitize_callback' => array( 'Travel_Booking_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Control_Repeater(
                $wp_customize,
                'ct_social_links',
                array(
                    'section' => 'contact_template_section',               
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
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_contact_template_section' );

if ( ! function_exists( 'travel_booking_pro_contact_template_ac' ) ) :
    
    /**
     * Active Callback
     */
    function travel_booking_pro_contact_template_ac( $control ){
        $ed_google_map = $control->manager->get_setting( 'ed_ct_google_map' )->value();
        $control_id    = $control->id;

        // Google map
        if ( $control_id == 'ed_map_scroll' && $ed_google_map ) return true;
        if ( $control_id == 'ed_map_controls' && $ed_google_map ) return true;
        if ( $control_id == 'ed_map_marker' && $ed_google_map ) return true;
        if ( $control_id == 'marker_title' && $ed_google_map ) return true;
        if ( $control_id == 'map_api' && $ed_google_map ) return true;
        if ( $control_id == 'latitude' && $ed_google_map ) return true;
        if ( $control_id == 'longitude' && $ed_google_map ) return true;
        if ( $control_id == 'map_zoom' && $ed_google_map ) return true;

        return false;
    }
endif;