<?php
/**
 * Template Name: Team Template
 *
 * @package Travel_Booking_Pro
 */

get_header();

while ( have_posts() ) : the_post();?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<article class="page">
							<header class="page-header">
								<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
							</header>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>
					</main>
				</div>
			</div>
		</div>
	</div>
	<?php 
	endwhile; 
	wp_reset_postdata(); 

    $show_core_member_section     = get_theme_mod( 'ed_core_member', true );
	$core_member_section_title    = get_theme_mod( 'core_member_section_title',  __( 'Core Members', 'travel-booking-pro' ) );
	$core_member_section_subtitle = get_theme_mod( 'core_member_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );
	$core_member_team_number      = get_theme_mod( 'core_member_team_number', 3 );
	$core_member_post_order       = get_theme_mod( 'core_member_post_order', 'date' );

	if( $show_core_member_section ){ 
		$core_member_posts = array();
		$core_member_args  = array();

		for( $i=1; $i<=$core_member_team_number; $i++ ){
			$post_id = get_theme_mod( 'core_member_post_' . $i );
			if( ! empty( $post_id ) && $post_id > 0 ){
				$core_member_posts = array_merge( $core_member_posts, array( $post_id ) );
			}
		}

		if( 'selective' == $core_member_post_order && ! empty( $core_member_posts ) ){
			$core_member_args = array(
				'post_type'      => 'tb_team',
				'post_status'    => 'publish',
				'posts_per_page' => $core_member_team_number,
				'orderby'        => 'post__in',
				'post__in'       => $core_member_posts,
			);
		}elseif( 'menu_order' == $core_member_post_order ){
			$core_member_args = array(
				'post_type'      => 'tb_team',
				'post_status'    => 'publish',
				'posts_per_page' => $core_member_team_number,
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
			);
		}elseif( 'date' == $core_member_post_order ) {
			$core_member_args = array(
				'post_type'      => 'tb_team',
				'post_status'    => 'publish',
				'posts_per_page' => $core_member_team_number,
			);
		}

		if( ! empty( $core_member_args ) ){
			$core_member_qry = new WP_Query( $core_member_args );?>

			<!-- Team Section -->
			<section id="core-member-section" class="team-section">
				<div class="container">
					<?php if( ! empty( $core_member_section_title ) || ! empty( $core_member_section_subtitle ) ){ ?>
						<header class="section-header">
							<?php 
								if( ! empty( $core_member_section_title ) ) echo '<h2 class="section-title">'. esc_html( $core_member_section_title ) .'</h2>'; 
								if( ! empty( $core_member_section_subtitle ) ) echo '<div class="section-content">'. wp_kses_post( wpautop( $core_member_section_subtitle ) ) . '</div>'; 

							?>
						</header>
					<?php } 

					if( $core_member_qry->have_posts() ){ ?>
					<div class="grid">
						<?php while( $core_member_qry->have_posts() ){ $core_member_qry->the_post(); ?>
							<div class="col">
								<div class="img-holder">
									<?php 
										$image_size = 'travel-booking-team';

										if( has_post_thumbnail() ){
											the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); 
										} else {
											// Fallback image
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
			<!-- team-members section -->
		<?php
		}
	}

	$show_our_team_section     = get_theme_mod( 'ed_our_team', true );
	$our_team_section_title    = get_theme_mod( 'our_team_section_title', __( 'Our Team', 'travel-booking-pro' ) );
	$our_team_section_subtitle = get_theme_mod( 'our_team_section_subtitle', __( 'From troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.', 'travel-booking-pro' ) );
	$post_order                = get_theme_mod( 'our_team_post_order', 'date' );

	if( $show_our_team_section ){

		$our_team_args = array(
		    'post_type'      => 'tb_team',
		    'post_status'    => 'publish',
		    'posts_per_page' => -1,
		);

		if( $post_order == 'menu_order' ){
		    $our_team_args['order']   = 'ASC';
		    $our_team_args['orderby'] = 'menu_order';
		}

		$our_team_qry = new WP_Query( $our_team_args ); ?>

		<section id="our-team-section" class="our-teams">
			<div class="container">

				<?php if( ! empty( $our_team_section_title ) || ! empty( $our_team_section_subtitle ) ) : ?>
					<header class="section-header">
						<?php 
							if( ! empty( $our_team_section_title ) ) echo '<h2 class="section-title">'. esc_html( $our_team_section_title ) .'</h2>';
							if( ! empty( $our_team_section_subtitle ) ) echo '<div class="section-content">'. wp_kses_post( wpautop( $our_team_section_subtitle ) ) .'</div>';
						?>
					</header>
				<?php endif; 

				if( $our_team_qry->have_posts() ){ ?>
					<div class="grid">
						<?php while( $our_team_qry->have_posts() ){ $our_team_qry->the_post(); ?>
							<div class="col">
								<div class="img-holder">
									<a href="<?php the_permalink(); ?>">
										<?php 
											$image_size = 'travel-booking-team';

											if( has_post_thumbnail() ){
												the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); 
											} else {
												//fallback image
					                           travel_booking_pro_fallback_image( $image_size );
											} 
										?>
									</a>
								</div>
								<div class="text-holder">
									<?php 
										$designation = get_post_meta( get_the_ID(), '_tb_team_position', true );
										the_title( '<h3 class="team-name"><a href="'. esc_url( get_the_permalink() ).'">', '</a></h3>' );
										if( $designation ) echo '<span class="designation">' . esc_html( $designation ) . '</span>';
									?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php }
get_footer(); ?>