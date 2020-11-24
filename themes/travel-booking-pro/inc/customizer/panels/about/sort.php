<?php
/**
 * About Page Template Sort Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_about_sort' ) ) :

    /**
     * Home page section sort
     */
    function travel_booking_pro_customize_register_about_sort( $wp_customize ){
        
        /** Sort About Page Template Section */   
        $wp_customize->add_section( 'sort_about_template_section', array(
            'title'    => __( 'Sort About Page Template Section', 'travel-booking-pro' ),
            'priority' => 100,
            'panel'    => 'about_page_setting',
        ) ); 
        
        /** Sort About Page Template Section Section */
        $wp_customize->add_setting(
    		'about_sort', 
    		array(
    			'default' => array( 'intro', 'client', 'service', 'testimonial', 'team' ),
    			'sanitize_callback' => 'travel_booking_pro_sanitize_sortable',						
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Sortable(
    			$wp_customize,
    			'about_sort',
    			array(
    				'section'     => 'sort_about_template_section',
    				'label'       => __( 'Sort Sections', 'travel-booking-pro' ),
    				'description' => __( 'Sort or toggle home page sections.', 'travel-booking-pro' ),
    				'choices'     => array(
                        'intro'       => __( 'Intro Section', 'travel-booking-pro' ),
                        'client'      => __( 'Client Section', 'travel-booking-pro' ),
                        'service'     => __( 'Service Section', 'travel-booking-pro' ),
                        'testimonial' => __( 'Testimonial Section', 'travel-booking-pro' ),
                        'team'        => __( 'Team Section', 'travel-booking-pro' ), 
                	),
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_about_sort' );