<?php
/**
 * Blog Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_blog_section' ) ) :

    /**
    * Frontpage Blog Section
    */
    function travel_booking_pro_customize_register_blog_section( $wp_customize ) {
    
        /** Blog Section */   
        $wp_customize->add_section( 'blog_section', array(
            'title'    => __( 'Blog Section', 'travel-booking-pro' ),
            'priority' => 100,
            'panel'    => 'home_page_setting',
        ) ); 
        
        /** Title */
        $wp_customize->add_setting(
            'blog_section_title',
            array(
                'default'           => __( 'Travel Stories', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'blog_section_title',
            array(
                'label'   => __( 'Title', 'travel-booking-pro' ),
                'section' => 'blog_section',
                'type'    => 'text',
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
            'selector' => '.blog-section .section-header h2.section-title',
            'render_callback' => 'travel_booking_pro_get_blog_section_title',
        ) );
        
        /** Sub Title */
        $wp_customize->add_setting(
            'blog_section_subtitle',
            array(
                'default'           => __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Front Page Settings > Blog section.', 'travel-booking-pro' ),
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'blog_section_subtitle',
            array(
                'label'   => __( 'Sub Title', 'travel-booking-pro' ),
                'section' => 'blog_section',
                'type'    => 'textarea',
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'blog_section_subtitle', array(
            'selector' => '.blog-section .section-header .section-content',
            'render_callback' => 'travel_booking_pro_get_blog_section_sub_title',
        ) );
        
        /** Readmore */
        $wp_customize->add_setting(
            'blog_section_readmore',
            array(
                'default'           => __( 'Read More', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'blog_section_readmore',
            array(
                'label'   => __( 'Readmore', 'travel-booking-pro' ),
                'section' => 'blog_section',
                'type'    => 'text',
            )
        );    
        
        $wp_customize->selective_refresh->add_partial( 'blog_section_readmore', array(
            'selector' => '.blog-section .grid a.blog-readmore',
            'render_callback' => 'travel_booking_pro_get_blog_section_readmore',
        ) );

        /** View All Label */
        $wp_customize->add_setting(
            'blog_view_all',
            array(
                'default'           => __( 'View All Posts', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'blog_view_all',
            array(
                'label'           => __( 'View All label', 'travel-booking-pro' ),
                'section'         => 'blog_section',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_blog_view_all_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
            'selector' => '.blog-section .btn-holder.view-all-btn a.primary-btn',
            'render_callback' => 'travel_booking_pro_get_blog_view_all_btn',
        ) );
            
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_blog_section' );


if( ! function_exists( 'travel_booking_pro_blog_view_all_ac' ) ) :

    /**
     * Active callback for frontpage blog section
     */
    function travel_booking_pro_blog_view_all_ac(){
                                                       
        $blog = get_option( 'page_for_posts' );
        if( $blog ) return true;
        
        return false; 
    }
endif;