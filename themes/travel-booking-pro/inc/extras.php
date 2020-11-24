<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_header_site_branding' ) ) :
    /**
     * Site branding
     */
    function travel_booking_pro_header_site_branding(){
        
        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
            the_custom_logo();
        } 
        
        echo '<div class="text-logo">';

        if( is_front_page() ){ ?>
            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ) ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
        <?php }else{ ?>
            <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ) ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
        <?php
        }

        $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ){ ?>
            <p class="site-description" itemprop="description"><?php echo $description; ?></p>
        <?php
        }

        echo '</div>';
    }
endif;

if( ! function_exists( 'travel_booking_pro_social_links' ) ) :
    /**
     * Prints social links
     */
    function travel_booking_pro_social_links( $ed_social = false , $social_links = array() ){
        
        if( $ed_social && $social_links ){
            echo '<ul class="social-networks">';
            foreach( $social_links as $link ){
                if( $link['link'] && $link['font'] ) echo '<li><a href="' . esc_url( $link['link'] ) . '" target="_blank" rel="nofollow"><i class="' . esc_attr( $link['font'] ) . '"></i></a></li>';         
            }
           echo '</ul>';    
        }
    }
endif;

if( ! function_exists( 'travel_booking_pro_header_phone' ) ) :
    /**
     * Phone
     */
    function travel_booking_pro_header_phone( $phone ){ ?>
        <a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D/', '', $phone ) ); ?>" class="tel-link"><i class="fa fa-phone"></i><?php echo esc_html( $phone ); ?></a>
        <?php
    }
endif;

if ( ! function_exists( 'travel_booking_pro_posted_on' ) ) :
    /**
     * Posted On
     */
    function travel_booking_pro_posted_on() {
        $post_updated_date = get_theme_mod( 'ed_post_update_date', true );
        $on                = '';

    	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            if( $post_updated_date ){
                $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
                $on = __( 'Updated on ', 'travel-booking-pro' );                         
            }else{
                $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
            }
        }else{
           $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
        }

    	$time_string = sprintf( $time_string,
    		esc_attr( get_the_date( 'c' ) ),
    		esc_html( get_the_date() ),
    		esc_attr( get_the_modified_date( 'c' ) ),
    		esc_html( get_the_modified_date() )
    	);

    	$posted_on = sprintf( '%1$s %2$s', '<i class="fa fa-clock-o"></i> '. esc_html( $on ) .'', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

        echo '<span class="posted-on">'. $posted_on .'</span>';
    }
endif;

if( ! function_exists( 'travel_booking_pro_posted_by' ) ) :
    /**
     * Posted By
    */
    function travel_booking_pro_posted_by(){
        echo '<span class="byline"><i class="fa fa-user"></i><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    }
endif; 

if( ! function_exists( 'travel_booking_pro_categories' ) ) :
    /**
     * Blog Categories
    */
    function travel_booking_pro_categories(){
        // Hide category and tag text for pages.
    	if ( 'post' === get_post_type() ) {
    		/* translators: used between list items, there is a space after the comma */
    		$categories_list = get_the_category_list( esc_html__( ' ', 'travel-booking-pro' ) );
    		if ( $categories_list ) {
    			echo $categories_list;
    		}	
    	}
    }
endif;

if( ! function_exists( 'travel_booking_pro_tags' ) ) :
/**
 * Blog Categories
*/
function travel_booking_pro_tags(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {	
		/* translators: used between list items, there is a space */
		$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'travel-booking-pro' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags">' . $tags_list . '</div>' ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'travel_booking_pro_comment_count' ) ) :
/**
 * Comments counts
 */
function travel_booking_pro_comment_count(){	
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="fa fa-comment-o"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'travel-booking-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			), 
            '1', 
            '%' 
		);
		echo '</span>';
	}	
}
endif;

if ( ! function_exists( 'travel_booking_pro_sidebar' ) ) :
    /**
     * Return sidebar for different archive and single pages
     */
    function travel_booking_pro_sidebar( $class = false ){
        global $post;
        $return = false;

        /** Load default theme options */
        $show_on_front   = get_option( 'show_on_front' );
        $blogpage_id     = get_option( 'page_for_posts' );
        $frontpage_id    = get_option( 'page_on_front' );
        
        // Default blogpage sidebar
        $blog_sidebar = get_theme_mod( 'home_page_sidebar', 'sidebar' );
        $blog_layout  = get_theme_mod( 'blog_sidebar_layout', 'right-sidebar' );
        
        // Default sidebar layout 
        $layout = get_theme_mod( 'default_sidebar_layout', 'right-sidebar' );

        if ( is_home() ){
            if( 'page' == $show_on_front && $blogpage_id > 0 ){
                $single_sidebar = get_post_meta( $blogpage_id, '_tb_sidebar', true );
                $single_sidebar = ! empty( $single_sidebar ) ? $single_sidebar : 'default-sidebar';

                $sidebar_layout = get_post_meta( $blogpage_id, '_tb_sidebar_layout', true );
                $sidebar_layout = ! empty( $sidebar_layout ) ? $sidebar_layout : 'default-sidebar';

                if( ( $single_sidebar == 'no-sidebar' ) || ( ( $single_sidebar == 'default-sidebar' ) && ( $blog_sidebar == 'no-sidebar' ) ) ){
                    $return = $class ? 'fullwidth' : false;
                }elseif( $single_sidebar == 'default-sidebar' && $blog_sidebar != 'no-sidebar' && is_active_sidebar( $blog_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $blog_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                        $return = $class ? 'rightsidebar' : $blog_sidebar;
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $blog_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                        $return = $class ? 'leftsidebar' : $blog_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $single_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $blog_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                        $return = $class ? 'rightsidebar' : $single_sidebar;
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $blog_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                        $return = $class ? 'leftsidebar' : $single_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }else{
                    $return = $class ? 'fullwidth' : false;
                }

            }elseif( is_active_sidebar( $blog_sidebar ) ){            
                if( $blog_layout == 'right-sidebar' ){
                    $return = $class ? 'rightsidebar' : $blog_sidebar;
                }elseif( $blog_layout == 'left-sidebar' ){
                    $return = $class ? 'leftsidebar' : $blog_sidebar;
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
            }else{
                $return = $class ? 'fullwidth' : false;
            }        
        }
    
        if ( is_archive() ) {
            //archive page
            $archive_sidebar = get_theme_mod( 'archive_page_sidebar', 'sidebar' );
            $cat_sidebar     = get_theme_mod( 'cat_archive_page_sidebar', 'default-sidebar' );
            $tag_sidebar     = get_theme_mod( 'tag_archive_page_sidebar', 'default-sidebar' );
            $date_sidebar    = get_theme_mod( 'date_archive_page_sidebar', 'default-sidebar' );
            $author_sidebar  = get_theme_mod( 'author_archive_page_sidebar', 'default-sidebar' );

            if( is_post_type_archive( 'trip' ) ){
               $return = $class ? 'fullwidth' : false;
            }elseif( ! is_active_sidebar( 'sidebar' ) && ! is_singular( 'trip' ) ){
                return 'fullwidth'; 
            } elseif ( is_category() ){
                
                if ( $cat_sidebar == 'no-sidebar' || ( $cat_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ) {
                    $return = $class ? 'fullwidth' : false;
                } elseif ( $cat_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) {
                    if( $layout == 'right-sidebar' ) {
                        $return = $class ? 'rightsidebar' : $archive_sidebar;
                    }elseif( $layout == 'left-sidebar' ) {
                        $return = $class ? 'leftsidebar' : $archive_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } elseif ( is_active_sidebar( $cat_sidebar ) ){
                    if( $layout == 'right-sidebar' ) {
                        $return = $class ? 'rightsidebar' : $cat_sidebar;
                    }elseif( $layout == 'left-sidebar' ) {
                        $return = $class ? 'leftsidebar' : $cat_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } else {
                    $return = $class ? 'fullwidth' : false;
                }
                    
            } elseif ( is_tag() ) {
                
                if( $tag_sidebar == 'no-sidebar' || ( $tag_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                   $return = $class ? 'fullwidth' : false;
                }elseif( ( $tag_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $archive_sidebar;
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $archive_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $tag_sidebar ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $tag_sidebar;
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $tag_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }     
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
                
            } elseif ( is_author() ) {
                
                if( $author_sidebar == 'no-sidebar' || ( $author_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                    $return = $class ? 'fullwidth' : false;
                }elseif( ( $author_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                    if( $layout == 'right-sidebar' ){ 
                        $return = $class ? 'rightsidebar' : $archive_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){ 
                        $return = $class ? 'leftsidebar' : $archive_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $author_sidebar ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $author_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $author_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
                
            } elseif ( is_date() ) {
                
               if( $date_sidebar == 'no-sidebar' || ( $date_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                    $return = $class ? 'fullwidth' : false;
                }elseif( ( $date_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $archive_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $archive_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $date_sidebar ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $date_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $date_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }else{
                    $return = $class ? 'fullwidth' : false;
                }                                                  
                
            } elseif ( travel_booking_pro_is_woocommerce_activated() && is_archive( 'product' ) ) {
                if ( $archive_sidebar != 'no-sidebar' && is_active_sidebar( 'shop-sidebar' ) ) {
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : 'shop-sidebar'; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : 'shop-sidebar'; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } elseif( is_active_sidebar( $archive_sidebar ) ) {
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $archive_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $archive_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } else {
                   $return = $class ? 'fullwidth' : false;
                }                      
            } else {
                if ( $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) {
                    
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $archive_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $archive_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } else {
                   $return = $class ? 'fullwidth' : false;
                }                      
            }
            
        }
        
        if ( is_singular() ) {
            $post_sidebar = get_theme_mod( 'single_post_sidebar', 'sidebar' );
            $page_sidebar = get_theme_mod( 'single_page_sidebar', 'sidebar' );
            $page_layout  = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' );
            $post_layout  = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' );
            
            // Single post/page selected sidebar
            $single_sidebar = get_post_meta( $post->ID, '_tb_sidebar', true );
            $single_sidebar = ! empty( $single_sidebar ) ? $single_sidebar : 'default-sidebar';

            // Single post/page sidebar layout
            $sidebar_layout = get_post_meta( $post->ID, '_tb_sidebar_layout', true );
            $sidebar_layout = ! empty( $sidebar_layout ) ? $sidebar_layout : 'default-sidebar';

            if( is_singular( 'trip' ) ){
                $wpte_option_setting = get_option('wp_travel_engine_settings', array() );
                $hide_sidebar        = false;

                if( ! empty( $wpte_option_setting ) && isset( $wpte_option_setting['booking'] ) ) $hide_sidebar =  true;

                if( is_active_sidebar( 'wte-sidebar-id' ) || false == $hide_sidebar ){
                    $return = $class ? 'right-sidebar' : false;
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
            }elseif ( travel_booking_pro_is_woocommerce_activated() && is_singular( 'product' ) ) {
                if( is_active_sidebar( 'shop-sidebar' ) ){
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : 'shop-sidebar'; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : 'shop-sidebar'; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                } else {
                    if( $layout == 'right-sidebar' ){
                        $return = $class ? 'rightsidebar' : $post_sidebar; 
                    }elseif( $layout == 'left-sidebar' ){
                        $return = $class ? 'leftsidebar' : $post_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }
            } elseif ( is_page() ){

                if( is_page_template( array( 'templates/about.php', 'templates/contact.php', 'templates/team.php', 'templates/testimonial' ) ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( ( $single_sidebar == 'no-sidebar' ) || ( ( $single_sidebar == 'default-sidebar' ) && ( $page_sidebar == 'no-sidebar' ) ) ){
                    $return = $class ? 'fullwidth' : false;
                }elseif( $single_sidebar == 'default-sidebar' && $page_sidebar != 'no-sidebar' && is_active_sidebar( $page_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){ 
                        $return = $class ? 'rightsidebar' : $page_sidebar; 
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){ 
                        $return = $class ? 'leftsidebar' : $page_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $single_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                        $return = $class ? 'rightsidebar' : $single_sidebar; 
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                        $return = $class ? 'leftsidebar' : $single_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
                
            }elseif( is_single() ){
                if( ( $single_sidebar == 'no-sidebar' ) || ( ( $single_sidebar == 'default-sidebar' ) && ( $post_sidebar == 'no-sidebar' ) ) ){
                    $return = $class ? 'fullwidth' : false;
                }elseif( $single_sidebar == 'default-sidebar' && $post_sidebar != 'no-sidebar' && is_active_sidebar( $post_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                        $return = $class ? 'rightsidebar' : $post_sidebar; 
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                        $return = $class ? 'leftsidebar' : $post_sidebar; 
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    }
                }elseif( is_active_sidebar( $single_sidebar ) ){
                    if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                        $return = $class ? 'rightsidebar' : $single_sidebar; 
                    }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                        $return = $class ? 'leftsidebar' : $single_sidebar;
                    }else{
                        $return = $class ? 'fullwidth' : false;
                    } 
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
            }
        }
        
        if ( is_search() ) {
            $search_sidebar = get_theme_mod( 'search_page_sidebar', 'sidebar' );
                
            if( $search_sidebar != 'no-sidebar' && is_active_sidebar( $search_sidebar ) ){
                if( $layout == 'right-sidebar' ){
                    $return = $class ? 'rightsidebar' : $search_sidebar; 
                }elseif( $layout == 'left-sidebar' ){
                    $return = $class ? 'leftsidebar' : $search_sidebar; 
                }else{
                    $return = $class ? 'fullwidth' : false;
                }
            }else{
                $return = $class ? 'fullwidth' : false;
            }
        }
    
        return $return; 
    }
endif;


if( ! function_exists( 'travel_booking_pro_comment_list' ) ) :
/**
 * Callback function for Comment List
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function travel_booking_pro_comment_list( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    
    <?php if ( 'div' != $args['style'] ){ ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php } ?>
        
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>                
            </div><!-- .comment-meta -->
            
            <div class="text-holder">
                <div class="top">
                
                    <?php if ( $comment->comment_approved == '0' ){ ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'travel-booking-pro' ); ?></em>
                    <?php } ?>
                    
                    <div class="left">
                        <b class="fn"><?php comment_author(); ?></b>
                        <span class="says"><?php __( 'Says:', 'travel-booking-pro' ); ?></span>
                        <div class="comment-metadata">
                            <?php
                            echo '<i class="fa fa-clock-o"></i>';
                            /* translators: 1: date, 2: time */
                            printf( __( '<time>%1$s at %2$s</time>', 'travel-booking-pro' ), get_comment_date(),  get_comment_time() ); ?>
                        </div>
                        <?php edit_comment_link( __( '(Edit)', 'travel-booking-pro' ), '  ', '' ); ?>                
                    </div><!-- .left -->
                    
                    <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                </div>
                <div class="comment-content"><?php comment_text(); ?></div>
                
                
            </div><!-- .text-holder -->
            
    <?php if ( 'div' != $args['style'] ){ ?>
        </div>
    <?php }
}    
endif;

if( ! function_exists( 'travel_booking_pro_get_trip_currency' ) ) :
/**
 * Get currency for WP Travel Engine Trip
*/
function travel_booking_pro_get_trip_currency(){
    $currency = '';
    if( travel_booking_pro_is_wpte_activated() ){
        $wpte_setting = get_option( 'wp_travel_engine_settings', true ); 
        $code = 'USD';
        if( isset( $wpte_setting['currency_code'] ) && $wpte_setting['currency_code']!= '' ){
            $code = $wpte_setting['currency_code'];
        } 
        $obj = new Wp_Travel_Engine_Functions();
        $currency = $obj->wp_travel_engine_currencies_symbol( $code );
    }
    return $currency;
}
endif;

if( ! function_exists( 'travel_booking_pro_get_template_part' ) ) :
/**
 * Get template from plus, companion or theme.
 *
 * @param string $template Name of the section.
 */
function travel_booking_pro_get_template_part( $template ) {

	if( locate_template( $template . '.php' ) ){
		get_template_part( $template );
	}else{
		if( defined( 'TBT_PLUGIN_DIR' ) ){
			 if( file_exists( TBT_PLUGIN_DIR . 'public/sections/' . $template . '.php' ) ){
				require_once( TBT_PLUGIN_DIR . 'public/sections/' . $template . '.php' );
			}
		}		
	}
}
endif;

if( ! function_exists( 'travel_booking_pro_primary_nagivation' ) ) :
/**
 * Primary Navigation.
 */
function travel_booking_pro_primary_nagivation(){ 

    $enabled_section   = array();
    $ed_one_page       = get_theme_mod( 'ed_one_page', false );
    $ed_home_link      = get_theme_mod( 'ed_home_link', true );
    $home_sections     = get_theme_mod( 'home_sort', array( 'about', 'popular', 'cta-one', 'featured-trip', 'deals', 'destination', 'cta-two', 'activities',  'testimonials', 'blog', 'clients' ) );
    
    $label_about        = get_theme_mod( 'label_about', __( 'About us', 'travel-booking-pro' ) );   
    $label_popular      = get_theme_mod( 'label_popular', __( 'Popular Packages', 'travel-booking-pro' ) );   
    $label_cta_one      = get_theme_mod( 'label_cta_one', __( 'CTA one', 'travel-booking-pro' ) );
    $label_featured     = get_theme_mod( 'label_featured', __( 'Featured Trips', 'travel-booking-pro' ) );
    $label_deals        = get_theme_mod( 'label_deals', __( 'Deals', 'travel-booking-pro' ) );
    $label_destination  = get_theme_mod( 'label_destination', __( 'Destinations', 'travel-booking-pro' ) );
    $label_cta_two      = get_theme_mod( 'label_cta_two', __( 'CTA Two', 'travel-booking-pro' ) );
    $label_activities   = get_theme_mod( 'label_activities', __( 'Activities', 'travel-booking-pro' ) );
    $label_testimonials = get_theme_mod( 'label_testimonials', __( 'Testimonials', 'travel-booking-pro' ) );
    $label_blog         = get_theme_mod( 'label_blog', __( 'Travel Stories', 'travel-booking-pro' ) );
    $label_client       = get_theme_mod( 'label_client', __( 'Featured On', 'travel-booking-pro' ) );
    
    $menu_label = array();
    if( ! empty( $label_about ) ) $menu_label['about'] = $label_about;          
    if( ! empty( $label_popular ) ) $menu_label['popular'] = $label_popular;      
    if( ! empty( $label_cta_one ) ) $menu_label['cta-one'] = $label_cta_one;        
    if( ! empty( $label_featured ) ) $menu_label['featured-trip'] = $label_featured; 
    if( ! empty( $label_deals ) ) $menu_label['deals'] = $label_deals;       
    if( ! empty( $label_destination ) ) $menu_label['destination'] = $label_destination;       
    if( ! empty( $label_cta_two ) ) $menu_label['cta-two'] = $label_cta_two;   
    if( ! empty( $label_activities ) ) $menu_label['activities'] = $label_activities;     
    if( ! empty( $label_testimonials ) ) $menu_label['testimonials'] = $label_testimonials;        
    if( ! empty( $label_blog ) ) $menu_label['blog'] = $label_blog;         
    if( ! empty( $label_client ) ) $menu_label['clients'] = $label_client;      

    
    foreach( $home_sections as $section ){
        if( array_key_exists( $section, $menu_label ) ){
            $enabled_section[] = array(
                'id'    => $section . '-section',
                'label' => $menu_label[$section],
            );
        }
    }
    
    if( $ed_one_page && ( 'page' == get_option( 'show_on_front' ) ) && $enabled_section ){ ?>
        <ul>
            <?php if( $ed_home_link ){ ?>
            <li class="<?php if( is_front_page() ) echo esc_attr( 'current-menu-item' ); ?>"><a href="<?php echo esc_url( home_url( '#banner-section' ) ); ?>"><?php esc_html_e( 'Home', 'travel-booking-pro' ); ?></a></li>
        <?php }
            foreach( $enabled_section as $section ){ 
                if( $section['label'] ){
        ?>
                <li><a href="<?php echo esc_url( home_url( '#' . esc_attr( $section['id'] ) ) ); ?>"><?php echo esc_html( $section['label'] );?></a></li>                        
        <?php 
                } 
            }
        ?>
        </ul>
    <?php } else { 
        
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'fallback_cb'    => 'travel_booking_pro_primary_menu_fallback',
        ) );
    }
}
endif;

if( ! function_exists( 'travel_booking_pro_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function travel_booking_pro_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'travel-booking-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'travel_booking_pro_get_homepage_section' ) ) :
/**
 * Return homepage sections
*/
function travel_booking_pro_get_homepage_section(){

    $enabled_sections = get_theme_mod( 'home_sort', array( 'about', 'popular', 'cta-one', 'featured-trip', 'deals', 'destination', 'cta-two', 'activities', 'testimonials', 'blog', 'clients' ) );

    $section = array(
        'about'         => 'sections/home/about',
        'popular'       => 'popular',
        'cta-one'       => 'sections/home/cta-one',
        'featured-trip' => 'featured-trip',
        'deals'         => 'deals',
        'destination'   => 'destination',
        'cta-two'       => 'sections/home/cta-two',
        'activities'    => 'activities',
        'testimonials'  => 'sections/home/testimonials',
        'blog'          => 'sections/home/blog',
        'clients'       => 'sections/home/clients'
    );

    $ed_search_bar = get_theme_mod( 'ed_search_bar', true );
    $sections      = array();

    if ( $ed_search_bar === true ) {
        array_push( $sections, 'sections/home/search' );
    }

    foreach( $enabled_sections as $s ){
        if( array_key_exists( $s, $section ) ) array_push( $sections, $section[$s] );
    }
    
    return $sections;
}
endif;

if( ! function_exists( 'travel_booking_pro_get_about_page_template_section' ) ) :
/**
 * Return about page template sections
*/
function travel_booking_pro_get_about_page_template_section(){

    $enabled_sections = get_theme_mod( 'about_sort', array( 'intro', 'client', 'service', 'testimonial', 'team' ) );

    $section = array(
        'intro'       => 'sections/about/intro',
        'client'      => 'sections/about/client',
        'service'     => 'sections/about/service',
        'testimonial' => 'sections/about/testimonial',
        'team'        => 'sections/about/team',
    );
    
    $sections      = array();

    foreach( $enabled_sections as $s ){
        if( array_key_exists( $s, $section ) ) array_push( $sections, $section[$s] );
    }
    
    return $sections;
}
endif;

if( ! function_exists( 'travel_booking_pro_get_header_search' ) ) :
/**
 * Display search button in header
*/
function travel_booking_pro_get_header_search(){ ?>
        <div class="form-section-holder">
            <div class="form-section">
                <span id="btn-search">
                    <svg x="0px" y="0px">
                        <path class="st0" d="M12.7,11.1L9.9,8.3c0,0,0,0,0,0c0.6-0.8,0.9-1.9,0.9-2.9c0-3-2.4-5.3-5.3-5.3C2.4,0,0,2.4,0,5.3
                        c0,3,2.4,5.3,5.3,5.3c1.1,0,2.1-0.3,2.9-0.9c0,0,0,0,0,0l2.8,2.8c0.4,0.4,1.1,0.4,1.5,0C13.1,12.3,13.1,11.6,12.7,11.1z M5.3,8.8
                        c-1.9,0-3.5-1.6-3.5-3.5c0-1.9,1.6-3.5,3.5-3.5c1.9,0,3.5,1.6,3.5,3.5C8.8,7.3,7.3,8.8,5.3,8.8z"/>
                    </svg>
                </span>
            </div>
            <div class="form-holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    <?php
}
endif;

if( ! function_exists( 'travel_booking_pro_get_page_id_by_template' ) ) :
/**
 * Returns Page ID by Page Template
*/
function travel_booking_pro_get_page_id_by_template( $template_name ){
    $args = array(
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template_name
    );
    return $pages = get_posts( $args );    
}
endif;

/**
 * Check if Wp Travel Engine Companion Plugin is activated
 */
function travel_booking_pro_is_tbt_activated() {
    return class_exists( 'Travel_Booking_Toolkit' ) ? true : false;
}

/**
 * Check if Wp Travel Engine Plugin is installed
*/
function travel_booking_pro_is_wpte_activated(){
    return class_exists( 'Wp_Travel_Engine' ) ? true : false;
}

/**
 * Query WooCommerce activation
 */
function travel_booking_pro_is_woocommerce_activated() {
    return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Check if WTE Advance Search is active
*/
function travel_booking_pro_is_wte_advanced_search_active(){
    return class_exists( 'Wte_Advanced_Search' ) ? true : false;
}

/**
 * Query Contact Form 7
 */
function travel_booking_pro_is_cf7_activated() {
    return class_exists( 'WPCF7' ) ? true : false;
}

/**
 * Check if Polylang is active
*/
function travel_booking_pro_is_polylang_active(){
    return class_exists( 'Polylang' ) ? true : false;
}

/**
 * Fuction to list Custom Post Type
*/
function travel_booking_pro_get_posts( $post_type = 'post', $slug = false ){
    
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => $post_type,
        'post_status'      => 'publish',
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'travel-booking-pro' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = esc_html( strip_tags( $posts->post_title ) );
            }else{
                $post_options[ $posts->ID ] = esc_html( strip_tags( $posts->post_title ) );    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}

if( ! function_exists( 'travel_booking_pro_get_id_from_page' ) ) :
/**
 * Get page ids from page name.
*/
function travel_booking_pro_get_id_from_page( $slider_pages ){
    if( $slider_pages ){
        $ids = array();
        foreach( $slider_pages as $p ){
             if( !empty( $p['page'] ) ){
                $page_ids = get_page_by_title( $p['page'] );
                $ids[] = $page_ids->ID;
             }
        }   
        return $ids;
    }else{
        return false;
    }
}
endif;

if( ! function_exists( 'travel_booking_pro_get_categories' ) ) :
    /**
     * Function to list post categories in customizer options
    */
    function travel_booking_pro_get_categories( $select = true, $taxonomy = 'category', $slug = false, $exclude = false ){    
        /* Option list of all categories */
        $categories = array();
        
        $args = array( 
            'hide_empty' => false,
            'taxonomy'   => $taxonomy 
        );
        
        if( $exclude ) $args['exclude'] = $exclude;
        
        $catlists = get_terms( $args );
        if( $select ) $categories[''] = __( 'Choose Category', 'travel-booking-pro' );
        foreach( $catlists as $category ){
            if( $slug ){
                $categories[$category->slug] = $category->name;
            }else{
                $categories[$category->term_id] = $category->name;    
            }        
        }
        
        return $categories;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_dynamnic_sidebar' ) ) :
    /**
     * Function to list dynamic sidebar
     */
    function travel_booking_pro_get_dynamnic_sidebar( $nosidebar = false, $sidebar = false, $default = false ){
        $sidebar_arr = array();
        $sidebars = get_theme_mod( 'dynamic_sidebars' );

        if( $default ) $sidebar_arr['default-sidebar'] = __( 'Default Sidebar', 'travel-booking-pro' );
        if( $sidebar ) $sidebar_arr['sidebar'] = __( 'Sidebar', 'travel-booking-pro' );
        
        if( $sidebars ){        
            foreach( $sidebars as $sidebar ){            
                $id = $sidebar['name'] ? sanitize_title( $sidebar['name'] ) : 'travel-sidebar-one';
                $sidebar_arr[$id] = $sidebar['name'];
            }
        }
        
        if( $nosidebar ) $sidebar_arr['no-sidebar'] = __( 'No Sidebar', 'travel-booking-pro' );
        
        return $sidebar_arr;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_template_page_url' ) ) :
    /**
     * Fuction to return page url
    */
    function travel_booking_pro_get_template_page_url( $template_key = '', $post_type = 'page' ){

        if( ! empty( $template_key ) ){
            $args = array(
                'meta_key'      => '_wp_page_template',
                'meta_value'    => $template_key,
                'post_type'     => $post_type,
            );

            $posts_array = get_posts( $args );

            if ( ! empty( $posts_array ) ) {
                foreach ( $posts_array as $posts ) {
                    $post_options[ $posts->ID ] = $posts->ID;    
                    $page_template_url = get_permalink( $post_options[ $posts->ID ] );
                    return $page_template_url;
                }
            }
        } else {
            return false;
        }
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_svg' ) ) :
    /**
     * Return SVG markup.
     *
     * @param array $args {
     *     Parameters needed to display an SVG.
     *
     *     @type string $icon  Required SVG icon filename.
     *     @type string $title Optional SVG title.
     *     @type string $desc  Optional SVG description.
     * }
     * @return string SVG markup.
     */
    function travel_booking_pro_get_svg( $args = array() ) {
        // Make sure $args are an array.
        if ( empty( $args ) ) {
            return __( 'Please define default parameters in the form of an array.', 'travel-booking-pro' );
        }

        // Define an icon.
        if ( false === array_key_exists( 'icon', $args ) ) {
            return __( 'Please define an SVG icon filename.', 'travel-booking-pro' );
        }

        // Set defaults.
        $defaults = array(
            'icon'        => '',
            'title'       => '',
            'desc'        => '',
            'fallback'    => false,
        );

        // Parse args.
        $args = wp_parse_args( $args, $defaults );

        // Set aria hidden.
        $aria_hidden = ' aria-hidden="true"';

        // Set ARIA.
        $aria_labelledby = '';

        /*
         * Travel Booking Pro doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
         *
         * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
         *
         * Example 1 with title: <?php echo travel_booking_pro_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
         *
         * Example 2 with title and description: <?php echo travel_booking_pro_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
         *
         * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
         */
        if ( $args['title'] ) {
            $aria_hidden     = '';
            $unique_id       = uniqid();
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

            if ( $args['desc'] ) {
                $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
            }
        }

        // Begin SVG markup.
        $svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

        // Display the title.
        if ( $args['title'] ) {
            $svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

            // Display the desc only if the title is already set.
            if ( $args['desc'] ) {
                $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
            }
        }

        /*
         * Display the icon.
         *
         * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
         *
         * See https://core.trac.wordpress.org/ticket/38387.
         */
        $svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

        // Add some markup to use as a fallback for browsers that do not support SVGs.
        if ( $args['fallback'] ) {
            $svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
        }

        $svg .= '</svg>';

        return $svg;
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_all_fonts' ) ) :
    
    /**
     * Return Web safe font and google font
    */
    function travel_booking_pro_get_all_fonts(){
        $google = array();        
        $standard = array(
            'georgia-serif'       => __( 'Georgia', 'travel-booking-pro' ),
            'palatino-serif'      => __( 'Palatino Linotype, Book Antiqua, Palatino', 'travel-booking-pro' ),
            'times-serif'         => __( 'Times New Roman, Times', 'travel-booking-pro' ),
            'arial-helvetica'     => __( 'Arial, Helvetica', 'travel-booking-pro' ),
            'arial-gadget'        => __( 'Arial Black, Gadget', 'travel-booking-pro' ),
            'comic-cursive'       => __( 'Comic Sans MS, cursive', 'travel-booking-pro' ),
            'impact-charcoal'     => __( 'Impact, Charcoal', 'travel-booking-pro' ),
            'lucida'              => __( 'Lucida Sans Unicode, Lucida Grande', 'travel-booking-pro' ),
            'tahoma-geneva'       => __( 'Tahoma, Geneva', 'travel-booking-pro' ),
            'trebuchet-helvetica' => __( 'Trebuchet MS, Helvetica', 'travel-booking-pro' ),
            'verdana-geneva'      => __( 'Verdana, Geneva', 'travel-booking-pro' ),
            'courier'             => __( 'Courier New, Courier', 'travel-booking-pro' ),
            'lucida-monaco'       => __( 'Lucida Console, Monaco', 'travel-booking-pro' ),
        );
        
        $fonts = include wp_normalize_path( get_template_directory() . '/inc/custom-controls/typography/webfonts.php' );
        
        foreach( $fonts['items'] as $font ){
            $google[$font['family']] = $font['family'];
        }
        $all_fonts = array_merge( $standard, $google );
        return $all_fonts; 
    }
endif;

if( ! function_exists( 'travel_booking_pro_get_patterns' ) ) :
    /**
     * Function to list Custom Pattern
    */
    function travel_booking_pro_get_patterns(){
        $patterns = array();
        $patterns['nobg'] = get_template_directory_uri() . '/images/patterns_thumb/' . 'nobg.png';
        for( $i=0; $i<38; $i++ ){
            $patterns['pattern'.$i] = get_template_directory_uri() . '/images/patterns_thumb/' . 'pattern' . $i .'.png';
        }
        for( $j=1; $j<26; $j++ ){
            $patterns['hbg'.$j] = get_template_directory_uri() . '/images/patterns_thumb/' . 'hbg' . $j . '.png';
        }
        return $patterns;
    }
endif;


if( ! function_exists( 'travel_booking_pro_get_social_share' ) ) :
    /**
     * Get list of social sharing icons
     * http://www.sharelinkgenerator.com/
     * 
    */
    function travel_booking_pro_get_social_share( $share ){
        global $post;
        
        switch( $share ){
            case 'facebook':
            echo '<li><a href="' . esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'twitter':
            echo '<li><a href="' . esc_url( 'https://twitter.com/home?status=' . get_the_title( $post->ID ) ) . '&nbsp;' . get_the_permalink( $post->ID ) . '" rel="nofollow" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'linkedin':
            echo '<li><a href="' . esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'pinterest':
            echo '<li><a href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink( $post->ID ) . '&description=' . get_the_title( $post->ID )  ) . '" rel="nofollow" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'email':
            echo '<li><a href="' . esc_url( 'mailto:?Subject=' . get_the_title( $post->ID ) . '&Body=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'gplus':
            echo '<li><a href="' . esc_url( 'https://plus.google.com/share?url=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'stumble':
            echo '<li><a href="' . esc_url( 'http://www.stumbleupon.com/submit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-stumbleupon" aria-hidden="true"></i></a></li>';
            
            break;
            
            case 'reddit':
            echo '<li><a href="' . esc_url( 'http://www.reddit.com/submit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-reddit" aria-hidden="true"></i></a></li>';
            
            break;                
        }
    }
endif;

if( ! function_exists( 'travel_booking_pro_escape_text_tags' ) ) :

    /**
     * Remove new line tags from string
     *
     * @param $text
     *
     * @return string
     */
    function travel_booking_pro_escape_text_tags( $text ) {
        return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
    }
endif;

if( ! function_exists( 'travel_booking_pro_author_social' ) ) :
    /**
     * Author Social Links
     */
    function travel_booking_pro_author_social(){
        $id        = get_the_author_meta( 'ID' );
        $facebook  = get_user_meta( $id, '_tb_facebook', true );
        $twitter   = get_user_meta( $id, '_tb_twitter', true );
        $instagram = get_user_meta( $id, '_tb_instagram', true );
        $snapchat  = get_user_meta( $id, '_tb_snapchat', true );
        $pinterest = get_user_meta( $id, '_tb_pinterest', true );
        $linkedin  = get_user_meta( $id, '_tb_linkedin', true );
        $gplus     = get_user_meta( $id, '_tb_gplus', true );
        
        if( $facebook || $twitter || $instagram || $snapchat || $pinterest || $linkedin || $gplus ){
            echo '<ul class="social-networks">';
            if( $facebook ){
                echo '<li><a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a></li>';
            }
            if( $twitter ){
                echo '<li><a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a></li>';
            }
            if( $instagram ){
                echo '<li><a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a></li>';
            }
            if( $snapchat ){
                echo '<li><a href="' . esc_url( $snapchat ) . '"><i class="fa fa-snapchat"></i></a></li>';
            }
            if( $pinterest ){
                echo '<li><a href="' . esc_url( $pinterest ) . '"><i class="fa fa-pinterest"></i></a></li>';
            }
            if( $linkedin ){
                echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a></li>';
            }
            if( $gplus ){
                echo '<li><a href="' . esc_url( $gplus ) . '"><i class="fa fa-google-plus"></i></a></li>';
            }
            echo '</ul>';
        }
    }
endif;


if( ! function_exists( 'travel_booking_pro_fallback_image' ) ) :

    /**
     * Returns fallback image
     */
    function travel_booking_pro_fallback_image( $image_size, $id = 0 ){

        $placeholder = get_template_directory_uri() . '/images/' . $image_size . '.jpg';

        if( get_theme_mod( 'ed_lazy_load', false ) ){
            $placeholder_src = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
            $layzr_attr = ' data-layzr="'.esc_attr( $placeholder ).'"';
        } else {
            $placeholder_src = $placeholder;
            $layzr_attr = '';
        }
        ?>
            <img src="<?php echo esc_url( $placeholder_src ); ?>" alt="<?php the_title_attribute(); ?>" itemprop="image"<?php echo $layzr_attr; ?>/>
        <?php
    }
endif;