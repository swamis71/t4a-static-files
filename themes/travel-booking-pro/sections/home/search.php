<?php
/**
 * Search Section
 * 
 * @package Travel_Booking_Pro
 */

$ed_search = get_theme_mod( 'ed_search_bar', true );

if( travel_booking_pro_is_wte_advanced_search_active() && $ed_search ){ ?>
    <div id="search-section" class="trip-search">
    	<div class="container">
    		<?php echo do_shortcode( '[Wte_Advanced_Search_Form]' ); ?>
    	</div>
    </div>

<?php
}