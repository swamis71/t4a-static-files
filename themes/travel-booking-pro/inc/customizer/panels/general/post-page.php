<?php
/**
 * Archive page Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_post_page_section' ) ) :

    /**
    * General Archive page Section
    */
    function travel_booking_pro_customize_register_post_page_section( $wp_customize ) {

    	/** Post Page */
	    $wp_customize->add_section(
	        'post_page_settings',
	        array(
	            'title'    => __( 'Post Page Settings', 'travel-booking-pro' ),
	            'priority' => 40,
	            'panel'    => 'general_settings',
	        )
	    );

	    /** Excerpt Length */
        $wp_customize->add_setting( 
            'excerpt_length', 
            array(
                'default'           => 30,
                'sanitize_callback' => 'travel_booking_pro_sanitize_number_absint'
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Slider_Control( 
                $wp_customize,                          
                'excerpt_length',
                array(
                    'section'     => 'post_page_settings',
                    'label'       => __( 'Excerpt Length', 'travel-booking-pro' ),
                    'description' => __( 'Automatically generated excerpt length (in words).', 'travel-booking-pro' ),
                    'input_attrs' => array(
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 5,
                    )                 
                )
            )
        );

        /** Read More label */
        $wp_customize->add_setting(
            'readmore',
            array(
                'default'           => __( 'Read More', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
    		'readmore',
    		array(
    			'section' => 'post_page_settings',
    			'label'	  => __( 'Read More Label', 'travel-booking-pro' ),
                'type'    => 'text'
    		)		
    	);
        
        $wp_customize->selective_refresh->add_partial( 'readmore', array(
            'selector'        => '.site-main .entry-footer .btn-holder .btn-more',
            'render_callback' => 'travel_booking_pro_get_readmore_btn',
        ) );

	    /** Enable/Disable category */
	    $wp_customize->add_setting(
	        'ed_category_meta',
	        array(
	            'default'           => false,
	            'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
	        )
	    );
	    
	    $wp_customize->add_control(
	    	new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
				'ed_category_meta',
				array(
					'section'	  => 'post_page_settings',
					'label'		  => __( 'Hide category meta', 'travel-booking-pro' ),
					'description' => __( 'Enable to hide category meta in single and archive page.', 'travel-booking-pro' ),
				)	
			)	
		);

	    /** Post Meta order controls*/
        $wp_customize->add_setting(
            'post_meta_order',
            array(
                'default'           => array( 'date', 'author', 'comment' ),
                'sanitize_callback' => 'travel_booking_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control(
                $wp_customize,
                'post_meta_order',
                array(
                    'label'       => esc_html__( 'Post Meta', 'travel-booking-pro' ),
                    'description' => esc_html__( 'Post meta order in blog or single page. You can rearrange the order you want.', 'travel-booking-pro' ),
                    'section'     => 'post_page_settings',
                    'multiple'    => 3,
                    'choices'     => array(                    
						'date'    => esc_html__( 'Date', 'travel-booking-pro' ),
						'author'  => esc_html__( 'Author', 'travel-booking-pro' ),
						'comment' => esc_html__( 'Comment', 'travel-booking-pro' ),
                    ),                  
                )
            )
        );
	    
	    /** Prefix Archive Page */
        $wp_customize->add_setting( 
            'ed_prefix_archive', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            ) 
        );

         $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_prefix_archive',
                array(
                    'section'     => 'post_page_settings',
                    'label'       => __( 'Hide Prefix in Archive Page', 'travel-booking-pro' ),
                    'description' => __( 'Enable to hide prefix in archive page.', 'travel-booking-pro' ),
                )
            )
        );
        
        /** Hide Author */
        $wp_customize->add_setting( 
            'ed_author_section', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_author_section',
    			array(
    				'section'     => 'post_page_settings',
    				'label'	      => __( 'Hide Author Section', 'travel-booking-pro' ),
                    'description' => __( 'Enable to hide author section.', 'travel-booking-pro' ),
    			)
    		)
    	);

	    /** Enable/Disable Related Posts */
	    $wp_customize->add_setting(
	        'ed_related_post_section',
	        array(
	            'default'           => true,
	            'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
	        )
	    );
	    
	    $wp_customize->add_control(
	    	new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
				'ed_related_post_section',
				array(
					'section'	  => 'post_page_settings',
					'label'		  => __( 'Enable Related Posts', 'travel-booking-pro' ),
					'description' => __( 'Enable to show related posts in single post page.', 'travel-booking-pro' ),
				)
			)		
		);
	    
	    /** Related Title */
	    $wp_customize->add_setting(
	        'related_post_section_title',
	        array(
	            'default'           => __( 'You may also like...', 'travel-booking-pro' ),
	            'sanitize_callback' => 'sanitize_text_field',
	            'transport'         => 'postMessage'
	        )
	    );
	    
	    $wp_customize->add_control(
			'related_post_section_title',
			array(
				'section'         => 'post_page_settings',
				'label'           => __( 'Related Post Title', 'travel-booking-pro' ),
				'active_callback' => 'travel_booking_pro_single_post_page_ac',
			)		
		);
	    
	    $wp_customize->selective_refresh->add_partial( 'related_post_section_title', array(
	        'selector'        => '#primary .recent-posts-area.related-post h2.section-title',
	        'render_callback' => 'travel_booking_pro_get_related_post_section_title',
	    ) );

	    /** Enable/Disable Recent Posts */
	    $wp_customize->add_setting(
	        'ed_recent_post_section',
	        array(
	            'default'           => true,
	            'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
	        )
	    );
	    
	    $wp_customize->add_control(
	    	new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
				'ed_recent_post_section',
				array(
					'section'	  => 'post_page_settings',
					'label'		  => __( 'Enable Recent Posts', 'travel-booking-pro' ),
					'description' => __( 'Enable to show recent posts in single post page.', 'travel-booking-pro' ),
				)
			)		
		);
	    
	    /** Recent Title */
	    $wp_customize->add_setting(
	        'recent_post_section_title',
	        array(
	            'default'           => __( 'Recent Posts', 'travel-booking-pro' ),
	            'sanitize_callback' => 'sanitize_text_field',
	            'transport'         => 'postMessage'
	        )
	    );
	    
	    $wp_customize->add_control(
			'recent_post_section_title',
			array(
				'section'         => 'post_page_settings',
				'label'           => __( 'Recent Post Title', 'travel-booking-pro' ),
				'active_callback' => 'travel_booking_pro_single_post_page_ac'
			)		
		);
	    
	    $wp_customize->selective_refresh->add_partial( 'recent_post_section_title', array(
	        'selector'        => '#primary .recent-posts-area.recent-post h2.section-title',
	        'render_callback' => 'travel_booking_pro_get_recent_post_section_title',
	    ) );

	    /** Hide Author */
        $wp_customize->add_setting( 
            'ed_author_comments', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_author_comments',
    			array(
    				'section'     => 'post_page_settings',
    				'label'	      => __( 'Highlight Author Comment', 'travel-booking-pro' ),
                    'description' => __( 'Enable to highlight author comment in single post page.', 'travel-booking-pro' ),
    			)
    		)
    	);
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_post_page_section' );

if( ! function_exists( 'travel_booking_pro_single_post_page_ac' ) ) :

	/**
     * Active Callback for single post page
    */
	function travel_booking_pro_single_post_page_ac( $control ){
		$ed_related = $control->manager->get_setting( 'ed_related_post_section' )->value();
		$ed_recent  = $control->manager->get_setting( 'ed_recent_post_section' )->value();
		$control_id = $control->id;

		if ( $control_id == 'related_post_section_title' && $ed_related ) return true;
        if ( $control_id == 'recent_post_section_title' && $ed_recent ) return true;

        return false;
	}
endif;