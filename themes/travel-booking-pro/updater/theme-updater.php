<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://wptravelengine.com/', // Site where EDD is hosted
		'item_name'      => 'Travel Booking Pro', // Name of theme
		'theme_slug'     => 'travel-booking-pro', // Theme slug
		'version'        => '2.0.5', // The current version of this theme
		'author'         => 'WP Travel Engine', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'travel-booking-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'travel-booking-pro' ),
		'license-key'               => __( 'License Key', 'travel-booking-pro' ),
		'license-action'            => __( 'License Action', 'travel-booking-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'travel-booking-pro' ),
		'activate-license'          => __( 'Activate License', 'travel-booking-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'travel-booking-pro' ),
		'renew'                     => __( 'Renew?', 'travel-booking-pro' ),
		'unlimited'                 => __( 'unlimited', 'travel-booking-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'travel-booking-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'travel-booking-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'travel-booking-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'travel-booking-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'travel-booking-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'travel-booking-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'travel-booking-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'travel-booking-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'travel-booking-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'travel-booking-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'travel-booking-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'travel-booking-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'travel-booking-pro' ),
	)

);
