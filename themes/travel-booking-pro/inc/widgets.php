<?php
/**
 * Widgets
 *
 * @package Travel_Booking_Pro
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travel_booking_pro_widgets_init() {
	
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'travel-booking-pro' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'travel-booking-pro' ),
        ),
        'about' => array(
            'name'        => __( 'About Section', 'travel-booking-pro' ),
            'id'          => 'about', 
            'description' => __( 'Add "Text" widget for the title and description. Add "WP Travel Engine: Icon Text" widget for the about.', 'travel-booking-pro' ),
        ),
        'cta-one' => array(
            'name'        => __( 'Call to Action One Section', 'travel-booking-pro' ),
            'id'          => 'cta-one', 
            'description' => __( 'Add "WP Travel Engine: Call To Action Widget" for the cta one section.', 'travel-booking-pro' ),
        ),
        'cta-two' => array(
            'name'        => __( 'Call to Action Two Section', 'travel-booking-pro' ),
            'id'          => 'cta-two', 
            'description' => __( 'Add "WP Travel Engine: Call To Action Widget" for the cta two section.', 'travel-booking-pro' ),
        ),
        'client' => array(
            'name'        => __( 'Client Section', 'travel-booking-pro' ),
            'id'          => 'client', 
            'description' => __( 'Add "WP Travel Engine: Client Logo" for the client section.', 'travel-booking-pro' ),
        ),
        'about-intro' => array(
            'name'        => __( 'About Template Intro Section', 'travel-booking-pro' ),
            'id'          => 'about-intro', 
            'description' => __( 'Add "Text" widget for the title and description. Add "WP Travel Engine: Icon Text" widget for the Intro.', 'travel-booking-pro' ),
        ),
        'about-client' => array(
            'name'        => __( 'About Template Client Section', 'travel-booking-pro' ),
            'id'          => 'about-client', 
            'description' => __( 'Add "WP Travel Engine: Client Logo" for the client section.', 'travel-booking-pro' ),
        ),
        'about-service' => array(
            'name'        => __( 'About Template Service Section', 'travel-booking-pro' ),
            'id'          => 'about-service', 
            'description' => __( 'Add "Text" widget for the title and description. Add "WP Travel Engine: Image Text" widget for the services.', 'travel-booking-pro' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'travel-booking-pro' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'travel-booking-pro' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'travel-booking-pro' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'travel-booking-pro' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'travel-booking-pro' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'travel-booking-pro' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'travel-booking-pro' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'travel-booking-pro' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>',
    	) );
    }
    
    /** Dynamic sidebars */
    $dynamic_sidebars = travel_booking_pro_get_dynamnic_sidebar();
    
    foreach( $dynamic_sidebars as $k => $v ){
        if( ! empty( $v ) ){
            register_sidebar( array(
                'name'          => esc_attr( $v ),
                'id'            => esc_attr( $k ),
                'description'   => '',
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
        }
    }
}
add_action( 'widgets_init', 'travel_booking_pro_widgets_init' );