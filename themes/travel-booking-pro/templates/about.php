<?php
/**
 * Template Name: About Template
 *
 * @package Travel_Booking_Pro
 */

get_header(); 

$about_template_sections = travel_booking_pro_get_about_page_template_section();

while ( have_posts() ) : the_post(); ?>
	<div class="about-us">
		<div class="container">
			<header class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header>
			<div class="about-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
<?php
endwhile;
wp_reset_postdata();

if( ! empty( $about_template_sections ) ){
	foreach( $about_template_sections as $section ){
		if( locate_template( $section . '.php' ) ){
			get_template_part( $section );
		}
	}
}

get_footer();