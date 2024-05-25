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

// For table of content
function sksk01_element_pack_heading_size() {
    $heading_sizes = [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
    ];

    return $heading_sizes;
}
function sksk01_element_pack_position() {
    $position_options = [
        ''              => esc_html__('Default', 'bdthemes-element-pack'),
        'top-left'      => esc_html__('Top Left', 'bdthemes-element-pack'),
        'top-center'    => esc_html__('Top Center', 'bdthemes-element-pack'),
        'top-right'     => esc_html__('Top Right', 'bdthemes-element-pack'),
        'center'        => esc_html__('Center', 'bdthemes-element-pack'),
        'center-left'   => esc_html__('Center Left', 'bdthemes-element-pack'),
        'center-right'  => esc_html__('Center Right', 'bdthemes-element-pack'),
        'bottom-left'   => esc_html__('Bottom Left', 'bdthemes-element-pack'),
        'bottom-center' => esc_html__('Bottom Center', 'bdthemes-element-pack'),
        'bottom-right'  => esc_html__('Bottom Right', 'bdthemes-element-pack'),
    ];

    return $position_options;
}
function sksk01_element_pack_drop_position() {
    $drop_position_options = [
        'bottom-left'    => esc_html__('Bottom Left', 'bdthemes-element-pack'),
        'bottom-center'  => esc_html__('Bottom Center', 'bdthemes-element-pack'),
        'bottom-right'   => esc_html__('Bottom Right', 'bdthemes-element-pack'),
        'bottom-justify' => esc_html__('Bottom Justify', 'bdthemes-element-pack'),
        'top-left'       => esc_html__('Top Left', 'bdthemes-element-pack'),
        'top-center'     => esc_html__('Top Center', 'bdthemes-element-pack'),
        'top-right'      => esc_html__('Top Right', 'bdthemes-element-pack'),
        'top-justify'    => esc_html__('Top Justify', 'bdthemes-element-pack'),
        'left-top'       => esc_html__('Left Top', 'bdthemes-element-pack'),
        'left-center'    => esc_html__('Left Center', 'bdthemes-element-pack'),
        'left-bottom'    => esc_html__('Left Bottom', 'bdthemes-element-pack'),
        'right-top'      => esc_html__('Right Top', 'bdthemes-element-pack'),
        'right-center'   => esc_html__('Right Center', 'bdthemes-element-pack'),
        'right-bottom'   => esc_html__('Right Bottom', 'bdthemes-element-pack'),
    ];

    return $drop_position_options;
}
function sksk01_element_pack_transition_options() {


    $transition_options = [
        ''                    => esc_html__('None', 'bdthemes-element-pack'),
        'fade'                => esc_html__('Fade', 'bdthemes-element-pack'),
        'scale-up'            => esc_html__('Scale Up', 'bdthemes-element-pack'),
        'scale-down'          => esc_html__('Scale Down', 'bdthemes-element-pack'),
        'slide-top'           => esc_html__('Slide Top', 'bdthemes-element-pack'),
        'slide-bottom'        => esc_html__('Slide Bottom', 'bdthemes-element-pack'),
        'slide-left'          => esc_html__('Slide Left', 'bdthemes-element-pack'),
        'slide-right'         => esc_html__('Slide Right', 'bdthemes-element-pack'),
        'slide-top-small'     => esc_html__('Slide Top Small', 'bdthemes-element-pack'),
        'slide-bottom-small'  => esc_html__('Slide Bottom Small', 'bdthemes-element-pack'),
        'slide-left-small'    => esc_html__('Slide Left Small', 'bdthemes-element-pack'),
        'slide-right-small'   => esc_html__('Slide Right Small', 'bdthemes-element-pack'),
        'slide-top-medium'    => esc_html__('Slide Top Medium', 'bdthemes-element-pack'),
        'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'bdthemes-element-pack'),
        'slide-left-medium'   => esc_html__('Slide Left Medium', 'bdthemes-element-pack'),
        'slide-right-medium'  => esc_html__('Slide Right Medium', 'bdthemes-element-pack'),
    ];

    return $transition_options;
}





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