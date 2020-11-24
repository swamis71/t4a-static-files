<?php
/**
 * Customizer Typography Control
 *
 * Taken from Kirki.
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Travel_Booking_Pro_Typography_Control' ) ) {
    
    class Travel_Booking_Pro_Typography_Control extends WP_Customize_Control {
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'travel-booking-pro-typography-control/il8n/strings', array(
    			'on'                 => esc_attr__( 'ON', 'travel-booking-pro' ),
    			'off'                => esc_attr__( 'OFF', 'travel-booking-pro' ),
    			'all'                => esc_attr__( 'All', 'travel-booking-pro' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'travel-booking-pro' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'travel-booking-pro' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'travel-booking-pro' ),
    			'greek'              => esc_attr__( 'Greek', 'travel-booking-pro' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'travel-booking-pro' ),
    			'khmer'              => esc_attr__( 'Khmer', 'travel-booking-pro' ),
    			'latin'              => esc_attr__( 'Latin', 'travel-booking-pro' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'travel-booking-pro' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'travel-booking-pro' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'travel-booking-pro' ),
    			'arabic'             => esc_attr__( 'Arabic', 'travel-booking-pro' ),
    			'bengali'            => esc_attr__( 'Bengali', 'travel-booking-pro' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'travel-booking-pro' ),
    			'tamil'              => esc_attr__( 'Tamil', 'travel-booking-pro' ),
    			'telugu'             => esc_attr__( 'Telugu', 'travel-booking-pro' ),
    			'thai'               => esc_attr__( 'Thai', 'travel-booking-pro' ),
    			'serif'              => esc_attr_x( 'Serif', 'font style', 'travel-booking-pro' ),
    			'sans-serif'         => esc_attr_x( 'Sans Serif', 'font style', 'travel-booking-pro' ),
    			'monospace'          => esc_attr_x( 'Monospace', 'font style', 'travel-booking-pro' ),
    			'font-family'        => esc_attr__( 'Font Family', 'travel-booking-pro' ),
    			'font-size'          => esc_attr__( 'Font Size', 'travel-booking-pro' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'travel-booking-pro' ),
    			'line-height'        => esc_attr__( 'Line Height', 'travel-booking-pro' ),
    			'font-style'         => esc_attr__( 'Font Style', 'travel-booking-pro' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'travel-booking-pro' ),
    			'text-align'         => esc_attr__( 'Text Align', 'travel-booking-pro' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'travel-booking-pro' ),
    			'none'               => esc_attr__( 'None', 'travel-booking-pro' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'travel-booking-pro' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'travel-booking-pro' ),
    			'top'                => esc_attr__( 'Top', 'travel-booking-pro' ),
    			'bottom'             => esc_attr__( 'Bottom', 'travel-booking-pro' ),
    			'left'               => esc_attr__( 'Left', 'travel-booking-pro' ),
    			'right'              => esc_attr__( 'Right', 'travel-booking-pro' ),
    			'center'             => esc_attr__( 'Center', 'travel-booking-pro' ),
    			'justify'            => esc_attr__( 'Justify', 'travel-booking-pro' ),
    			'color'              => esc_attr__( 'Color', 'travel-booking-pro' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'travel-booking-pro' ),
    			'variant'            => esc_attr__( 'Variant', 'travel-booking-pro' ),
    			'style'              => esc_attr__( 'Style', 'travel-booking-pro' ),
    			'size'               => esc_attr__( 'Size', 'travel-booking-pro' ),
    			'height'             => esc_attr__( 'Height', 'travel-booking-pro' ),
    			'spacing'            => esc_attr__( 'Spacing', 'travel-booking-pro' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'travel-booking-pro' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'travel-booking-pro' ),
    			'light'              => esc_attr__( 'Light 200', 'travel-booking-pro' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'travel-booking-pro' ),
    			'book'               => esc_attr__( 'Book 300', 'travel-booking-pro' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'travel-booking-pro' ),
    			'regular'            => esc_attr__( 'Normal 400', 'travel-booking-pro' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'travel-booking-pro' ),
    			'medium'             => esc_attr__( 'Medium 500', 'travel-booking-pro' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'travel-booking-pro' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'travel-booking-pro' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'travel-booking-pro' ),
    			'bold'               => esc_attr__( 'Bold 700', 'travel-booking-pro' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'travel-booking-pro' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'travel-booking-pro' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'travel-booking-pro' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'travel-booking-pro' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'travel-booking-pro' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'travel-booking-pro' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'travel-booking-pro-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            /*
    		 * JavaScript
    		 */
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		
    		// Selectize
    		wp_enqueue_script( 'travel-booking-pro-selectize', get_template_directory_uri() . '/inc/custom-controls/select/selectize.js', array( 'jquery' ), false, true );
    
    		// Typography
    		wp_enqueue_script( 'travel-booking-pro-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array(
    			'jquery',
    			'travel-booking-pro-selectize'
    		), false, true );
    
    		$google_fonts   = Travel_Booking_Pro_Fonts::get_google_fonts();
    		$standard_fonts = Travel_Booking_Pro_Fonts::get_standard_fonts();
    		$all_variants   = Travel_Booking_Pro_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'travel-booking-pro-typography', 'travel_booking_pro_all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template() { ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="travel-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant travel-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="travel-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}
    
    }
}