<?php
/**
 * Template Name: Contact Template
 *
 * @package Travel_Booking_Pro
 */
get_header(); 

$contact_detail_title = get_theme_mod( 'ct_detail_title', __( 'Contact Information', 'travel-booking-pro' ) );
$show_gmap            = get_theme_mod( 'ed_ct_google_map', true );
$phone_number         = get_theme_mod( 'ct_phone', __( '1-800-567-0123', 'travel-booking-pro' ) );
$address              = get_theme_mod( 'ct_address', __( '12 Street, New York City', 'travel-booking-pro' ) );
$email                = get_theme_mod( 'ct_email', __( 'domain@email.com', 'travel-booking-pro' ) );
$social_links         = get_theme_mod( 'ct_social_links', array() );
?>
    <div class="contact-holder">

        <?php while ( have_posts() ) : the_post(); ?>
            <div class="left">
                <header class="page-header">
                    <?php 
                        the_title( '<h1 class="page-title">', '</h1>' );
                        the_content();
                    ?>
                </header>
            </div>

            <div class="right">
                <?php 
                    if( $show_gmap || has_post_thumbnail() ){
                        echo '<div class="map-holder">';
                            if( $show_gmap ) {
                                echo '<div id="map-canvas" class="map-holder"></div><!-- .map-holder -->';
                            } else {
                                the_post_thumbnail( 'travel-booking-gmap', array( 'itemprop' => 'image' ) );
                            }
                        echo '</div>';
                    }
                ?>

                <div class="contact-info">
                    <?php  
                        if( ! empty( $contact_detail_title ) ) echo '<h3>'. esc_html( $contact_detail_title ).'</h3>';

                        if( !empty( $phone_number ) ){
                            echo ' <div class="phone">
                                <svg x="0px" y="0px" viewBox="0 0 32 32">
                                    <path class="st0" d="M23,0H9C6.8,0,5,1.8,5,4v24c0,2.2,1.8,4,4,4H23c2.2,0,4-1.8,4-4V4C26.9,1.8,25.2,0,23,0z M19,28.2
                                    c0,0.4-0.3,0.8-0.7,0.8h-4.5c-0.4,0-0.7-0.3-0.7-0.8v-1.5c0-0.4,0.3-0.7,0.7-0.7h4.5c0.4,0,0.7,0.3,0.7,0.7V28.2z M23,23H9V4H23
                                    V23z"/>
                                </svg>
                                <a href="tel:'. esc_attr( preg_replace( '/\D/', '', $phone_number ) ) .'">'. esc_html( $phone_number ) .'</a>
                            </div>';
                        }

                        if( !empty( $address ) ){
                            echo '<div class="address">
                                <svg x="0px" y="0px" viewBox="0 0 32 32">
                                    <path class="st1" d="M23,15.9C22.7,12,19.7,9,16,9c-3.7,0-6.7,3-7,6.9c-0.1,1.8,0.4,3.5,1.5,4.9l5,6.9c0.2,0.3,0.6,0.3,0.9,0.1
                                    c0,0,0.1-0.1,0.1-0.1l5-6.9C22.5,19.4,23.1,17.7,23,15.9z M18.9,16.1c0,1.7-1.3,3-2.9,3v0c-1.6,0-2.9-1.3-2.9-3
                                    c0-1.7,1.3-3,2.9-3C17.6,13.1,18.9,14.4,18.9,16.1L18.9,16.1z"/>
                                </svg>
                                <address>'. esc_html( $address ) .'</address>
                            </div>';
                        }

                        if( !empty( $email ) ){
                            echo '<div class="email">
                                <svg x="0px" y="0px" viewBox="0 0 32 32">
                                    <path class="st1" d="M25,13.3C25,13.3,25,13.3,25,13.3c0-1.3-1-2.3-2.2-2.3H10.2C9,11,8,12,8,13.3c0,0,0,0,0,0c0,0,0,0,0,0v9.5
                                    C8,24,9,25,10.2,25h12.5c1.2,0,2.2-1,2.2-2.3L25,13.3C25,13.3,25,13.3,25,13.3z M10.2,12.4h12.5c0.4,0,0.7,0.2,0.8,0.6l-7.1,5
                                    l-7.1-5C9.6,12.6,9.9,12.4,10.2,12.4z M23.6,22.7c0,0.5-0.4,0.9-0.9,0.9H10.2c-0.5,0-0.9-0.4-0.9-0.9v-8.1l6.7,4.8
                                    c0.1,0.1,0.3,0.1,0.4,0.1c0.1,0,0.3,0,0.4-0.1l6.7-4.8V22.7z"/>
                                </svg>
                                <a href="mailto:'. sanitize_email( $email ) .'">'. sanitize_email( $email ) .'</a>
                            </div>';
                        }

                        travel_booking_pro_social_links( true, $social_links ); 
                    ?>
                    
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php
get_footer();