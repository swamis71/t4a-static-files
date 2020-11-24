<?php
/**
 * About Template Team Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_about_template_team' ) ) :

    /**
     * About Template Team section
     */
    function travel_booking_pro_customize_register_about_template_team( $wp_customize ){

    	/** Team Section */   
        $wp_customize->add_section( 'about_team_section', array(
            'title'    => __( 'Team Section', 'travel-booking-pro' ),
            'priority' => 50,
            'panel'    => 'about_page_setting',
        ) ); 


        /** Title */
        $wp_customize->add_setting(
            'about_team_section_title',
            array(
                'default'           => __( 'Happy Travellers', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'about_team_section_title',
            array(
                'label'   => __( 'Title', 'travel-booking-pro' ),
                'section' => 'about_team_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'about_team_section_title', array(
            'selector' => '.page-template-about .team-section .container .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_about_team_title',
        ) );

        /** Sub Title */
        $wp_customize->add_setting(
            'about_team_section_subtitle',
            array(
                'default'           => __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'about_team_section_subtitle',
            array(
                'label'   => __( 'Sub Title', 'travel-booking-pro' ),
                'section' => 'about_team_section',
                'type'    => 'textarea',
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'about_team_section_subtitle', array(
            'selector' => '.page-template-about .team-section .container .section-header .section-content',
            'render_callback' => 'travel_booking_pro_get_team_sub_title',
        ) );

        /** Number of members */
        $wp_customize->add_setting( 'about_no_of_team', array(
            'default'           => '3',
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control( 
                $wp_customize,
                'about_no_of_team',
                array(
                    'section' => 'about_team_section',
                    'label'   => __( 'Number of members', 'travel-booking-pro' ),
                    'choices' => array(
                        '3' => __( '3', 'travel-booking-pro' ),
                    	'6' => __( '6', 'travel-booking-pro' ),
                    )
                )
            )
        );

        /** Post Order */    
        $wp_customize->add_setting( 
            'about_team_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'about_team_post_order',
    			array(
    				'section'	  => 'about_team_section',
    				'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for team post.', 'travel-booking-pro' ),
    				'choices'	  => array(
    					'selective'  => __( 'Select', 'travel-booking-pro' ),                                      					
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
    				)
    			)
    		)
    	);    

    	for( $i=1; $i<=6; $i++ ){

    		/** Team Posts */
	        $wp_customize->add_setting(
	            'about_team_post_'. $i,
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	            'about_team_post_'. $i,
	            array(
					'label'           => sprintf( __( 'Team Member %s', 'travel-booking-pro' ), $i ),
					'section'         => 'about_team_section',
					'type'            => 'select',
					'choices'         => travel_booking_pro_get_posts( 'tb_team' ),
					'active_callback' => 'travel_booking_pro_team_member_post_ac'
	            )
	        );
    	}
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_about_template_team' );

if( ! function_exists( 'travel_booking_pro_team_member_post_ac' ) ) :

    /**
     * Active Callback for about page template team member post
    */
	function travel_booking_pro_team_member_post_ac( $control ){
        $post_from = $control->manager->get_setting( 'about_team_post_order' )->value();
        $number_of_post = $control->manager->get_setting( 'about_no_of_team' )->value();
        $control_id  = $control->id;

        for( $i=1; $i<=$number_of_post; $i++ ){
        	if ( $control_id == 'about_team_post_'. $i && 'selective' == $post_from ) return true;
        }

        return false;
	}
endif;