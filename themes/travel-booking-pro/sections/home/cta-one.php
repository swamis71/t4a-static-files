<?php
/**
 * CTA One Section
 * 
 * @package Travel_Booking_Pro
*/

if( is_active_sidebar( 'cta-one' ) ){ ?>
<!-- CTA -->
	<div id="cta-one-section" class="cta-section">
		<div class="container">
			<?php dynamic_sidebar( 'cta-one' ); ?>
		</div>
	</div>
<?php  }