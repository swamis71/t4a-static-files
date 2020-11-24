<?php
/**
 * Custom Post Type
 * 
 * @package Travel_Booking_Pro
 */

if ( ! function_exists('travel_booking_pro_testimonial_cpt') ) :
/**
 * Register Testimonial Custom Post Type
 */
function travel_booking_pro_testimonial_cpt() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'travel-booking-pro' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'travel-booking-pro' ),
		'menu_name'             => __( 'Testimonials', 'travel-booking-pro' ),
		'name_admin_bar'        => __( 'Testimonial', 'travel-booking-pro' ),
		'archives'              => __( 'Testimonial Archives', 'travel-booking-pro' ),
		'attributes'            => __( 'Testimonial Attributes', 'travel-booking-pro' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'travel-booking-pro' ),
		'all_items'             => __( 'All Testimonials', 'travel-booking-pro' ),
		'add_new_item'          => __( 'Add New Testimonial', 'travel-booking-pro' ),
		'add_new'               => __( 'Add New', 'travel-booking-pro' ),
		'new_item'              => __( 'New Testimonial', 'travel-booking-pro' ),
		'edit_item'             => __( 'Edit Testimonial', 'travel-booking-pro' ),
		'update_item'           => __( 'Update Testimonial', 'travel-booking-pro' ),
		'view_item'             => __( 'View Testimonial', 'travel-booking-pro' ),
		'view_items'            => __( 'View Testimonials', 'travel-booking-pro' ),
		'search_items'          => __( 'Search Testimonial', 'travel-booking-pro' ),
		'not_found'             => __( 'Not found', 'travel-booking-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'travel-booking-pro' ),
		'featured_image'        => __( 'Featured Image', 'travel-booking-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'travel-booking-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'travel-booking-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'travel-booking-pro' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'travel-booking-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'travel-booking-pro' ),
		'items_list'            => __( 'Testimonials list', 'travel-booking-pro' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'travel-booking-pro' ),
		'filter_items_list'     => __( 'Filter testimonials list', 'travel-booking-pro' ),
	);
	$rewrite = array(
		'slug'                  => 'testimonial',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'travel-booking-pro' ),
		'description'           => __( 'Testimonial Custom Post Type', 'travel-booking-pro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'tb_testimonial', $args );

}
add_action( 'init', 'travel_booking_pro_testimonial_cpt', 0 );
endif;

if ( ! function_exists('travel_booking_pro_team_cpt') ) :
/**
 * Register Team Custom Post Type
*/
function travel_booking_pro_team_cpt() {

	$labels = array(
		'name'                  => _x( 'Teams', 'Post Type General Name', 'travel-booking-pro' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'travel-booking-pro' ),
		'menu_name'             => __( 'Teams', 'travel-booking-pro' ),
		'name_admin_bar'        => __( 'Team', 'travel-booking-pro' ),
		'archives'              => __( 'Team Archives', 'travel-booking-pro' ),
		'attributes'            => __( 'Team Attributes', 'travel-booking-pro' ),
		'parent_item_colon'     => __( 'Parent Team:', 'travel-booking-pro' ),
		'all_items'             => __( 'All Teams', 'travel-booking-pro' ),
		'add_new_item'          => __( 'Add New Team', 'travel-booking-pro' ),
		'add_new'               => __( 'Add New', 'travel-booking-pro' ),
		'new_item'              => __( 'New Team', 'travel-booking-pro' ),
		'edit_item'             => __( 'Edit Team', 'travel-booking-pro' ),
		'update_item'           => __( 'Update Team', 'travel-booking-pro' ),
		'view_item'             => __( 'View Team', 'travel-booking-pro' ),
		'view_items'            => __( 'View Teams', 'travel-booking-pro' ),
		'search_items'          => __( 'Search Team', 'travel-booking-pro' ),
		'not_found'             => __( 'Not found', 'travel-booking-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'travel-booking-pro' ),
		'featured_image'        => __( 'Featured Image', 'travel-booking-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'travel-booking-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'travel-booking-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'travel-booking-pro' ),
		'insert_into_item'      => __( 'Insert into team', 'travel-booking-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this team', 'travel-booking-pro' ),
		'items_list'            => __( 'Teams list', 'travel-booking-pro' ),
		'items_list_navigation' => __( 'Teams list navigation', 'travel-booking-pro' ),
		'filter_items_list'     => __( 'Filter teams list', 'travel-booking-pro' ),
	);
	$rewrite = array(
		'slug'                  => 'team',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Team', 'travel-booking-pro' ),
		'description'           => __( 'Team Custom Post Type', 'travel-booking-pro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'tb_team', $args );

}
add_action( 'init', 'travel_booking_pro_team_cpt', 0 );
endif;