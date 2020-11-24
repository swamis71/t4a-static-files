<?php
/**
 * Typography Related Functions
 *
 * @package Travel_Booking_Pro
 */
 
function travel_booking_pro_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'Lato' );
    $ig_primary_font    = travel_booking_pro_is_google_font( $primary_font );    
    
    $h1_font    = get_theme_mod( 'h1_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h1_font = travel_booking_pro_is_google_font( $h1_font['font-family'] );
    $h2_font    = get_theme_mod( 'h2_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h2_font = travel_booking_pro_is_google_font( $h2_font['font-family'] ); 
    $h3_font    = get_theme_mod( 'h3_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h3_font = travel_booking_pro_is_google_font( $h3_font['font-family'] );
    $h4_font    = get_theme_mod( 'h4_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h4_font = travel_booking_pro_is_google_font( $h4_font['font-family'] );
    $h5_font    = get_theme_mod( 'h5_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h5_font = travel_booking_pro_is_google_font( $h5_font['font-family'] );
    $h6_font    = get_theme_mod( 'h6_font', array( 'font-family'=>'Lato', 'variant'=>'700' ) );
    $ig_h6_font = travel_booking_pro_is_google_font( $h6_font['font-family'] );    
    
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'travel-booking-pro' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'travel-booking-pro' );
    $h1         = _x( 'on', 'H1 Content Font: on or off', 'travel-booking-pro' );
    $h2         = _x( 'on', 'H2 Content Font: on or off', 'travel-booking-pro' );
    $h3         = _x( 'on', 'H3 Content Font: on or off', 'travel-booking-pro' );
    $h4         = _x( 'on', 'H4 Content Font: on or off', 'travel-booking-pro' );
    $h5         = _x( 'on', 'H5 Content Font: on or off', 'travel-booking-pro' );
    $h6         = _x( 'on', 'H6 Content Font: on or off', 'travel-booking-pro' );
    
    if ( 'off' !== $primary || 'off' !== $h1 || 'off' !== $h2 || 'off' !== $h3 || 'off' !== $h4 || 'off' !== $h5 || 'off' !== $h6 ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = travel_booking_pro_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
         
        if ( 'off' !== $h1 && $ig_h1_font ) {
            if( ! empty( $h1_font['variant'] ) ){
                $h1_var = ':' . travel_booking_pro_check_varient( $h1_font['font-family'], $h1_font['variant'] );    
            }else{
                $h1_var = '';
            }
            $font_families[] = $h1_font['font-family'] . $h1_var;
        }
        
        if ( 'off' !== $h2 && $ig_h2_font ) {
            if( ! empty( $h2_font['variant'] ) ){
                $h2_var = ':' . travel_booking_pro_check_varient( $h2_font['font-family'], $h2_font['variant'] );    
            }else{
                $h2_var = '';
            }
            $font_families[] = $h2_font['font-family'] . $h2_var;
        }
        
        if ( 'off' !== $h3 && $ig_h3_font ) {
            if( ! empty( $h3_font['variant'] ) ){
                $h3_var = ':' . travel_booking_pro_check_varient( $h3_font['font-family'], $h3_font['variant'] );    
            }else{
                $h3_var = '';
            }
            $font_families[] = $h3_font['font-family'] . $h3_var;
        }
        
        if ( 'off' !== $h4 && $ig_h4_font ) {
            if( ! empty( $h4_font['variant'] ) ){
                $h4_var = ':' . travel_booking_pro_check_varient( $h4_font['font-family'], $h4_font['variant'] );    
            }else{
                $h4_var = '';
            }
            $font_families[] = $h4_font['font-family'] . $h4_var;
        }
        
        if ( 'off' !== $h5 && $ig_h5_font ) {
            if( ! empty( $h5_font['variant'] ) ){
                $h5_var = ':' . travel_booking_pro_check_varient( $h5_font['font-family'], $h5_font['variant'] );    
            }else{
                $h5_var = '';
            }
            $font_families[] = $h5_font['font-family'] . $h5_var;
        }
        
        if ( 'off' !== $h6 && $ig_h6_font ) {
            if( ! empty( $h6_font['variant'] ) ){
                $h6_var = ':' . travel_booking_pro_check_varient( $h6_font['font-family'], $h6_font['variant'] );    
            }else{
                $h6_var = '';
            }
            $font_families[] = $h6_font['font-family'] . $h6_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
     
    return esc_url_raw( $fonts_url );
}

/**
 * Get Google Fonts
*/
function travel_booking_pro_get_google_fonts(){
    $fonts = include wp_normalize_path( get_template_directory() . '/inc/custom-controls/typography/webfonts.php' );
    $google_fonts = array();
    if ( is_array( $fonts ) ) {
		foreach ( $fonts['items'] as $font ) {
            $google_fonts[ $font['family'] ] = array(
				'variants' => $font['variants'],
			);
		}
	}    
    return $google_fonts;
}

/**
 * Function listing WebSafe Fonts and its attributes
*/
function travel_booking_pro_get_websafe_font(){
    $standard_fonts = array(
		'georgia-serif' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => 'Georgia, serif',
		),
        'palatino-serif' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
		),
        'times-serif' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Times New Roman", Times, serif',
		),
        'arial-helvetica' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => 'Arial, Helvetica, sans-serif',
		),
        'arial-gadget' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Arial Black", Gadget, sans-serif',
		),
		'comic-cursive' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Comic Sans MS", cursive, sans-serif',
		),
		'impact-charcoal'  => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => 'Impact, Charcoal, sans-serif',
		),
        'lucida' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		),
        'tahoma-geneva' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-helvetica' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Trebuchet MS", Helvetica, sans-serif',
		),
		'verdana-geneva'  => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => 'Verdana, Geneva, sans-serif',
		),
        'courier' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Courier New", Courier, monospace',
		),
        'lucida-monaco' => array(
			'variants' => array( 'regular', 'italic', '700', '700italic' ),
			'fonts' => '"Lucida Console", Monaco, monospace',
		)
	); 
    
    return $standard_fonts;
}

/**
 * Checks for matched varients in google fonts for typography fields
*/
function travel_booking_pro_check_varient( $font_family = 'serif', $font_variants = 'regular', $body = false ){
    $variant = '';
    $var     = array();
    $google_fonts  = travel_booking_pro_get_google_fonts(); //Google Fonts
    $websafe_fonts = travel_booking_pro_get_websafe_font(); //Standard Web Safe Fonts
    
    if( array_key_exists( $font_family, $google_fonts ) ){
        $variants = $google_fonts[ $font_family ][ 'variants' ];

        if( in_array( $font_variants, $variants ) ){
            if( $body ){ //LOAD ALL VARIANTS FOR BODY FONT
                foreach( $variants as $v ){
                    $var[] = $v;
                }
                $variant = implode( ',', $var );
            }else{                
                $variant = $font_variants;
            }
        }else{
            $variant = 'regular';
        }
        
    }else{ //Standard Web Safe Fonts
        if( array_key_exists( $font_family, $websafe_fonts ) ){
            $variants = $websafe_fonts[ $font_family ][ 'variants' ];
            if( in_array( $font_variants, $variants ) ){
                if( $body ){ //LOAD ALL VARIANTS FOR BODY FONT
                    foreach( $variants as $v ){
                        $var[] = $v;
                    }
                    $variant = implode( ',', $var );
                }else{  
                    $variant = $font_variants;
                }
            }else{
                $variant = 'regular';
            }    
        }
    }
    return $variant;
}

/**
 * Returns font weight and font style to use in dynamic styles.
*/
function travel_booking_pro_get_css_variant( $font_variant ){
    $v_array = array(
		'100'       => array(
            'weight'    => '100',
            'style'     => 'normal'
            ),
		'100italic' => array(
            'weight'    => '100',
            'style'     => 'italic'
            ),
		'200'       => array(
            'weight'    => '200',
            'style'     => 'normal'
            ),
		'200italic' => array(
            'weight'    => '200',
            'style'     => 'italic'
            ),
		'300'       => array(
            'weight'    => '300',
            'style'     => 'normal'
            ),
		'300italic' => array(
            'weight'    => '300',
            'style'     => 'italic'
            ),
		'regular'   => array(
            'weight'    => '400',
            'style'     => 'normal'
            ),
		'italic'    => array(
            'weight'    => '400',
            'style'     => 'italic'
            ),
		'500'       => array(
            'weight'    => '500',
            'style'     => 'normal'
            ),
		'500italic' => array(
            'weight'    => '500',
            'style'     => 'italic'
            ),
		'600'       => array(
            'weight'    => '600',
            'style'     => 'normal'
            ),
		'600italic' => array(
            'weight'    => '600',
            'style'     => 'italic'
            ),
		'700'       => array(
            'weight'    => '700',
            'style'     => 'normal'
            ),
		'700italic' => array(
            'weight'    => '700',
            'style'     => 'italic'
            ),
		'800'       => array(
            'weight'    => '800',
            'style'     => 'normal'
            ),
		'800italic' => array(
            'weight'    => '800',
            'style'     => 'italic'
            ),
		'900'       => array(
            'weight'    => '900',
            'style'     => 'normal'
            ),
		'900italic' => array(
            'weight'    => '900',
            'style'     => 'italic'
            ),
	);
    
    if( array_key_exists( $font_variant, $v_array ) ){
        return $v_array[ $font_variant ];
    }
}

/**
 * Function to check if it's a google font
*/
function travel_booking_pro_is_google_font( $font ){
    $return = false;
    $websafe_fonts = travel_booking_pro_get_websafe_font();
    if( $font ){
        if( array_key_exists( $font, $websafe_fonts ) ){
            //Web Safe Font
            $return = false;
        }else{
            //Google Font
            $return = true;
        }
    }
    return $return; 
}

/**
 * Function to get valid font, weight and style
*/
function travel_booking_pro_get_fonts( $font_family, $font_variant = 'regular' ){
    
    $fonts = array();
    $websafe_fonts = travel_booking_pro_get_websafe_font(); //Web Safe Font
    
    if( $font_family ){
        if( travel_booking_pro_is_google_font( $font_family ) ){
            $fonts['font'] = esc_attr( $font_family ); //Google Font
            if( $font_variant ){
                $weight_style    = travel_booking_pro_get_css_variant( travel_booking_pro_check_varient( $font_family, $font_variant ) );
                $fonts['weight'] = $weight_style['weight'];
                $fonts['style']  = $weight_style['style'];
            }else{
                $fonts['weight'] = '400';
                $fonts['style']  = 'normal';
            }
        }else{
            if( array_key_exists( $font_family, $websafe_fonts ) ){
                $fonts['font'] = $websafe_fonts[ $font_family ]['fonts']; //Web Safe Font
                if( $font_variant ){
                    $weight_style    = travel_booking_pro_get_css_variant( travel_booking_pro_check_varient( $font_family, $font_variant ) );
                    $fonts['weight'] = $weight_style['weight'];
                    $fonts['style']  = $weight_style['style'];
                }else{
                    $fonts['weight'] = '400';
                    $fonts['style']  = 'normal';
                }
            }
        }   
    }else{
        $fonts['font']   = '"Times New Roman", Times, serif';
        $fonts['weight'] = '400';
        $fonts['style']  = 'normal';
    }
    
    return $fonts;
}