<?php
/**
 * Team Page Template Core Members Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_team_template_core_members' ) ) :

    /**
     * Team Page Template Core Members section
     */
    function travel_booking_pro_customize_register_team_template_core_members( $wp_customize ){
        
        /** Core Member Section */   
        $wp_customize->add_section( 'core_members_team_section', array(
            'title'    => __( 'Core Member Section', 'travel-booking-pro' ),
            'priority' => 10,
            'panel'    => 'team_page_setting',
        ) ); 

        /** Enable Core Member Section */
        $wp_customize->add_setting(
            'ed_core_member',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'ed_core_member',
                array(
                    'section'         => 'core_members_team_section',
                    'label'           => __( 'Enable Core Member', 'travel-booking-pro' ),
                )
            )
        );

        /** Title */
        $wp_customize->add_setting(
            'core_member_section_title',
            array(
                'default'           =>  __( 'Core Members', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'core_member_section_title',
            array(
                'label'           => __( 'Title', 'travel-booking-pro' ),
                'section'         => 'core_members_team_section',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_core_member_post_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'core_member_section_title', array(
            'selector' => '.page-template-team .team-section .container .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_core_member_section_title',
        ) );

        /** Sub Title */
        $wp_customize->add_setting(
            'core_member_section_subtitle',
            array(
                'default'           => __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'core_member_section_subtitle',
            array(
                'label'           => __( 'Sub Title', 'travel-booking-pro' ),
                'section'         => 'core_members_team_section',
                'type'            => 'textarea',
                'active_callback' => 'travel_booking_pro_core_member_post_ac'
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'core_member_section_subtitle', array(
            'selector' => '.page-template-team .team-section .container .section-header .section-content',
            'render_callback' => 'travel_booking_pro_get_core_member_subtitle',
        ) );

        /** Number of members */
        $wp_customize->add_setting( 'core_member_team_number', array(
            'default'           => 3,
            'sanitize_callback' => 'travel_booking_pro_sanitize_select'
        ) );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control( 
                $wp_customize,
                'core_member_team_number',
                array(
                    'section' => 'core_members_team_section',
                    'label'   => __( 'Number of Members', 'travel-booking-pro' ),
                    'choices' => array(
                        '3' => __( '3', 'travel-booking-pro' ),
                    	'6' => __( '6', 'travel-booking-pro' ),
                    ),
                    'active_callback' => 'travel_booking_pro_core_member_post_ac'
                )
            )
        );

        /** Post Order */    
        $wp_customize->add_setting( 
            'core_member_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'core_member_post_order',
    			array(
    				'section'	  => 'core_members_team_section',
    				'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for team post.', 'travel-booking-pro' ),
    				'choices'	  => array(
    					'selective'  => __( 'Select', 'travel-booking-pro' ),                                      					
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
    				),
                    'active_callback' => 'travel_booking_pro_core_member_post_ac'
    			)
    		)
    	);    

    	for( $i=1; $i<=6; $i++ ){

    		/** Team Posts */
	        $wp_customize->add_setting(
	            'core_member_post_'. $i,
	            array(
	                'default'           => '',
	                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
	            )
	        );
	        
	        $wp_customize->add_control(
	            'core_member_post_'. $i,
	            array(
					'label'           => sprintf( __( 'Core Member %s', 'travel-booking-pro' ), $i ),
					'section'         => 'core_members_team_section',
					'type'            => 'select',
					'choices'         => travel_booking_pro_get_posts( 'tb_team' ),
					'active_callback' => 'travel_booking_pro_core_member_post_ac'
	            )
	        );
    	}
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_team_template_core_members' );

if( ! function_exists( 'travel_booking_pro_core_member_post_ac' ) ) :

    /**
     * Active Callback for team template core member post
    */
	function travel_booking_pro_core_member_post_ac( $control ){
        $show_core_member = $control->manager->get_setting( 'ed_core_member' )->value();
        $post_from        = $control->manager->get_setting( 'core_member_post_order' )->value();
        $number_of_post   = $control->manager->get_setting( 'core_member_team_number' )->value();
        $control_id  = $control->id;

        if ( $control_id == 'core_member_section_title' && $show_core_member ) return true;
        if ( $control_id == 'core_member_section_subtitle' && $show_core_member ) return true;
        if ( $control_id == 'core_member_team_number' && $show_core_member ) return true;
        if ( $control_id == 'core_member_post_order' && $show_core_member ) return true;

        for( $i=1; $i<=$number_of_post; $i++ ){
        	if ( $control_id == 'core_member_post_'. $i && 'selective' == $post_from && $show_core_member ) return true;
        }

        return false;
	}
endif;