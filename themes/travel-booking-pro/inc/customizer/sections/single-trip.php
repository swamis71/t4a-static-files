<?php
/**
 * Single Trip Page Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_related_trip' ) ) : 

    /**
     *  Related trip 
     */
    function travel_booking_pro_customize_register_related_trip( $wp_customize ) {
        
        $wp_customize->add_section( 'trip_page_setting', array(
            'title'      => __( 'Single Trip Page Settings', 'travel-booking-pro' ),
            'priority'   => 90,
            'capability' => 'edit_theme_options',
            'active_callback' => 'travel_booking_pro_is_wpte_activated',
        ) );
        
        /** Related Trip Title */
        $wp_customize->add_setting(
            'enable_related_trips',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'enable_related_trips',
                array(
                    'section' => 'trip_page_setting',
                    'label'   => __( 'Enable Related Trips', 'travel-booking-pro' ),
                    'description' => __( 'Option to display related trips based on single trip.', 'travel-booking-pro' ),
                )
            )       
        );

        /** Related Trip Title */
        $wp_customize->add_setting(
            'related_trip_title',
            array(
                'default'           => __( 'Related Trips', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
    		'related_trip_title',
    		array(
    			'section' => 'trip_page_setting',
    			'label'	  => __( 'Related Trip Title', 'travel-booking-pro' ),
                'type'    => 'text',
                'active_callback' => 'travel_booking_pro_related_trip_ac',
    		)		
    	);
        
        $wp_customize->selective_refresh->add_partial( 'related_trip_title', array(
            'selector'        => '.site .related-trips .section-title',
            'render_callback' => 'travel_booking_pro_single_trip_related_post_section_title',
        ) );
        
        /** Related Trip Readmore */
        $wp_customize->add_setting(
            'related_trip_readmore',
            array(
                'default'           => __( 'View Details', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
    		'related_trip_readmore',
    		array(
    			'section' => 'trip_page_setting',
    			'label'	  => __( 'Related Trip Readmore', 'travel-booking-pro' ),
                'type'    => 'text',
                'active_callback' => 'travel_booking_pro_related_trip_ac',
    		)		
    	);
        
        $wp_customize->selective_refresh->add_partial( 'related_trip_readmore', array(
            'selector'        => '.site .related-trips .grid .text-holder .btn-holder .btn-more',
            'render_callback' => 'travel_booking_pro_related_trip_readmore',
        ) );
        
        /** Related Trip Taxonomy */    
        $wp_customize->add_setting( 
            'related_trip_tax', 
            array(
                'default'           => 'destination',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'related_trip_tax',
    			array(
    				'section'	  => 'trip_page_setting',
    				'label'       => __( 'Related Trip Taxonomy', 'travel-booking-pro' ),
                    'description' => sprintf( __( 'Choose Taxonomy to display related trips based on single trip. %1$sNote:%2$s Displays %3$sBreadcrumb%4$s in single trip page according to choosen option.', 'travel-booking-pro' ), '<br><b>', '</b>', '<b>', '</b>' ),
    				'choices'	  => array(                                      					
                        'destination' => __( 'Destination', 'travel-booking-pro' ),
                        'activities'  => __( 'Activities', 'travel-booking-pro' ),
                        'trip_types'  => __( 'Trip Type', 'travel-booking-pro' ),
    				),
                    'active_callback' => 'travel_booking_pro_related_trip_ac',
    			)
    		)
    	);
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_related_trip' );

if( ! function_exists( 'travel_booking_pro_related_trip_ac' ) ) :

    /**
     * Active Callback
    */
    function travel_booking_pro_related_trip_ac( $control ){
        
        $enable_related_trips     = $control->manager->get_setting( 'enable_related_trips' )->value();
        $control_id  = $control->id;
        
        if ( $control_id == 'related_trip_title' && $enable_related_trips == true ) return true;
        if ( $control_id == 'related_trip_readmore' && $enable_related_trips == true ) return true;
        if ( $control_id == 'related_trip_tax' && $enable_related_trips == true ) return true;
        
        return false;
    }
endif;