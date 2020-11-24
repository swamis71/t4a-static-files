<?php
/**
 * Slider / Banner Section
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_customize_register_slider_banner_section' ) ) :
    
    /**
    * Frontpage Slider / Banner Section
    */
    function travel_booking_pro_customize_register_slider_banner_section( $wp_customize ) {
        
        $wp_customize->get_section( 'header_image' )->panel                    = 'home_page_setting';
        $wp_customize->get_section( 'header_image' )->title                    = __( 'Slider / Banner Section', 'travel-booking-pro' );
        $wp_customize->get_section( 'header_image' )->priority                 = 10;
        $wp_customize->get_control( 'header_image' )->active_callback          = 'travel_booking_pro_slider_banner_ac';
        $wp_customize->get_control( 'header_video' )->active_callback          = 'travel_booking_pro_slider_banner_ac';
        $wp_customize->get_control( 'external_header_video' )->active_callback = 'travel_booking_pro_slider_banner_ac';
        $wp_customize->get_section( 'header_image' )->description              = '';                                               
        $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
        $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
        $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
        $wp_customize->remove_control( 'header_textcolor' );

        /** Enable/Disable Banner Section */
        $wp_customize->add_setting(
            'ed_banner_section',
            array(
                'default'           => 'static_banner',
                'sanitize_callback' => 'travel_booking_pro_sanitize_select',
                
                
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control(
                $wp_customize,
        		'ed_banner_section',
        		array(
                    'section'          => 'header_image',
                    'label'            => __( 'Banner Options', 'travel-booking-pro' ),
                    'description'      => __( 'Choose banner as static image/video or as a slider.', 'travel-booking-pro' ),
                    'priority'         => 5,
                    'choices'          => array(
                        'no_banner'        => __( 'Disable Banner Section', 'travel-booking-pro' ),
                        'static_banner'    => __( 'Static/Video CTA Banner', 'travel-booking-pro' ),
                        'static_nl_banner' => __( 'Static/Video Newsletter Banner', 'travel-booking-pro' ),
                        'slider_banner'    => __( 'Banner as Slider', 'travel-booking-pro' ),
                    ),
        		)
            )		
    	);
        
        /** Title */
        $wp_customize->add_setting(
            'banner_title',
            array(
                'default'           => __( 'Book unique homes and experiences all over the world.', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'banner_title',
            array(
                'label'           => __( 'Title', 'travel-booking-pro' ),
                'section'         => 'header_image',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_slider_banner_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'banner_title', array(
            'selector' => '.banner .banner-text h1.title',
            'render_callback' => 'travel_booking_pro_get_banner_title',
        ) );
        
        /** Button Label */
        $wp_customize->add_setting(
            'banner_btn_label',
            array(
                'default'           =>  __( 'GET STARTED', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'banner_btn_label',
            array(
                'label'    => __( 'Button Label', 'travel-booking-pro' ),
                'section'  => 'header_image',
                'type'     => 'text',
                'active_callback' => 'travel_booking_pro_slider_banner_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'banner_btn_label', array(
            'selector' => '.banner .banner-text a.primary-btn',
            'render_callback' => 'travel_booking_pro_get_banner_btn_label',
        ) );
        
        /** Button Url */
        $wp_customize->add_setting(
            'banner_btn_url',
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        
        $wp_customize->add_control(
            'banner_btn_url',
            array(
                'label'           => __( 'Button Url', 'travel-booking-pro' ),
                'section'         => 'header_image',
                'type'            => 'url',
                'active_callback' => 'travel_booking_pro_slider_banner_ac'
            )
        );

         /** Banner Newsletter */
        $wp_customize->add_setting(
            'banner_newsletter',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'banner_newsletter',
            array(
                'label'           => __( 'Banner Newsletter', 'travel-booking-pro' ),
                'section'         => 'header_image',
                'type'            => 'text',
                'active_callback' => 'travel_booking_pro_slider_banner_ac'
            )
        );
        
        /** Slider Content Style */
        $wp_customize->add_setting(
            'slider_type',
            array(
                'default'           => 'latest_posts',
                'sanitize_callback' => 'travel_booking_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control(
                $wp_customize,
                'slider_type',
                array(
                    'label'   => __( 'Slider Content Style', 'travel-booking-pro' ),
                    'section' => 'header_image',
                    'choices' => array(
                        'latest_posts' => __( 'Latest Posts', 'travel-booking-pro' ),
                        'cat'          => __( 'Category', 'travel-booking-pro' ),
                        'pages'        => __( 'Pages', 'travel-booking-pro' ),
                        'custom'       => __( 'Custom', 'travel-booking-pro' ),
                    ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'  
                )
            )
        );
        
        /** Slider Category */
        $wp_customize->add_setting(
            'slider_cat',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_booking_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control(
                $wp_customize,
                'slider_cat',
                array(
                    'label'           => __( 'Slider Category', 'travel-booking-pro' ),
                    'section'         => 'header_image',
                    'choices'         => travel_booking_pro_get_categories(),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'  
                )
            )
        );
        
        /** No. of slides */
        $wp_customize->add_setting(
            'no_of_slides',
            array(
                'default'           => 3,
                'sanitize_callback' => 'travel_booking_pro_sanitize_number_absint'
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Slider_Control( 
                $wp_customize,
                'no_of_slides',
                array(
                    'section'     => 'header_image',
                    'label'       => __( 'Number of Slides', 'travel-booking-pro' ),
                    'description' => __( 'Choose the number of slides you want to display', 'travel-booking-pro' ),
                    'choices'     => array(
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'                 
                )
            )
        );
        
        /** Slider Pages */
        $wp_customize->add_setting( 
            new Travel_Booking_Pro_Repeater_Setting( 
                $wp_customize, 
                'slider_pages', 
                array(
                    'default'           => '',
                    'sanitize_callback' => array( 'Travel_Booking_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Control_Repeater(
                $wp_customize,
                'slider_pages',
                array(
                    'section' => 'header_image',                
                    'label'   => __( 'Slider Pages ', 'travel-booking-pro' ),
                    'fields'  => array(
                        'page' => array(
                            'type'    => 'select',
                            'label'   => __( 'Select Page for slider', 'travel-booking-pro' ),
                            'choices' => travel_booking_pro_get_posts( 'page', true )
                        )
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'pages', 'travel-booking-pro' ),
                        'field' => 'page'
                    ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'                        
                )
            )
        );
        
        /** Add Slides */
        $wp_customize->add_setting( 
            new Travel_Booking_Pro_Repeater_Setting( 
                $wp_customize, 
                'slider_custom', 
                array(
                    'default'           => '',
                    'sanitize_callback' => array( 'Travel_Booking_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),                             
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Control_Repeater(
                $wp_customize,
                'slider_custom',
                array(
                    'section' => 'header_image',                
                    'label'   => __( 'Add Sliders', 'travel-booking-pro' ),
                    'fields'  => array(
                        'thumbnail' => array(
                            'type'  => 'image', 
                            'label' => __( 'Add Image', 'travel-booking-pro' ),                
                        ),
                        'title'     => array(
                            'type'  => 'text',
                            'label' => __( 'Title', 'travel-booking-pro' ),
                        ),
                        'link'     => array(
                            'type'  => 'text',
                            'label' => __( 'Link', 'travel-booking-pro' ),
                        ),
                    ),
                    'row_label' => array(
                        'type'  => 'field',
                        'value' => __( 'Slide', 'travel-booking-pro' ),
                        'field' => 'title'
                    ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'                                              
                )
            )
        );
        
        /** HR */
        $wp_customize->add_setting(
            'hr',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Note_Control( 
                $wp_customize,
                'hr',
                array(
                    'section'     => 'header_image',
                    'description' => '<hr/>',
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'
                )
            )
        ); 
        
        /** Slider Auto */
        $wp_customize->add_setting(
            'slider_auto',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'slider_auto',
                array(
                    'section'     => 'header_image',
                    'label'       => __( 'Slider Auto', 'travel-booking-pro' ),
                    'description' => __( 'Enable slider auto transition.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'
                )
            )
        );
        
        /** Slider Loop */
        $wp_customize->add_setting(
            'slider_loop',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'slider_loop',
                array(
                    'section'     => 'header_image',
                    'label'       => __( 'Slider Loop', 'travel-booking-pro' ),
                    'description' => __( 'Enable slider loop.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'
                )
            )
        );
        
        /** Slider Caption */
        $wp_customize->add_setting(
            'slider_caption',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_booking_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            new Travel_Booking_Pro_Toggle_Control( 
                $wp_customize,
                'slider_caption',
                array(
                    'section'     => 'header_image',
                    'label'       => __( 'Slider Caption', 'travel-booking-pro' ),
                    'description' => __( 'Enable slider caption.', 'travel-booking-pro' ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'
                )
            )
        );
        
        /** Slider Animation */
        $wp_customize->add_setting(
            'slider_animation',
            array(
                'default'           => '',
                'sanitize_callback' => 'travel_booking_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Travel_Booking_Pro_Select_Control(
                $wp_customize,
                'slider_animation',
                array(
                    'label'       => __( 'Slider Animation', 'travel-booking-pro' ),
                    'section'     => 'header_image',
                    'choices'     => array(
                        'bounceOut'      => __( 'Bounce Out', 'travel-booking-pro' ),
                        'bounceOutLeft'  => __( 'Bounce Out Left', 'travel-booking-pro' ),
                        'bounceOutRight' => __( 'Bounce Out Right', 'travel-booking-pro' ),
                        'bounceOutUp'    => __( 'Bounce Out Up', 'travel-booking-pro' ),
                        'bounceOutDown'  => __( 'Bounce Out Down', 'travel-booking-pro' ),
                        'fadeOut'        => __( 'Fade Out', 'travel-booking-pro' ),
                        'fadeOutLeft'    => __( 'Fade Out Left', 'travel-booking-pro' ),
                        'fadeOutRight'   => __( 'Fade Out Right', 'travel-booking-pro' ),
                        'fadeOutUp'      => __( 'Fade Out Up', 'travel-booking-pro' ),
                        'fadeOutDown'    => __( 'Fade Out Down', 'travel-booking-pro' ),
                        'flipOutX'       => __( 'Flip OutX', 'travel-booking-pro' ),
                        'flipOutY'       => __( 'Flip OutY', 'travel-booking-pro' ),
                        'hinge'          => __( 'Hinge', 'travel-booking-pro' ),
                        'pulse'          => __( 'Pulse', 'travel-booking-pro' ),
                        'rollOut'        => __( 'Roll Out', 'travel-booking-pro' ),
                        'rotateOut'      => __( 'Rotate Out', 'travel-booking-pro' ),
                        'rubberBand'     => __( 'Rubber Band', 'travel-booking-pro' ),
                        'shake'          => __( 'Shake', 'travel-booking-pro' ),
                        ''               => __( 'Slide', 'travel-booking-pro' ),
                        'slideOutLeft'   => __( 'Slide Out Left', 'travel-booking-pro' ),
                        'slideOutRight'  => __( 'Slide Out Right', 'travel-booking-pro' ),
                        'slideOutUp'     => __( 'Slide Out Up', 'travel-booking-pro' ),
                        'slideOutDown'   => __( 'Slide Out Down', 'travel-booking-pro' ),
                        'swing'          => __( 'Swing', 'travel-booking-pro' ),
                        'tada'           => __( 'Tada', 'travel-booking-pro' ),
                        'zoomOut'        => __( 'Zoom Out', 'travel-booking-pro' ),
                        'zoomOutLeft'    => __( 'Zoom Out Left', 'travel-booking-pro' ),
                        'zoomOutRight'   => __( 'Zoom Out Right', 'travel-booking-pro' ),
                        'zoomOutUp'      => __( 'Zoom Out Up', 'travel-booking-pro' ),
                        'zoomOutDown'    => __( 'Zoom Out Down', 'travel-booking-pro' ),                    
                    ),
                    'active_callback' => 'travel_booking_pro_slider_banner_ac'                                  
                )
            )
        );
        
        /** Readmore Text */
        $wp_customize->add_setting(
            'slider_readmore',
            array(
                'default'           => __( 'Continue Reading', 'travel-booking-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage' 
            )
        );
        
        $wp_customize->add_control(
            'slider_readmore',
            array(
                'type'            => 'text',
                'section'         => 'header_image',
                'label'           => __( 'Slider Readmore', 'travel-booking-pro' ),
                'active_callback' => 'travel_booking_pro_slider_banner_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'slider_readmore', array(
            'selector' => '.site-banner .banner-caption .banner-wrap .btn-more',
            'render_callback' => 'travel_booking_pro_get_slider_readmore',
        ) );
    }
endif;
add_action( 'customize_register', 'travel_booking_pro_customize_register_slider_banner_section' );

if( ! function_exists( 'travel_booking_pro_slider_banner_ac' ) ) :

    /**
     * Active Callback for Banner Slider
    */
    function travel_booking_pro_slider_banner_ac( $control ){

        $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
        $slider_type = $control->manager->get_setting( 'slider_type' )->value();
        $control_id  = $control->id;
        
        if ( $control_id == 'header_image' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
        if ( $control_id == 'header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
        if ( $control_id == 'external_header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
        if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
        if ( $control_id == 'banner_btn_label' && $banner == 'static_banner' ) return true;
        if ( $control_id == 'banner_btn_url' && $banner == 'static_banner' ) return true;
        if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;
        
        if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
        if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
        if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
        if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;          
        if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;    
        if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
        if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
        if ( $control_id == 'slider_pages' && $banner == 'slider_banner' && $slider_type == 'pages' ) return true;
        if ( $control_id == 'slider_custom' && $banner == 'slider_banner' && $slider_type == 'custom' ) return true;
        if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
        if ( $control_id == 'hr' && $banner == 'slider_banner' ) return true;
        
        return false;
    }
endif;