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
	//$my_theme = wp_get_theme();
	$config = array(
		'remote_api_url' => 'https://premiumcoding.com/', // Site where EDD is hosted
		'item_name' => 'marketeer-lite', // Name of theme
		'theme_slug' => 'marketeer-lite', // Theme slug
		'version' => wp_get_theme()->get( 'Version' ), // The current version of this theme
		'author' => 'PremiumCoding', // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'marketeer-lite' ),
		'enter-key' => __( 'Enter your theme license key.', 'marketeer-lite' ),
		'license-key' => __( 'License Key', 'marketeer-lite' ),
		'license-action' => __( 'License Action', 'marketeer-lite' ),
		'deactivate-license' => __( 'Deactivate License', 'marketeer-lite' ),
		'activate-license' => __( 'Activate License', 'marketeer-lite' ),
		'status-unknown' => __( 'License status is unknown.', 'marketeer-lite' ),
		'renew' => __( 'Renew?', 'marketeer-lite' ),
		'unlimited' => __( 'unlimited', 'marketeer-lite' ),
		'license-key-is-active' => __( 'License key is active.', 'marketeer-lite' ),
		'expires%s' => __( 'Expires %s.', 'marketeer-lite' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'marketeer-lite' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'marketeer-lite' ),
		'license-key-expired' => __( 'License key has expired.', 'marketeer-lite' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'marketeer-lite' ),
		'license-is-inactive' => __( 'License is inactive.', 'marketeer-lite' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'marketeer-lite' ),
		'site-is-inactive' => __( 'Site is inactive.', 'marketeer-lite' ),
		'license-status-unknown' => __( 'License status is unknown.', 'marketeer-lite' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'marketeer-lite' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'marketeer-lite' )
	)

);