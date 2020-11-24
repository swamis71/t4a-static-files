<?php
/**
 * About Template Testimonial Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_about_template_testimonial' ) ) :

    /**
     * About Template Testimonial section
     */
    function travel_booking_pro_customize_register_about_template_testimonial( $wp_customize ){
        
        /** Testimonial Section */   
        $wp_customize->add_section( 'about_testimonial_section', array(
            'title'    => __( 'Testimonial Section', 'travel-booking-pro' ),
            'priority' => 40,
            'panel'    => 'about_page_setting',
        ) ); 
        
        /** Title */
        $wp_customize->add_setting(
            'about_testimonial_section_title',
            array(
                'default'           => __( 'Happy Travellers', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'about_testimonial_section_title',
            array(
                'label'   => __( 'Title', 'travel-booking-pro' ),
                'section' => 'about_testimonial_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'about_testimonial_section_title', array(
            'selector' => '.page-template-about .testimonial-section .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_about_testimonial_title',
        ) );

        /** Number of testimonials */
        $wp_customize->add_setting( 'about_no_of_testimonial', array(
            'default'           => 3,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Slider_Control( 
                $wp_customize,
                'about_no_of_testimonial',
                array(
                    'section' => 'about_testimonial_section',
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
            'about_testimonial_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'about_testimonial_post_order',
    			array(
    				'section'	  => 'about_testimonial_section',
    				'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for testimonial post.', 'travel-booking-pro' ),
    				'choices'	  => array(                                      					
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
    				)
    			)
    		)
    	);    

    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_about_template_testimonial' );