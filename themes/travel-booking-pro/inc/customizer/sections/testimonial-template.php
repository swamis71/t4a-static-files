<?php
/**
 * Testimonial Template Section
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_register_testimonial_template_section' ) ) :

    /**
     * Add contact template section controls
     */
    function travel_booking_pro_customize_register_testimonial_template_section( $wp_customize ) {

        /** Testimonial Section */
        $wp_customize->add_section(
            'testimonial_template_section',
            array(
                'title'    => __( 'Testimonial Template Settings', 'travel-booking-pro' ),
                'priority' => 85,
            )
        );

        /** Post Order */    
        $wp_customize->add_setting( 
            'testimonial_template_post_order', 
            array(
                'default'           => 'date',
                'sanitize_callback' => 'esc_attr'
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Radio_Buttonset_Control(
                $wp_customize,
                'testimonial_template_post_order',
                array(
                    'section'     => 'testimonial_template_section',
                    'label'       => __( 'Post Order', 'travel-booking-pro' ),
                    'description' => __( 'Choose post order for testimonial page template.', 'travel-booking-pro' ),
                    'choices'     => array(                                                         
                        'date'       => __( 'Date', 'travel-booking-pro' ),
                        'menu_order' => __( 'Menu Order', 'travel-booking-pro' ),
                    )
                )
            )
        );    
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_testimonial_template_section' );