<?php
/**
 * SEO Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_seo_section' ) ) :

    /**
    * General SEO Section
    */
    function travel_booking_pro_customize_register_seo_section( $wp_customize ) {

    	/** SEO Settings */
	    $wp_customize->add_section(
	        'seo_settings',
	        array(
	            'title'    => __( 'SEO Settings', 'travel-booking-pro' ),
	            'priority' => 30,
	            'panel'    => 'general_settings',
	        )
	    );

	    /** Enable updated date */
        $wp_customize->add_setting( 
            'ed_post_update_date', 
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
        	new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
	            'ed_post_update_date',
	            array(
					'section'     => 'seo_settings',
					'label'       => __( 'Enable Last Update Post Date', 'travel-booking-pro' ),
					'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'travel-booking-pro' ),
	            )
	        )
        );

	    /** Enable/Disable BreadCrumb */
	    $wp_customize->add_setting(
	        'ed_breadcrumb',
	        array(
	            'default'           => true,
	            'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
	        )
	    );
	    
	    $wp_customize->add_control(
	    	new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
				'ed_breadcrumb',
				array(
					'section'     => 'seo_settings',
					'label'       => __( 'Enable Breadcrumb', 'travel-booking-pro' ),
					'description' => __( 'Enable to show breadcrumb in inner pages.', 'travel-booking-pro' ),
				)
			)		
		);
	    
	    /** Home Text */
	    $wp_customize->add_setting(
	        'breadcrumb_home_text',
	        array(
	            'default'           => __( 'Home', 'travel-booking-pro' ),
	            'sanitize_callback' => 'sanitize_text_field',
	        )
	    );
	    
	    $wp_customize->add_control(
	        'breadcrumb_home_text',
	        array(
	            'label'   => __( 'Breadcrumb Home Text', 'travel-booking-pro' ),
	            'section' => 'seo_settings',
	            'type'    => 'text',
	        )
	    );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_seo_section' );