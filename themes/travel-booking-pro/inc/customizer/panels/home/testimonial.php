<?php
/**
 * Home Page Testimonial Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_home_testimonial' ) ) :

    /**
     * Homepage Testimonial section
     */
    function travel_booking_pro_customize_register_home_testimonial( $wp_customize ){
        
        /** Testimonial Section */   
        $wp_customize->add_section( 'testimonial_section', array(
            'title'    => __( 'Testimonial Section', 'travel-booking-pro' ),
            'priority' => 95,
            'panel'    => 'home_page_setting',
        ) ); 
        
        /** Title */
        $wp_customize->add_setting(
            'testimonial_section_title',
            array(
                'default'           => __( 'Testimonials', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'testimonial_section_title',
            array(
                'label'   => __( 'Title', 'travel-booking-pro' ),
                'section' => 'testimonial_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'testimonial_section_title', array(
            'selector' => '.home .testimonial-section .container .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_testimonial_title',
        ) );
        
        /** Sub Title */
        $wp_customize->add_setting(
            'testimonial_section_subtitle',
            array(
                'default'           => __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'testimonial_section_subtitle',
            array(
                'label'   => __( 'Sub Title', 'travel-booking-pro' ),
                'section' => 'testimonial_section',
                'type'    => 'textarea',
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'testimonial_section_subtitle', array(
            'selector' => '.testimonial-section .container .section-header .section-content',
            'render_callback' => 'travel_booking_pro_get_testimonial_sub_title',
        ) );

        /** Testimonial Demo */
        $wp_customize->add_setting(
            'ed_testimonial_demo',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_testimonial_demo',
    			array(
    				'section'     => 'testimonial_section',
    				'label'       => __( 'Enable Testimonial Demo Content', 'travel-booking-pro' ),
                    'description' => __( 'If there are no testimonial, demo content will be displayed. Uncheck to hide demo content of this section.', 'travel-booking-pro' )
    			)
    		)
    	);

         /** H1 Font Size */
        $wp_customize->add_setting( 'no_of_testimonial', array(
            'default'           => 3,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Slider_Control( 
                $wp_customize,
                'no_of_testimonial',
                array(
                    'section' => 'testimonial_section',
                    'label'   => __( 'Number of testimonials', 'travel-booking-pro' ),
                    'choices' => array(
                        'min'   => 1,
                        'max'   => 15,
                        'step'  => 1,
                    )
                )
            )
        );
        

        /** Post Order */    
        $wp_customize->add_setting( 
            'testimonial_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'testimonial_post_order',
    			array(
    				'section'	  => 'testimonial_section',
    				'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for testimonial post.', 'travel-booking-pro' ),
    				'choices'	  => array(                                      					
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
    				)
    			)
    		)
    	);    

        /** View All Testimonial */
        $wp_customize->add_setting(
            'testimonial_view_all',
            array(
                'default'           => __( 'Read All Testimonials', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'testimonial_view_all',
            array(
                'label'           => __( 'View All Testimonial Label', 'travel-booking-pro' ),
                'section'         => 'testimonial_section',
                'type'            => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'testimonial_view_all', array(
            'selector' => '.testimonial-section .btn-holder a.primary-btn',
            'render_callback' => 'travel_booking_pro_get_testimonial_view_all_btn',
        ) );

        // Testimonial link.
        $wp_customize->add_setting(
            'testimonial_link',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw' 
            )
        );
            
        $wp_customize->add_control(
            'testimonial_link',
            array(
                'section'  => 'testimonial_section',
                'label'    => esc_html__( 'Testimonial Link', 'travel-booking-pro' ),
                'type'     => 'url'
            )
        );

    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_home_testimonial' );