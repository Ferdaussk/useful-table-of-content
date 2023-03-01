<?php
/**
 * Plugin Name: Useful Table of Content
 * Description: Useful Table of Content plugin for Elementor with 20+ responsive and modern lottie designs.
 * Plugin URI:  https://bwdplugins.com/plugins/useful-table-of-content
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: useful-table-of-content
 * Elementor tested up to: 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/utofc-plugin-activition.php';

function utofc_plugin_instance() {
	return \Elementor\Plugin::instance();
}

function sk_bg_lazyLoad($option =[], $option2 =[]){
	return '';
}

final class utofc_swiper_lottie{

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'utofc_init', array( $this, 'utofc_loaded_textdomain' ) );
		// utofc_init Plugin
		add_action( 'plugins_loaded', array( $this, 'utofc_init' ) );
	}

	public function utofc_loaded_textdomain() {
		load_plugin_textdomain( 'useful-table-of-content' );
	}

	public function utofc_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'utofc_addon_failed_load');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'utofc_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'utofc_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'utofc-table-boots.php' );
	}

	public function utofc_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'useful-table-of-content' ),
			'<strong>' . esc_html__( 'Useful Table of Content', 'useful-table-of-content' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'useful-table-of-content' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'useful-table-of-content') . '</p></div>', $message );
	}

	public function utofc_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'useful-table-of-content' ),
			'<strong>' . esc_html__( 'Useful Table of Content', 'useful-table-of-content' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'useful-table-of-content' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'useful-table-of-content') . '</p></div>', $message );
	}
}

// Instantiate lottie.
new utofc_swiper_lottie();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );