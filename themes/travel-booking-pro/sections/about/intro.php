<?php
/**
 * About page template Intro Section
 * 
 * @package Travel_Booking_Pro
*/

if( is_active_sidebar( 'about-intro' ) ) : ?>
	<!-- why book with us section -->
	<section id="about-intro-section" class="intro-section">
		<div class="container">
			<div class="grid">
				<?php dynamic_sidebar( 'about-intro' ); ?>
			</div>
		</div>
	</section>
<?php endif; ?>