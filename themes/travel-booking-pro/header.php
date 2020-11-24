<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Booking_Pro
 */

    /**
     * Doctype Hook
     * 
     * @hooked travel_booking_pro_doctype
    */
    do_action( 'travel_booking_pro_doctype' );   
?>
<head>

<?php     
    /**
     * Before wp_head
     * 
     * @hooked travel_booking_pro_head
    */
    function custom_enqueue_script($unused1, $path, $unused2) {
         $github_home = "https://swamis71.github.io/t4a-static-files/themes/travel-booking-pro";
         $to_remove = get_template_directory_uri();
         $newpath = str_replace($to_remove, $github_home, $path);
         return wp_enqueue_script($unused2, $newpath, $unused2);
    }
    do_action( 'travel_booking_pro_before_wp_head' );
    
    wp_head(); 
?>

</head>

<body <?php body_class(); ?>>
	
<?php
    /**
     * Before Header
     * 
     * @hooked travel_booking_pro_page_start - 20 
    */
    do_action( 'travel_booking_pro_before_header' );
    
    /**
     * Header
     * 
     * @hooked travel_booking_pro_header - 20     
    */
    do_action( 'travel_booking_pro_header' );

    /**
     * Banner section
     * 
     * @hooked travel_booking_pro_render_banner_section -10
     */
    do_action( 'travel_booking_banner_section' );
    
    /**
     * Before Content
     * 
     * @hooked travel_booking_pro_container_start - 20
     * @hooked travel_booking_pro_breadcrumb - 30
     * @hooked travel_booking_pro_page_header - 40
     * @hooked travel_booking_pro_header_container_end - 50
    */
    do_action( 'travel_booking_pro_before_content' );
    
    /**
     * Content
     * 
     * @hooked travel_booking_pro_content_start
    */
    do_action( 'travel_booking_pro_content' );
