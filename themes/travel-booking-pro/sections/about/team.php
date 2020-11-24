<?php
/**
 * About page template team Section
 * 
 * @package Travel_Booking_Pro
*/

$title       = get_theme_mod( 'about_team_section_title', __( 'Core Members', 'travel-booking-pro' ) );
$subtitle    = get_theme_mod( 'about_team_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );
$team_number = get_theme_mod( 'about_no_of_team', 3 );
$post_order  = get_theme_mod( 'about_team_post_order', 'date' );

$team_posts = array();
$team_args  = array();

for( $i=1; $i<=$team_number; $i++ ){
	$post_id = get_theme_mod( 'about_team_post_' . $i );
	if( ! empty( $post_id ) && $post_id > 0 ){
		$team_posts = array_merge( $team_posts, array( $post_id ) );
	}
}

if( 'selective' == $post_order && ! empty( $team_posts ) ){
	$team_args = array(
		'post_type'      => 'tb_team',
		'post_status'    => 'publish',
		'posts_per_page' => $team_number,
		'post__in'       => $team_posts,
		'orderby'        => 'post__in'
	);
}elseif( $post_order == 'menu_order' ){
	$team_args = array(
		'post_type'      => 'tb_team',
		'post_status'    => 'publish',
		'posts_per_page' => $team_number,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	);
}elseif( $post_order == 'date' ){
	$team_args = array(
		'post_type'      => 'tb_team',
		'post_status'    => 'publish',
		'posts_per_page' => $team_number,
	);
}

if( ! empty( $team_args ) ){
	$team_qry = new WP_Query( $team_args );
	?>

	<!-- Team Section -->
	<section id="about-team-section" class="team-section">
		<div class="container">
			<?php if( ! empty( $title ) || ! empty( $subtitle ) ){ ?>
				<header class="section-header">
					<?php 
						if( ! empty( $title ) ) echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>'; 
						if( ! empty( $subtitle ) ) echo '<div class="section-content">'. wp_kses_post( wpautop( $subtitle ) ) . '</div>'; 

					?>
				</header>
			<?php } 

			if( $team_qry->have_posts() ){ ?>
			<div class="grid">
				<?php while( $team_qry->have_posts() ){ $team_qry->the_post(); ?>
					<div class="col">
						<div class="img-holder">
							<?php 
								$image_size = 'travel-booking-team';

								if( has_post_thumbnail() ){
									the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); 
								} else {
									//fallback 
		                            travel_booking_pro_fallback_image( $image_size );
								}

								$sociallinks = get_post_meta( get_the_ID(), '_tb_team_social', true );

								if( ! empty( $sociallinks ) ){ ?>
									<div class="social-networks-holder">
										<ul class="social-networks">
											<?php 
												foreach( $sociallinks as $key => $link ){ 
													$add = ( $key == 'youtube' ) ? '-play' : '';
													if( $link ) echo '<li><a href="' . esc_url( $link ) . '" target="_blank"><i class="fa fa-' . esc_attr( $key.$add ) . '"></i></a></li>'; 
												}
											?>
										</ul>
									</div>
							<?php } ?>
						</div>
						<div class="text-holder">
							<div class="team-info">
								<?php 
									$designation = get_post_meta( get_the_ID(), '_tb_team_position', true );
									the_title( '<h3 class="team-name"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h3>' ); 
									if( $designation ) echo '<span class="designation">' . esc_html( $designation ) . '</span>';
								?>
							</div>
							<div class="team-content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php } 
				wp_reset_postdata();  
				?>
			</div>
			<?php } ?>
		</div>
	</section>
<?php }  