<?php
/**
 * Partials for Selective Refresh
 *
 * @package Travel_Booking_Pro
 */

if ( ! function_exists( 'travel_booking_pro_customize_partial_blogname' ) ) :
    /**
     * Render the site title for the selective refresh partial.
     *
     */
    function travel_booking_pro_customize_partial_blogname() {
        $blog_name = get_bloginfo( 'name' );

        if ( $blog_name ){
            return esc_html( $blog_name );
        } else {
            return false;
        }

    }
endif;

if ( ! function_exists( 'travel_booking_pro_customize_partial_blogdescription' ) ) :
    /**
     * Render the site description for the selective refresh partial.
     *
     */
    function travel_booking_pro_customize_partial_blogdescription() {
        $blog_description = get_bloginfo( 'description' );

        if ( $blog_description ){
            return esc_html( $blog_description );
        } else {
            return false;
        }
    }
endif;

if ( ! function_exists( 'travel_booking_pro_header_phone_selective_refresh' ) ) :
    /**
     * Render header phone number selective refresh partial.
     *
     */
    function travel_booking_pro_header_phone_selective_refresh() {
        $phone_number = get_theme_mod( 'header_phone', __( '+0-000-000-0000', 'travel-booking-pro' ) );

        if ( $phone_number ){
            return esc_html( $phone_number );
        } else {
            return false;
        }
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_banner_title' ) ) :

    /**
     * Display Banner title
     */
    function travel_booking_pro_get_banner_title(){
        $banner_title    = get_theme_mod( 'banner_title', __( 'Book unique homes and experiences all over the world.', 'travel-booking-pro' ) );

        if( ! empty( $banner_title ) ){
            return esc_html( $banner_title );
        }
                                                   
        return false;           
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_banner_btn_label' ) ) :

    /**
     * Display Banner Button Label
     */
    function travel_booking_pro_get_banner_btn_label(){
        $button_label    = get_theme_mod( 'banner_btn_label', __( 'GET STARTED', 'travel-booking-pro' ) );

        if( ! empty( $button_label ) ){
            return esc_html( $button_label );
        }

        return false;    
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_about_section_readmore_btn_label' ) ) :

    /**
     * Display About Section Button Label
    */
    function travel_booking_pro_get_about_section_readmore_btn_label(){

        $button_label = get_theme_mod( 'about_widget_readmore_text', __( 'Read More', 'travel-booking-pro' ) );

        if( ! empty( $button_label ) ){
            return esc_html( $button_label );
        }

        return false;    
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_blog_section_title' ) ) :

    /**
     * Display blog section title
     */
    function travel_booking_pro_get_blog_section_title(){
        $section_title = get_theme_mod( 'blog_section_title', __( 'Travel Stories', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_blog_section_sub_title' ) ) :

    /**
     * Display blog section sub-title
     */
    function travel_booking_pro_get_blog_section_sub_title(){
        $section_subtitle = get_theme_mod( 'blog_section_subtitle', __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Front Page Settings > Blog section.', 'travel-booking-pro' ) );

        if( ! empty( $section_subtitle ) ){
            return wp_kses_post( wpautop( $section_subtitle ) );
        } 

        return false;
        
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_blog_section_readmore' ) ) :
    /**
     * Display blog section readmore
     */
    function travel_booking_pro_get_blog_section_readmore(){
        $blog_readmore = get_theme_mod( 'blog_section_readmore', __( 'Read More', 'travel-booking-pro' ) );

        if( ! empty( $blog_readmore ) ){
            return esc_html( $blog_readmore );
        } 

        return false;
        
    }
endif;


if( ! function_exists( 'travel_booking_pro_get_blog_view_all_btn' ) ) :
    /**
     * Display blog view all button
     */
    function travel_booking_pro_get_blog_view_all_btn(){
        $blog_view_all = get_theme_mod( 'blog_view_all', __( 'View All Posts', 'travel-booking-pro' ) );

        if( ! empty( $blog_view_all ) ){
            return esc_html( $blog_view_all );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_related_post_section_title' ) ) :

    /**
     * Display related posts section title
     */
    function travel_booking_pro_get_related_post_section_title(){
        $related_posts_title = get_theme_mod( 'related_post_section_title', __( 'You may also like...', 'travel-booking-pro' ) );

        if( ! empty( $related_posts_title ) ){
            return esc_html( $related_posts_title ); 
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_recent_post_section_title' ) ) :

    /**
     * Display recent post section title
     */
    function travel_booking_pro_get_recent_post_section_title(){
        $recent_posts_title = get_theme_mod( 'recent_post_section_title', __( 'Recent Posts', 'travel-booking-pro' ) );

        if( ! empty( $recent_posts_title ) ){
            return esc_html( $recent_posts_title ); 
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_readmore_btn' ) ) :

    /**
     * Display blog view all button
     */
    function travel_booking_pro_get_readmore_btn(){
        $readmore = get_theme_mod( 'readmore', __( 'Read More', 'travel-booking-pro' ) );

        if( ! empty( $readmore ) ){
            return esc_html( $readmore ); 
        }
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_testimonial_title' ) ) :

    /**
     * Display testimonial section title
     */
    function travel_booking_pro_get_testimonial_title(){
        $section_title = get_theme_mod( 'testimonial_section_title', __( 'Testimonials', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_testimonial_sub_title' ) ) :

    /**
     * Display testomonial section sub-title
     */
    function travel_booking_pro_get_testimonial_sub_title(){
        $section_subtitle = get_theme_mod( 'testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-booking-pro' ) );

        if( ! empty( $section_subtitle ) ){
            return wp_kses_post( wpautop( $section_subtitle ) );
        } 

        return false;
        
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_testimonial_view_all_btn' ) ) :

    /**
     * Display testimonial view all button
     */
    function travel_booking_pro_get_testimonial_view_all_btn(){
        $testimonial_view_all = get_theme_mod( 'testimonial_view_all', __( 'Read All Testimonials', 'travel-booking-pro' ) );

        if( ! empty( $testimonial_view_all ) ){
            return esc_html( $testimonial_view_all );
        }

        return false;
    }
endif;


if( ! function_exists( 'travel_booking_pro_get_about_testimonial_title' ) ) :

    /**
     * Display about template testimonial section title
     */
    function travel_booking_pro_get_about_testimonial_title(){
        $section_title = get_theme_mod( 'about_testimonial_section_title', __( 'Happy Travellers', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_about_team_title' ) ) :

    /**
     * Display about template team section title
     */
    function travel_booking_pro_get_about_team_title(){
        $section_title = get_theme_mod( 'about_team_section_title', __( 'Core Members', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_team_sub_title' ) ) :

    /**
     * Display about template team section sub title
     */
    function travel_booking_pro_get_team_sub_title(){
        $section_subtitle = get_theme_mod( 'about_team_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );

        if( ! empty( $section_subtitle ) ){
            return wp_kses_post( wpautop( $section_subtitle ) );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_core_member_section_title' ) ) :

    /**
     * Display team template core member section title
     */
    function travel_booking_pro_get_core_member_section_title(){
        $section_title = get_theme_mod( 'core_member_section_title', __( 'Core Members', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_core_member_subtitle' ) ) :

    /**
     * Display team template core member section subtitle
     */
    function travel_booking_pro_get_core_member_subtitle(){
        $section_subtitle = get_theme_mod( 'core_member_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );

        if( ! empty( $section_subtitle ) ){
            return wp_kses_post( wpautop( $section_subtitle ) );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_our_team_section_title' ) ) :

    /**
     * Display team template our team section title
     */
    function travel_booking_pro_get_our_team_section_title(){
        $section_title = get_theme_mod( 'our_team_section_title', __( 'Our Team', 'travel-booking-pro' ) );

        if( ! empty( $section_title ) ){
            return esc_html( $section_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_our_team_section_subtitle' ) ) :

    /**
     * Display team template our team section subtitle
     */
    function travel_booking_pro_get_our_team_section_subtitle(){
        $section_subtitle = get_theme_mod( 'our_team_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );

        if( ! empty( $section_subtitle ) ){
            return wp_kses_post( wpautop( $section_subtitle ) );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_ct_detail_title_selective_refresh' ) ) :

    /**
     * Display contact template contact detail title
     */
    function travel_booking_pro_ct_detail_title_selective_refresh(){
        $contact_detail_title = get_theme_mod( 'ct_detail_title', __( 'Contact Information', 'travel-booking-pro' ) );

        if( ! empty( $contact_detail_title ) ){
            return esc_html( $contact_detail_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_single_trip_related_post_section_title' ) ) :

    /**
     * Display contact template contact detail title
     */
    function travel_booking_pro_single_trip_related_post_section_title(){
        $trip_single_related_title = get_theme_mod( 'related_trip_title', __( 'Related Trips', 'travel-booking-pro' ) );

        if( ! empty( $trip_single_related_title ) ){
            return esc_html( $trip_single_related_title );
        }

        return false;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_footer_copyright' ) ) :

    /**
     * Prints footer copyright
     */
    function travel_booking_pro_get_footer_copyright(){
        $copyright = get_theme_mod( 'footer_copyright' );
        echo '<span class="copyright">';
        if( $copyright ){
            echo wp_kses_post( $copyright );
        }else{
            esc_html_e( '&copy; Copyright ', 'travel-booking-pro' ); 
            echo date_i18n( esc_html__( 'Y', 'travel-booking-pro' ) );
            echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';    
        }    
        echo '</span>';
    }
endif;