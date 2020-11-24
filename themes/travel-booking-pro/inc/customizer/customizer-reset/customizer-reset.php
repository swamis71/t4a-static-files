<?php
/**
 * Reset Setting of all customizer options.
 * 
 * @package Travel_Booking_Pro
*/

if ( ! class_exists( 'Travel_Booking_Pro_Customizer_Reset' ) ) {

    final class Travel_Booking_Pro_Customizer_Reset {

		private static $instance = null;

		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			add_action( 'customize_controls_print_scripts', array( $this, 'customize_controls_print_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		public function customize_controls_print_scripts() {
			custom_enqueue_script( 'travel-booking-pro-customizer-reset', get_template_directory_uri() . '/inc/customizer/customizer-reset/js/customizer-reset.js', array( 'jquery' ), '20171201' );
			wp_localize_script( 'travel-booking-pro-customizer-reset', 'CustomizerReset', array(
				'reset'   => __( 'Reset', 'travel-booking-pro' ),
				'confirm' => __( "Attention! This will remove all customizations ever made via customizer to this theme!\n\nThis action is irreversible!", 'travel-booking-pro' ),
				'nonce'   => array(
					'reset' => wp_create_nonce( 'customizer-reset' ),
				)
			) );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			$this->reset_customizer();

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}
Travel_Booking_Pro_Customizer_Reset::get_instance();