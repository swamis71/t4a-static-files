<?php
/**
 * 404 Page Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_404_page_section' ) ) :

    /**
    * General 404 Page Section
    */
    function travel_booking_pro_customize_register_404_page_section( $wp_customize ) {

    	/** 
	     * 404 Page Section 
	     */
	    $wp_customize->add_section(
	        '404_page_section',
	        array(
	            'title'    => __( '404 Page Settings', 'travel-booking-pro' ),
	            'priority' => 20,
	            'panel'    => 'general_settings',
	        )
	    );

	    if( travel_booking_pro_is_wpte_activated() && travel_booking_pro_is_tbt_activated() ){

	        /** Enable/Disable Popular in 404 page */
	        $wp_customize->add_setting(
	            'ed_404_popular',
	            array(
	                'default'           => true,
	                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Toggle_Control( 
	                $wp_customize,
		            'ed_404_popular',
		            array(
		                'section'     => '404_page_section',
		                'label'       => __( 'Enable Popular on 404 Page', 'travel-booking-pro' ),
		            )
		        )       
	        );
	        
	        /** Popular Section Text */
	        $wp_customize->add_setting(
	            '404_popular_text',
	            array(
	                'default'           => __( 'Popular Trips', 'travel-booking-pro' ),
	                'sanitize_callback' => 'sanitize_text_field',
	            )
	        );
	        
	        $wp_customize->add_control(
	            '404_popular_text',
	            array(
	                'label'   => __( 'Popular Title', 'travel-booking-pro' ),
	                'section' => '404_page_section',
	                'type'    => 'text',
	            )
	        );

	        /** Popular Trip One */
	        $wp_customize->add_setting(
	            '404_popular_trip_one',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_one',
		            array(
		                'label'   => __( 'Popular Trip One', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );
	        
	        /** Popular Trip Two */
	        $wp_customize->add_setting(
	            '404_popular_trip_two',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_two',
		            array(
		                'label'   => __( 'Popular Trip Two', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );
	        
	        /** Popular Trip Three */
	        $wp_customize->add_setting(
	            '404_popular_trip_three',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_three',
		            array(
		                'label'   => __( 'Popular Trip Three', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );

	        /** Popular Trip Four */
	        $wp_customize->add_setting(
	            '404_popular_trip_four',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_four',
		            array(
		                'label'   => __( 'Popular Trip Four', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );

	        /** Popular Trip Five */
	        $wp_customize->add_setting(
	            '404_popular_trip_five',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_five',
		            array(
		                'label'   => __( 'Popular Trip Five', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );

	        /** Popular Trip Six */
	        $wp_customize->add_setting(
	            '404_popular_trip_six',
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	        	new Travel_Booking_Pro_Select_Control(
	                $wp_customize,
		            '404_popular_trip_six',
		            array(
		                'label'   => __( 'Popular Trip Six', 'travel-booking-pro' ),
		                'section' => '404_page_section',
		                'choices' => travel_booking_pro_get_posts( 'trip' )
		            )
		        )
	        );
	    } else {
	        $popular_section_404 = sprintf( __( 'Please install/activate %1$sWP Travel Engine%2$s and %3$sTravel Booking Toolkit%4$s plugins to add Popular section in 404 page. %5$sClick here%6$s to Install/Activate plugins.', 'travel-booking-pro' ), '<b>', '</b>', '<b>', '</b>', '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' );

	        $wp_customize->add_setting( '404_popular_info',
	            array(
	                'default' => '',
	                'sanitize_callback' => 'wp_kses_post',
	            )
	        );

	        $wp_customize->add_control( 
	            new Travel_Booking_Pro_Note_Control( 
	            $wp_customize,
	            '404_popular_info', 
	                array(
	                    'label' => __( 'Install and Activate Recommended Plugin.' , 'travel-booking-pro' ),
	                    'section'     => '404_page_section',
	                    'description' => $popular_section_404
	                )
	            )
	        );
	    }
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_404_page_section' );