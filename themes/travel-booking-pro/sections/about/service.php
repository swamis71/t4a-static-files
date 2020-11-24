<?php
/**
 * About page template service Section
 * 
 * @package Travel_Booking_Pro
*/

if( is_active_sidebar( 'about-service') ) : ?>
	<!-- our services section -->
	<section id="about-our-services-section" class="our-services">
		<div class="container">
			<div class="grid">
				<?php dynamic_sidebar( 'about-service' ); ?>
			</div>
		</div>
	</section>
<?php endif; ?>