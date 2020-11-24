<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Travel_Booking_Pro
 */

if( ! function_exists( 'travel_booking_pro_doctype' ) ) :
/**
 * Doctype Declaration
*/
function travel_booking_pro_doctype(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'travel_booking_pro_doctype', 'travel_booking_pro_doctype' );

if( ! function_exists( 'travel_booking_pro_head' ) ) :
/**
 * Before wp_head 
*/
function travel_booking_pro_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'travel_booking_pro_before_wp_head', 'travel_booking_pro_head' );

if( ! function_exists( 'travel_booking_pro_page_start' ) ) :
/**
 * Page Start
*/
function travel_booking_pro_page_start(){
    ?>
    <div id="page" class="site">
    <?php
}
endif;
add_action( 'travel_booking_pro_before_header', 'travel_booking_pro_page_start', 20 );


if( ! function_exists( 'travel_booking_pro_header' ) ) :
/**
 * Header Start
*/
function travel_booking_pro_header(){ 
    $header_array    = array( 'one', 'two', 'three', 'four', 'five' );
    $header          = get_theme_mod( 'header_layout', 'one' );

    if( in_array( $header, $header_array ) ){            
        get_template_part( 'headers/' . $header );
    }
}
endif;
add_action( 'travel_booking_pro_header', 'travel_booking_pro_header', 20 );

if( ! function_exists( 'travel_booking_pro_container_start' ) ) :
/**
 * Add main container before content 
*/
function travel_booking_pro_container_start(){
    if( is_front_page() && ! is_home() ) return;

    if( is_404() ) echo '<div class="error-page" style="background: url('. esc_url( get_template_directory_uri() .'/images/bg-error.jpg' ) .') no-repeat;">';
    ?>
    <div class="container">
    <?php
}
endif;
add_action( 'travel_booking_pro_before_content', 'travel_booking_pro_container_start' );

if( ! function_exists( 'travel_booking_pro_container_end' ) ) :
/**
 * Add main container before content 
*/
function travel_booking_pro_container_end(){
    if( ( is_front_page() && ! is_home() ) || is_page_template( 'templates/about.php' ) ) return;

    ?>
    </div><!-- .container -->
    <?php
    if( is_404() ){

        echo '</div><!-- .error-page -->';

        /**
         * Popular Packages
         * 
         * @hooked travel_booking_pro_get_popular_package - 15
         */
        do_action( 'travel_booking_pro_popular_package' ); 
    }

    if( is_singular( 'trip' ) ){

        /**
         * Related Trips
         * 
         * @hooked travel_booking_pro_get_related_trips - 15
         */
        do_action( 'travel_booking_pro_related_trips' ); 
    }
}
endif;
add_action( 'travel_booking_pro_before_footer', 'travel_booking_pro_container_end', 30 );

if( ! function_exists( 'travel_booking_pro_breadcrumb' ) ) :
/**
 * Page Header for inner pages
*/
function travel_booking_pro_breadcrumb(){    
    
    global $post;
    $depth = 1;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'breadcrumb_home_text', __( 'Home', 'travel-booking-pro' ) ); // text for the 'Home' link
    $before     = '<li class="current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</li>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) && ! is_front_page() ){
        
        echo '<ul id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
        
        if( is_home() ){
            
            $depth = 2;
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            
            
        }elseif( is_category() ){
            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );

            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                        $depth ++;
                    }
                }
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
        
        }elseif( travel_booking_pro_is_wpte_activated() && is_tax( array( 'activities', 'destination', 'trip_types' ) ) ){ //Trip Taxonomy pages
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            $tax = array(
                'activities'  => 'templates/template-activities.php',
                'destination' => 'templates/template-destination.php',
                'trip_types'  => 'templates/template-trip_types.php'
            );
            $depth = 2;

            foreach( $tax as $k => $v ){
                if( is_tax( $k ) ){
                    $p_id = travel_booking_pro_get_page_id_by_template( $v );
                    if( $p_id ){
                         echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $p_id[0] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $p_id[0] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                    }else{
                        $post_type = get_post_type_object( 'trip' );
                        if( $post_type->has_archive == true ){// For CPT Archive Link
                           
                           // Add support for a non-standard label of 'archive_title' (special use case).
                           $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                           printf( '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );            
                        }
                    }

                    $depth = 3;
                    //For trip taxonomy hierarchy
                    $ancestors = get_ancestors( $current_term->term_id, $k );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, $k );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                            $depth++;
                        }
                    }
                }
            }
            
            echo $before .'<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">' . esc_html( $current_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
        }elseif(travel_booking_pro_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
            
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                        $depth ++;
                    }
                }
            }           
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">' . esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
            
        }elseif(travel_booking_pro_is_woocommerce_activated() && is_shop() ){ //Shop Archive page
            $depth = 2;
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                return;
            }
            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
    
            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }
            echo $before . '<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            
        }elseif( is_tag() ){
            
            $queried_object = get_queried_object();
            $depth = 2;

            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_author() ){
            
            $depth = 2;
            global $author;

            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_search() ){
            
            $depth = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before .'<a itemprop="item" href="'. esc_url( $request_uri ) .'"><span itemprop="name">'. esc_html__( 'Search Results for "', 'travel-booking-pro' ) . esc_html( get_search_query() ) . esc_html__( '"', 'travel-booking-pro' ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_day() ){
            
            $depth = 2;
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
            $depth ++;
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ), get_the_time( __( 'm', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'travel-booking-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
            $depth ++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ), get_the_time( __( 'm', 'travel-booking-pro' ) ), get_the_time( __( 'd', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'd', 'travel-booking-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_month() ){
            
            $depth = 2;
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
            $depth++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ), get_the_time( __( 'm', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'F', 'travel-booking-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_year() ){
            
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'travel-booking-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
    
        }elseif( is_single() && !is_attachment() ){
            $depth = 2;
            if( travel_booking_pro_is_wpte_activated() && get_post_type() === 'trip' ){ //For Single Trip 
                $breadcrumb_selected_tax = get_theme_mod( 'related_trip_tax', 'destination' ); 

                // Check for page templage
                $tax_template = travel_booking_pro_get_page_id_by_template( 'templates/template-'. $breadcrumb_selected_tax .'.php' );

                if( $tax_template ){
                    echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $tax_template[0] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $tax_template[0] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';     
                }else{
                    $post_type = get_post_type_object( 'trip' );
                    if( $post_type->has_archive == true ){// For CPT Archive Link
                       
                       // Add support for a non-standard label of 'archive_title' (special use case).
                       $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                       printf( '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );        
                    }                    
                }
                // Check for destination taxonomy hierarchy
                $depth = 3;
                $terms = wp_get_post_terms( $post->ID, $breadcrumb_selected_tax, array( 'orderby' => 'parent', 'order' => 'DESC' ) );                
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { //Parents terms
                    $ancestors = get_ancestors( $terms[0]->term_id, $breadcrumb_selected_tax );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, $breadcrumb_selected_tax );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                        }
                        $depth ++;
                    }
                    // Last child term
                    echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $terms[0] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $terms[0]->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                    $depth ++;                   
                }
                                
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                                                    
                
            }elseif( travel_booking_pro_is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                /** NEED TO CHECK THIS PORTION WHILE INTEGRATION WITH WOOCOMMERCE */
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                            $depth++;
                        }
                    }
                    echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                    $depth++;
                }
                
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }elseif( get_post_type() != 'post' ){
                $post_type = get_post_type_object( get_post_type() );
                
                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   printf( '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><meta itemprop="position" content="%3$s" />', esc_url( get_post_type_archive_link( get_post_type() ) ), $label, $depth );
                   echo '<meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                   $depth ++;
    
                }
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                   echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';    
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
        			 //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object )
                    {
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term = $key;
                            $potential_parent = $object->term_id;
                        }
                    }
                    
                    $cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                            $depth ++;
                        }
                    }
                }
    
                echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }
        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                echo $before . sprintf( __('Page %s', 'travel-booking-pro'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before;
                    echo '<a itemprop="item" href="'. esc_url( get_post_type_archive_link( $post_type->name ) ). '"><span itemprop="name">';
                    echo esc_html( post_type_archive_title() ); 
                    echo '</span></a><meta itemprop="position" content="'. absint( $depth ).'">';    
                echo $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }
    
        }elseif( is_attachment() ){
            
            global $post;
            $depth = 2;
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' ' );
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
            }
            echo  $before .'<a itemprop="item" href="' . esc_url( wp_get_attachment_url( $post->ID ) ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
    
        }elseif( is_page() && $post->post_parent ){
            
            $depth = 2;
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $page->ID ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $page->ID ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></li>';
                $parent_id  = $page->post_parent;
                $depth++;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo $breadcrumbs[$i];
            }
            echo $before .'<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'travel-booking-pro' ) . $after;
        }
                
        echo '</ul>';
        
    }
}
endif;
add_action( 'travel_booking_pro_before_content', 'travel_booking_pro_breadcrumb', 20 );

if( ! function_exists( 'travel_booking_pro_content_start' ) ) :
/**
 * Content Start
*/
function travel_booking_pro_content_start(){
    
    $home_sections = travel_booking_pro_get_homepage_section();
    
    if( is_404() || is_page_template( array( 'templates/about.php', 'templates/contact.php', 'templates/team.php' ) ) ) return;
    
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){
    ?>
    <div id="content" class="site-content">
       <div class="row">
    <?php
    }
}
endif;
add_action( 'travel_booking_pro_content', 'travel_booking_pro_content_start' );

if( ! function_exists( 'travel_booking_pro_render_banner_section' ) ) :
/**
 * Banner
*/
function travel_booking_pro_render_banner_section(){
    
    $ed_banner      = get_theme_mod( 'ed_banner_section', 'static_banner' );

    if( is_front_page() && ! is_home() && $ed_banner ) {
        get_template_part( 'sections/home/banner' );
    }
}
endif;
add_action( 'travel_booking_banner_section', 'travel_booking_pro_render_banner_section', 10 );

if( ! function_exists( 'travel_booking_pro_page_header' ) ) :
/**
 * Page Header
*/
function travel_booking_pro_page_header(){
    if( is_404() ) return;
   
    if( is_archive() ){
        echo '<header class="page-header">';
		if( ! is_tax( array( 'destination', 'activities', 'trip_types' ) ) ){
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            if( ! is_post_type_archive( 'trip' ) ) the_archive_description( '<div class="archive-description">', '</div>' );
        }
        echo '</header><!-- .page-header -->';
    }
}
endif;
add_action( 'travel_booking_pro_before_content', 'travel_booking_pro_page_header', 40 );

if( ! function_exists( 'travel_booking_pro_get_search_page_header' ) ) :
/**
 * Content Start
*/
function travel_booking_pro_get_search_page_header(){ 
    global $wp_query;
    ?>
    
    <div class="page-header">          
        <h1 class="page-title">
            <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'travel-booking-pro' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h1>

        <div class="header-content">
            <?php
                echo '<p>';
                /* translators: 1: number of posts found, 2: search query   */
                printf( esc_html__( 'We found %1$s results for %2$s. You can search again if you are unsatisfied.', 'travel-booking-pro' ), number_format_i18n( $wp_query->found_posts ), get_search_query() ); 
                echo '</p>';
            ?>
        </div>

        <?php get_search_form(); ?>

    </div><!-- .page-header --> 
    <?php        
}
endif;
add_action( 'travel_booking_pro_search_page_header', 'travel_booking_pro_get_search_page_header', 10 );

if( ! function_exists( 'travel_booking_pro_header_container_end' ) ) :
/**
 * Header container end
*/
function travel_booking_pro_header_container_end(){
    if( is_page_template( array( 'templates/about.php', 'templates/team.php' ) ) ){
        echo '</div><!-- .container -->';
    }
}
endif;
add_action( 'travel_booking_pro_before_content', 'travel_booking_pro_header_container_end', 50 );

if( ! function_exists( 'travel_booking_pro_get_post_page_header' ) ) :
    /**
     * Display post/page title.
     *
     */
    function travel_booking_pro_get_post_page_header(){
        if( is_singular() ){
        ?>
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header>
        <?php
        }
    }
endif;
add_action( 'travel_booking_pro_before_text_holder', 'travel_booking_pro_get_post_page_header' );

if( ! function_exists( 'travel_booking_pro_entry_header' ) ) :
/**
 * Post Entry Header
*/
function travel_booking_pro_entry_header(){ 
    $post_entry_meta = get_theme_mod( 'post_meta_order', array( 'date', 'author', 'comment' ) );

    if( ! is_page() ){ ?>    
    <header class="entry-header">		

        <?php 
            if( is_single() ){
                the_title( '<h1 class="entry-title">', '</h1>' );    
            }else{
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h2>' ); 
            }
        ?>        
        <div class="entry-meta">
            <?php
                foreach( $post_entry_meta as $meta ){
                    if( $meta === 'date' ) travel_booking_pro_posted_on();
                    if( $meta === 'author' ) travel_booking_pro_posted_by();
                    if( $meta === 'comment' ) travel_booking_pro_comment_count();  
                } 
            ?>
        </div>

        <?php 
            if( is_single() ){
                $ed_share = get_theme_mod( 'ed_social_sharing', true );
                $shares   = get_theme_mod( 'social_share', array( 'facebook', 'twitter', 'linkedin', 'gplus', 'pinterest' ) );
                
                if( $ed_share ){
                    echo '<div class="share-post"><ul class="social-networks">';
                        foreach( $shares as $share ){
                            travel_booking_pro_get_social_share( $share );
                        }
                    echo '</ul></div>';
                }
            }
        ?>

	</header>
    <?php  
    }
}
endif;
add_action( 'travel_booking_pro_post_content', 'travel_booking_pro_entry_header', 20 );

if( ! function_exists( 'travel_booking_pro_post_thumbnail' ) ) :
/**
 * Post Thumbnail
*/
function travel_booking_pro_post_thumbnail(){
    if( is_singular() ){
        $sidebar_layout = travel_booking_pro_sidebar( true );
        $image_size     = ( 'fullwidth' != $sidebar_layout ) ? 'travel-booking-blog-single' : 'travel-booking-blog-full';
        
        if( has_post_thumbnail() ){
            echo '<div class="post-thumbnail">';
            the_post_thumbnail( $image_size, array( 'itemprop'=>'image' ) );
            echo '</div>';
        }
    }else{
        echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';

        $image_size = 'travel-booking-blog-full';

        if( has_post_thumbnail() ){
            the_post_thumbnail( $image_size, array( 'itemprop'=>'image' ) );
        } else {
            travel_booking_pro_fallback_image( $image_size ); 
        }
        echo '</a>';
    }
}
endif;
add_action( 'travel_booking_pro_before_entry_content', 'travel_booking_pro_post_thumbnail', 20 );
add_action( 'travel_booking_pro_before_text_holder', 'travel_booking_pro_post_thumbnail', 20 );

if( ! function_exists( 'travel_booking_pro_before_entry_header' ) ) :
/**
 * Display Categories
*/
function travel_booking_pro_before_entry_header(){ 
    $hide_category = get_theme_mod( 'ed_category_meta', false );

    if( ! $hide_category ){ ?>
        <div class="category">
            <?php travel_booking_pro_categories(); ?>
        </div>
    <?php
    }
}
endif;
add_action( 'travel_booking_pro_post_content', 'travel_booking_pro_before_entry_header', 10 );


if( ! function_exists( 'travel_booking_pro_entry_content' ) ) :
/**
 * Entry Content
*/
function travel_booking_pro_entry_content(){ ?>
    <div class="entry-content">
		<?php
			
            if( ! is_singular() && false === get_post_format() ){
                the_excerpt();
            }else{
                the_content( sprintf(
    				wp_kses(
    					/* translators: %s: Name of current post. Only visible to screen readers */
    					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'travel-booking-pro' ),
    					array(
    						'span' => array(
    							'class' => array(),
    						),
    					)
    				),
    				get_the_title()
    			) );
    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-booking-pro' ),
    				'after'  => '</div>',
    			) );
            }
            
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'travel_booking_pro_post_content', 'travel_booking_pro_entry_content', 30 );
add_action( 'travel_booking_pro_page_content', 'travel_booking_pro_entry_content', 10 );

if( ! function_exists( 'travel_booking_pro_entry_footer' ) ) :
/**
 * Entry Footer
*/
function travel_booking_pro_entry_footer(){ ?>
	<footer class="entry-footer">
		<?php
        $readmore = get_theme_mod( 'readmore', __( 'Read More', 'travel-booking-pro' ) );
        $ed_share = get_theme_mod( 'ed_social_sharing', true );
        $shares   = get_theme_mod( 'social_share', array( 'facebook', 'twitter', 'linkedin', 'gplus', 'pinterest' ) );

        if( ! is_page() ){
            if( is_single() ){

                if( $ed_share ){
                    echo '<div class="post-share"><span>'. esc_html__( 'Share This Article', 'travel-booking-pro' ) .'</span><ul class="social-networks">';
                    foreach( $shares as $share ){
                        travel_booking_pro_get_social_share( $share );
                    }
                    echo '</ul></div>';
                }     

                travel_booking_pro_tags();
            }else{
                if( $readmore ) echo '<div class="btn-holder"><a href="' . esc_url( get_the_permalink() ) . '" class="primary-btn">' . esc_html( $readmore ) . '</a></div>';

                if( $ed_share ){
                    echo '<ul class="social-networks">';
                    foreach( $shares as $share ){
                        travel_booking_pro_get_social_share( $share );
                    }
                    echo '</ul>';
                }     
            } 
        }
        
        if ( get_edit_post_link() ){
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'travel-booking-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
        }
		?>
	</footer><!-- .entry-footer -->
	<?php            
}
endif;
add_action( 'travel_booking_pro_post_content', 'travel_booking_pro_entry_footer', 40 );
add_action( 'travel_booking_pro_page_content', 'travel_booking_pro_entry_footer', 20 );

if( ! function_exists( 'travel_booking_pro_author' ) ) :
/**
 * Author Bio
*/
function travel_booking_pro_author(){ 
    $hide_author = get_theme_mod( 'ed_author_section', false );

    if(  get_the_author_meta( 'description' ) && ! $hide_author ){ ?>
        <div class="author-section">
    		<div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?></div>
    		<div class="text-holder">
    			<h3 class="title"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h3>				
    			<?php 
                    echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); 
                    travel_booking_pro_author_social();
                ?>   
    		</div>
    	</div>
    <?php
    }
}
endif;
add_action( 'travel_booking_pro_after_post_content', 'travel_booking_pro_author', 15 );

if( ! function_exists( 'travel_booking_pro_pagination' ) ) :
/**
 * Pagination
*/
function travel_booking_pro_pagination(){    
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Prev Post', 'travel-booking-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Post', 'travel-booking-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'travel-booking-pro' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }        
    }else{
       $pagination = get_theme_mod( 'pagination_type', 'numbered' );
        
        switch( $pagination ){
            case 'default': // Default Pagination
            
            the_posts_navigation();
            
            break;
            
            case 'numbered': // Numbered Pagination
            
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous', 'travel-booking-pro' ),
                'next_text'          => __( 'Next', 'travel-booking-pro' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'travel-booking-pro' ) . ' </span>',
            ) );
        
            break;
            
            case 'load_more': // Load More Button
            case 'infinite_scroll': // Auto Infinite Scroll
            
            echo '<div class="pagination"></div>';
            
            break;
            
            default:
            
            the_posts_navigation();
            
            break;
        }
    }    
}
endif;
add_action( 'travel_booking_pro_after_post_content', 'travel_booking_pro_pagination', 20 );
add_action( 'travel_booking_pro_after_content', 'travel_booking_pro_pagination' );

if( ! function_exists( 'travel_booking_pro_related_posts' ) ) :
/**
 * Related Posts
*/
function travel_booking_pro_related_posts(){
    global $post;
    
    $ed_related         = get_theme_mod( 'ed_related_post_section', true );
    $ed_recent_posts    = get_theme_mod( 'ed_recent_post_section', true );
    $related_title      = get_theme_mod( 'related_post_section_title', __( 'You may also like...', 'travel-booking-pro' ) );
    $recent_posts_title = get_theme_mod( 'recent_post_section_title', __( 'Recent Posts', 'travel-booking-pro' ) );
    
        if( $ed_related ){
            $args = array(
                'post_type'             => 'post',
                'post_status'           => 'publish',
                'posts_per_page'        => 3,
                'ignore_sticky_posts'   => true,
                'post__not_in'          => array( $post->ID ),
                'orderby'               => 'rand'
            );
            $cats = get_the_category( $post->ID );
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
            
            $qry = new WP_Query( $args );
            
            if( $qry->have_posts() ){
            ?>
            <section class="recent-posts-area related-post">
        		<?php if( $related_title ) echo '<h2 class="section-title">' . esc_html( $related_title ) . '</h2>'; ?>
        		<div class="row">
        			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>

                         <article class="col">
                            <?php 
                                $image_size = 'travel-booking-related';

                                if( has_post_thumbnail() ){
                                    echo '<a class="post-thumbnail" href="'. esc_url( get_the_permalink() ).'">';
                                    the_post_thumbnail( $image_size, array( 'itemprop'=>'image' ) );  
                                    echo '</a>';  
                                }else{ ?>
                                    <a class="post-thumbnail" href="#">
                                       <?php travel_booking_pro_fallback_image( $image_size ); ?>
                                    </a>
                                <?php  
                                }
                            ?>            
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </article>

        			<?php }
                    wp_reset_postdata(); ?>
        		</div><!-- .row -->
        	</section>
            <?php
        }

        if( $ed_recent_posts ){
            $args = array(
                'post_type'             => 'post',
                'post_status'           => 'publish',
                'posts_per_page'        => 3,
                'ignore_sticky_posts'   => true,
                'post__not_in'          => array( $post->ID ),
                'orderby'               => 'rand'
            );
            
            $qry = new WP_Query( $args );
            
            if( $qry->have_posts() ){
            ?>
            <section class="recent-posts-area recent-post">
                <?php if( $recent_posts_title ) echo '<h2 class="section-title">' . esc_html( $recent_posts_title ) . '</h2>'; ?>
                <div class="row">
                    <?php while( $qry->have_posts() ){ $qry->the_post(); ?>

                         <article class="col">
                            <?php 
                                $image_size = 'travel-booking-related';

                                if( has_post_thumbnail() ){
                                    echo '<a class="post-thumbnail" href="'. esc_url( get_the_permalink() ).'">';
                                    the_post_thumbnail( $image_size, array( 'itemprop'=>'image' ) );    
                                    echo '</a>';
                                }else{ ?>
                                     <a class="post-thumbnail" href="#">
                                       <?php travel_booking_pro_fallback_image( $image_size ); ?>
                                    </a>
                                <?php  
                                }
                            ?>            
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </article>

                    <?php }
                    wp_reset_postdata(); ?>
                </div><!-- .row -->
            </section>
            <?php
            }
        }
    }
}
endif;
add_action( 'travel_booking_pro_after_post_content', 'travel_booking_pro_related_posts', 25 );

if( ! function_exists( 'travel_booking_pro_comment' ) ) :
/**
 * Page Header
*/
function travel_booking_pro_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'travel_booking_pro_after_post_content', 'travel_booking_pro_comment', 30 );
add_action( 'travel_booking_pro_after_page_content', 'travel_booking_pro_comment' );

if( ! function_exists( 'travel_booking_pro_content_end' ) ) :
/**
 * Content End
*/
function travel_booking_pro_content_end(){
    $home_sections = travel_booking_pro_get_homepage_section();
    
    if( is_404() || is_page_template( array( 'templates/about.php', 'templates/contact.php' ) ) ) return;
    
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){
    ?>
            </div><!-- .row -->
    </div><!-- #content -->
    <?php
    }
}
endif;
add_action( 'travel_booking_pro_before_footer', 'travel_booking_pro_content_end', 20 );

if( ! function_exists( 'travel_booking_pro_footer_start' ) ) :
/**
 * Footer Start
*/
function travel_booking_pro_footer_start(){
    $background_image = get_theme_mod( 'footer_bg_image', get_template_directory_uri() .'/images/bg-footer.jpg' );
    $footer_style     = '';

    if( ! empty( $background_image ) ){
        $footer_style = 'style="background: url('. esc_url( $background_image ).') no-repeat;"';
    }
    ?>
    <footer id="colophon" class="site-footer" <?php echo $footer_style; ?>>
    <?php
}
endif;
add_action( 'travel_booking_pro_footer', 'travel_booking_pro_footer_start', 20 );

if( ! function_exists( 'travel_booking_pro_footer_top' ) ) :
/**
 * Footer Top
*/
function travel_booking_pro_footer_top(){ 
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;

    foreach ( $footer_sidebars as $footer_sidebar ) {
        if( is_active_sidebar( $footer_sidebar ) ){
            array_push( $active_sidebars, $footer_sidebar );
            $sidebar_count++ ;
        }
    }

    if( ! empty( $active_sidebars ) ){ ?>

    <div class="footer-t">
        <div class="container">
    		<div class="col-<?php echo esc_attr( $sidebar_count ); ?> footer-col-holder">
    			<?php 
                    foreach( $active_sidebars as $active_footer_sidebar ){
                        echo '<div class="column">';
                        dynamic_sidebar( $active_footer_sidebar );
                        echo '</div>';
                    } 
                ?>
    		</div>
        </div><!-- .container -->
	</div><!-- .footer-t -->

    <?php 
    }   
}
endif;
add_action( 'travel_booking_pro_footer', 'travel_booking_pro_footer_top', 30 );

if( ! function_exists( 'travel_booking_pro_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function travel_booking_pro_footer_bottom(){ 
    $hide_author_link = get_theme_mod( 'ed_author_link', false );
    $hide_wp_link     = get_theme_mod( 'ed_wp_link', false ); ?>

    <div class="footer-b">
        <div class="container">
    		<span class="site-info">
    			<?php
                    travel_booking_pro_get_footer_copyright();
                    
                    if( ! $hide_author_link ) {
                        printf(  esc_html__( 'Travel Booking Pro by %1$sWP Travel Engine%2$s.', 'travel-booking-pro' ), '<a href="' . esc_url( 'https://wptravelengine.com/downloads/travel-booking-pro-wordpress-theme/' ) .'" rel="nofollow" target="_blank">', '</a>' );
                    }
                    
                    if( ! $hide_wp_link ){
                        printf( esc_html__( ' Powered by %s', 'travel-booking-pro' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'travel-booking-pro' ) ) .'" target="_blank">WordPress</a> .' );
                    }

                    if ( function_exists( 'the_privacy_policy_link' ) ) {
                        the_privacy_policy_link( '<span class="policy_link">', '</span>');
                    }                        
                     
                ?>                              
    		</span>
        </div>
	</div>
    <?php
}
endif;
add_action( 'travel_booking_pro_footer', 'travel_booking_pro_footer_bottom', 40 );

if( ! function_exists( 'travel_booking_pro_footer_end' ) ) :
/**
 * Footer End 
*/
function travel_booking_pro_footer_end(){
    ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'travel_booking_pro_footer', 'travel_booking_pro_footer_end', 50 );

if( ! function_exists( 'travel_booking_pro_scroll_to_top' ) ) :
    /**
     * Scroll to Top Options
     */  
    function travel_booking_pro_scroll_to_top(){

        /** Load default theme options */
        $enable_scroll_top = get_theme_mod( 'ed_scroll_to_top', true );

        if( $enable_scroll_top ){
        ?>
            <div class="to_top">
                <a href="#" class="btn"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="15.69" height="18.88" viewBox="0 0 15.69 18.88"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><path d="M9.328,17.805 L9.321,17.836 L9.321,5.217 L13.310,9.184 C13.505,9.377 13.768,9.484 14.045,9.484 C14.322,9.484 14.584,9.377 14.779,9.184 L15.399,8.566 C15.594,8.373 15.701,8.113 15.701,7.838 C15.701,7.561 15.594,7.303 15.400,7.109 L8.578,0.309 C8.383,0.114 8.122,0.008 7.845,0.009 C7.567,0.008 7.306,0.114 7.111,0.309 L0.289,7.109 C0.094,7.303 -0.013,7.561 -0.013,7.838 C-0.013,8.113 0.094,8.373 0.289,8.566 L0.908,9.184 C1.103,9.377 1.362,9.484 1.639,9.484 C1.916,9.484 2.162,9.377 2.357,9.184 L6.367,5.172 L6.367,17.820 C6.367,18.388 6.859,18.864 7.429,18.864 L8.305,18.864 C8.875,18.864 9.328,18.373 9.328,17.805 Z" class="cls-1"/></svg>
</a>
            </div>
        <?php
        }
    }
endif;
add_action( 'travel_booking_pro_after_footer', 'travel_booking_pro_scroll_to_top', 10 );

if( ! function_exists( 'travel_booking_pro_page_end' ) ) :
/**
 * Page End
*/
function travel_booking_pro_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'travel_booking_pro_after_footer', 'travel_booking_pro_page_end', 20 );

if( ! function_exists( 'travel_booking_pro_get_popular_package' ) ) :
/**
 * Popular Packages
*/
function travel_booking_pro_get_popular_package(){
    $ed_popular    = get_theme_mod( 'ed_404_popular', true ); 
    $section_title = get_theme_mod( '404_popular_text', __( 'Popular Trips', 'travel-booking-pro' ) );
    $trip_one      = get_theme_mod( '404_popular_trip_one' ); 
    $trip_two      = get_theme_mod( '404_popular_trip_two' ); 
    $trip_three    = get_theme_mod( '404_popular_trip_three' ); 
    $trip_four     = get_theme_mod( '404_popular_trip_four' ); 
    $trip_five     = get_theme_mod( '404_popular_trip_five' ); 
    $trip_six      = get_theme_mod( '404_popular_trip_six' ); 
    $trip_array    = array( $trip_one, $trip_two, $trip_three, $trip_four, $trip_five, $trip_six );
    $trip_array    = array_diff( array_unique( $trip_array ), array('') );

    if( $ed_popular && travel_booking_pro_is_wpte_activated() && travel_booking_pro_is_tbt_activated() ){
        $defaults   = new Travel_Booking_Toolkit_Dummy_Array;
        $obj        = new Travel_Booking_Toolkit_Functions;

        $args = array( 
            'post_type'      => 'trip',
            'post_status'    => 'publish',
            'posts_per_page' => 6,
            'post__in'       => $trip_array,
            'orderby'        => 'post__in'  
        );
        $popular_qry = new WP_Query( $args );
        ?>
        <section class="popular-package">
            <div class="container">

                <?php if( ! empty( $section_title ) ){ ?>
                    <header class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
                    </header>
                <?php } 

                if( $popular_qry->have_posts() && ! empty( $trip_array ) ){ 
                    $currency = $obj->travel_booking_toolkit_get_trip_currency();
                    $new_obj  = new Wp_Travel_Engine_Functions();
                    ?>
                    <div class="grid">
                        <?php  
                            while( $popular_qry->have_posts() ){ 
                                $popular_qry->the_post(); 
                                $code = $new_obj->trip_currency_code( get_post() );
                                $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); ?>
                                <div class="col">
                                    <div class="img-holder">
                                        <a href="<?php the_permalink(); ?>">
                                        <?php 
                                            $popular_image_size =  'travel-booking-popular-package';
                                            if( has_post_thumbnail() ){
                                                the_post_thumbnail( $popular_image_size, array( 'itemprop'=>'image' ) );    
                                            }else{ ?>
                                                <img src="<?php echo esc_url( TBT_FILE_URL . '/includes/images/popular-package-image-size.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />
                                                <?php
                                            }
                                        ?>
                                        </a>
                                        <?php 
                                            if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) && ( isset( $meta['sale'] ) && $meta['sale'] ) && ( isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){ 
                                                $diff = (int)( $meta['trip_prev_price'] - $meta['trip_price'] );
                                                $perc = (float)( ( $diff / $meta['trip_prev_price'] ) * 100 );  

                                                printf( __( '<div class="discount-amount">%1$s&percnt; Off</div>', 'travel-booking-pro' ), round( $perc ) );  
                                            }
                                        ?>
                                    </div>
                                    <div class="text-holder">
                                        <div class="price-info">
                                        <?php 
                                            $obj->travel_booking_toolkit_trip_symbol_options( get_the_ID(), $code, $currency );                                                              
                                            if( $obj->travel_booking_toolkit_is_wpte_gd_activated() && isset( $meta['group']['discount'] ) && isset( $meta['group']['traveler'] ) && ! empty( $meta['group']['traveler'] ) ){ ?>
                                                <span class="group-discount"><span class="tooltip"><?php esc_html_e( 'You have group discount in this trip.', 'travel-booking-pro' ) ?></span><?php esc_html_e( 'Group Discount', 'travel-booking-pro' ) ?></span>
                                                <?php
                                            } 
                                        ?>
                                            
                                        </div>

                                        <div class="trip-info">
                                            <?php  if( $obj->travel_booking_toolkit_is_wpte_tr_activated() ){ ?>
                                                <div class="star-holder">
                                                    <?php
                                                        global $post;
                                                        $comments = get_comments( array(
                                                            'post_id' => $post->ID,
                                                            'status' => 'approve',
                                                        ) );
                                                        if ( !empty( $comments ) ){
                                                            echo '<div class="review-wrap"><div class="average-rating">';
                                                            $sum = 0;
                                                            $i = 0;
                                                            foreach($comments as $comment) {
                                                                $rating = get_comment_meta( $comment->comment_ID, 'stars', true );
                                                                $sum = $sum+$rating;
                                                                $i++;
                                                            }
                                                            $aggregate = $sum/$i;
                                                            $aggregate = round($aggregate,2);

                                                            echo 
                                                            '<script>
                                                                jQuery(document).ready(function($){
                                                                    $(".agg-rating").rateYo({
                                                                        rating: '. esc_html( $aggregate ).'
                                                                    });
                                                                });
                                                            </script>';
                                                            echo '<div class="agg-rating"></div><div class="aggregate-rating">
                                                            <span class="rating-star">'.$aggregate.'</span><span>'.$i.'</span> '. esc_html( _nx( 'review', 'reviews', $i, 'reviews count', 'travel-booking-pro' ) ) .'</div>';
                                                            echo '</div></div><!-- .review-wrap -->';
                                                        }
                                                    ?>  
                                                </div>
                                            <?php } ?>
                                            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="meta-info">
                                                <?php 
                                                    $destinations = wp_get_post_terms( get_the_ID(), 'destination' );

                                                    if( ! empty( $destinations ) ){
                                                        foreach ($destinations as $destination ){
                                                            echo '<span class="place"><i class="fa fa-map-marker"></i>'. esc_html( $destination->name ) .'</span>';
                                                        }
                                                    }
                                                ?>
                                                <?php if( isset( $meta['trip_duration'] ) && '' != $meta['trip_duration'] ) echo '<span class="time"><i class="fa fa-clock-o"></i>' . absint( $meta['trip_duration'] ) . esc_html__( ' Days', 'travel-booking-pro' ) . '</span>'; ?>
                                            </div>
                                        </div>
                                        <?php 
                                        if( $obj->travel_booking_toolkit_is_wpte_fsd_activated() ){ 
                                            $starting_dates = get_post_meta( get_the_ID(), 'WTE_Fixed_Starting_Dates_setting', true );

                                            if( isset( $starting_dates['departure_dates'] ) && ! empty( $starting_dates['departure_dates'] ) && isset($starting_dates['departure_dates']['sdate']) ){ ?>
                                                <div class="next-trip-info">
                                                    <h3><?php esc_html_e( 'Next Departure', 'travel-booking-pro' ); ?></h3>
                                                    <ul class="next-departure-list">
                                                        <?php
                                                            $wpte_option_settings = get_option('wp_travel_engine_settings', true);
                                                            $sortable_settings    = get_post_meta( get_the_ID(), 'list_serialized', true);

                                                            if(!is_array($sortable_settings))
                                                            {
                                                              $sortable_settings = json_decode($sortable_settings);
                                                            }
                                                            $today = strtotime(date("Y-m-d"))*1000;
                                                            $i = 0;
                                                            foreach( $sortable_settings as $content )
                                                            {
                                                                $new_date = substr( $starting_dates['departure_dates']['sdate'][$content->id], 0, 7 );
                                                                if( $today <= strtotime($starting_dates['departure_dates']['sdate'][$content->id])*1000 )
                                                                {
                                                                    
                                                                    $num = isset($wpte_option_settings['trip_dates']['number']) ? $wpte_option_settings['trip_dates']['number']:5;
                                                                    if($i < $num)
                                                                    {
                                                                        if( isset( $starting_dates['departure_dates']['seats_available'][$content->id] ) )
                                                                        {
                                                                            $remaining = isset( $starting_dates['departure_dates']['seats_available'][$content->id] ) && ! empty( $starting_dates['departure_dates']['seats_available'][$content->id] ) ?  $starting_dates['departure_dates']['seats_available'][$content->id] . ' ' . __( 'spaces left', 'travel-booking-pro' ) : __( '0 space left', 'travel-booking-pro' );
                                                                            echo '<li><span class="left"><i class="fa fa-clock-o"></i>'. date_i18n( get_option( 'date_format' ), strtotime( $starting_dates['departure_dates']['sdate'][$content->id] ) ).'</span><span class="right">'. esc_html( $remaining) .'</span></li>';
                                                                        }
                                                                    
                                                                    }
                                                                $i++;
                                                                }
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php } 
                                        }  if( ! empty( $readmore ) ){ ?>
                                            <div class="btn-holder">
                                                <a href="<?php the_permalink(); ?>" class="primary-btn"><?php echo esc_html( $readmore ); ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php } ?>
                    </div>
                <?php } else {
                    //Default 
                    $populars = $defaults->travel_booking_toolkit_default_trip_featured_posts(); ?>
                        <div class="grid">
                            <?php foreach( $populars as $v ){ ?>
                            <div class="col">
                                <div class="img-holder">
                                    <a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ) ?>"></a>
                                    <div class="discount-amount"><?php echo esc_html( $v['discount'] ) ?></div>
                                </div>
                                <div class="text-holder">
                                    <div class="price-info">
                                        <span class="price-holder">
                                            <span class="old-price"><?php echo esc_html( $v['old_price'] ) ?></span>
                                            <span class="new-price"><?php echo esc_html( $v['new_price'] ) ?></span>
                                        </span>
                                        <span class="group-discount"><span class="tooltip"><?php esc_html_e( 'You have group discount in this trip.', 'travel-booking-pro' ) ?></span><?php esc_html_e( 'Group Discount', 'travel-booking-pro' ) ?></span>
                                    </div>
                                    <div class="trip-info">
                                        <div class="star-holder"><img src="<?php echo esc_url( $v['rating'] ) ?>" alt="<?php esc_html_e( '5 rating', 'travel-booking-pro' ) ?>"></div>
                                        <h2 class="title"><a href="#"><?php echo esc_html( $v['title'] ) ?></a></h2>
                                        <div class="meta-info">
                                            <span class="place"><i class="fa fa-map-marker"></i><?php echo esc_html( $v['destination'] ) ?></span>
                                            <span class="time"><i class="fa fa-clock-o"></i><?php echo esc_html( $v['days'] ) ?></span>
                                        </div>
                                    </div>
                                    <div class="next-trip-info">
                                        <h3><?php esc_html_e( 'Next Departure', 'travel-booking-pro' ) ?></h3>
                                        <ul class="next-departure-list">
                                            <?php 
                                                foreach ( $v['next-trip-info'] as $value ) {
                                                echo '<li>
                                                        <span class="left"><i class="fa fa-clock-o"></i>'. esc_html( $value['date'] ) .'</span>
                                                        <span class="right">'. esc_html( $value['space_left']).'</span>
                                                    </li>';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="btn-holder">
                                        <a href="#" class="primary-btn"><?php esc_html_e( 'View Details', 'travel-booking-pro' ) ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div><!-- .grid -->
                <?php } ?>
            </div>
        </section>
    <?php
    }
}
endif;
add_action( 'travel_booking_pro_popular_package', 'travel_booking_pro_get_popular_package', 10 );


if( ! function_exists( 'travel_booking_pro_get_related_trips' ) ) :

    /**
     * Related Trips
    */
    function travel_booking_pro_get_related_trips(){
        $enable_related_trips = get_theme_mod( 'enable_related_trips', true );

        if( $enable_related_trips && travel_booking_pro_is_wpte_activated() && travel_booking_pro_is_tbt_activated() ){ 
            global $post;
            $related_title = get_theme_mod( 'related_trip_title', __( 'Related Trips', 'travel-booking-pro' ) );
            $related_tax   = get_theme_mod( 'related_trip_tax', 'destination' );
            $label         = get_theme_mod( 'related_trip_readmore', __( 'View Details', 'travel-booking-pro' ) );
            
            $terms = get_the_terms( $post->ID, $related_tax );

            $defaults = new Travel_Booking_Toolkit_Dummy_Array;
            $obj      = new Travel_Booking_Toolkit_Functions;
            
            $args = array( 
                'post_type'      => 'trip',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'post__not_in'   => array( $post->ID ),
                'orderby'        => 'relevance meta_value_num',
                'meta_query' => array(
                        'key'     => '_yoast_wpseo_primary_activities',
                        'value'   => get_post_meta ( get_the_ID(),   '_yoast_wpseo_primary_activities',1),
                        'compare' => '=',
                    ),                
                'meta_key'      => '_yoast_wpseo_primary_activities'

            );
 # get_post_meta ( get_the_ID(),   '_yoast_wpseo_primary_activities',1)         
            if( $terms ){
                $t = array();
                foreach( $terms as $term ){
                    $t[] = $term->term_id; 
                }
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $related_tax,                 
                        'terms'    => $t,
                    ),
                );            
            }
                
            $related_qry = new WP_Query( $args );
            
            if( $related_qry->have_posts() ){ ?>
            <section class="related-trips">
                <div class="container">
                    <?php if( $related_title ){ ?>
                    <header class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $related_title ); ?></h2>                    
                    </header>
                    <?php } ?>
                    
                    <?php if( $related_qry->have_posts() ){ 
                        $new_obj  = new Wp_Travel_Engine_Functions();
                        $currency = $obj->travel_booking_toolkit_get_trip_currency();
                        ?>
                        <div class="grid">
                            <?php  
                                while( $related_qry->have_posts() ){ 
                                    $related_qry->the_post(); 
                                    $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
                                    $code     = $new_obj->trip_currency_code( get_post() ); ?>
                                   <div class="col">
                                        <div class="img-holder">
                                            <a href="<?php the_permalink(); ?>">
                                            <?php 
                                                $popular_image_size =  'travel-booking-popular-package';
                                                if( has_post_thumbnail() ){
                                                    the_post_thumbnail( $popular_image_size, array( 'itemprop'=>'image' ) );    
                                                }else{ ?>
                                                    <img src="<?php echo esc_url( TBT_FILE_URL . '/includes/images/popular-package-image-size.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />
                                                    <?php
                                                }
                                            ?>
                                            </a>
                                            <?php 
                                                if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) && ( isset( $meta['sale'] ) && $meta['sale'] ) && ( isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){ 
                                                    $diff = (int)( $meta['trip_prev_price'] - $meta['trip_price'] );
                                                    $perc = (float)( ( $diff / $meta['trip_prev_price'] ) * 100 );  

                                                    printf( __( '<div class="discount-amount">%1$s&percnt; Off</div>', 'travel-booking-pro' ), round( $perc ) );  
                                                }
                                            ?>
                                        </div>
                                        <div class="text-holder">
                                            <div class="price-info">
                                            <?php 
                                                $obj->travel_booking_toolkit_trip_symbol_options( get_the_ID(), $code, $currency );

                                                if( $obj->travel_booking_toolkit_is_wpte_gd_activated() && isset( $meta['group']['discount'] ) && isset( $meta['group']['traveler'] ) && ! empty( $meta['group']['traveler'] ) ){ ?>
                                                    <span class="group-discount"><span class="tooltip"><?php esc_html_e( 'You have group discount in this trip.', 'travel-booking-pro' ) ?></span><?php esc_html_e( 'Group Discount', 'travel-booking-pro' ) ?></span>
                                                    <?php
                                                } 
                                            ?>
                                                
                                            </div>

                                            <div class="trip-info">
                                                <?php if( $obj->travel_booking_toolkit_is_wpte_tr_activated() ){  ?>
                                                    <div class="star-holder">
                                                        <?php
                                                            global $post;
                                                            $comments = get_comments( array(
                                                                'post_id' => $post->ID,
                                                                'status' => 'approve',
                                                            ) );
                                                            if ( !empty( $comments ) ){
                                                                echo '<div class="review-wrap"><div class="average-rating">';
                                                                $sum = 0;
                                                                $i = 0;
                                                                foreach($comments as $comment) {
                                                                    $rating = get_comment_meta( $comment->comment_ID, 'stars', true );
                                                                    $sum = $sum+$rating;
                                                                    $i++;
                                                                }
                                                                $aggregate = $sum/$i;
                                                                $aggregate = round($aggregate,2);

                                                                echo 
                                                                '<script>
                                                                    jQuery(document).ready(function($){
                                                                        $(".agg-rating").rateYo({
                                                                            rating: '. esc_html( $aggregate ) .'
                                                                        });
                                                                    });
                                                                </script>';
                                                                echo '<div class="agg-rating"></div><div class="aggregate-rating">
                                                                <span class="rating-star">'.$aggregate.'</span><span>'.$i.'</span> '. esc_html( _nx( 'review', 'reviews', $i, 'reviews count', 'travel-booking-pro' ) ) .'</div>';
                                                                echo '</div></div><!-- .review-wrap -->';
                                                            }
                                                        ?>  
                                                    </div>
                                                <?php } ?>
                                                <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <div class="meta-info">
                                                    <?php 
                                                        $destinations = wp_get_post_terms( get_the_ID(), 'destination' );

                                                        if( ! empty( $destinations ) ){
                                                            foreach ($destinations as $destination ){
                                                                echo '<span class="place"><i class="fa fa-map-marker"></i>'. esc_html( $destination->name ) .'</span>';
                                                            }
                                                        }
                                                    ?>
                                                    <?php if( isset( $meta['trip_duration'] ) && '' != $meta['trip_duration'] ) echo '<span class="time"><i class="fa fa-clock-o"></i>' . absint( $meta['trip_duration'] ) . esc_html__( ' Days', 'travel-booking-pro' ) . '</span>'; ?>
                                                </div>
                                            </div>
                                            <?php 
                                            if( $obj->travel_booking_toolkit_is_wpte_fsd_activated() ){ 
                                                $starting_dates = get_post_meta( get_the_ID(), 'WTE_Fixed_Starting_Dates_setting', true );

                                                 if( isset( $starting_dates['departure_dates'] ) && ! empty( $starting_dates['departure_dates'] ) && isset($starting_dates['departure_dates']['sdate']) ){ ?>
                                                    <div class="next-trip-info">
                                                        <h3><?php esc_html_e( 'Next Departure', 'travel-booking-pro' ); ?></h3>
                                                        <ul class="next-departure-list">
                                                            <?php
                                                                $wpte_option_settings = get_option('wp_travel_engine_settings', true);
                                                                $sortable_settings    = get_post_meta( get_the_ID(), 'list_serialized', true);

                                                                if(!is_array($sortable_settings))
                                                                {
                                                                  $sortable_settings = json_decode($sortable_settings);
                                                                }
                                                                $today = strtotime(date("Y-m-d"))*1000;
                                                                $i = 0;
                                                                foreach( $sortable_settings as $content )
                                                                {
                                                                    $new_date = substr( $starting_dates['departure_dates']['sdate'][$content->id], 0, 7 );
                                                                    if( $today <= strtotime($starting_dates['departure_dates']['sdate'][$content->id])*1000 )
                                                                    {
                                                                        
                                                                        $num = isset($wpte_option_settings['trip_dates']['number']) ? $wpte_option_settings['trip_dates']['number']:5;
                                                                        if($i < $num)
                                                                        {
                                                                            if( isset( $starting_dates['departure_dates']['seats_available'][$content->id] ) )
                                                                            {
                                                                                $remaining = isset( $starting_dates['departure_dates']['seats_available'][$content->id] ) && ! empty( $starting_dates['departure_dates']['seats_available'][$content->id] ) ?  $starting_dates['departure_dates']['seats_available'][$content->id] . ' ' . __( 'spaces left', 'travel-booking-pro' ) : __( '0 space left', 'travel-booking-pro' );
                                                                                echo '<li><span class="left"><i class="fa fa-clock-o"></i>'. date_i18n( get_option( 'date_format' ), strtotime( $starting_dates['departure_dates']['sdate'][$content->id] ) ).'</span><span class="right">'. esc_html( $remaining) .'</span></li>';
                                                                            }
                                                                        
                                                                        }
                                                                    $i++;
                                                                    }
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php } 
                                            }  if( ! empty( $readmore ) ){ ?>
                                                <div class="btn-holder">
                                                    <a href="<?php the_permalink(); ?>" class="primary-btn"><?php echo esc_html( $readmore ); ?></a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                            <?php } wp_reset_postdata(); ?>
                        </div>
                    <?php } else {
                        //Default 
                        $populars = $defaults->travel_booking_toolkit_default_trip_featured_posts(); ?>
                            <div class="grid">
                                <?php foreach( $populars as $v ){ ?>
                                <div class="col">
                                    <div class="img-holder">
                                        <a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ) ?>"></a>
                                        <div class="discount-amount"><?php echo esc_html( $v['discount'] ) ?></div>
                                    </div>
                                    <div class="text-holder">
                                        <div class="price-info">
                                            <span class="price-holder">
                                                <span class="old-price"><?php echo esc_html( $v['old_price'] ) ?></span>
                                                <span class="new-price"><?php echo esc_html( $v['new_price'] ) ?></span>
                                            </span>
                                            <span class="group-discount"><span class="tooltip"><?php esc_html_e( 'You have group discount in this trip.', 'travel-booking-pro' ) ?></span><?php esc_html_e( 'Group Discount', 'travel-booking-pro' ) ?></span>
                                        </div>
                                        <div class="trip-info">
                                            <div class="star-holder"><img src="<?php echo esc_url( $v['rating'] ) ?>" alt="<?php esc_html_e( '5 rating', 'travel-booking-pro' ) ?>"></div>
                                            <h2 class="title"><a href="#"><?php echo esc_html( $v['title'] ) ?></a></h2>
                                            <div class="meta-info">
                                                <span class="place"><i class="fa fa-map-marker"></i><?php echo esc_html( $v['destination'] ) ?></span>
                                                <span class="time"><i class="fa fa-clock-o"></i><?php echo esc_html( $v['days'] ) ?></span>
                                            </div>
                                        </div>
                                        <div class="next-trip-info">
                                            <h3><?php esc_html_e( 'Next Departure', 'travel-booking-pro' ) ?></h3>
                                            <ul class="next-departure-list">
                                                <?php 
                                                    foreach ( $v['next-trip-info'] as $value ) {
                                                    echo '<li>
                                                            <span class="left"><i class="fa fa-clock-o"></i>'. esc_html( $value['date'] ) .'</span>
                                                            <span class="right">'. esc_html( $value['space_left']).'</span>
                                                        </li>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="btn-holder">
                                            <a href="#" class="primary-btn"><?php esc_html_e( 'View Details', 'travel-booking-pro' ) ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div><!-- .grid -->
                    <?php } ?>              
                    
                </div>
            </section>    
            <?php
            }
        }
    }
endif;
add_action( 'travel_booking_pro_related_trips', 'travel_booking_pro_get_related_trips' );

if( ! function_exists( 'travel_booking_pro_polylang_language_switcher' ) ) :

    /**
     * Template for Polylang Language Switcher
     */
    function travel_booking_pro_polylang_language_switcher(){
        if( travel_booking_pro_is_polylang_active() && has_nav_menu( 'language' ) ){ ?>
            <nav class="language-dropdown">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'language',
                        'menu_class'     => 'languages',
                        'fallback_cb'    => false,
                    ) );
                ?>
            </nav><!-- #site-navigation -->
            <?php        
        }
    }
endif;
add_action( 'travel_booking_pro_language_switcher', 'travel_booking_pro_polylang_language_switcher' );