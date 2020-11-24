<?php
/**
 * Header One
 * 
 * @package Travel_Booking_Pro
*/

$ed_search = get_theme_mod( 'ed_header_search', true ); 
$language  = ( travel_booking_pro_is_polylang_active() && has_nav_menu( 'language' ) ) ? true : false;
$sticky    = get_theme_mod( 'ed_sticky_header', false );
?>

<div class="sticky-holder"></div>
<header class="site-header header-one<?php if( $sticky ) echo ' sticky-menu';?>">
    <div class="site-branding">
        <?php travel_booking_pro_header_site_branding(); ?>
    </div>
    <div class="overlay"></div>
    <div id="toggle-button">
        <span></span>
    </div>
    <div class="mobile-menu">
        <div class="btn-close-menu"><span></span></div>
        <?php  if( $ed_search ) get_search_form(); ?>
        <nav id="site-navigation" class="main-navigation">
            <?php travel_booking_pro_primary_nagivation(); ?>
        </nav>
        <?php 
             /**
             * Language Switcher
             *
             * travel_booking_pro_polylang_language_switcher
             */ 
             do_action( 'travel_booking_pro_language_switcher' );
        ?>
    </div> <!-- mobile-menu -->
    <div class="right">
        <nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
           <?php travel_booking_pro_primary_nagivation(); ?>
        </nav>

        <?php if( $language || $ed_search ){ ?>
            <div class="tools">
                <?php 
                    /**
                     * Language Switcher
                     *
                     * travel_booking_pro_polylang_language_switcher
                    */ 
                    do_action( 'travel_booking_pro_language_switcher' );

                    if( $ed_search ) travel_booking_pro_get_header_search(); 
                ?>
            </div>
        <?php } ?>
    </div>

</header> <!-- header ends -->
