<?php
/**
 * About Section
 * 
 * @package Travel_Booking_Pro
*/

if( is_active_sidebar( 'client' ) ){ ?>
    <!-- clients section -->
    <div id="clients-section" class="clients-section">
    	<div class="container">
    		<?php dynamic_sidebar( 'client' ); ?>
    	</div>
    </div>
<?php } ?>