<?php
/**
 * General Sidebar Layout Section
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_general_sidebar_layout_section' ) ) :

    /**
     * Add general sidebar layout controls
     */
    function travel_booking_pro_customize_register_general_sidebar_layout_section( $wp_customize ) {

        /** General Sidebar Layout Settings */
        $wp_customize->add_section(
            'general_sidebar_layout_settings',
            array(
                'title'    => __( 'General Sidebar Layout', 'travel-booking-pro' ),
                'priority' => 20,
                'panel'    => 'layout_settings',
            )
        );
        
        /** Page Sidebar layout */
        $wp_customize->add_setting( 
            'page_sidebar_layout', 
            array(
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Image_Control(
    			$wp_customize,
    			'page_sidebar_layout',
    			array(
    				'section'	  => 'general_sidebar_layout_settings',
    				'label'		  => __( 'Page Sidebar Layout', 'travel-booking-pro' ),
    				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in repective page.', 'travel-booking-pro' ),
    				'choices'	  => array(
    					'no-sidebar'    => get_template_directory_uri() . '/images/no-sidebar.png',
    					'left-sidebar'  => get_template_directory_uri() . '/images/left-sidebar.png',
                        'right-sidebar' => get_template_directory_uri() . '/images/right-sidebar.png',
    				)
    			)
    		)
    	);
        
        /** Post Sidebar layout */
        $wp_customize->add_setting( 
            'post_sidebar_layout', 
            array(
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Image_Control(
    			$wp_customize,
    			'post_sidebar_layout',
    			array(
    				'section'	  => 'general_sidebar_layout_settings',
    				'label'		  => __( 'Post Sidebar Layout', 'travel-booking-pro' ),
    				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in repective post.', 'travel-booking-pro' ),
    				'choices'	  => array(
    					'no-sidebar'    => get_template_directory_uri() . '/images/no-sidebar.png',
    					'left-sidebar'  => get_template_directory_uri() . '/images/left-sidebar.png',
                        'right-sidebar' => get_template_directory_uri() . '/images/right-sidebar.png',
    				)
    			)
    		)
    	);

        /** Blog Sidebar layout */
        $wp_customize->add_setting( 
            'blog_sidebar_layout', 
            array(
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Radio_Image_Control(
                $wp_customize,
                'blog_sidebar_layout',
                array(
                    'section'     => 'general_sidebar_layout_settings',
                    'label'       => __( 'Blog Sidebar Layout', 'travel-booking-pro' ),
                    'description' => __( 'This is the sidebar layout for blog page.', 'travel-booking-pro' ),
                    'choices'     => array(
                        'no-sidebar'    => get_template_directory_uri() . '/images/no-sidebar.png',
                        'left-sidebar'  => get_template_directory_uri() . '/images/left-sidebar.png',
                        'right-sidebar' => get_template_directory_uri() . '/images/right-sidebar.png',
                    )
                )
            )
        );

        /** Default Sidebar layout */
        $wp_customize->add_setting( 
            'default_sidebar_layout', 
            array(
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'travel_booking_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Radio_Image_Control(
                $wp_customize,
                'default_sidebar_layout',
                array(
                    'section'     => 'general_sidebar_layout_settings',
                    'label'       => __( 'Default Sidebar Layout', 'travel-booking-pro' ),
                    'description' => __( 'This is the general sidebar layout for whole site.', 'travel-booking-pro' ),
                    'choices'     => array(
                        'no-sidebar'    => get_template_directory_uri() . '/images/no-sidebar.png',
                        'left-sidebar'  => get_template_directory_uri() . '/images/left-sidebar.png',
                        'right-sidebar' => get_template_directory_uri() . '/images/right-sidebar.png',
                    )
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_sidebar_layout_section' );