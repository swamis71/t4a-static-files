<?php
/**
 * Home Page Sort Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_home_sort' ) ) :
    /**
     * Home page section sort
     */
    function travel_booking_pro_customize_register_home_sort( $wp_customize ){
        
        /** Sort Home Page Section */   
        $wp_customize->add_section( 'sort_home_section', array(
            'title'    => __( 'Sort Home Page Section', 'travel-booking-pro' ),
            'priority' => 140,
            'panel'    => 'home_page_setting',
        ) ); 
        
        /** Sort Home Page Section Section */
        $wp_customize->add_setting(
    		'home_sort', 
    		array(
    			'default' => array( 'about', 'popular', 'cta-one', 'featured-trip', 'deals', 'destination', 'cta-two', 'activities',  'testimonials', 'blog', 'clients' ),
    			'sanitize_callback' => 'travel_booking_pro_sanitize_sortable',						
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Sortable(
    			$wp_customize,
    			'home_sort',
    			array(
    				'section'     => 'sort_home_section',
    				'label'       => __( 'Sort Sections', 'travel-booking-pro' ),
    				'description' => __( 'Sort or toggle home page sections.', 'travel-booking-pro' ),
    				'choices'     => array(
                        'about'         => __( 'About Section', 'travel-booking-pro' ),
                        'popular'       => __( 'Popular Packages', 'travel-booking-pro' ),
                        'cta-one'       => __( 'Call to Action One Section', 'travel-booking-pro' ),
                        'featured-trip' => __( 'Featured Section', 'travel-booking-pro' ),
                        'deals'         => __( 'Deals Section', 'travel-booking-pro' ), 
                        'destination'   => __( 'Destination Section', 'travel-booking-pro' ), 
                        'cta-two'       => __( 'Call to Action Two Section', 'travel-booking-pro' ),
                        'activities'    => __( 'Activities Section', 'travel-booking-pro' ),
                        'testimonials'  => __( 'Testimonial Section', 'travel-booking-pro' ),
                        'blog'          => __( 'Blog Section', 'travel-booking-pro' ),
                        'clients'       => __( 'Clients Section', 'travel-booking-pro' ),
                	),
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_home_sort' );