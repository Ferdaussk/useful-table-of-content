<?php
namespace utofc_lottie_namespace;

use utofc_lottie_namespace\PageSettings\Page_Settings;
define( "UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "UTOFC_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );

class ClassUTOFCeffective {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function utofc_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'utofc_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function utofc_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'utofc_effective_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}
		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/utofc-table-widget.php' );
		// require_once( __DIR__ . '/widgets/utofc-table-widget-copy.php' );
	}

	public function utofc_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register WidgetsF
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\UTOFC_Effective_widgets());
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/utofc-content-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function utofc_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'bwdthebest_general_category',
			[
				'title' => esc_html__( 'BWD General Group', 'useful-table-of-content' ),
				'icon' => 'eicon-person',
			]
		);
	}

	//css-js-link-here
	public function utofc_all_assets_for_the_public(){
		$all_css_file = array(
			'utofc-effective-style-table-of-contents-style' => array('utofc_path_public_define'=>UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/utofc-table-content.css'),
			'utofc-effective-style-table-of-contents-min-style' => array('utofc_path_public_define'=>UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/utofc-table-content.min.css'),
		);
		foreach($all_css_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['utofc_path_public_define'], null, '1.0', 'all');
		}
		$all_js_file = array(
			'utofc-effective-table-of-contents-script' => array('utofc_path_public_define'=>UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/utofc-table-content.js'),
			'utofc-effective-table-of-contents-min' => array('utofc_path_public_define'=>UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/utofc-table-content.min.js'),
			'utofc-effective-table-of-contents-tocbot' => array('utofc_path_public_define'=>UTOFC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/tocbot.min.js'),
		);
		foreach($all_js_file as $handle => $fileinfo){
			wp_enqueue_script( $handle, $fileinfo['utofc_path_public_define'], ['jquery'], '1.0', true);
		}
	}

	//admin-icon
	public function utofc_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
			'utofc_effective_admin_main_css' => array('utofc_path_admin_define'=>UTOFC_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['utofc_path_admin_define'], null, '1.0', 'all');
		}
	}
	
	public function __construct() {
		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'utofc_all_assets_for_the_public']);
		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'utofc_all_assets_for_elementor_editor_admin']);
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'utofc_add_elementor_widget_categories' ] );
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'utofc_register_widgets' ] );
		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'utofc_admin_editor_scripts' ] );
		$this->add_page_settings_controls();
	}
}
// Instantiate Plugin Class
ClassUTOFCeffective::instance();