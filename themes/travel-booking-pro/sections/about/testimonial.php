<?php
/**
 * About page template testimonial Section
 * 
 * @package Travel_Booking_Pro
*/

$title              = get_theme_mod( 'about_testimonial_section_title', __( 'Happy Travellers', 'travel-booking-pro' ) ); // from_customizer
$no_of_testimonials = get_theme_mod( 'about_no_of_testimonial' ); // from_customizer
$post_order         = get_theme_mod( 'about_testimonial_post_order', 'date' );

$testimonial_args = array(
    'post_type'      => 'tb_testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => $no_of_testimonials,
);

if( $post_order == 'menu_order' ){
    $testimonial_args['order']   = 'ASC';
    $testimonial_args['orderby'] = 'menu_order';
}

$testimonial_qry = new WP_Query( $testimonial_args ); ?>
	<!-- testimonial-section -->
	<section id="about-testimonial-section" class="testimonial-section">

        <?php if( ! empty( $title ) ){ ?>
    		<div class="container">
    			<header class="section-header">
    				<?php echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>'; ?>
    			</header>
    		</div>
        <?php }

        if( $testimonial_qry->have_posts() ){ ?>
		<div class="testimonial-holder">
			<div id="testimonial-carousel" class="owl-carousel">
				<?php 
                    while( $testimonial_qry->have_posts() ){ 
                        $testimonial_qry->the_post();

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
			</div><!-- .owl-carousel -->
		</div>
		<?php } ?>
	</section>