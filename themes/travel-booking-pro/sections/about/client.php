<?php
/**
 * About page template client Section
 * 
 * @package Travel_Booking_Pro
*/

if( is_active_sidebar( 'about-client') ) : ?>
	<!-- clients section -->
	<div id="about-clients-section" class="clients-section">
		<div class="container">
			<?php dynamic_sidebar( 'about-client' ); ?>
		</div>
	</div>
<?php endif; ?>