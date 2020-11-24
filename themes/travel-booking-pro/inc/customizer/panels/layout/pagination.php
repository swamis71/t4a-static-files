<?php
/**
 * Pagination Settings
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_layout_pagination' ) ) :

    /**
     * Pagination option
     */
    function travel_booking_pro_customize_register_layout_pagination( $wp_customize ) {
        
        /** Pagination Settings */
        $wp_customize->add_section(
            'pagination_settings',
            array(
                'title'    => __( 'Pagination Settings', 'travel-booking-pro' ),
                'priority' => 30,
                'panel'    => 'layout_settings',
            )
        );

        /** Pagination Type */
        $wp_customize->add_setting(
            'pagination_type',
            array(
                'default'           => 'numbered',
                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
            )
        );

        $wp_customize->add_control(
            'pagination_type',
            array(
                'label'       => __( 'Pagination Type', 'travel-booking-pro' ),
                'description' => __( 'Select pagination type.', 'travel-booking-pro' ),
                'section'     => 'pagination_settings',
                'type'        => 'radio',
                'choices'     => array(
                    'default'         => __( 'Default (Next / Previous)', 'travel-booking-pro' ),
                    'numbered'        => __( 'Numbered (1 2 3 4...)', 'travel-booking-pro' ),
                    'load_more'       => __( 'AJAX (Load More Button)', 'travel-booking-pro' ),
                    'infinite_scroll' => __( 'AJAX (Auto Infinite Scroll)', 'travel-booking-pro' ),
                )
            )
        );

         /** Load More Label */
        $wp_customize->add_setting(
            'load_more_label',
            array(
                'default'           => __( 'Load More Posts', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
           'load_more_label',
            array(
                'section' => 'pagination_settings',
                'label'   => __( 'Load More Label', 'travel-booking-pro' ),
                'type'    => 'text',
                'active_callback' => 'travel_booking_pro_loading_ac' 
            )       
        );

        /** Loading Label */
        $wp_customize->add_setting(
            'loading_label',
            array(
                'default'           => __( 'Loading...', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
           'loading_label',
            array(
                'section' => 'pagination_settings',
                'label'   => __( 'Loading Label', 'travel-booking-pro' ),
                'type'    => 'text',
                'active_callback' => 'travel_booking_pro_loading_ac' 
            )       
        );

          /** Nomore Posts */
        $wp_customize->add_setting(
            'nomore_post_label',
            array(
                'default'           => __( 'No More Post', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
           'nomore_post_label',
            array(
                'section' => 'pagination_settings',
                'label'   => __( 'No more Post Label', 'travel-booking-pro' ),
                'type'    => 'text',
                'active_callback' => 'travel_booking_pro_loading_ac' 
            )       
        );
        
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_layout_pagination' );

/**
 * Active Callback for contact phone
 */
function travel_booking_pro_loading_ac( $control ){
    
    $pagination_type = $control->manager->get_setting( 'pagination_type' )->value();
    
    if ( $pagination_type == 'load_more' ) return true;
    
    return false;
}