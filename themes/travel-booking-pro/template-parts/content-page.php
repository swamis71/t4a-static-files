<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Booking_Pro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <?php
        /**
         * Page Title
         * 
         * @hooked travel_booking_pro_get_post_page_header - 10
         *
         * @hooked travel_booking_pro_post_thumbnail - 20
         */
        do_action( 'travel_booking_pro_before_text_holder' );
    ?>
    
    <div class="text-holder">
    	<?php
            /**
             * Entry Content
             * 
             * @hooked travel_booking_pro_entry_content - 10
             *
             * @hooked travel_booking_pro_entry_footer  - 20
             */
            do_action( 'travel_booking_pro_page_content' );        
        ?>
    </div><!-- .text-holder -->
    
</article><!-- #post-<?php the_ID(); ?> -->