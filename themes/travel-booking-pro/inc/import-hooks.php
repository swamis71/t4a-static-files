<?php
/**
 * Travel Booking Pro Import Hooks.
 *
 * @package Travel_Booking_Pro 
 */
 
/** Import content data*/
if ( ! function_exists( 'travel_booking_pro_import_files' ) ) :
function travel_booking_pro_import_files() {
    return array(
        array(
            'import_file_name'           => 'Default Layout',
            'import_file_url'            => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro.xml',
            'import_widget_file_url'     => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro.wie',
            'import_customizer_file_url' => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro.dat',
            'import_preview_image_url'   => get_template_directory_uri() . '/screenshot.png',
            'import_notice'              => __( 'Please wait for about 10 - 15 minutes. Do not close or refresh the page until the import is complete.', 'travel-booking-pro' ),
            'preview_url'                => 'https://demo.wptravelengine.com/travel-booking-pro/',
        ),
        array(
            'import_file_name'           => 'One Page Layout',
            'import_file_url'            => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro-one-page.xml',
            'import_widget_file_url'     => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro-one-page.wie',
            'import_customizer_file_url' => 'https://wptravelengine.com/wp-content/uploads/2018/08/travelbookingpro-one-page.dat',
            'import_preview_image_url'   => get_template_directory_uri() . '/screenshot.png',
            'import_notice'              => __( 'Please wait for about 10 - 15 minutes. Do not close or refresh the page until the import is complete.', 'travel-booking-pro' ),
            'preview_url'                => 'https://demo.wptravelengine.com/travel-booking-pro-one-page/',
        ),        
    );       
}
add_filter( 'pt-ocdi/import_files', 'travel_booking_pro_import_files' );
endif;

/** Programmatically set the front page and menu */
if ( ! function_exists( 'travel_booking_pro_after_import' ) ) :
    function travel_booking_pro_after_import(){    
        //Set Menu
        $primary = get_term_by( 'name', 'Primary', 'nav_menu' );
        set_theme_mod( 'nav_menu_locations' , array( 
              'primary'   => $primary->term_id,
             ) 
        );
      
        /** Set Front page */
        $page = get_page_by_path('home'); /** This need to be slug of the page that is assigned as Front page */
            if ( isset( $page->ID ) ) {
            update_option( 'page_on_front', $page->ID );
            update_option( 'show_on_front', 'page' );
        }
        
        /** Blog Page */
        $postpage = get_page_by_path('blog'); /** This need to be slug of the page that is assigned as Posts page */
        if( $postpage ){
            $post_pgid = $postpage->ID;
            
            update_option( 'page_for_posts', $post_pgid );
        }    
    }
add_action( 'pt-ocdi/after_import', 'travel_booking_pro_after_import' );
endif;

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );