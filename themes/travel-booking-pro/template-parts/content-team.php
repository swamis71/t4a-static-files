<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Booking_Pro
 */

$designation = get_post_meta( get_the_ID(), '_tb_team_position', true );
$sociallinks = get_post_meta( get_the_ID(), '_tb_team_social', true );
$galleries   = get_post_meta( get_the_ID(), '_tb_team_gallery_ids', true );
$gal_title   = get_post_meta( get_the_ID(), '_tb_team_gallery_title', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
        if( has_post_thumbnail() ){
            echo ' <div class="post-thumbnail">';
            the_post_thumbnail( 'travel-booking-team-single', array( 'itemprop' => 'image' ) );   
            echo '</div>'; 
        } 
    ?>
    <header class="entry-header">

        <div class="team-info">
            <?php  
                the_title( '<h2 class="team-name">', '</h2>' );
                if( ! empty( $designation ) ) echo '<span class="designation">'. esc_html( $designation ) .'</span>';
            ?>
        </div>
        
        <?php if( ! empty( $sociallinks ) ){ ?>
            <ul class="social-networks">
                <?php 
                    foreach( $sociallinks as $key => $link ){
                        $add = ( $key == 'youtube' ) ? '-play' : '';
                        if( $link ) echo '<li><a href="' . esc_url( $link ) . '" target="_blank"><i class="fa fa-' . esc_attr( $key.$add ) . '"></i></a></li>';                                   
                    }
                ?>
            </ul>
        <?php } ?>

    </header>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <?php if( $galleries ){ ?>
        <div class="gallery">
            <?php if( $gal_title ) echo '<h3 class="title">' . esc_html( $gal_title ) . '</h3>';?>
            <div class="gallery-holder">
                <?php foreach( $galleries as $id ){ ?> 
                    <div class="img-holder"><img src="<?php echo esc_url( wp_get_attachment_image_url( $id, 'thumbnail' ) ); ?>"/></div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</article><!-- #post-<?php the_ID(); ?>-->