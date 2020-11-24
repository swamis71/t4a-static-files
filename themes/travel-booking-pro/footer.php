<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Booking_Pro
 */

    /**
     * After Content
     * 
     * @hooked travel_booking_pro_content_end - 20
     * @hooked travel_booking_pro_container_end - 30
    */
    do_action( 'travel_booking_pro_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked travel_booking_pro_footer_start  - 20
     * @hooked travel_booking_pro_footer_top    - 30
     * @hooked travel_booking_pro_footer_bottom - 40
     * @hooked travel_booking_pro_footer_end    - 50
    */
    do_action( 'travel_booking_pro_footer' );
    
    /**
     * After Footer
     * @hooked travel_booking_pro_scroll_to_top  - 10
     * @hooked travel_booking_pro_page_end - 20
    */
    do_action( 'travel_booking_pro_after_footer' );   
 
    wp_footer(); 

?>
</body>
</html>