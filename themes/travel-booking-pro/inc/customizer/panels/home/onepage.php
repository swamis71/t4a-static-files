<?php
/**
 * One Page Settings
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_frontpage_onepage' ) ) :

    /**
     * Add onepage option for frontpage sections
     */
    function travel_booking_pro_customize_register_frontpage_onepage( $wp_customize ){

        /** Sort Front Page Section */
        $wp_customize->add_section(
            'one_page_settings',
            array(
                'title'    => __( 'One Page Settings', 'travel-booking-pro' ),
                'priority' => 160,
                'panel'    => 'home_page_setting',
            )
        );
        
        /** Enable / Disable Options */
        $wp_customize->add_setting(
            'ed_one_page',
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control(
                $wp_customize,
                'ed_one_page',
                array(
                    'label'       => __( 'Enable Section Menu', 'travel-booking-pro' ),
                    'description' => __( 'Enable to make home page one page scrolling with section menu.', 'travel-booking-pro' ),
                    'section'     => 'one_page_settings',
                )            
            )
        );
        
        /** Enable / Disable Home Options */
        $wp_customize->add_setting(
            'ed_home_link',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control(
                $wp_customize,
                'ed_home_link',
                array(
                    'label'           => __( 'Home Link', 'travel-booking-pro' ),
                    'description'     => __( 'Enable to display "Home" link in section menu.', 'travel-booking-pro' ),
                    'section'         => 'one_page_settings',
                    'active_callback' => 'travel_booking_pro_onepage_menu_ac'
                )            
            )
        );
        
        /** About Section Menu Label  */
        $wp_customize->add_setting(
            'label_about',
            array(
                'default'           => __( 'About us', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_about',
            array(
                'label'           => __( 'About Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );
        
        /** Popular Section Menu Label  */
        $wp_customize->add_setting(
            'label_popular',
            array(
                'default'           => __( 'Popular Packages', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_popular',
            array(
                'label'           => __( 'Popular Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );
        
        /** CTA One Label  */
        $wp_customize->add_setting(
            'label_cta_one',
            array(
                'default'           => __( 'CTA one', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_cta_one',
            array(
                'label'           => __( 'CTA One Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );
        
        /** Featured Section Menu Label  */
        $wp_customize->add_setting(
            'label_featured',
            array(
                'default'           => __( 'Featured Trips', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_featured',
            array(
                'label'           => __( 'Featured Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Deals Section Menu Label  */
        $wp_customize->add_setting(
            'label_deals',
            array(
                'default'           => __( 'Deals', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_deals',
            array(
                'label'           => __( 'Deals Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Destination Section Menu Label  */
        $wp_customize->add_setting(
            'label_destination',
            array(
                'default'           => __( 'Destinations', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_destination',
            array(
                'label'           => __( 'Destination Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );
        
        /** CTA Two Section Menu Label  */
        $wp_customize->add_setting(
            'label_cta_two',
            array(
                'default'           => __( 'CTA Two', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_cta_two',
            array(
                'label'           => __( 'CTA Two Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Activities Section Menu Label  */
        $wp_customize->add_setting(
            'label_activities',
            array(
                'default'           => __( 'Activities', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_activities',
            array(
                'label'           => __( 'Activities Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Testimonial Section Menu Label  */
        $wp_customize->add_setting(
            'label_testimonials',
            array(
                'default'           => __( 'Testimonials', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_testimonials',
            array(
                'label'           => __( 'Testimonial Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Blog Section Menu Label  */
        $wp_customize->add_setting(
            'label_blog',
            array(
                'default'           => __( 'Travel Stories', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_blog',
            array(
                'label'           => __( 'Blog Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );

        /** Client Section Menu Label  */
        $wp_customize->add_setting(
            'label_client',
            array(
                'default'           => __( 'Featured On', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        
        $wp_customize->add_control(
            'label_client',
            array(
                'label'           => __( 'Client Section Menu Label', 'travel-booking-pro' ),
                'description'     => __( 'Left blank to hide the section in the menu.', 'travel-booking-pro' ),
                'section'         => 'one_page_settings',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_onepage_menu_ac'
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_frontpage_onepage' );

if ( ! function_exists( 'travel_booking_pro_onepage_menu_ac' ) ) :
    /**
     * Active Callback
    */
    function travel_booking_pro_onepage_menu_ac( $control ){
        $enabled_sections = $control->manager->get_setting( 'home_sort' )->value();
        $ed_one_page      = $control->manager->get_setting( 'ed_one_page' )->value();
        $control_id       = $control->id;
        
        $show_about        = in_array( 'about', $enabled_sections ) ? true : false;
        $show_popular      = in_array( 'popular', $enabled_sections ) ? true : false;
        $show_cta_one      = in_array( 'cta-one', $enabled_sections ) ? true : false;
        $show_featured     = in_array( 'featured-trip', $enabled_sections ) ? true : false;
        $show_deals        = in_array( 'deals', $enabled_sections ) ? true : false;
        $show_destination  = in_array( 'destination', $enabled_sections ) ? true : false;
        $show_cta_two      = in_array( 'cta-two', $enabled_sections ) ? true : false;
        $show_activities   = in_array( 'activities', $enabled_sections ) ? true : false;
        $show_testimonials = in_array( 'testimonials', $enabled_sections ) ? true : false;
        $show_blog         = in_array( 'blog', $enabled_sections ) ? true : false;
        $show_clients      = in_array( 'clients', $enabled_sections ) ? true : false;
        
        if ( $control_id == 'ed_home_link' && $ed_one_page == true ) return true; 
        if ( $control_id == 'label_about' && $ed_one_page == true && $show_about ) return true;   
        if ( $control_id == 'label_popular' && $ed_one_page == true && $show_popular ) return true;   
        if ( $control_id == 'label_cta_one' && $ed_one_page == true && $show_cta_one ) return true;
        if ( $control_id == 'label_featured' && $ed_one_page == true && $show_featured ) return true;
        if ( $control_id == 'label_deals' && $ed_one_page == true && $show_deals ) return true;
        if ( $control_id == 'label_destination' && $ed_one_page == true && $show_destination ) return true;
        if ( $control_id == 'label_cta_two' && $ed_one_page == true && $show_cta_two ) return true;
        if ( $control_id == 'label_activities' && $ed_one_page == true && $show_activities ) return true;
        if ( $control_id == 'label_testimonials' && $ed_one_page == true && $show_testimonials ) return true;
        if ( $control_id == 'label_blog' && $ed_one_page == true && $show_blog ) return true;
        if ( $control_id == 'label_client' && $ed_one_page == true && $show_clients ) return true;
        
        return false;
    }
endif;