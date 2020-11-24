<?php
/**
 * Sidebar Options
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_sidebar' ) ) :
    /**
     *
     */
    function travel_booking_pro_customize_register_sidebar( $wp_customize ) {

        $wp_customize->add_section( 'sidebar_settings', array(
            'title'       => __( 'Sidebar Settings', 'travel-booking-pro' ),
            'priority'    => 65,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Add custom sidebars. You need to save the changes and reload the customizer to use the sidebars in the dropdowns below. You can add content to the sidebars in Appearance->Widgets.', 'travel-booking-pro' ),
            'panel'       => 'general_settings' 
        ) );
        
        /** Custom Sidebars */
        $wp_customize->add_setting( 
            new Travel_Booking_Pro_Repeater_Setting( 
                $wp_customize, 
                'dynamic_sidebars', 
                array(
                    'default' => '',                             
                ) 
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Control_Repeater(
    			$wp_customize,
    			'dynamic_sidebars',
    			array(
    				'section' => 'sidebar_settings',				
    				'label'	  => __( 'Add Sidebars', 'travel-booking-pro' ),
                    'fields'  => array(
                        'name' => array(
                            'type'         => 'text',
                            'label'        => __( 'Name', 'travel-booking-pro' ),
                            'description'  => __( 'Example: Homepage Sidebar', 'travel-booking-pro' ),
                        )
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'sidebar', 'travel-booking-pro' ),
                        'field' => 'name'
                    )                                              
    			)
    		)
    	);
        
        /** Blog Page */
        $wp_customize->add_setting(
    		'blog_page_sidebar',
    		array(
    			'default'			=> 'sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'blog_page_sidebar',
        		array(
                    'label'	      => __( 'Blog Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the blog page.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true ),	
         		)
    		)
    	);
        
        /** Single Page */
        $wp_customize->add_setting(
    		'single_page_sidebar',
    		array(
    			'default'			=> 'sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'single_page_sidebar',
        		array(
                    'label'	      => __( 'Single Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true ),	
         		)
    		)
    	);
        
        /** Single Post */
        $wp_customize->add_setting(
    		'single_post_sidebar',
    		array(
    			'default'			=> 'sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'single_post_sidebar',
        		array(
                    'label'	      => __( 'Single Post Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true ),	
         		)
    		)
    	);
            
        /** Archive Page */
        $wp_customize->add_setting(
    		'archive_page_sidebar',
    		array(
    			'default'			=> 'sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'archive_page_sidebar',
        		array(
                    'label'	      => __( 'Archive Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true ),	
         		)
    		)
    	);
        
        /** Category Archive Page */
        $wp_customize->add_setting(
    		'cat_archive_page_sidebar',
    		array(
    			'default'			=> 'default-sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'cat_archive_page_sidebar',
        		array(
                    'label'	      => __( 'Category Archive Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the category archives.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true, true ),	
         		)
    		)
    	);
        
        /** Tag Archive Page */
        $wp_customize->add_setting(
    		'tag_archive_page_sidebar',
    		array(
    			'default'			=> 'default-sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'tag_archive_page_sidebar',
        		array(
                    'label'	      => __( 'Tag Archive Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the tag archives.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true, true ),	
         		)
    		)
    	);
        
        /** Date Archive Page */
        $wp_customize->add_setting(
    		'date_archive_page_sidebar',
    		array(
    			'default'			=> 'default-sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'date_archive_page_sidebar',
        		array(
                    'label'	      => __( 'Date Archive Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the date archives.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true, true ),	
         		)
    		)
    	);
        
        /** Author Archive Page */
        $wp_customize->add_setting(
    		'author_archive_page_sidebar',
    		array(
    			'default'			=> 'default-sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'author_archive_page_sidebar',
        		array(
                    'label'	      => __( 'Author Archive Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the author archives.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true, true ),	
         		)
    		)
    	);
        
        /** Search Page */
        $wp_customize->add_setting(
    		'search_page_sidebar',
    		array(
    			'default'			=> 'sidebar',
    			'sanitize_callback' => 'travel_booking_pro_sanitize_select'
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Select_Control(
        		$wp_customize,
        		'search_page_sidebar',
        		array(
                    'label'	      => __( 'Search Page Sidebar', 'travel-booking-pro' ),
                    'description' => __( 'Select a sidebar for the search results.', 'travel-booking-pro' ),
        			'section'     => 'sidebar_settings',
        			'choices'     => travel_booking_pro_get_dynamnic_sidebar( true, true ),	
         		)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_sidebar' );