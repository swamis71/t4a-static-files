<?php
/**
 * General Social Sharing Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_general_sharing' ) ) :

    /**
     * Show social share
     */
    function travel_booking_pro_customize_register_general_sharing( $wp_customize ) {
    	
        /** Social Sharing */
        $wp_customize->add_section(
            'social_sharing',
            array(
                'title'    => __( 'Social Sharing', 'travel-booking-pro' ),
                'priority' => 20,
                'panel'    => 'general_settings',
            )
        );
        
        /** Enable Social Sharing Buttons */
        $wp_customize->add_setting(
            'ed_social_sharing',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Travel_Booking_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_social_sharing',
    			array(
    				'section'     => 'social_sharing',
    				'label'       => __( 'Enable Social Sharing Buttons', 'travel-booking-pro' ),
                    'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'travel-booking-pro' ),
    			)
    		)
    	);
        
        /** Social Sharing Buttons */
        $wp_customize->add_setting(
    		'social_share', 
    		array(
    			'default' => array( 'facebook', 'twitter', 'linkedin', 'gplus', 'pinterest' ),
    			'sanitize_callback' => 'travel_booking_pro_sanitize_sortable',						
    		)
    	);

    	$wp_customize->add_control(
    		new Travel_Booking_Pro_Sortable(
    			$wp_customize,
    			'social_share',
    			array(
    				'section'     => 'social_sharing',
    				'label'       => __( 'Social Sharing Buttons', 'travel-booking-pro' ),
    				'description' => __( 'Sort or toggle social sharing buttons.', 'travel-booking-pro' ),
    				'choices'     => array(
                		'facebook'  => __( 'Facebook', 'travel-booking-pro' ),
                		'twitter'   => __( 'Twitter', 'travel-booking-pro' ),
                		'linkedin'  => __( 'Linkedin', 'travel-booking-pro' ),
                		'pinterest' => __( 'Pinterest', 'travel-booking-pro' ),
                		'email'     => __( 'Email', 'travel-booking-pro' ),
                		'gplus'     => __( 'Google Plus', 'travel-booking-pro' ),
                        'stumble'   => __( 'StumbleUpon', 'travel-booking-pro' ),
                        'reddit'    => __( 'Reddit', 'travel-booking-pro' ),            
                	),
                    'active_callback' => 'travel_booking_pro_social_share_ac'
    			)
    		)
    	);
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_general_sharing' );

if( ! function_exists( 'travel_booking_pro_social_share_ac' ) ) :

    /**
     * Active callback for social share
     */
    function travel_booking_pro_social_share_ac( $control ){
        $banner      = $control->manager->get_setting( 'ed_social_sharing' )->value();
        $control_id  = $control->id;

        if ( $control_id == 'social_share' && $banner ) return true;

        return false;
    }
endif;