<?php
/**
 * Header Five
 * 
 * @package Travel_Booking_Pro
*/

$ed_search              = get_theme_mod( 'ed_header_search', true ); 
$phone                  = get_theme_mod( 'header_phone', __( '+0-000-000-0000', 'travel-booking-pro' ) );
$ed_header_social_links = get_theme_mod( 'ed_header_social_links', true );
$language               = ( travel_booking_pro_is_polylang_active() && has_nav_menu( 'language' ) ) ? true : false;

$default_social 		= array(
    array(
        'font'          => 'fa fa-facebook',
        'link'          => 'https://www.facebook.com/',                        
    ),
    array(
        'font'          => 'fa fa-twitter',
        'link'          => 'https://twitter.com/',
    ),
    array(
        'font'          => 'fa fa-youtube-play',
        'link'          => 'https://www.youtube.com/',
    ),
    array(
        'font'          => 'fa fa-instagram',
        'link'          => 'https://www.instagram.com/',
    ),
    array(
        'font'          => 'fa fa-google-plus-circle',
        'link'          => 'https://plus.google.com',
    ),
    array(
        'font'          => 'fa fa-odnoklassniki',
        'link'          => 'https://ok.ru/',
    ),
    array(
        'font'          => 'fa fa-vk',
        'link'          => 'https://vk.com/',
    ),
    array(
        'font'          => 'fa fa-xing',
        'link'          => 'https://www.xing.com/',
    )
);

$social_links           = get_theme_mod( 'header_social_links', $default_social );

if( empty( $phone ) &&  ! ( $ed_header_social_links && ! empty( $social_links ) ) ){ 
    $class = ' hide-header-top';
} else {
    $class ='';
} ?>

<header class="site-header header-five" itemscope itemtype="http://schema.org/WPHeader">
    <div class="header-holder">
        <div class="header-t">
            <div class="container">
                <?php travel_booking_pro_social_links( $ed_header_social_links, $social_links ); ?>
                <div class="site-branding">
                <?php travel_booking_pro_header_site_branding(); ?>
                </div>
                <div class="overlay"></div>
                <div id="toggle-button"><span></span></div>
                <div class="mobile-menu">
                    <div class="btn-close-menu"><span></span></div>
                    <?php 
                        if( $ed_search ) get_search_form();

                        echo '<nav id="site-navigation" class="main-navigation">';
                        travel_booking_pro_primary_nagivation();
                        echo '</nav>';

                        /**
                         * Language Switcher
                         */ 
                        do_action( 'travel_booking_pro_language_switcher' );
                    ?>
                </div>
                <div class="right">
                    <?php  if( $phone ) travel_booking_pro_header_phone( $phone ); ?>
                    <div class="separator"></div>
                    <div class="tools">
                        <?php 
                            /**
                             * Language Switcher
                             */ 
                            do_action( 'travel_booking_pro_language_switcher' );

                            if( $ed_search ) travel_booking_pro_get_header_search(); 
                        ?>
                    </div> <!-- tools -->
                </div> <!-- .right -->
            </div> <!-- container -->
        </div> <!-- header-t -->
    </div> <!-- header-holder -->
    <div class="sticky-holder"></div>
    <div class="navigation-holder">
        <div class="container">
            <nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <?php travel_booking_pro_primary_nagivation(); ?>
            </nav>
        </div>
    </div>
</header> <!-- header -->
