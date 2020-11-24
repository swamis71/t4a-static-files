<?php
/**
 * Home Page Search Settings
 *
 * @package Travel_Booking_Pro
 */

function travel_booking_pro_customize_register_home_search( $wp_customize ){
    
    /** Search Section */   
    $wp_customize->add_section( 'search_section', array(
        'title'    => __( 'Search Section', 'travel-booking-pro' ),
        'priority' => 15,
        'panel'    => 'home_page_setting',
    ) ); 
    
    if( travel_booking_pro_is_wte_advanced_search_active() ){
        /** Enable Search Bar */
        $wp_customize->add_setting(
            'ed_search_bar',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_search_bar',
    			array(
    				'section'     => 'search_section',
    				'label'       => __( 'Search Bar', 'travel-booking-pro' ),
                    'description' => __( 'Enable Search Bar', 'travel-booking-pro' ),
    			)
    		)
    	);
    }else{
        /** Note */
        $wp_customize->add_setting(
            'search_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Note_Control( 
    			$wp_customize,
    			'search_text',
    			array(
    				'section'	  => 'search_section',
    				'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sWP Travel Engine - Trip Search%2$s and refresh the customizer. After that option related with this section will be visible.', 'travel-booking-pro' ), '<a href="' . esc_url( 'https://wptravelengine.com/downloads/trip-search/' ) . '" target="_blank">', '</a>' )
    			)
    		)
        );        
    }         
    
}
add_action( 'customize_register', 'travel_booking_pro_customize_register_home_search' ); 