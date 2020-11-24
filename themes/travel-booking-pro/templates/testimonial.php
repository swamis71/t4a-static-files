<?php
/**
 * Template Name: Testimonial Template
 *
 * @package Travel_Booking_Pro
 */

get_header(); 
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            
        <?php while( have_posts() ){ the_post(); ?>  

            <article class="testimonial-page">
                <header class="page-header">
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?> 
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
                
        <?php } wp_reset_postdata(); ?>
        
        <?php 
            $post_order         = get_theme_mod( 'testimonial_template_post_order', 'date' );
            $args = array(
                'post_type'     => 'tb_testimonial',
                'post_per_page' => -1,
                'post_status'   => 'publish',
            );

            if( $post_order == 'menu_order' ){
                $args['order']   = 'ASC';
                $args['orderby'] = 'menu_order';
            }

            $qry =  new WP_Query( $args );

            if( $qry->have_posts() ){ ?>
                <div class="testimoanil-holder">
                    <?php while( $qry->have_posts() ){ $qry ->the_post(); 

                        $trip_title   = get_post_meta( get_the_ID(), '_tb_testimonail_trip_title', true );
                        $visited_trip = get_post_meta( get_the_ID(), '_tb_testimonail_visited_trip', true );
                        $trip_date    = get_post_meta( get_the_ID(), '_tb_testimonail_trip_date', true );
                        $trip_rating  = get_post_meta( get_the_ID(), '_tb_testimonail_trip_rating', true );
                    ?>

                        <div class="testimonial-item">
                            <div class="left">
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

                                <?php
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

                                    the_title( '<strong class="name">', '</strong>' ); 

                                    if( ! empty( $visited_trip ) ) echo '<address>'. esc_html( $visited_trip ) .'</address>';
                                ?>
                            </div>
                            <div class="right">
                                <?php 
                                    if( ! empty( $trip_date ) ) echo '<span class="visited-on">'. esc_html( $trip_date ) .'</span>';
                                    if( ! empty( $trip_title ) ) echo '<h2 class="testimonial-title">'. esc_html( $trip_title ) .'</h2>';
                                ?>
                                <div class="testimonial-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div> <!-- .testimonial-item -->

                    <?php } ?>
                </div>
                <?php
                wp_reset_postdata();
            }
        ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();

get_footer();