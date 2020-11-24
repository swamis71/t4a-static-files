<?php
/**
 * Sanitization Functions
 * 
 * @package Travel_Booking_Pro
*/

/**
 * Sanitize callback for checkbox
*/
function travel_booking_pro_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize callback for select
*/
function travel_booking_pro_sanitize_select( $value, $setting ){
                                                                    
     if ( is_array( $value ) ) {
        foreach ( $value as $key => $subvalue ) {
            $value[ $key ] = sanitize_text_field( $subvalue );
        }
        return $value;
    }
    return sanitize_text_field( $value );
}

/**
 * Sanitize callback for radio field
 */
function travel_booking_pro_sanitize_radio( $input, $setting ) {
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize callback for number field
*/
function travel_booking_pro_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
    
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function travel_booking_pro_sanitize_number_floatval( $number, $setting ) {
    // Ensure $number is an floatval.
    $number = floatval( $number );                                                          
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

/**
 * Sanitize image.
 */
function travel_booking_pro_sanitize_image( $image, $setting ) {

    /**
     * Array of valid image file types.
    */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon',
    );

    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );

    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? esc_url_raw( $image ) : '' );
}

function travel_booking_pro_sanitize_multiple_check( $value ) {                        
    $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
    return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();    
}

function travel_booking_pro_sanitize_sortable( $value = array() ) {
    if ( is_string( $value ) || is_numeric( $value ) ) {
        return array(
            esc_attr( $value ),
        );
    }
    $sanitized_value = array();
    foreach ( $value as $sub_value ) {
        $sanitized_value[] = esc_attr( $sub_value );
    }
    return $sanitized_value;
}