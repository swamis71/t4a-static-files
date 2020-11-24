<?php
/**
 * Banner Section
 * 
 * @package Travel_Booking_Pro
 */

/** Load default theme options */
$ed_banner_section = get_theme_mod( 'ed_banner_section', 'static_banner' );
$banner_title      = get_theme_mod( 'banner_title', __( 'Book unique homes and experiences all over the world.', 'travel-booking-pro' ) );
$slider_type       = get_theme_mod( 'slider_type', 'latest_posts' ); 
$slider_cat        = get_theme_mod( 'slider_cat' );
$slider_pages      = get_theme_mod( 'slider_pages' );
$slider_custom     = get_theme_mod( 'slider_custom' );
$posts_per_page    = get_theme_mod( 'no_of_slides', 3 );
$ed_caption        = get_theme_mod( 'slider_caption', true );
$read_more         = get_theme_mod( 'slider_readmore', __( 'Continue Reading', 'travel-booking-pro' ) );
$button_label      = get_theme_mod( 'banner_btn_label',  __( 'GET STARTED', 'travel-booking-pro' ) );
$button_url        = get_theme_mod( 'banner_btn_url', '#' );
$banner_newsletter = get_theme_mod( 'banner_newsletter' );
$banner_content    = get_custom_header_markup();

$class = has_header_video() ? 'video-banner' : '';

if( ( $ed_banner_section == 'static_banner' || $ed_banner_section == 'static_nl_banner' ) && has_custom_header() ){ ?>
    <div id="banner-section" class="banner <?php echo esc_attr( $class ); ?>">
    	<?php 

            the_custom_header_markup(); 
            
            if( $ed_banner_section == 'static_banner' && ( $banner_title || ( $button_label && $button_url ) ) ){ ?>	
                <div class="banner-text">
            		<?php 
                        if( $banner_title ) echo '<h2 class="title">' . esc_html( travel_booking_pro_get_banner_title() ) . '</h2>';
                        if( $button_label && $button_url ) echo '<a href="'. esc_url( $button_url ) .'" class="primary-btn">'. esc_html( $button_label ) .'</a>';
                    ?>
            	</div>            
            <?php 
            }elseif( $ed_banner_section == 'static_nl_banner' && $banner_newsletter ){
                echo '<div class="banner-text"><div class="wrapper">';
                echo do_shortcode( wp_kses_post( $banner_newsletter ) );
                echo '</div></div>';
            }   
        ?>
    </div> <!-- banner ends -->
<?php
} elseif( $ed_banner_section == 'slider_banner' ){
    $image_size = 'travel-booking-slider';
    
    if( $slider_type == 'latest_posts' || $slider_type == 'cat' || $slider_type == 'pages' ){        
        $args = array(
            'post_status'         => 'publish',            
            'ignore_sticky_posts' => true
        );
        
        if( $slider_type === 'cat' && $slider_cat ){
            $args['post_type']      = 'post';
            $args['cat']            = $slider_cat; 
            $args['posts_per_page'] = -1;  
        }elseif( $slider_type == 'pages' && $slider_pages ){
            $args['post_type']      = 'page';
            $args['posts_per_page'] = -1;
            $args['post__in']       = travel_booking_pro_get_id_from_page( $slider_pages );
            $args['orderby']        = 'post__in';
        }else{
            $args['post_type']      = 'post';
            $args['posts_per_page'] = $posts_per_page;
        }
            
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div id="banner-section" class="banner">
                <div id="banner-slider" class="owl-carousel">            
                <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <div class="item">
                    <?php 
                    if( has_post_thumbnail() ){
                        the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
                    }else{ 
                        travel_booking_pro_fallback_image( $image_size );;
                    }
                    
                    if( $ed_caption ){ ?>                        
                    <div class="banner-caption">
                        <div class="wrapper">
                            <div class="banner-text">
                            <?php
                                the_title( '<h2 class="title">', '</h2>' );
                                if( $read_more ) echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn-more primary-btn">' . esc_html( $read_more ) . '</a>';                              
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>                        
            </div>                
        </div>
        <?php
        wp_reset_postdata();
        }
    
    }elseif( $slider_type == 'custom' && $slider_custom ){ ?>
        <div id="banner-section" class="banner">
            <div id="banner-slider" class="owl-carousel">
                <?php 
                foreach( $slider_custom as $slide ){ 
                    if( $slide['thumbnail'] || $slide['title'] || $slide['link'] ){ ?>
                    <div class="item">
                        <?php 
                        if( $slide['thumbnail'] ){
                            $image = wp_get_attachment_image_url( $slide['thumbnail'], $image_size ); ?>
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $slide['title'] );?>" itemprop="image" />
                            <?php
                        }else{ 
                            echo '<img src="'. esc_url( get_template_directory_uri() .'/images/travel-booking-slider.jpg' ) .'" alt="'. esc_attr( get_the_title() ).'">';
                        }
                        
                        if( $ed_caption ){ ?>                        
                        <div class="banner-caption">
                            <div class="wrapper">
                                <div class="banner-text">
                                <?php
                                    if( $slide['title'] ){
                                        echo '<h2 class="title">';
                                        echo esc_html( $slide['title'] );
                                        echo '</h2>';    
                                    }
                                    if( $read_more && ! empty( $slide['link'] ) ) echo '<a href="' . esc_url( $slide['link'] ) . '" class="btn-more primary-btn">' . esc_html( $read_more ) . '</a>';                              
                                ?>
                                </div>
                            </div>
                        </div>                        
                        <?php } ?>
                    </div>
                    <?php 
                    } 
                } 
                ?>                        
            </div>            
        </div>
        <?php
    }
}       