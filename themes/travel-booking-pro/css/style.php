<?php
/**
 * Dynamic Styles
 * 
 * @package Travel_Booking_Pro
*/


function travel_booking_pro_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Lato' );
    $primary_fonts   = travel_booking_pro_get_fonts( $primary_font );
    $font_size       = get_theme_mod( 'font_size', 20 );
    
    $h1_font         = get_theme_mod( 'h1_font', array( 'font-family'=>'Lato' ) );
    $h1_fonts        = travel_booking_pro_get_fonts( $h1_font['font-family'] );
    $h1_font_size    = get_theme_mod( 'h1_font_size', 38 );
    
    $h2_font         = get_theme_mod( 'h2_font', array('font-family'=>'Lato' ) );
    $h2_fonts        = travel_booking_pro_get_fonts( $h2_font['font-family'] );
    $h2_font_size    = get_theme_mod( 'h2_font_size', 26 );
    
    $h3_font         = get_theme_mod( 'h3_font', array('font-family'=>'Lato' ) );
    $h3_fonts        = travel_booking_pro_get_fonts( $h3_font['font-family'] );
    $h3_font_size    = get_theme_mod( 'h3_font_size', 20 );
    
    $h4_font         = get_theme_mod( 'h4_font', array('font-family'=>'Lato' ) );
    $h4_fonts        = travel_booking_pro_get_fonts( $h4_font['font-family'] );
    $h4_font_size    = get_theme_mod( 'h4_font_size', 18 );
    
    $h5_font         = get_theme_mod( 'h5_font', array('font-family'=>'Lato' ) );
    $h5_fonts        = travel_booking_pro_get_fonts( $h5_font['font-family'] );
    $h5_font_size    = get_theme_mod( 'h5_font_size', 18 );
    
    $h6_font         = get_theme_mod( 'h6_font', array('font-family'=>'Lato' ) );
    $h6_fonts        = travel_booking_pro_get_fonts( $h6_font['font-family'] );
    $h6_font_size    = get_theme_mod( 'h6_font_size', 18 );
    
    $body_color      = get_theme_mod( 'background_color', '#000' );
    $primary_color   = get_theme_mod( 'primary_color', '#5c7cfb' );
    $bg_color        = get_theme_mod( 'background_color', '#ffffff' );
    $body_bg         = get_theme_mod( 'body_bg', 'image' );
    $bg_image        = get_theme_mod( 'bg_image' );
    $bg_pattern      = get_theme_mod( 'bg_pattern', 'nobg' );
    $ed_auth_comment = get_theme_mod( 'ed_author_comments', false );
    $body_text_color = get_theme_mod( 'body_color', '#333333');
    
    $rgb = travel_booking_pro_hex2rgb( travel_booking_pro_sanitize_hex_color( $primary_color ) ); 
    
    $image = '';
    if( $body_bg == 'image' && $bg_image ){
        $image = $bg_image;    
    }elseif( $body_bg == 'pattern' && $bg_pattern != 'nobg' ){
        $image = get_template_directory_uri() . '/images/patterns/' . $bg_pattern . '.png';
    }
    
    echo "<style type='text/css' media='all'>";
     ?>

    /* Typography */
    body,
    button,
    input,
    select,
    textarea{
        font-size: <?php echo absint( $font_size ); ?>px;
        color: <?php echo travel_booking_pro_sanitize_hex_color( $body_text_color ); ?>;
        font-family: <?php echo $primary_fonts['font']; ?>;        
    }

    body{
        background: url(<?php echo esc_url( $image ); ?>) <?php echo travel_booking_pro_sanitize_hex_color( $bg_color ); ?>;
    }

    #primary .post .entry-content h1,
    #primary .page .entry-content h1{
        font-family: <?php echo $h1_fonts['font']; ?>;
        font-size: <?php echo absint( $h1_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h1_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h1_fonts['style'] ); ?>;
    }
    
    #primary .post .entry-content h2,
    #primary .page .entry-content h2{
        font-family: <?php echo $h2_fonts['font']; ?>;
        font-size: <?php echo absint( $h2_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h2_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h2_fonts['style'] ); ?>;
    }
    
    #primary .post .entry-content h3,
    #primary .page .entry-content h3{
        font-family: <?php echo $h3_fonts['font']; ?>;
        font-size: <?php echo absint( $h3_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h3_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h3_fonts['style'] ); ?>;
    }
    
    #primary .post .entry-content h4,
    #primary .page .entry-content h4{
        font-family: <?php echo $h4_fonts['font']; ?>;
        font-size: <?php echo absint( $h4_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h4_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h4_fonts['style'] ); ?>;
    }
    
    #primary .post .entry-content h5,
    #primary .page .entry-content h5{
        font-family: <?php echo $h5_fonts['font']; ?>;
        font-size: <?php echo absint( $h5_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h5_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h5_fonts['style'] ); ?>;
    }
    
    #primary .post .entry-content h6,
    #primary .page .entry-content h6{
        font-family: <?php echo $h6_fonts['font']; ?>;
        font-size: <?php echo absint( $h6_font_size ); ?>px;
        font-weight: <?php echo esc_attr( $h6_fonts['weight'] ); ?>;
        font-style: <?php echo esc_attr( $h6_fonts['style'] ); ?>;
    }

    /* Color Scheme */
    a{
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>; 
    }

    .trip-content-area .widget-area .trip-price .price-holder .top-price-holder .group-discount-notice:after{
        border-bottom-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"]{
      background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    button:active,
    button:focus,
    input[type="button"]:active,
    input[type="button"]:focus,
    input[type="reset"]:active,
    input[type="reset"]:focus,
    input[type="submit"]:active,
    input[type="submit"]:focus{
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .homepage.hasbanner .site-header .right .tools .form-section-holder:hover .form-section svg,
    .homepage.hasbanner .site-header .right .tools .form-section-holder:focus .form-section svg,
    .site-header .right .tools .form-section-holder:hover .form-section svg,
    .site-header .right .tools .form-section-holder:focus .form-section svg{
        fill: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .main-navigation ul li a:hover,
    .main-navigation ul li a:focus,
    .main-navigation ul li:hover>a,
    .main-navigation ul li:focus>a,
    .header-two .header-t .social-networks li a:hover,
    .header-two .header-t .social-networks li a:focus,
    .header-two .header-t .tel-link:hover,
    .header-two .header-t .tel-link:focus,
    .homepage.hasbanner .header-two .main-navigation ul ul li a:hover,
    .homepage.hasbanner .header-two .main-navigation ul ul li a:focus,
    .homepage.hasbanner .header-two .main-navigation ul ul li:hover > a,
    .homepage.hasbanner .header-two .main-navigation ul ul li:focus > a,
    .header-two .main-navigation ul ul li a:hover,
    .header-two .main-navigation ul ul li a:focus,
    .header-two .main-navigation ul ul li:hover > a,
    .header-two .main-navigation ul ul li:focus > a,
    .header-two .main-navigation ul ul .current-menu-item > a,
    .header-two .main-navigation ul ul .current-menu-ancestor > a,
    .header-two .main-navigation ul ul .current_page_item > a,
    .header-two .main-navigation ul ul .current_page_ancestor > a,
    .header-three .header-t .social-networks li a:hover,
    .header-three .header-t .social-networks li a:focus,
    .header-three .header-t .tel-link:hover,
    .header-three .header-t .tel-link:focus,
    .homepage.hasbanner .header-three .right .main-navigation ul ul li a:hover,
    .homepage.hasbanner .header-three .right .main-navigation ul ul li a:focus,
    .homepage.hasbanner .header-three .right .main-navigation ul ul li:hover > a,
    .homepage.hasbanner .header-three .right .main-navigation ul ul li:focus > a,
    .homepage.hasbanner .header-three .right .main-navigation ul ul .current-menu-item > a,
    .homepage.hasbanner .header-three .right .main-navigation ul ul .current-menu-ancestor > a,
    .homepage.hasbanner .header-three .right .main-navigation ul ul .current_page_item > a,
    .homepage.hasbanner .header-three .right .main-navigation ul ul .current_page_ancestor > a,
    .header-three .right .main-navigation ul ul li a:hover,
    .header-three .right .main-navigation ul ul li a:focus,
    .header-three .right .main-navigation ul ul li:hover > a,
    .header-three .right .main-navigation ul ul li:focus > a,
    .header-three .right .main-navigation ul ul .current-menu-item > a,
    .header-three .right .main-navigation ul ul .current-menu-ancestor > a,
    .header-three .right .main-navigation ul ul .current_page_item > a,
    .header-three .right .main-navigation ul ul .current_page_ancestor > a,
    .header-four .header-t .social-networks li a:hover,
    .header-four .header-t .social-networks li a:focus,
    .header-four .header-t .tel-link:hover,
    .header-four .header-t .tel-link:focus,
    .intro-section .widget_travel_booking_toolkit_icon_text_widget .icon-holder svg,
    .popular-package .grid .col .text-holder .trip-info .title a:hover,
    .popular-package .grid .col .text-holder .trip-info .title a:focus,
    .popular-package .grid .col .text-holder .next-trip-info .next-departure-list li .left,
    .cta-section .widget .widget-content .btn-cta:hover,
    .cta-section .widget .widget-content .btn-cta:focus,
    .featured-trip .grid .col .text-holder .trip-info .title a:hover,
    .featured-trip .grid .col .text-holder .trip-info .title a:focus,
    .featured-trip .grid .col .text-holder .next-trip-info .next-departure-list li .left,
    .deals-section .grid .col .text-holder .trip-info .title a:hover,
    .deals-section .grid .col .text-holder .trip-info .title a:focus,
    .deals-section .grid .col .text-holder .next-trip-info .next-departure-list li .left,
    .popular-destination .grid .col .trip-title a:hover,
    .popular-destination .grid .col .trip-title a:focus,
    .activities-section .grid .col .activities-title a:hover,
    .activities-section .grid .col .activities-title a:focus,
    .blog-section .grid .text-holder .posted-on a:hover,
    .blog-section .grid .text-holder .posted-on a:focus,
    .blog-section .grid .text-holder .entry-title a:hover,
    .blog-section .grid .text-holder .entry-title a:focus,
    #secondary .widget ul li a:hover, #secondary .widget ul li a:focus,
    #secondary .widget_recent_comments ul li a,
    #secondary .widget_rss ul li a,
    #secondary .widget_travel_booking_toolkit_pro_recent_post ul li .entry-header .cat-links a:hover,
    #secondary .widget_travel_booking_toolkit_pro_recent_post ul li .entry-header .cat-links a:focus,
    #secondary .widget_travel_booking_toolkit_pro_recent_post ul li .entry-header .entry-meta a:hover,
    #secondary .widget_travel_booking_toolkit_pro_recent_post ul li .entry-header .entry-meta a:focus,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-header .cat-links a:hover,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-header .cat-links a:focus,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-header .entry-title a:hover,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-header .entry-title a:focus,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-meta a:hover,
    .site-footer .widget_travel_booking_toolkit_pro_recent_post .style-three li .entry-meta a:focus,
    #primary .post .text-holder .entry-header .entry-title a:hover,
    #primary .post .text-holder .entry-header .entry-title a:focus,
    #primary .search-item .text-holder .entry-header .entry-title a:hover,
    #primary .search-item .text-holder .entry-header .entry-title a:focus,
    #primary .post .text-holder .entry-header .entry-meta a:hover,
    #primary .post .text-holder .entry-header .entry-meta a:focus,
    #primary .search-item .text-holder .entry-header .entry-meta a:hover,
    #primary .search-item .text-holder .entry-header .entry-meta a:focus,
    .site-main .post-navigation .nav-previous:hover .post-title,
    .site-main .post-navigation .nav-previous:focus .post-title,
    .recent-posts-area .col .entry-title a:hover,
    .recent-posts-area .col .entry-title a:focus,
    .popular-posts-area .col .entry-title a:hover,
    .popular-posts-area .col .entry-title a:focus,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .title a:hover,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .title a:focus,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .next-trip-info .next-departure-list li .left,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .btn-holder .btn-more:hover,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .btn-holder .btn-more:focus,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .title a:hover,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .title a:focus,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .next-trip-info .next-departure-list li .left,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .btn-holder .btn-more:hover,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .btn-holder .btn-more:focus,
    .page-template-template-trip_types .trip_types-holder .item .img-holder .text-holder .btn-more:hover,
    .page-template-template-trip_types .trip_types-holder .item .img-holder .text-holder .btn-more:focus,
    .page-template-template-activities .activities-holder .item .img-holder .text-holder .btn-more:hover,
    .page-template-template-activities .activities-holder .item .img-holder .text-holder .btn-more:focus,
    .single-trip #primary .trip-post .entry-content .trip-post-content .secondary-trip-info .trip-facts-value li svg,
    .trip-content-area .secondary-trip-info .trip-facts-value li svg,
    .single-trip #tabs-container .tab-inner-wrapper .tab-anchor-wrapper.nav-tab-active a,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .entry-title a:hover,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .entry-title a:focus,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .btn-holder .btn-more:hover,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .btn-holder .btn-more:focus,
    .page-template-about .team-section .grid .col .text-holder .team-info .team-name a:hover,
    .page-template-about .team-section .grid .col .text-holder .team-info .team-name a:focus,
    .page-template-team .team-section .grid .col .text-holder .team-info .team-name a:hover,
    .page-template-team .team-section .grid .col .text-holder .team-info .team-name a:focus,
    .page-template-team .our-teams .grid .col .text-holder .team-name a:hover,
    .page-template-team .our-teams .grid .col .text-holder .team-name a:focus,
    .page-template-testimonial .testimoanil-holder .testimonial-item .right .testimonial-title,
    .contact-holder .right .contact-info .phone a:hover,
    .contact-holder .right .contact-info .phone a:focus,
    .contact-holder .right .contact-info .address a:hover,
    .contact-holder .right .contact-info .address a:focus,
    .contact-holder .right .contact-info .email a:hover,
    .contact-holder .right .contact-info .email a:focus,
    .header-five .header-t .social-networks li a:hover,
    .header-five .header-t .social-networks li a:focus,
    .header-five .header-t .right .tel-link:hover,
    .header-five .header-t .right .tel-link:focus,
    .intro-section .widget_travel_booking_toolkit_icon_text_widget .icon-holder,
    .single-trip #primary .trip-post .entry-content .trip-post-content .secondary-trip-info .trip-facts-value li svg,
    .trip-content-area .secondary-trip-info .trip-facts-value li svg,
    .page-template-template-destination .destination-holder .item:hover .child-title,
    .page-template-template-destination .destination-holder .item:focus .child-title,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .title a:hover,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .title a:focus{
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .header-two .navigation-holder,
    .homepage.hasbanner .header-three .right .main-navigation ul li a:hover,
    .homepage.hasbanner .header-three .right .main-navigation ul li a:focus,
    .homepage.hasbanner .header-three .right .main-navigation ul li:hover > a,
    .homepage.hasbanner .header-three .right .main-navigation ul li:focus > a,
    .homepage.hasbanner .header-three .right .main-navigation ul .current-menu-item > a,
    .homepage.hasbanner .header-three .right .main-navigation ul .current-menu-ancestor > a,
    .homepage.hasbanner .header-three .right .main-navigation ul .current_page_item > a,
    .homepage.hasbanner .header-three .right .main-navigation ul .current_page_ancestor > a,
    .header-three .right .main-navigation ul li a:hover,
    .header-three .right .main-navigation ul li a:focus,
    .header-three .right .main-navigation ul li:hover > a,
    .header-three .right .main-navigation ul li:focus > a,
    .header-three .right .main-navigation ul .current-menu-item > a,
    .header-three .right .main-navigation ul .current-menu-ancestor > a,
    .header-three .right .main-navigation ul .current_page_item > a,
    .header-three .right .main-navigation ul .current_page_ancestor > a,
    .header-four .navigation-holder,
    .trip-search form .search-dur .ui-slider-horizontal .ui-slider-range,
    .trip-search form .search-price .ui-slider-horizontal .ui-slider-range,
    .widget_calendar caption,
    .widget_calendar table tbody td a,
    #primary .post .text-holder .category a:hover,
    #primary .post .text-holder .category a:focus,
    #primary .search-item .text-holder .category a:hover,
    #primary .search-item .text-holder .category a:focus,
    .pagination .page-numbers:hover,
    .pagination .page-numbers:focus,
    .pagination .page-numbers.current,
    .to_top,
    .single #primary .post .text-holder .entry-footer .tags a:hover,
    .single #primary .post .text-holder .entry-footer .tags a:focus,
    #crumbs .current a,
    #crumbs a:hover,
    #crumbs a:focus,
    .trip-content-area .widget-area .trip-price .price-holder,
    .single-trip #tabs-container .tab-content .itinerary-row:before,
    .review-wrap .average-rating .aggregate-rating .stars,
    .single-trip #wte_enquiry_contact_form,
    .trip-search-result #primary .advanced-search-wrapper .sidebar .advanced-search-field .ui-slider-horizontal .ui-slider-range,
    .trip-search-result #primary .advanced-search-wrapper .sidebar .advanced-search-field .ui-slider-horizontal .ui-slider-handle,
    .trip-pagination .page-numbers:hover,
    .trip-pagination .page-numbers:focus,
    .trip-pagination .page-numbers.current,
    .contact-holder .right .contact-info .social-networks li a{
      background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    @media only screen and (min-width: 1025px){
      .homepage.hasbanner .main-navigation ul ul li a:hover,
      .homepage.hasbanner .main-navigation ul ul li a:focus,
      .homepage.hasbanner .main-navigation ul ul li:hover > a,
      .homepage.hasbanner .main-navigation ul ul li:focus > a,
      .main-navigation ul ul li:hover>a,
      .main-navigation ul ul li:focus>a
      .main-navigation ul ul li a:hover,
      .main-navigation ul ul li a:focus{
        color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      }
    }

    .header-four .main-navigation ul ul li a:hover,
    .header-four .main-navigation ul ul li a:focus{
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?> !important;
    }

    .primary-btn,
    .post-type-archive-trip .trip-content-area .wp-travel-engine-archive-wrap .text-holder .btn-holder .btn-more,
    .archive .trip-content-area .wp-travel-inner-wrapper .grid .col .text-holder .btn-holder .btn-more,
    .trip-search-result #primary .advanced-search-wrapper .wte-advanced-search-wrap .grid .col .text-holder .btn-holder .btn-more,
    .banner .owl-prev,
    .banner .owl-next{
      background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .primary-btn:hover,
    .primary-btn:focus{
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .trip-search form .search-dur .ui-slider-horizontal .ui-slider-handle,
    .trip-search form .search-price .ui-slider-horizontal .ui-slider-handle{
      border-left-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .intro-section .widget_travel_booking_toolkit_icon_text_widget .text-holder .primary-btn:hover,
    .intro-section .widget_travel_booking_toolkit_icon_text_widget .text-holder .primary-btn:focus{
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .intro-section .btn-holder .btn-readmore:hover,
    .intro-section .btn-holder .btn-readmore:focus,
    .popular-package .grid .col .text-holder .btn-holder .primary-btn:hover,
    .popular-package .grid .col .text-holder .btn-holder .primary-btn:focus,
    .popular-package .btn-holder .primary-btn:hover,
    .popular-package .btn-holder .primary-btn:focus,
    .featured-trip .grid .col .text-holder .btn-holder .primary-btn:hover,
    .featured-trip .grid .col .text-holder .btn-holder .primary-btn:focus,
    .featured-trip .btn-holder .primary-btn:hover,
    .featured-trip .btn-holder .primary-btn:focus,
    .deals-section .grid .col .text-holder .btn-holder .primary-btn:hover,
    .deals-section .grid .col .text-holder .btn-holder .primary-btn:focus,
    .deals-section .btn-holder .primary-btn:hover,
    .deals-section .btn-holder .primary-btn:focus,
    .testimonial-section .btn-holder .primary-btn:hover,
    .testimonial-section .btn-holder .primary-btn:focus,
    .blog-section .btn-holder .primary-btn:hover,
    .blog-section .btn-holder .primary-btn:focus,
    .widget_travel_booking_toolkit_icon_text_widget .primary-btn:hover,
    .widget_travel_booking_toolkit_icon_text_widget .primary-btn:focus,
    .widget_travel_booking_toolkit_image_text_widget .primary-btn:hover,
    .widget_travel_booking_toolkit_image_text_widget .primary-btn:focus,
    #primary .post .text-holder .entry-footer .btn-holder .primary-btn:hover,
    #primary .post .text-holder .entry-footer .btn-holder .primary-btn:focus,
    #primary .search-item .text-holder .entry-footer .btn-holder .primary-btn:hover,
    #primary .search-item .text-holder .entry-footer .btn-holder .primary-btn:focus{
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .cta-section .widget .widget-content .btn-cta{
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    #secondary .widget_search .search-form input[type="submit"],
    .error404 .error-page .error-holder .search-form input[type="submit"]{
      background-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .btn-cta{
      background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
      border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    #crumbs .current a:after,
    #crumbs a:hover:after,
    #crumbs a:focus:after{
        border-left-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .review-wrap .average-rating .aggregate-rating .stars:before{
        border-right-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    #primary .post .entry-content blockquote svg,
    #primary .page .entry-content blockquote svg{
        fill: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .mobile-menu .main-navigation ul li a:hover,
    .mobile-menu .main-navigation ul li a:focus,
    .mobile-menu .main-navigation ul li:hover > a,
    .mobile-menu .main-navigation ul li:focus > a,
    .mobile-menu .main-navigation ul .current-menu-item > a,
    .mobile-menu .main-navigation ul .current-menu-ancestor > a,
    .mobile-menu .main-navigation ul .current_page_ancestor > a,
    .mobile-menu .main-navigation ul .current_page_item > a{
        color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?> !important;
    }

    .trip-content-area .widget-area .trip-price .group-discount-notice:after{
        border-bottom-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    /* WooCommerce */
    <?php if( travel_booking_pro_is_woocommerce_activated() ){ ?>

    .woocommerce ul.products li.product .price ins,
    .woocommerce div.product p.price ins,
    .woocommerce div.product span.price ins, 
    .woocommerce nav.woocommerce-pagination ul li a:hover,
    .woocommerce nav.woocommerce-pagination ul li a:focus, 
    .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover,
    .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:focus, 
    .woocommerce div.product .entry-summary .product_meta .posted_in a:hover,
     .woocommerce div.product .entry-summary .product_meta .posted_in a:focus,
     .woocommerce div.product .entry-summary .product_meta .tagged_as a:hover,
     .woocommerce div.product .entry-summary .product_meta .tagged_as a:focus, 
     .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:hover,
    .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:focus, 
    .widget.woocommerce ul li a:hover, .woocommerce #secondary .widget_price_filter .price_slider_amount .button:hover,
    .woocommerce #secondary .widget_price_filter .price_slider_amount .button:focus, 
    .widget.woocommerce ul li.cat-parent .cat-toggle:hover, 
    .woocommerce.widget .product_list_widget li .product-title:hover,
    .woocommerce.widget .product_list_widget li .product-title:focus, 
    .woocommerce.widget .product_list_widget li ins,
    .woocommerce.widget .product_list_widget li ins .amount, 
    .woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce div.product span.price ins,
    .woocommerce div.product .entry-summary .product_meta .posted_in a:hover, .woocommerce div.product .entry-summary .product_meta .posted_in a:focus, .woocommerce div.product .entry-summary .product_meta .tagged_as a:hover, .woocommerce div.product .entry-summary .product_meta .tagged_as a:focus, 
    .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover, .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:focus, 
    .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus {
            color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce ul.products li.product .added_to_cart:hover,
        .woocommerce ul.products li.product .added_to_cart:focus, 
        .woocommerce ul.products li.product .add_to_cart_button:hover,
         .woocommerce ul.products li.product .add_to_cart_button:focus,
         .woocommerce ul.products li.product .product_type_external:hover,
         .woocommerce ul.products li.product .product_type_external:focus,
         .woocommerce ul.products li.product .ajax_add_to_cart:hover,
         .woocommerce ul.products li.product .ajax_add_to_cart:focus, 
         .woocommerce ul.products li.product .button.loading,
        .woocommerce-page ul.products li.product .button.loading, 
        .woocommerce nav.woocommerce-pagination ul li span.current, 
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:hover,
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:focus, 
        .woocommerce div.product form.cart .single_add_to_cart_button:hover,
         .woocommerce div.product form.cart .single_add_to_cart_button:focus,
         .woocommerce div.product .cart .single_add_to_cart_button.alt:hover,
         .woocommerce div.product .cart .single_add_to_cart_button.alt:focus, 
         .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:focus, 
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:hover,
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:focus, 
        .woocommerce-checkout .woocommerce .woocommerce-info, 
         .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:hover,
         .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:focus,
         .woocommerce-checkout .woocommerce form.checkout_coupon input.button:hover,
         .woocommerce-checkout .woocommerce form.checkout_coupon input.button:focus,
         .woocommerce form.lost_reset_password input.button:hover,
         .woocommerce form.lost_reset_password input.button:focus,
         .woocommerce .return-to-shop .button:hover,
         .woocommerce .return-to-shop .button:focus,
         .woocommerce #payment #place_order:hover,
         .woocommerce-page #payment #place_order:focus, 
         .woocommerce #respond input#submit:hover, 
         .woocommerce #respond input#submit:focus, 
         .woocommerce a.button:hover, 
         .woocommerce a.button:focus, 
         .woocommerce button.button:hover, 
         .woocommerce button.button:focus, 
         .woocommerce input.button:hover, 
         .woocommerce input.button:focus, 
         .woocommerce #secondary .widget_shopping_cart .buttons .button:hover,
        .woocommerce #secondary .widget_shopping_cart .buttons .button:focus, 
        .woocommerce #secondary .widget_price_filter .ui-slider .ui-slider-range, 
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button,  
        .woocommerce .woocommerce-message .button:hover,
        .woocommerce .woocommerce-message .button:focus, 
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover {
            background: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before, 
        .widget.widget_layered_nav_filters ul li.chosen a:before, 
        .woocommerce-product-search button[type="submit"]:hover {
            background-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus, 
        .woocommerce nav.woocommerce-pagination ul li span.current, 
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a:hover:before, 
        .widget.widget_layered_nav_filters ul li a:hover:before, 
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before, 
        .widget.widget_layered_nav_filters ul li.chosen a:before, 
        .woocommerce #secondary .widget_price_filter .ui-slider .ui-slider-handle, 
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button {
            border-color: <?php echo travel_booking_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce div.product .product_title, 
        .woocommerce div.product .woocommerce-tabs .panel h2 {
            font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
         }

         .woocommerce.widget_shopping_cart ul li a, 
         .woocommerce.widget .product_list_widget li .product-title, 
         .woocommerce-order-details .woocommerce-order-details__title, 
        .woocommerce-order-received .woocommerce-column__title, 
        .woocommerce-customer-details .woocommerce-column__title {
            font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        }
        <?php } ?>

         /* Author Comment Style */
        <?php if( $ed_auth_comment ){ ?>
                                 
        .bypostauthor {
            display: block;
        }

        .comments-area .comment-list .bypostauthor .comment-body{
            background: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            border: 1px solid #ededed;
        }

    <?php }          
    echo "</style>";
}
add_action( 'wp_head', 'travel_booking_pro_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function travel_booking_pro_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function travel_booking_pro_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
