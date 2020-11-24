<?php
/**
 * Testimonial Section
 * 
 * @package Travel_Booking_Pro
 */

$title              = get_theme_mod( 'testimonial_section_title', __( 'Testimonials', 'travel-booking-pro' ) );
$content            = get_theme_mod( 'testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-booking-pro' ) );
$post_order         = get_theme_mod( 'testimonial_post_order', 'date' );
$ed_demo            = get_theme_mod( 'ed_testimonial_demo', true );
$no_of_testimonials = get_theme_mod( 'no_of_testimonial', 3 );
$view_all_text      = get_theme_mod( 'testimonial_view_all', __( 'Read All Testimonials', 'travel-booking-pro' ) ); 
$testimonial_link   = get_theme_mod( 'testimonial_link', '#' ); 

$args = array(
    'post_type'      => 'tb_testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => $no_of_testimonials,
);

if( $post_order == 'menu_order' ){
    $args['order']   = 'ASC';
    $args['orderby'] = 'menu_order';
}

$qry = new WP_Query( $args );

if( $title || $content || $qry->have_posts() ){ ?>
	<!-- testimonial-section -->
	<section id="testimonials-section" class="testimonial-section">

		<?php if( $title || $content ){ ?>
			<div class="container">
				<header class="section-header">
					<?php 
						if( ! empty( $title ) ) echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>';

						if( ! empty( $content ) ){
							echo '<div class="section-content">'. wp_kses_post( wpautop( $content ) ) .'</div>';
						}
					?>
				</header>
			</div>
		<?php } 

		if( $qry->have_posts() ){ ?>
			<div class="testimonial-holder">
	        		<div id="testimonial-carousel" class="owl-carousel">
	        			<?php 
	                        while( $qry->have_posts() ){ 
	                            $qry->the_post();

								$trip_title   = get_post_meta( get_the_ID(), '_tb_testimonail_trip_title', true );
								$visited_trip = get_post_meta( get_the_ID(), '_tb_testimonail_visited_trip', true );
								$trip_date    = get_post_meta( get_the_ID(), '_tb_testimonail_trip_date', true );
								$trip_rating  = get_post_meta( get_the_ID(), '_tb_testimonail_trip_rating', true );
	                            ?>
	                            <div class="item">                				
	                                <div class="holder">
									   <div class="testimonial-content">
									   		<?php 
									   			if( $trip_title ) echo '<h3 class="title">' . esc_html( $trip_title ) . '</h3>'; 

									   			if( $trip_rating || $trip_date ){
									   				echo '<div class="meta">';

									   				if( $trip_rating ) {
									   					echo '<div class="star-holder">';
									   					echo '<span id="rating-' . get_the_ID() . '"></span>';
									   					echo '</div>';
														echo '<script>
								                        jQuery(document).ready(function($){
								                            $("#rating-' . get_the_ID() . '").rateYo({
								                                rating: ' . $trip_rating . ',
								                                starWidth: "13px",
								                                readOnly: true
								                            });
								                        });
								                        </script>';     
									   				}

									   				if(  $trip_date ) echo '<span class="visited-on">'. esc_html( $trip_date ) .'</span>';

									   				echo '</div>';
									   			}
									   		?>
									        <div class="text-holder">
									            <?php the_content(); ?>
									        </div>
									   </div>
									   <div class="testimonial-meta">
									   		<div class="img-holder">
										   		<?php 
									                if( has_post_thumbnail() ){
									                    the_post_thumbnail( 'thumbnail', array( 'itemprop' => 'image' ) );
									                }else{
											        	//fallback image 
											        	travel_booking_pro_fallback_image( 'travel-booking-thumbnail' );
											        }
									            ?>
									       </div>
									       <div class="name">
									       		<?php 
									       			the_title( '<strong>', '</strong>' ); 
									       			if( $visited_trip ) echo '<span>'. esc_html( $visited_trip ) .'</span>';
									       		?>
									       </div>
									   </div>
									</div>
	                			</div>			
	                            <?php 
	                        }
	                        wp_reset_postdata(); 
	                    ?>
	        		</div>
	        	</div>
		<?php } elseif ( $ed_demo ) {
			echo '<div class="testimonial-holder"><img src="'. esc_url( get_template_directory_uri() .'/images/testimonial-img.png') .'" alt="'. __( 'Demo Testimonial Image', 'travel-booking-pro' ).'"></div>';
		}

		if( ! empty( $view_all_text ) && ! empty( $testimonial_link ) ){ ?>
			<div class="btn-holder">
				<a href="<?php echo esc_url( $testimonial_link ); ?>" class="primary-btn"><?php echo esc_html( $view_all_text ) ?></a>
			</div>
		<?php } ?>

	</section>
<?php }