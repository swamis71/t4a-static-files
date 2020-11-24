<?php 
/**
* Metabox for Sidebar Layout
*
* @package Travel_Booking_Pro
*
*/ 

function travel_booking_pro_add_sidebar_layout_box(){

    $post_id   = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $shop_id   = get_option( 'woocommerce_shop_page_id' );
    $template  = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = array( 'templates/about.php', 'templates/contact.php', 'templates/team.php', 'templates/template-activities.php', 'templates/template-destination.php', 'templates/template-trip_types.php' );

    if( ! in_array( $template, $templates ) && ( $shop_id != $post_id ) ){
        add_meta_box( 
            'travel_booking_pro_sidebar_layout',
            __( 'Sidebar Layout', 'travel-booking-pro' ),
            'travel_booking_pro_sidebar_layout_callback', 
            array( 'page', 'post' ),
            'normal',
            'high'
        );
    }

    //Testimonial Details
    add_meta_box(
        'travel_booking_pro_testimonial_details',
        __( 'Testimonial Details', 'travel-booking-pro' ),
        'travel_booking_pro_testimonial_detail_callback',
        'tb_testimonial',
        'side',
        'high'
    );

    //Trip details
    add_meta_box(
        'travel_booking_pro_team_details',
        __( 'Team Details', 'travel-booking-pro' ),
        'travel_booking_pro_team_metabox_callback',
        'tb_team',
        'side',
        'high'
    );
    
    //Trip Gallery
    add_meta_box(
        'travel_booking_pro_team_gallery',
        __( 'Team Gallery', 'travel-booking-pro' ),
        'travel_booking_pro_team_gallery_callback',
        'tb_team',
        'normal',
        'high'
    );
    
}
add_action( 'add_meta_boxes', 'travel_booking_pro_add_sidebar_layout_box' );

$travel_booking_pro_sidebar_layout = array(
    'default-sidebar' => array(
        'value'     => 'default-sidebar',
        'label'     => __( 'Default Sidebar', 'travel-booking-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
    ),
    'left-sidebar'   => array(
        'value'     => 'left-sidebar',
        'label'     => __( 'Left Sidebar', 'travel-booking-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
    ),
    'no-sidebar'     => array(
        'value'     => 'no-sidebar',
        'label'     => __( 'No Sidebar', 'travel-booking-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
    ),
    'right-sidebar' => array(
        'value'     => 'right-sidebar',
        'label'     => __( 'Right Sidebar', 'travel-booking-pro' ),
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'         
    )
);

function travel_booking_pro_sidebar_layout_callback(){
    global $post , $travel_booking_pro_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'travel_booking_pro_sidebar_layout_nonce' );
    
    $sidebars = travel_booking_pro_get_dynamnic_sidebar( true, true, true );
    $sidebar  = get_post_meta( $post->ID, '_tb_sidebar', true );
?>
 
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'travel-booking-pro' ); ?></em></td>
    </tr>

    <tr>
        <td>
        <?php
            $layout = get_post_meta( $post->ID, '_tb_sidebar_layout', true );   

            $checked_layout = 'default-sidebar';

            if( ! empty( $layout ) ){
                $checked_layout = $layout;
            } 

            foreach( $travel_booking_pro_sidebar_layout as $field ){  
            ?>

            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" /></span><br/>
                    <input type="radio" name="tb_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $checked_layout ); ?>/>&nbsp;<?php echo esc_html( $field['label'] ); ?>
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr>
        <td colspan="3"><em class="f13"><?php esc_html_e( 'Choose Sidebar', 'travel-booking-pro' ); ?></em></td>
    </tr>
    
    <tr>
        <td>
            <select name="tb_sidebar">
            <?php 
                foreach( $sidebars as $k => $v ){ ?>
                    <option value="<?php echo esc_attr( $k ); ?>" <?php selected( $sidebar, $k ); if( empty( $sidebar ) && $k == 'default-sidebar' ){ echo "selected='selected'";}?> ><?php echo esc_html( $v ); ?></option>
                <?php }
            ?>
            </select>
        </td>    
    </tr>
    
    <tr>
        <td><em class="f13"><?php printf( esc_html__( 'You can set up the sidebar content from %s', 'travel-booking-pro' ), '<a href="'. esc_url( admin_url( 'widgets.php' ) ) .'">here</a>' ); ?></em></td>
    </tr>
</table>
 
<?php 
}

function travel_booking_pro_save_sidebar_layout( $post_id ){
    global $travel_booking_pro_sidebar_layout , $post;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'travel_booking_pro_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'travel_booking_pro_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;

    if( 'page' == $_POST['post_type'] ){  
        if( !current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( !current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }
    
    // Make sure that it is set.
    if( ! isset( $_POST['tb_sidebar_layout'] ) && ! isset( $_post['tb_sidebar'] ) ){
        return;
    }
    
    foreach( $travel_booking_pro_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, '_tb_sidebar_layout', true ); 
        $new = sanitize_text_field( $_POST['tb_sidebar_layout'] );
        if( $new && $new != $old ) {  
            update_post_meta( $post_id, '_tb_sidebar_layout', $new );  
        }elseif( '' == $new && $old ) {  
            delete_post_meta( $post_id, '_tb_sidebar_layout', $old );  
        } 
     } // end foreach    
     
    // Sanitize user input.
	$sidebar = sanitize_text_field( $_POST['tb_sidebar'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_tb_sidebar', $sidebar );
     
}
add_action( 'save_post', 'travel_booking_pro_save_sidebar_layout' ); 

/**
 * Callback for Testimonial Details
*/
function travel_booking_pro_testimonial_detail_callback( $post ){
    wp_nonce_field( basename( __FILE__ ), 'tb_testimonial_detail_nonce' );
        
    $trip_title = get_post_meta( $post->ID, '_tb_testimonail_trip_title', true );
    $visited_trip = get_post_meta( $post->ID, '_tb_testimonail_visited_trip', true );
    $trip_date    = get_post_meta( $post->ID, '_tb_testimonail_trip_date', true );
    $trip_rating  = get_post_meta( $post->ID, '_tb_testimonail_trip_rating', true );
    ?>
    <div class="testimonial-visited-trip">
        <label for="visited-trip"><?php esc_html_e( 'Trip Title : ', 'travel-booking-pro' ); ?></label>
        <input type="text" name="tb_testimonail_trip_title" id="trip-title" value="<?php echo esc_attr( $trip_title ? $trip_title : '' ); ?>" />
    </div>
    <div class="testimonial-visited-trip">
        <label for="visited-trip"><?php esc_html_e( 'Visited Trip : ', 'travel-booking-pro' ); ?></label>
        <input type="text" name="tb_testimonail_visited_trip" id="visited-trip" value="<?php echo esc_attr( $visited_trip ? $visited_trip : '' ); ?>" />
    </div>
    <div class="testimonial-trip-date">
        <label for="trip-date"><?php esc_html_e( 'Trip Date: ', 'travel-booking-pro' ); ?></label>
        <input type="text" name="tb_testimonail_trip_date" id="trip-date" value="<?php echo esc_attr( $trip_date ? $trip_date : '' ); ?>" />
    </div>
    <div class="testimonial-rating">
        <label for="trip-rating"><?php esc_html_e( 'Rating: ', 'travel-booking-pro' ); ?></label>
        <div id="rate-<?php echo esc_attr( $post->ID ); ?>"></div>
        <input type="hidden" name="tb_testimonail_trip_rating" id="trip-rating" value="<?php echo esc_attr( $trip_rating ? $trip_rating : '' ); ?>" />
    </div>
    <?php
}

/**
 * Save Testimonial Details
*/
function travel_booking_pro_save_testimonial_details( $post_id ){
    if( !isset( $_POST['tb_testimonial_detail_nonce'] ) || !wp_verify_nonce( $_POST['tb_testimonial_detail_nonce'], basename(__FILE__) ) ) return;

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if( isset( $_POST['tb_testimonail_trip_title'] ) ){
        $trip_title = sanitize_text_field( $_POST['tb_testimonail_trip_title'] );
        update_post_meta( $post_id, '_tb_testimonail_trip_title', $trip_title );
    }

    if( isset( $_POST['tb_testimonail_visited_trip'] ) ){
        $visited_trip = sanitize_text_field( $_POST['tb_testimonail_visited_trip'] );
        update_post_meta( $post_id, '_tb_testimonail_visited_trip', $visited_trip );
    }
    
    if( isset( $_POST['tb_testimonail_trip_date'] ) ){
        $trip_date = sanitize_text_field( $_POST['tb_testimonail_trip_date'] );
        update_post_meta( $post_id, '_tb_testimonail_trip_date', $trip_date );
    }
    
    if( isset( $_POST['tb_testimonail_trip_rating'] ) ){
        $trip_rating = sanitize_text_field( $_POST['tb_testimonail_trip_rating'] );
        update_post_meta( $post_id, '_tb_testimonail_trip_rating', $trip_rating );
    }
}
add_action( 'save_post', 'travel_booking_pro_save_testimonial_details' );

    
/**
 * Social Icons for Team
*/
function travel_booking_pro_team_social(){
    global $post;
    $social = get_post_meta( $post->ID, '_tb_team_social', true );
    
    $defaults = array( 
        'facebook'     => '', 
        'twitter'      => '',
        'instagram'    => '',
        'snapchat'     => '',
        'pinterest'    => '',
        'google-plus'  => '',
        'youtube'      => ''
    );
    $social_icons = apply_filters( 'tb_social_icons', $defaults );
    
    if( $social ){
        return $social;
    }else{
        return $social_icons;
    }
}
/**
 * Callback for Team Details
*/
function travel_booking_pro_team_metabox_callback(){
    
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'tb_team_detail_nonce' );
    
    $position = get_post_meta( $post->ID, '_tb_team_position', true );
    $socials  = travel_booking_pro_team_social();
    ?>
    <div class="team-info">
        <label for="position"><?php esc_html_e( 'Position : ', 'travel-booking-pro' ); ?></label>
        <input type="text" name="tb_team_position" id="position" value="<?php echo $position ? $position : ''; ?>" />
    </div>
    
    <div class="team-social">
        <br>
        <b><?php esc_html_e( 'Social Links', 'travel-booking-pro' ); ?></b>
        <ul class="tb-team-sortable-icons">
            <?php foreach( $socials as $k => $v ){ ?>
            <li class="social-icons">
                <label for="<?php echo esc_attr( $k ); ?>"><?php printf( esc_html__( '%s :', 'travel-booking-pro' ), ucfirst( $k ) ); ?></label>
                <input id="<?php echo esc_attr( $k ); ?>" name="tb_team_social[<?php echo esc_attr( $k ); ?>]" type="text" value="<?php echo isset( $v ) ? esc_attr( $v ) : ''; ?>" />
            </li>
            <?php } ?>            
        </ul>
    </div>
    <?php
}

/**
 * Saving Team Details
*/
function travel_booking_pro_save_team_details( $post_id ){
    global $post;
    $socials = array();
    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'tb_team_detail_nonce' ] ) || !wp_verify_nonce( $_POST[ 'tb_team_detail_nonce' ], basename( __FILE__ ) ) ) return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if( isset( $_POST['tb_team_position'] ) ){
        $position = sanitize_text_field( $_POST['tb_team_position'] );
        update_post_meta( $post_id, '_tb_team_position', $position );
    }
    
    if( isset( $_POST['tb_team_social'] ) ){
        foreach( $_POST['tb_team_social'] as $key => $links ){
            $socials[$key] = esc_url_raw( $links );
        }
        update_post_meta( $post_id, '_tb_team_social', $socials );
    }    
}
add_action( 'save_post', 'travel_booking_pro_save_team_details' );

/**
 * Team Gallery Meta Box
*/
function travel_booking_pro_team_gallery_callback( $post ){
    wp_nonce_field( basename(__FILE__), 'tb_team_gallery_nonce' );
    $ids   = get_post_meta( $post->ID, '_tb_team_gallery_ids', true );
    $title = get_post_meta( $post->ID, '_tb_team_gallery_title', true );
    ?>
    <table class='form-table'>
        <tr>
            <td>
                <label for="gallery-title"><?php esc_html_e( 'Gallery Title: ', 'travel-booking-pro' ); ?></label>
                <input type="text" name="tb_team_gallery_title" id="gallery-title" value="<?php echo esc_attr( $title ? $title : '' ); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <a class='img-gallery-add button' href='javascript:void(0);' data-uploader-title='<?php esc_attr_e( 'Add image(s) to gallery', 'travel-booking-pro' );?>' data-uploader-button-text='<?php esc_attr_e( 'Add image(s)', 'travel-booking-pro' ); ?>'><?php esc_html_e( 'Add image(s)', 'travel-booking-pro' ); ?></a>
                <ul id='img-gallery-metabox-list'>
                <?php
                if( $ids ){ 
                    foreach( $ids as $key => $value ){ 
                        $image = wp_get_attachment_image_src( $value ); ?>
                        <li>
                            <input type='hidden' name='tb_team_gallery_ids[<?php echo esc_attr( $key ); ?>]' value='<?php echo esc_attr( $value ); ?>'>
                            <img class='image-preview' src='<?php echo $image[0]; ?>'>
                            <a class='change-image button button-small' href='javascript:void(0);' data-uploader-title='<?php esc_attr_e( 'Change image', 'travel-booking-pro' ); ?>' data-uploader-button-text='<?php esc_attr_e( 'Change image', 'travel-booking-pro' ); ?>'><?php esc_html_e( 'Change image', 'travel-booking-pro' ); ?></a><br>
                            <small><a class='remove-image' href='javascript:void(0);'><?php esc_html_e( 'Remove image', 'travel-booking-pro' ); ?></a></small>
                        </li>
                    <?php 
                    }
                } 
                ?>
                </ul>
            </td>
        </tr>
    </table>
    <?php 
}

/**
 * Save Gallery post meta
*/
function travel_booking_pro_save_team_gallery( $post_id ){
    if( !isset( $_POST['tb_team_gallery_nonce'] ) || !wp_verify_nonce( $_POST['tb_team_gallery_nonce'], basename(__FILE__) ) ) return;

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( isset( $_POST['tb_team_gallery_ids'] ) ){
        update_post_meta( $post_id, '_tb_team_gallery_ids', $_POST['tb_team_gallery_ids'] );
    }else{
        delete_post_meta( $post_id, '_tb_team_gallery_ids' );
    }
    
    if( isset( $_POST['tb_team_gallery_title']) ){
        $title = sanitize_text_field( $_POST['tb_team_gallery_title'] );
        update_post_meta( $post_id, '_tb_team_gallery_title', $_POST['tb_team_gallery_title'] );
    }
} 
add_action( 'save_post', 'travel_booking_pro_save_team_gallery' );


/**
 * User Profile Extra Fields 
 */
function travel_booking_pro_user_fields( $user ) { 
    
    wp_nonce_field( basename( __FILE__ ), 'tb_user_fields_nonce' ); 
    
    if( is_string( $user ) === true ){
        $user = new stdClass();//create a new
        $id = -9999;
        unset( $user );
    }else{
        $id = $user->ID;
    }
     
    $facebook  = get_user_meta( $id, '_tb_facebook', true );
    $twitter   = get_user_meta( $id, '_tb_twitter', true );
    $instagram = get_user_meta( $id, '_tb_instagram', true );
    $snapchat  = get_user_meta( $id, '_tb_snapchat', true );
    $pinterest = get_user_meta( $id, '_tb_pinterest', true );
    $linkedin  = get_user_meta( $id, '_tb_linkedin', true );
    $gplus     = get_user_meta( $id, '_tb_gplus', true );
    ?>
    
    <h3><?php esc_html_e( 'User Social Link', 'travel-booking-pro' ); ?></h3>
    
    <table class="form-table">    
        <tr>
            <th><label for="facebook"><?php esc_html_e( 'Facebook Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( $facebook ? $facebook : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Facebook Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php esc_html_e( 'Twitter Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( $twitter ? $twitter : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Twitter Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php esc_html_e( 'Instagram Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( $instagram ? $instagram : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Instagram Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="snapchat"><?php esc_html_e( 'Snapchat Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="snapchat" id="snapchat" value="<?php echo esc_attr( $snapchat ? $snapchat : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Snapchat Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>  
        <tr>
            <th><label for="pinterest"><?php esc_html_e( 'Pinterest Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( $pinterest ? $pinterest : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Pinterest Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin"><?php esc_html_e( 'LinkedIn Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( $linkedin ? $linkedin : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your LinkedIn Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>      
        <tr>
            <th><label for="gplus"><?php esc_html_e( 'Google Plus Url', 'travel-booking-pro' ); ?></label></th>
            <td>
                <input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( $gplus ? $gplus : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Google Plus Url.", 'travel-booking-pro' ); ?></span>
            </td>
        </tr>          
    </table>
<?php 
}
/** Hooks to add extra field in profile */
add_action( 'show_user_profile', 'travel_booking_pro_user_fields' ); // editing your own profile
add_action( 'edit_user_profile', 'travel_booking_pro_user_fields' ); // editing another user
add_action( 'user_new_form', 'travel_booking_pro_user_fields' ); // creating a new user

/**
 * Saving Extra User Profile Information
*/ 
function travel_booking_pro_save_user_fields( $user_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['tb_user_fields_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['tb_user_fields_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    if ( !current_user_can( 'edit_user', $user_id ) ) return false;

    if( isset( $_POST['facebook'] ) ){
        $facebook = esc_url_raw( $_POST['facebook'] );
        update_user_meta( $user_id, '_tb_facebook', $facebook );
    }
    
    if( isset( $_POST['twitter'] ) ){
        $twitter = esc_url_raw( $_POST['twitter'] );
        update_user_meta( $user_id, '_tb_twitter', $twitter );
    }
    
    if( isset( $_POST['instagram'] ) ){
        $instagram = esc_url_raw( $_POST['instagram'] );
        update_user_meta( $user_id, '_tb_instagram', $instagram );
    }
    
    if( isset( $_POST['snapchat'] ) ){
        $snapchat = esc_url_raw( $_POST['snapchat'] );
        update_user_meta( $user_id, '_tb_snapchat', $snapchat );
    }
    
    if( isset( $_POST['pinterest'] ) ){
        $pinterest = esc_url_raw( $_POST['pinterest'] );
        update_user_meta( $user_id, '_tb_pinterest', $pinterest );
    }
    
    if( isset( $_POST['linkedin'] ) ){
        $linkedin = esc_url_raw( $_POST['linkedin'] );
        update_user_meta( $user_id, '_tb_linkedin', $linkedin );
    }
    
    if( isset( $_POST['gplus'] ) ){
        $gplus = esc_url_raw( $_POST['gplus'] );
        update_user_meta( $user_id, '_tb_gplus', $gplus );
    }
    
}
/** Hook to Save Extra User Fields */
add_action( 'personal_options_update', 'travel_booking_pro_save_user_fields' );
add_action( 'edit_user_profile_update', 'travel_booking_pro_save_user_fields' );
add_action( 'user_register', 'travel_booking_pro_save_user_fields' );