<?php
/**
 * Travel Booking Pro custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Booking_Pro
 */

/**
 * Show/Hide Admin Bar in frontend.
*/
if( ! get_theme_mod( 'ed_adminbar', true ) ) add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'travel_booking_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function travel_booking_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Travel Booking Pro, use a find and replace
	 * to change 'travel-booking-pro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'travel-booking-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two location.
    $menus = array(
        'primary' => esc_html__( 'Primary', 'travel-booking-pro' ),
    );

    if( travel_booking_pro_is_polylang_active() ){
        $menus['language'] = esc_html__( 'Language', 'travel-booking-pro' ); 
    }

	register_nav_menus( $menus );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'gallery',
		'caption',
	) );
    
    //Custom Header
    add_theme_support( 'custom-header', apply_filters( 'travel_booking_pro_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/banner-img.jpeg',
		'width'         => 1920,
		'height'        => 800,
		'video'	   		=> true,
		'header-text'   => false
	) ) );

	register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/images/banner-img.jpeg',
            'thumbnail_url' => '%s/images/banner-img.jpeg',
            'description'   => __( 'Default Header Image', 'travel-booking-pro' ),
        ),
    ) );
    
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'travel_booking_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    
    /** Custom Logo */
    add_theme_support( 'custom-logo', array(    
        'height'      => 50,
        'width'       => 47,
        'flex-height' => true,
        'flex-width'  => true,	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Add excerpt support for page.
    add_post_type_support( 'page', 'excerpt' );
    
    /** Image Sizes */
    add_image_size( 'travel-booking-blog-full', 1290, 737, true );
    add_image_size( 'travel-booking-blog-single', 770, 440, true );
    add_image_size( 'travel-booking-slider', 1920, 800, true );
    add_image_size( 'travel-booking-popular-package', 370, 263, true );
    add_image_size( 'travel-booking-deals-discount', 270, 385, true );
    add_image_size( 'travel-booking-destination', 270, 330, true );
    add_image_size( 'travel-booking-blog', 410, 265, true );
    add_image_size( 'travel-booking-related', 370, 235, true );
    add_image_size( 'travel-booking-team', 370, 323, true );
    add_image_size( 'travel-booking-team-single', 770, 450, true );
    add_image_size( 'travel-booking-gmap', 530, 327, true );
    add_image_size( 'travel-booking-schema', 600, 60 );
        
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 
            'home',
            'blog',
            'about' => array(
                'post_type'  => 'page',
                'post_title' => __( 'About Us', 'travel-booking-pro' ),
                'template'   => 'templates/about.php',
            ),
            'team' => array(
                'post_type'  => 'page',
                'post_title' => __( 'Our Team', 'travel-booking-pro' ),
                'template'   => 'templates/team.php',
            ),
            'contact_us' => array(
                'post_type'  => 'page',
                'post_title' => __( 'Contact Us', 'travel-booking-pro' ),
                'template' => 'templates/contact.php',
            )
        ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'travel-booking-pro' ),
				'items' => array(
					'page_home',
					'page_blog',
                    'page_about' => array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{about}}',
                    ),
                    'page_team' => array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{team}}',
                    ),
                    'page_contact' => array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{contact_us}}',
                    ),
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'travel_booking_pro_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );    

	// Add theme support for WooCommerce.
	add_theme_support( 'woocommerce' );  
}
endif;
add_action( 'after_setup_theme', 'travel_booking_pro_setup' );

if( ! function_exists( 'travel_booking_pro_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travel_booking_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travel_booking_pro_content_width', 910 );
}
endif;
add_action( 'after_setup_theme', 'travel_booking_pro_content_width', 0 );

if( ! function_exists( 'travel_booking_pro_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function travel_booking_pro_template_redirect_content_width(){
	// Full Width in the absence of sidebar.
    $sidebar_layout = travel_booking_pro_sidebar( true );
    if( $sidebar_layout == 'fullwidth' ) $GLOBALS['content_width'] = 1290;
}
endif;
add_action( 'template_redirect', 'travel_booking_pro_template_redirect_content_width' );

if( ! function_exists( 'travel_booking_pro_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function travel_booking_pro_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is turned off
    $build        = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix       = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    $onepage_menu         = get_theme_mod( 'ed_one_page', false );
    $enable_sticky_header = get_theme_mod( 'ed_sticky_header', false );
    $enable_lazy_load     = get_theme_mod( 'ed_lazy_load', false );
    $enable_lazy_cimage   = get_theme_mod( 'ed_lazy_load_cimage', false );

    wp_enqueue_style( 'jquery-mCustomScrollbar', get_template_directory_uri(). '/css' . $build . '/jquery.mCustomScrollbar' . $suffix . '.css', array(), '3.1.5' );

    custom_enqueue_script( 'jquery-mCustomScrollbar', get_template_directory_uri() . '/js' . $build . '/jquery.mCustomScrollbar' . $suffix . '.js', array( 'jquery' ), '3.1.5', true ); 

    wp_enqueue_style( 'travel-booking-pro-google-fonts', travel_booking_pro_fonts_url(), array(), null );

    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );

    if( travel_booking_pro_is_woocommerce_activated() ){
        wp_enqueue_style( 'travel-booking-pro-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce-style' . $suffix . '.css' );
    }

    wp_enqueue_style( 'travel-booking-pro-style', get_stylesheet_uri(), array(), TRAVEL_BOOKING_PRO_THEME_VERSION );

    if( $enable_lazy_load || $enable_lazy_cimage ){
        custom_enqueue_script( 'layzr', get_template_directory_uri() . '/js' . $build . '/layzr' . $suffix . '.js', array('jquery'), '2.0.4', true );
    }

    custom_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );

    custom_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );

    custom_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );

    if( is_page_template( 'templates/contact.php' ) ){
        $latitude      = get_theme_mod( 'latitude', 27.7204766 );
        $longitude     = get_theme_mod( 'longitude', 85.3389148 );
        $map_zoom      = get_theme_mod( 'map_zoom', 17 );
        $map_scroll    = get_theme_mod( 'ed_map_scroll', true );
        $map_control   = get_theme_mod( 'ed_map_controls', true );
        $map_api_key   = get_theme_mod( 'map_api' );
        $map_api_key   = ! empty( $map_api_key ) ? $map_api_key : 'AIzaSyDSpFEIkAaNbDXI5o57mvGZ_aE-Gz51sy0' ;
        $ed_map_marker = get_theme_mod( 'ed_map_marker', false );
        $marker_title  = get_theme_mod( 'marker_title' );
        $custom_css    = '#map-canvas{ width : 100%; height : 310px }';

        wp_add_inline_style( 'travel-booking-pro-style', $custom_css );
        custom_enqueue_script( 'travel-booking-pro-google-map', '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=' . $map_api_key );
        custom_enqueue_script( 'travel-booking-pro-google', get_template_directory_uri() . '/js' . $build . '/google' . $suffix . '.js', array( 'jquery', 'travel-booking-pro-google-map' ), TRAVEL_BOOKING_PRO_THEME_VERSION, true );        
        
        $array = array(
            'latitude'     => esc_attr( $latitude ),
            'longitude'    => esc_attr( $longitude ),
            'zoom'         => absint( $map_zoom ), 
            'scroll'       => (bool) $map_scroll,
            'control'      => (bool) $map_control,
            'ed_marker'    => (bool) $ed_map_marker,
            'marker_title' => esc_html( $marker_title )
        );
        wp_localize_script( 'travel-booking-pro-google', 'tbp_gdata', $array );
    }

    if( $onepage_menu ){
        custom_enqueue_script( 'scroll-nav', get_template_directory_uri() . '/js'. $build .'/scroll-nav'. $suffix .'.js', array( 'jquery' ), '3.3.0', true );
    }

    custom_enqueue_script( 'travel-booking-pro-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), TRAVEL_BOOKING_PRO_THEME_VERSION, true );

    $array = array( 
        'rtl'          => is_rtl(),
        'sticky_menu'  => esc_attr( $enable_sticky_header ),
        'onepage_menu' => esc_attr( $onepage_menu ),
        'auto'         => get_theme_mod( 'slider_auto', true ),
        'loop'         => get_theme_mod( 'slider_loop', true ),
        'animation'    => get_theme_mod( 'slider_animation' ),
        'h_layout'     => get_theme_mod( 'header_layout', 'one' ),
    );

    wp_localize_script( 'travel-booking-pro-custom', 'travel_booking_pro_data', $array );

    $pagination = get_theme_mod( 'pagination_type', 'default' );
    $loadmore   = get_theme_mod( 'load_more_label', __( 'Load More Posts', 'travel-booking-pro' ) );
    $loading    = get_theme_mod( 'loading_label', __( 'Loading...', 'travel-booking-pro' ) );
    $nomore     = get_theme_mod( 'nomore_post_label', __( 'No More Post', 'travel-booking-pro' ) );

    if( $pagination == 'load_more' || $pagination == 'infinite_scroll' ){
        
        // Add parameters for the JS
        global $wp_query;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $posts_per_page = get_option( 'posts_per_page' );
        
        if( is_page_template( 'templates/testimonial.php' ) ){
            $args = array(
                'post_type'      => 'tb_testimonial',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page,
                'paged'          => $paged,
            );
        
            $qry = new WP_Query( $args );
            $max = $qry->max_num_pages;    
        }else{
            $max = $wp_query->max_num_pages;
        }
        
        custom_enqueue_script( 'travel-booking-pro-ajax', get_template_directory_uri() . '/js' . $build . '/ajax' . $suffix . '.js', array('jquery'), TRAVEL_BOOKING_PRO_THEME_VERSION, true );
        
        wp_localize_script( 
            'travel-booking-pro-ajax', 
            'tap_ajax',
            array(
                'startPage'  => $paged,
                'maxPages'   => $max,
                'nextLink'   => next_posts( $max, false ),
                'autoLoad'   => $pagination,
                'loadmore'   => $loadmore,
                'loading'    => $loading,
                'nomore'     => $nomore,
                'plugin_url' => plugins_url(),                
             )
        );
        
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( ( is_front_page() && ! is_home() ) || is_page_template( 'templates/about.php' ) || is_page_template( 'templates/testimonial.php' ) ){
        wp_enqueue_style( 'jquery-rateyo', get_template_directory_uri() . '/inc/css/jquery.rateyo.min.css', array(), TRAVEL_BOOKING_PRO_THEME_VERSION ); 
        custom_enqueue_script( 'jquery-rateyo', get_template_directory_uri() . '/inc/js/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', false );
    }
}
endif;
add_action( 'custom_enqueue_scripts', 'travel_booking_pro_scripts' );

if( ! function_exists( 'travel_booking_pro_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles
*/
function travel_booking_pro_admin_scripts( $hook ){
    global $post;
    $screen = get_current_screen();
    
    $data = array( 'screen' => $screen->id );
    
    if( $screen->id == 'tb_testimonial' ){
        wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-rateyo', get_template_directory_uri() . '/inc/css/jquery.rateyo.min.css', array(), TRAVEL_BOOKING_PRO_THEME_VERSION ); 
        custom_enqueue_script( 'jquery-rateyo', get_template_directory_uri() . '/inc/js/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', false );
        $data['id'] = $post->ID;   
    }
    
    if( $hook == 'post-new.php' || $hook == 'post.php' ){
        $data ['post_type'] = $post->post_type;
        wp_enqueue_style( 'travel-booking-pro-admin', get_template_directory_uri() . '/inc/css/admin.css', array(), TRAVEL_BOOKING_PRO_THEME_VERSION );     
        custom_enqueue_script( 'travel-booking-pro-admin', get_template_directory_uri() . '/inc/js/admin.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-datepicker' ), TRAVEL_BOOKING_PRO_THEME_VERSION, false );
        wp_localize_script( 'travel-booking-pro-admin', 'tb_admin', $data );
    }
    
    if( $screen->id == 'tb_team' ){
        custom_enqueue_script( 'travel-booking-pro-gallery', get_template_directory_uri() . '/inc/js/gallery.js', array( 'jquery' ), TRAVEL_BOOKING_PRO_THEME_VERSION, false );
        $arr = array(
            'change_image' => __( 'Change Image', 'travel-booking-pro' ),
            'remove_image' => __( 'Remove Image', 'travel-booking-pro' ),
        );
        wp_localize_script( 'travel-booking-pro-gallery', 'tb_gallery_data', $arr );    
    }
    
}
endif;
add_action( 'admin_enqueue_scripts', 'travel_booking_pro_admin_scripts' );

if( ! function_exists( 'travel_booking_pro_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function travel_booking_pro_body_classes( $classes ) {
    $enable_banner = get_theme_mod( 'ed_banner_section', 'static_banner' );

	// Adds class if banner is active in frontpage
    if( is_front_page() && ! is_home() && 'no_banner' != $enable_banner ){
    	$classes[] = 'homepage hasbanner';
    }

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image custom-background';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color custom-background';
	}

    // Add class if pattern is used as background image
    $bg_control       = get_theme_mod( 'body_bg', 'image' );
    $bg_pattern       = get_theme_mod( 'bg_pattern', 'nobg' );
    $background_image = get_background_image();

    if( 'pattern' == $bg_control && $bg_pattern != 'nobg' ){
        $classes[] = 'pattern-bg';
    }
    
    // Add class in 404 page
    if( is_404() ){
        $classes[] = 'error404';
    }

    // Add class in team single page
    if( is_singular( 'tb_team' ) ){
        $classes[] = 'page-template-team-single';
    }

    $sidebar_layout = travel_booking_pro_sidebar( true );
    $classes[] = $sidebar_layout;

	return $classes;
}
endif;
add_filter( 'body_class', 'travel_booking_pro_body_classes' );

if( ! function_exists( 'travel_booking_pro_post_classes' ) ) :
/**
 * Adds custom class in post class1
*/
function travel_booking_pro_post_classes( $classes ){
    if( is_search() ){
        $classes[] = 'post';
    }

    $classes[] = 'latest_post';
    
    return $classes;    
}
endif;
add_filter( 'post_class', 'travel_booking_pro_post_classes' );

if( ! function_exists( 'travel_booking_pro_pingback_header' ) ) :
    /**
     * Add a pingback url auto-discovery header for singularly identifiable articles.
     */
    function travel_booking_pro_pingback_header() {
    	if ( is_singular() && pings_open() ) {
    		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    	}
    }
endif;
add_action( 'wp_head', 'travel_booking_pro_pingback_header' );

if ( ! function_exists( 'travel_booking_pro_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function travel_booking_pro_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'travel_booking_pro_excerpt_more' );

if ( ! function_exists( 'travel_booking_pro_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function travel_booking_pro_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 30 );

	return is_admin() ? $length : $excerpt_length;    
}

endif;
add_filter( 'excerpt_length', 'travel_booking_pro_excerpt_length', 999 );

if( ! function_exists( 'travel_booking_pro_modify_search_form,' ) ) :
    /**
     *  Filters the HTML format of the search form.
     */
    function travel_booking_pro_modify_search_form( $search_form ){
        $search_form = '<form role="search" method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
            <span class="screen-reader-text">'. _x( 'Search for:', 'label', 'travel-booking-pro' ) .'</span>
            <label>
                <input type="search" placeholder="'. esc_attr_x( 'Search Here&hellip;', 'placeholder', 'travel-booking-pro' ) .'" value="'. get_search_query() .'" name="s" title="'. esc_attr_x( 'Search for:', 'label', 'travel-booking-pro' ) .'" />
            </label>
            <input type="submit" value="'. esc_attr_x( 'Search', 'label', 'travel-booking-pro' ) .'">
        </form>';

        return $search_form;
    }
    endif;
add_filter( 'get_search_form', 'travel_booking_pro_modify_search_form' );

if( ! function_exists( 'travel_booking_pro_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_booking_pro_change_comment_form_default_fields( $fields ){
    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'travel-booking-pro' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'travel-booking-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'travel-booking-pro' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'travel-booking-pro' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'travel-booking-pro' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'travel-booking-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;
    
}
endif;
add_filter( 'comment_form_default_fields', 'travel_booking_pro_change_comment_form_default_fields' );

if( ! function_exists( 'travel_booking_pro_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_booking_pro_change_comment_form_defaults( $defaults ){
    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'travel-booking-pro' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'travel-booking-pro' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;
    
}
endif;
add_filter( 'comment_form_defaults', 'travel_booking_pro_change_comment_form_defaults' );

if ( !function_exists( 'travel_booking_pro_video_controls' ) ) :
/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings Video settings.
 */
function travel_booking_pro_video_controls( $settings ) {
    $settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'travel-booking-pro' ) . '</span>' . travel_booking_pro_get_svg( array( 'icon' => 'play' ) );
    $settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'travel-booking-pro' ) . '</span>' . travel_booking_pro_get_svg( array( 'icon' => 'pause' ) );
    return $settings;
}
endif;
add_filter( 'header_video_settings', 'travel_booking_pro_video_controls' );

if( ! function_exists( 'travel_booking_pro_include_svg_icons' ) ) :
/**
 * Add SVG definitions to the footer.
 */
function travel_booking_pro_include_svg_icons() {
    // Define SVG sprite file.
    $svg_icons = get_parent_theme_file_path( '/images/svg-icons.svg' );

    // If it exists, include it.
    if ( file_exists( $svg_icons ) ) {
        require_once( $svg_icons );
    }
}
endif;
add_action( 'wp_footer', 'travel_booking_pro_include_svg_icons', 9999 );

if( ! function_exists( 'travel_booking_pro_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
 */
function travel_booking_pro_get_the_archive_title( $title ){

    $hide_prefix     = get_theme_mod( 'ed_prefix_archive', false );

    if( $hide_prefix ){
        if( is_category() ){
            $title = single_cat_title( '', false );
        }elseif ( is_tag() ){
            $title = single_tag_title( '', false );
        }elseif( is_author() ){
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        }elseif ( is_year() ) {
            $title = get_the_date( __( 'Y', 'travel-booking-pro' ) );
        }elseif ( is_month() ) {
            $title = get_the_date( __( 'F Y', 'travel-booking-pro' ) );
        }elseif ( is_day() ) {
            $title = get_the_date( __( 'F j, Y', 'travel-booking-pro' ) );
        }elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        }elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            $title = single_term_title( '', false );
        }
    }    
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'travel_booking_pro_get_the_archive_title' );

if( ! function_exists( 'travel_booking_pro_single_post_schema' ) ) :
    /**
     * Single Post Schema
     *
     * @return string
     */
    function travel_booking_pro_single_post_schema() {
        if ( is_singular( 'post' ) ) {
            global $post;
            $custom_logo_id = get_theme_mod( 'custom_logo' );

            $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'travel-booking-schema' );
            $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            $excerpt     = travel_booking_pro_escape_text_tags( $post->post_excerpt );
            $content     = $excerpt === "" ? mb_substr( travel_booking_pro_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
            $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

            $args = array(
                "@context"  => "http://schema.org",
                "@type"     => $schema_type,
                "mainEntityOfPage" => array(
                    "@type" => "WebPage",
                    "@id"   => esc_url( get_permalink( $post->ID ) )
                ),
                "headline"  => esc_html( get_the_title( $post->ID ) ),
                "image"     => array(
                    "@type"  => "ImageObject",
                    "url"    => $images[0],
                    "width"  => $images[1],
                    "height" => $images[2]
                ),
                "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
                "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
                "author"        => array(
                    "@type"     => "Person",
                    "name"      => travel_booking_pro_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
                ),
                "publisher" => array(
                    "@type"       => "Organization",
                    "name"        => esc_html( get_bloginfo( 'name' ) ),
                    "description" => esc_html( get_bloginfo( 'description' ) ),
                    "logo"        => array(
                        "@type"   => "ImageObject",
                        "url"     => $site_logo[0],
                        "width"   => $site_logo[1],
                        "height"  => $site_logo[2]
                    )
                ),
                "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
            );

            if ( has_post_thumbnail( $post->ID ) ) :
                $args['image'] = array(
                    "@type"  => "ImageObject",
                    "url"    => $images[0],
                    "width"  => $images[1],
                    "height" => $images[2]
                );
            endif;

            if ( ! empty( $custom_logo_id ) ) :
                $args['publisher'] = array(
                    "@type"       => "Organization",
                    "name"        => esc_html( get_bloginfo( 'name' ) ),
                    "description" => esc_html( get_bloginfo( 'description' ) ),
                    "logo"        => array(
                        "@type"   => "ImageObject",
                        "url"     => $site_logo[0],
                        "width"   => $site_logo[1],
                        "height"  => $site_logo[2]
                    )
                );
            endif;

            echo '<script type="application/ld+json">';

            if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
                echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
            } else {
                echo wp_json_encode( $args );
            }

            echo '</script>';
        }
    }
endif;
add_action( 'wp_head', 'travel_booking_pro_single_post_schema' );

if( ! function_exists( 'travel_booking_pro_columns_head' ) ) :
    /**
     * Adds a Order column header in the item list admin page.
     *
     * @param array $defaults
     * @return array
     */
    function travel_booking_pro_columns_head( $defaults ){
           
        if( get_post_type() === 'tb_testimonial' ){
            $defaults['testimonial_order'] = __( 'Order', 'travel-booking-pro' );
        }

        if( get_post_type() === 'tb_team' ){
            $defaults['team_order'] = __( 'Order', 'travel-booking-pro' );
        }

        return $defaults;
    }
endif;
add_filter( 'manage_posts_columns', 'travel_booking_pro_columns_head' );

if( ! function_exists( 'travel_booking_pro_columns_content' ) ) :
    /**
     * @param string $column_name The name of the column to display.
     * @param int $post_ID The ID of the current post.
     */
    function travel_booking_pro_columns_content( $column_name, $post_ID ){
        global $post;
        
        if( $column_name == 'testimonial_order' ){
            echo $post->menu_order;
        }
        if( $column_name == 'team_order' ){
            echo $post->menu_order;
        } 
    }
endif;
add_action( 'manage_posts_custom_column', 'travel_booking_pro_columns_content', 10, 2 );


if( ! function_exists( 'travel_booking_pro_testimonial_order_column_sortable' ) ) :
    /**
    * make column sortable
    */
    function travel_booking_pro_testimonial_order_column_sortable( $columns ){
        $columns['testimonial_order'] = 'menu_order';
        return $columns;
    }
endif;
add_filter( 'manage_edit-testimonial_sortable_columns', 'travel_booking_pro_testimonial_order_column_sortable' );

if( ! function_exists( 'travel_booking_pro_team_order_column_sortable' ) ) :
    /**
    * make column sortable
    */
    function travel_booking_pro_team_order_column_sortable( $columns ){
        $columns['team_order'] = 'menu_order';
        return $columns;
    }
endif;
add_filter( 'manage_edit-team_sortable_columns', 'travel_booking_pro_team_order_column_sortable' );

if ( ! function_exists( 'travel_booking_pro_migrate_theme_options' ) ) :

    /**
    * Function to migrate travel booking  theme option to travel booking  pro theme options
    */
    function travel_booking_pro_migrate_theme_options(){
        
        $fresh  = get_option( '_travel_booking_pro_fresh_install', false ); //flag to check if it is first switch
        
        if( ! $fresh ){
            $free_theme_options = get_option( 'theme_mods_travel-booking' );


            if( ! empty( $free_theme_options ) ){
                foreach( $free_theme_options as $option => $value ){
                    if( $option == 'ed_banner_section' ){
                        if( $value == '1' ){
                            set_theme_mod( 'ed_banner_section', 'static_banner' );
                        }else{
                            set_theme_mod( 'ed_banner_section', 'no_banner' );
                        }
                    }elseif( $option !== 'sidebars_widgets' ){
                        set_theme_mod( $option, $value );
                    }    
                }
            }
            
            update_option( '_travel_booking_pro_fresh_install', true );  
        }
    }
endif;
add_action( 'after_switch_theme', 'travel_booking_pro_migrate_theme_options' );
