<?php
namespace utofc_lottie_namespace\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'utofc_adlottie_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'utofc_adlottie_register_document_controls' ] );
	}

	public function utofc_adlottie_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Useful Table of Content', 'useful-table-of-content' ) );
	}

	public function utofc_adlottie_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'utofc_new_section',
			[
				'label' => esc_html__( 'Settings', 'useful-table-of-content' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'utofc_text',
			[
				'label' => esc_html__( 'Title', 'useful-table-of-content' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'useful-table-of-content' ),
			]
		);

		$document->end_controls_section();
	}
}
