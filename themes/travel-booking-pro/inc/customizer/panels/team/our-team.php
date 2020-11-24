<?php
/**
 * Team Page Template Our Team Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_team_template_our_team' ) ) :

    /**
     * Team Page Template Our Team section
     */
    function travel_booking_pro_customize_register_team_template_our_team( $wp_customize ){
        
        /** Our Team Section */   
        $wp_customize->add_section( 'our_team_section', array(
            'title'    => __( 'Our Team Section', 'travel-booking-pro' ),
            'priority' => 20,
            'panel'    => 'team_page_setting',
        ) ); 

        /** Enable Our Team Section */
        $wp_customize->add_setting(
            'ed_our_team',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_our_team',
                array(
                    'section'         => 'our_team_section',
                    'label'           => __( 'Enable Our Team', 'travel-booking-pro' ),
                )
            )
        );

        /** Title */
        $wp_customize->add_setting(
            'our_team_section_title',
            array(
                'default'           => __( 'Our Team', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'our_team_section_title',
            array(
                'label'           => __( 'Title', 'travel-booking-pro' ),
                'section'         => 'our_team_section',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_our_team_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'our_team_section_title', array(
            'selector' => '.page-template-team .our-teams .container .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_our_team_section_title',
        ) );

        /** Sub Title */
        $wp_customize->add_setting(
            'our_team_section_subtitle',
            array(
                'default'           => __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'our_team_section_subtitle',
            array(
                'label'           => __( 'Sub Title', 'travel-booking-pro' ),
                'section'         => 'our_team_section',
                'type'            => 'textarea',
                'active_callback' => 'travel_booking_pro_our_team_ac'
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'our_team_section_subtitle', array(
            'selector' => '.page-template-team .our-teams .container .section-header .section-content',
            'render_callback' => 'travel_booking_pro_get_our_team_section_subtitle',
        ) );

        /** Post Order */    
        $wp_customize->add_setting( 
            'our_team_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'our_team_post_order',
    			array(
    				'section'	  => 'our_team_section',
    				'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for team post.', 'travel-booking-pro' ),
    				'choices'	  => array(
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
    				),
                    'active_callback' => 'travel_booking_pro_our_team_ac'
    			)
    		)
    	);
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_team_template_our_team' );

if( ! function_exists( 'travel_booking_pro_our_team_ac' ) ) :

    /**
     * Active Callback for team template core member post
    */
	function travel_booking_pro_our_team_ac( $control ){
        $show_our_team = $control->manager->get_setting( 'ed_our_team' )->value();
        $post_from        = $control->manager->get_setting( 'our_team_post_order' )->value();
        $control_id  = $control->id;

        if ( $control_id == 'our_team_section_title' && $show_our_team ) return true;
        if ( $control_id == 'our_team_section_subtitle' && $show_our_team ) return true;
        if ( $control_id == 'our_team_post_order' && $show_our_team ) return true;

        return false;
	}
endif;