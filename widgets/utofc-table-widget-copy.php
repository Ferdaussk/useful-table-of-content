<?php
namespace utofc_lottie_namespace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class UTOFC_Effective_widgets extends Widget_Base {

	public function get_name() {
		return esc_html__( 'UsefulTableOfContent', 'useful-table-of-content' );
	}

	public function get_title() {
		return esc_html__( 'Useful Table of Content', 'useful-table-of-content' );
	}

	public function get_icon() {
		return 'utofc-effective-icon eicon-table-of-contents';
	}

	public function get_categories() {
		return [ 'bwdthebest_general_category' ];
	}

	public function get_keywords() {
		return ['table of content', 'table', 'toc'];
	}

	protected function register_controls() {
	$this->start_controls_section(
		'table_content_option_section',
		[
			'label' => esc_html__( 'Layout', 'useful-table-of-content' ),
			'tab' => Controls_Manager::TAB_CONTENT,
		]
	);
	$this->add_control(
		'Style',
		[
			'label' => esc_html__( 'Style', 'useful-table-of-content' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'style-2',
			'options' => [
				'style-1' => esc_html__( 'None', 'useful-table-of-content' ),
				'none'  => esc_html__( 'Number', 'useful-table-of-content' ),
				'style-2' => esc_html__( 'Line', 'useful-table-of-content' ),
			],
		]
	);
	$this->add_control(
		'typeList',
		[
			'label' => esc_html__( 'Type of List', 'useful-table-of-content' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'OL',
			'options' => [
				'UL'  => esc_html__( 'UL', 'useful-table-of-content' ),
				'OL' => esc_html__( 'OL', 'useful-table-of-content' ),
			],
			'condition' => [
				'Style' => 'none',
			],
		]
	);		
	$this->add_control(
		'selectorHeading',
		[
			'label' => __( 'Select Tags', 'useful-table-of-content' ),
			'type' => Controls_Manager::SELECT2,
			'multiple' => true,
			'options' => [
				'h1'  => __( 'H1', 'useful-table-of-content' ),
				'h2' => __( 'H2', 'useful-table-of-content' ),
				'h3' => __( 'H3', 'useful-table-of-content' ),
				'h4' => __( 'H4', 'useful-table-of-content' ),
				'h5' => __( 'H5', 'useful-table-of-content' ),
				'h6' => __( 'H6', 'useful-table-of-content' ),
			],
			'default' => [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ],
			'separator' => 'before',
			'label_block' => true,
		]
	);
	$this->end_controls_section();	

	$this->start_controls_section(
		'table_content_section',
		[
			'label' => esc_html__( 'Content', 'useful-table-of-content' ),
			'tab' => Controls_Manager::TAB_CONTENT,
		]
	);
	$this->add_control(
		'showText',
		[
			'label' => esc_html__( 'Content', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'yes',				
		]
	);
	$this->add_control(
		'contentText',
		[
			'label' => esc_html__( 'Title', 'useful-table-of-content' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Table Of Content', 'useful-table-of-content' ),
			'placeholder' => esc_html__( 'Enter Title', 'useful-table-of-content' ),	
			'label_block' => true,
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->add_control(
		'TableDescText',
		[   
			'label' => esc_html__( 'Description', 'useful-table-of-content' ),
			'type' => Controls_Manager::WYSIWYG,
			'default' => '',
			'placeholder' => esc_html__( 'Enter Description', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
			],
			'separator' => 'before',
		]
	);
	$this->add_control(
		'showIcon',
		[
			'label' => esc_html__( 'Icon', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'no',
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
			],	
		]
	);
	$this->add_control(
		'PrefixIcon',
		[
			'label' => esc_html__( 'Select Icon', 'useful-table-of-content' ),
			'type' => Controls_Manager::ICONS,			
			'default' => [
				'value' => 'fa fa-exclamation-circle',
				'library' => 'solid',
			],
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
		]
	);		
	$this->end_controls_section();
	
	$this->start_controls_section(
		'table_extra_option_section',
		[
			'label' => esc_html__( 'Extra Settings', 'useful-table-of-content' ),
			'tab' => Controls_Manager::TAB_CONTENT,
		]
	);
	$this->add_control(
		'ToggleIcon',
		[
			'label' => esc_html__( 'Toggle', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'no',
			'condition' => [
				'showText' => 'yes',
			],	
		]
	);
	$this->add_responsive_control(
		'DefaultToggle',
		[
			'label' => esc_html__( 'Default On', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'yes',
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],	
		]
	);
	$this->start_controls_tabs( 'toggle_open_close' );
	$this->start_controls_tab(
		'Ticon_opn',
		[
			'label' => esc_html__( 'Open', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);	
	$this->add_control(
		'openIcon',
		[
			'label' => esc_html__( 'Select Open Icon', 'useful-table-of-content' ),
			'type' => Controls_Manager::ICONS,			
			'default' => [
				'value' => 'fas fa-angle-up',
				'library' => 'solid',
			],
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Ticon_close',
		[
			'label' => esc_html__( 'Close', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);
	$this->add_control(
		'closeIcon',
		[
			'label' => esc_html__( 'Select Close Icon', 'useful-table-of-content' ),
			'type' => Controls_Manager::ICONS,			
			'default' => [
				'value' => 'fas fa-angle-down',
				'library' => 'solid',
			],
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);		
		$this->end_controls_tab();
		$this->end_controls_tabs();        
	$this->add_control(
		'smoothScroll',
		[
			'label' => esc_html__( 'Smooth Scroll', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'no',
		]
	);
	$this->add_responsive_control(
		'smoothDuration',
		[
			'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Smooth Duration', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 420,
			],
			'render_type' => 'ui',
			'condition' => [
				'smoothScroll' => 'yes',
			],	
		]
	);
	$this->add_responsive_control(
		'scrollOffset',
		[
			'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Scroll Offset', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'smoothScroll' => 'yes',
			],
					]
			);
			$this->add_control(
		'fixedPosition',
		[
			'label' => esc_html__( 'Fixed', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'no',
		]
	);
	$this->add_responsive_control(
		'fixedOffset',
		[
			'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Fixed Offset', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'fixedPosition' => 'yes',
			],
		]
	);
	$this->add_control(
		'contentSelector',
		[
			'label' => esc_html__( 'Exclude', 'useful-table-of-content' ),
			'type' => Controls_Manager::TEXT,
			'default' => '',
			'dynamic' => [
				'active' => true,
			],
			'description' => esc_html__( 'Add a class which content you want to exclude from here.', 'useful-table-of-content' ),
			'label_block' => true,
		]
	);
	$this->end_controls_section();

	$this->start_controls_section(
		'table_heading_textbg_styling',
		[
			'label' => esc_html__('Heading', 'useful-table-of-content'),
			'tab' => Controls_Manager::TAB_STYLE,
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->add_responsive_control(
		'TextMargin',
		[
			'label'      => esc_html__( 'Margin', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px','em'],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],	
			'condition' => [
				'showText' => 'yes',
			],			
		]
	);
	$this->add_responsive_control(
		'TextPadding',
		[
			'label'      => esc_html__( 'Padding', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px','em'],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],	
			'condition' => [
				'showText' => 'yes',
			],			
		]
	);
	$this->add_control(
		'tct_HeadOPt',
		[
			'label' => esc_html__( 'Heading Option ', 'useful-table-of-content' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
			$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'TextTypo',
			'label' => esc_html__('Typography', 'useful-table-of-content'),
			'scheme' => Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading',
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
			$this->start_controls_tabs( 'table_textbg_color' );
	$this->start_controls_tab(
		'Nml_Textbg_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->add_control(
		'TextNormalColor',
		[
			'label' => esc_html__( 'Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading' => 'color: {{VALUE}};',
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading svg' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_Textbg_color',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->add_control(
		'TextHoverColor',
		[
			'label' => esc_html__( 'Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading' => 'color: {{VALUE}};',
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading svg' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();
	$this->add_control(
		'tct_DescOPt',
		[
			'label' => esc_html__( 'Description Option ', 'useful-table-of-content' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],
		]
	);	
	 $this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'DescTextTypo',
							'label' => esc_html__('Typography', 'useful-table-of-content'),
			'scheme' => Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading .utofc-table-desc',
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],	
		]
	);
			$this->start_controls_tabs( 'table_desctext_color' );
	$this->start_controls_tab(
		'Nml_Desctext_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],
		]
	);
	$this->add_control(
		'DescTextNormalColor',
		[
			'label' => esc_html__( 'Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading .utofc-table-desc' => 'color: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_Desctext_color',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],
		]
	);
	$this->add_control(
		'DescTextHoverColor',
		[
			'label' => esc_html__( 'Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'condition' => [
				'showText' => 'yes',
				'TableDescText!' => '',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading .utofc-table-desc' => 'color: {{VALUE}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();	
	$this->add_control(
		'tct_IcnOPt',
		[
			'label' => esc_html__( 'Icon Option ', 'useful-table-of-content' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
		]
	);
	$this->add_responsive_control(
					'IconSize',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Icon Size', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],				
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-heading .table-prefix-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .utofc-toc-heading .table-prefix-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
			],
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
					]
			);
			$this->start_controls_tabs( 'table_icon_color' );
	$this->start_controls_tab(
		'Nml_Icon_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
		]
	);
	$this->add_control(
		'IconNormalColor',
		[
			'label' => esc_html__( 'Icon Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-heading .table-prefix-icon i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .utofc-toc-heading .table-prefix-icon svg' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],	
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_Icon_color',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
		]
	);
	$this->add_control(
		'IconHoverColor',
		[
			'label' => esc_html__( 'Icon Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'condition' => [
				'showText' => 'yes',
				'showIcon' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading .table-prefix-icon i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading .table-prefix-icon svg' => 'fill: {{VALUE}};',
			],	
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();	
	$this->add_control(
		'tct_TgIcnOPt',
		[
			'label' => esc_html__( 'Toggle Icon Option ', 'useful-table-of-content' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);
	$this->add_responsive_control(
					'ToggleIconSize',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Icon Size', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],				
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
			],
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
					]
			);
			$this->start_controls_tabs( 'table_toggleicon_color' );
	$this->start_controls_tab(
		'Nml_TglIcon_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);
	$this->add_control(
		'ToggleIconNormalColor',
		[
			'label' => esc_html__( 'Icon Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon svg' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],	
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_TglIcon_color',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],
		]
	);
	$this->add_control(
		'ToggleIconHoverColor',
		[
			'label' => esc_html__( 'Icon Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .table-toggle-wrap.utofc-toc-wrap:hover .table-toggle-icon i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .table-toggle-wrap.utofc-toc-wrap:hover .table-toggle-icon svg' => 'fill: {{VALUE}};',
			],
			'condition' => [
				'showText' => 'yes',
				'ToggleIcon' => 'yes',
			],	
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();	
	$this->add_control(
		'tct_BgOPt',
		[
			'label' => esc_html__( 'Background Option ', 'useful-table-of-content' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'showText' => 'yes',
				],
		]
	);
	$this->start_controls_tabs( 'Nml_hvr_border' );
	$this->start_controls_tab(
		'Nml_Border',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
				],
		]
	);
	$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			 'name' => 'TextBg',
			 'label' => esc_html__( 'Background', 'useful-table-of-content' ),
			 'types' => [ 'classic', 'gradient' ],
			 'selector' => '{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading',
			 'condition' => [
				 'showText' => 'yes',
				],	
		]
	);	
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'TextBorder',
			'label' => esc_html__( 'Border', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading',
			'condition' => [
					'showText' => 'yes',
				],		
		]
		);
	$this->add_responsive_control(
		'TextBorderRadius',
		[
			'label'      => esc_html__( 'Border Radius', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
					'showText' => 'yes',
				],		
		]
	);
	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'TextBoxShadow',
			'label' => esc_html__( 'Box Shadow', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap .utofc-toc-heading',
			'condition' => [
				'showText' => 'yes',
			],	
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_Border',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
			'condition' => [
				'showText' => 'yes',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			 'name' => 'TextBgHover',
			 'label' => esc_html__( 'Background', 'useful-table-of-content' ),
			 'types' => [ 'classic', 'gradient' ],
			 'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading',
			 'condition' => [
					'showText' => 'yes',
				],
		]
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'TextBorderHover',
			'label' => esc_html__( 'Border', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading',
			'condition' => [
					'showText' => 'yes',
				],	
		]
		);
	$this->add_responsive_control(
		'TextBorderRadiusHover',
		[
			'label'      => esc_html__( 'Border Radius', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
					'showText' => 'yes',
				],	
		]
	);
	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'TextBoxShadowHover',
			'label' => esc_html__( 'Box Shadow', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover .utofc-toc-heading',
			'condition' => [
				'showText' => 'yes',
			],
		]
	);	
	$this->end_controls_tab();
	$this->end_controls_tabs();	
			$this->end_controls_section();
			
	$this->start_controls_section(
					'table_content_heading_styling',
					[
							'label' => esc_html__('Content', 'useful-table-of-content'),
							'tab' => Controls_Manager::TAB_STYLE,					
					]
			);
			$this->add_responsive_control(
					'leftOffset',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Left Space', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 20,
			],
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .toc-list,
				{{WRAPPER}} .table-style-2 .toc-list li,
				{{WRAPPER}} .table-style-3 .utofc-toc .toc-list .toc-list li,
				{{WRAPPER}} .table-style-4 .utofc-toc .toc-list .toc-list li' => 'padding-left: {{SIZE}}{{UNIT}}',					
			],
					]
			);
			$this->add_responsive_control(
					'bottomOffset',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Bottom Space', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 10,
			],
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .utofc-table-content .toc-list li,{{WRAPPER}} .utofc-table-content .toc-list li.is-active-li a' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list,{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list.is-collapsible' => 'margin-top: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list .toc-list-item:last-child,
				{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list.is-collapsible .toc-list-item:last-child' => 'margin-bottom: 0 !important;',
				'{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list .toc-list,{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list.is-collapsible .toc-list,{{WRAPPER}} .utofc-toc-wrap .toc-list-item .toc-list.is-collapsible.is-collapsed' => 'margin-top: 0 !important;',
			],
			'condition' => [
				'Style' => ['style-2','style-3','style-4']
			],
					]
			);
			$this->add_responsive_control(
		'contentPadding',
		[
			'label'      => esc_html__( 'Padding', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px','em'],	
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],			
		]
	);
	$this->add_responsive_control(
		'outerMargin',
		[
			'label'      => esc_html__( 'Outer Margin', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px','em' ],
			'condition' => [
				'showText' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],		
		]
	);
			$this->add_responsive_control(
					'Style4Padding',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Child Padding', 'useful-table-of-content'),
			'size_units' => [ 'px','em','%' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 5,
			],
			'render_type' => 'ui',
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'condition' => [
				'Style' => 'style-4',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc > .toc-list > li .toc-list' => 'padding-left: {{SIZE}}{{UNIT}}',
			],
					]
			);
			$this->add_control(
		'TableSetMinHeight',
		[
			'label' => esc_html__( 'Height', 'useful-table-of-content' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'useful-table-of-content' ),
			'label_off' => esc_html__( 'No', 'useful-table-of-content' ),
			'default' => 'yes',
			'separator' => 'before',
		]
	);
	$this->add_responsive_control(
					'TableMinHeight',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Minimum Height', 'useful-table-of-content'),
			'size_units' => [ 'px','em','%' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 5,
			],
			'render_type' => 'ui',				
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'condition' => [
				'TableSetMinHeight' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc' => 'min-height: {{SIZE}}{{UNIT}}',
			],
					]
			);
	$this->add_responsive_control(
					'TableMaxHeight',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Maximum Height', 'useful-table-of-content'),
			'size_units' => [ 'px','em','%' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
					'step' => 1,
				],
			],
			'render_type' => 'ui',				
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'condition' => [
				'TableSetMinHeight' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc' => 'max-height: {{SIZE}}{{UNIT}}',
			],
					]
			);
	$this->add_responsive_control(
					'ScrollBarWidth',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('ScrollBar Width', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
					'step' => 1,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 5,
			],
			'render_type' => 'ui',
			
			'condition' => [
				'TableSetMinHeight' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}}',
			],
					]
			);
			$this->add_control(
		'ScrollBarThumb',
		[
			'label' => esc_html__( 'ScrollBar Thumb Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'condition' => [
				'TableSetMinHeight' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc::-webkit-scrollbar-thumb' => 'background-color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'ScrollBarTrack',
		[
			'label' => esc_html__( 'ScrollBar Track Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'condition' => [
				'TableSetMinHeight' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .utofc-toc-wrap .utofc-toc::-webkit-scrollbar-track' => 'background-color: {{VALUE}};',
			],	
		]
	); 
			$this->end_controls_section();
			
			$this->start_controls_section(
					'table_content_styling_section',
					[
							'label' => esc_html__('Content Line', 'useful-table-of-content'),
							'tab' => Controls_Manager::TAB_STYLE,
							'condition' => [
								'Style!' => 'none',
								'typeList' => ['UL','OL'],					
			],
					]
			);
			$this->add_responsive_control(
					'LineWidth',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Line Width', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .table-style-1 .toc-link::before,
				{{WRAPPER}} .table-style-3 .utofc-toc > .toc-list .toc-list li:before,
				{{WRAPPER}} .table-style-4 .utofc-toc > .toc-list .toc-list li:before' => 'width: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .table-style-2 .toc-list li' => 'border-left-width: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .table-style-4 .utofc-toc > .toc-list .toc-list li.is-active-li:before' => 'left: calc({{SIZE}} / 2 * 1px)',
			],	
					]
			);
			$this->add_responsive_control(
					'Line2Width',
					[
							'type' => Controls_Manager::SLIDER,
			'label' => esc_html__('Active Line Width', 'useful-table-of-content'),
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 500,
					'step' => 1,
				],
			],
			'render_type' => 'ui',
			'selectors' => [
				'{{WRAPPER}} .table-style-2 .toc-list li.is-active-li' => 'border-left-width: {{SIZE}}{{UNIT}}',
				'{{WRAPPER}} .table-style-3 .utofc-toc > .toc-list .toc-list li.is-active-li:before,
				{{WRAPPER}} .table-style-4 .utofc-toc > .toc-list .toc-list li.is-active-li:before' => 'width: {{SIZE}}{{UNIT}}',
			],
			'condition' => [
				'Style' => ['style-2','style-3','style-4']
			],	
					]
			);
			$this->start_controls_tabs( 'Nml_Act_color' );
	$this->start_controls_tab(
		'Nml_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
		]
	);
			$this->add_control(
					'LineColor',
					[
							'label' => esc_html__('Line Color', 'useful-table-of-content'),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
				'{{WRAPPER}} .table-style-1 .toc-link::before' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .table-style-2 .toc-list li' => 'border-left-color: {{VALUE}};',
				'{{WRAPPER}} .table-style-3 .utofc-toc > .toc-list .toc-list li:before,
				{{WRAPPER}} .table-style-4 .utofc-toc > .toc-list .toc-list li:before' => 'background: {{VALUE}};',
			],  
					]
			);
			$this->end_controls_tab();
	$this->start_controls_tab(
		'Act_color',
		[
			'label' => esc_html__( 'Active', 'useful-table-of-content' ),
		]
	);
			$this->add_control(
					'LineActiveColor',
					[
							'label' => esc_html__('Line Color', 'useful-table-of-content'),
							'type' => Controls_Manager::COLOR,
							 'selectors' => [
				'{{WRAPPER}} .table-style-1 .toc-link.is-active-link::before' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .table-style-2 .toc-list li.is-active-li' => 'border-left-color: {{VALUE}};',
				'{{WRAPPER}} .table-style-3 .utofc-toc > .toc-list .toc-list li.is-active-li:before,
				{{WRAPPER}} .table-style-4 .utofc-toc > .toc-list .toc-list li.is-active-li:before' => 'background: {{VALUE}};',
			],
					]
			);
			$this->end_controls_tab();
	$this->end_controls_tabs();	
			$this->end_controls_section();
			
			$this->start_controls_section(
					'table_content_L1section_styling',
					[
							'label' => esc_html__('Level 1 Typography', 'useful-table-of-content'),
							'tab' => Controls_Manager::TAB_STYLE,
					]
			);
			$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'Level1Typo',
							'label' => esc_html__('Typography', 'useful-table-of-content'),
			'scheme' => Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .utofc-toc .toc-list > li > a',
		]
	);
			$this->start_controls_tabs( 'table_L1_color' );
	$this->start_controls_tab(
		'Nml_L1_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
		]
	);
	$this->add_control(
		'Level1NormalColor',
		[
			'label' => esc_html__( 'Normal Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc .toc-list > li > a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Act_L1_color',
		[
			'label' => esc_html__( 'Active', 'useful-table-of-content' ),
		]
	);
	$this->add_control(
		'Level1ActiveColor',
		[
			'label' => esc_html__( 'Active Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc .toc-list > li:hover > a, {{WRAPPER}} .utofc-toc > .toc-list > li.is-active-li > a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();		
			$this->end_controls_section();
			
			$this->start_controls_section(
					'table_content_sublevel_styling',
					[
							'label' => esc_html__('Sub-Level Typography', 'useful-table-of-content'),
							'tab' => Controls_Manager::TAB_STYLE,
					]
			);
			$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'LevelSubTypo',
							'label' => esc_html__('Typography', 'useful-table-of-content'),
			'scheme' => Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .utofc-toc .toc-list .toc-list > li > a,
			{{WRAPPER}} .utofc-toc .toc-list .toc-listis-collapsible > li > a',
		]
	);
			$this->start_controls_tabs( 'table_sl_color' );
	$this->start_controls_tab(
		'Nml_Sl_color',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
		]
	);
	$this->add_control(
		'LevelSubNormalColor',
		[
			'label' => esc_html__( 'Normal Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc .toc-list .toc-list > li > a,
			{{WRAPPER}} .utofc-toc .toc-list .toc-listis-collapsible > li > a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Act_Sl_color',
		[
			'label' => esc_html__( 'Active', 'useful-table-of-content' ),
		]
	);
	$this->add_control(
		'LevelSubActiveColor',
		[
			'label' => esc_html__( 'Active Color', 'useful-table-of-content' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .utofc-toc .toc-list .toc-list > li:hover > a, {{WRAPPER}} .utofc-toc .toc-list .toc-list > li.is-active-li > a,{{WRAPPER}} .utofc-toc .toc-list .toc-listis-collapsible > li:hover > a, {{WRAPPER}} .utofc-toc .toc-list .toc-listis-collapsible > li.is-active-li > a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();		
	$this->end_controls_section();
	
	$this->start_controls_section(
		'table_content_boxbg_styling',
		[
			'label' => esc_html__('Box', 'useful-table-of-content'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_responsive_control(
		'boxPadding',
		[
			'label'      => esc_html__( 'Padding', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px','em'],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'after',
		]
	);
	$this->start_controls_tabs( 'Nml_hvr_Boxborder' );
	$this->start_controls_tab(
		'Nml_BoxBorder',
		[
			'label' => esc_html__( 'Normal', 'useful-table-of-content' ),
		]
	);
	$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			 'name' => 'boxBg',
			 'label' => esc_html__( 'Background', 'useful-table-of-content' ),
			 'types' => [ 'classic', 'gradient' ],
			 'selector' => '{{WRAPPER}} .utofc-toc-wrap',
		]
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'boxBorder',
			'label' => esc_html__( 'Border', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap',
		]
		);
	$this->add_responsive_control(
		'boxBorderRadius',
		[
			'label'      => esc_html__( 'Border Radius', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'boxBoxShadow',
			'label' => esc_html__( 'Box Shadow', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap',
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab(
		'Hvr_BoxBorder',
		[
			'label' => esc_html__( 'Hover', 'useful-table-of-content' ),
		]
	);
	$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			 'name' => 'boxBgHover',
			 'label' => esc_html__( 'Background', 'useful-table-of-content' ),
			 'types' => [ 'classic', 'gradient' ],
			 'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover',
		]
	);	
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'boxBorderHover',
			'label' => esc_html__( 'Border', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover',
		]
		);
	$this->add_responsive_control(
		'boxBorderRadiusHover',
		[
			'label'      => esc_html__( 'Border Radius', 'useful-table-of-content' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .utofc-toc-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'boxBoxShadowHover',
			'label' => esc_html__( 'Box Shadow', 'useful-table-of-content' ),
			'selector' => '{{WRAPPER}} .utofc-toc-wrap:hover',
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();
			$this->end_controls_section();
}
// It's elementor table of content. here should show only h1, h2, h3, h4, h5, h6 and p tag's conent but why i can see others content? please fixed the problem
	protected function render() {
	$settings = $this->get_settings_for_display();
	$uid_tblcontent=uniqid("utofc-tbl");
	$Style = (!empty($settings["Style"])) ? $settings["Style"] : 'none';
	$ToggleIcon = (!empty($settings["ToggleIcon"])) ? $settings["ToggleIcon"] : false;
	$TableDescText = (!empty($settings["TableDescText"])) ? $settings["TableDescText"] : '';
	$PrefixIcon = (!empty($settings["PrefixIcon"])) ? $settings["PrefixIcon"] : '';
	$DefaultToggle['md'] = (!empty($settings["DefaultToggle"]) && $settings["DefaultToggle"]=='yes') ? true : false;
		$DefaultToggle['sm'] = (!empty($settings["DefaultToggle_tablet"]) && $settings["DefaultToggle_tablet"]=='yes') ? true : false;
	$DefaultToggle['xs'] = (!empty($settings["DefaultToggle_mobile"]) && $settings["DefaultToggle_mobile"]=='yes') ? true : false;
			
	$option = [];
	$option['tocSelector'] = '.utofc-toc';
	$option['contentSelector'] = (!empty($settings["contentSelector"])) ? $settings["contentSelector"] : '.elementor-page';
	$option['headingSelector']= (is_array($settings["selectorHeading"])) ? implode(',', $settings["selectorHeading"]) : $settings["selectorHeading"];

	$option['scrollSmooth'] = (!empty($settings['smoothScroll'])) ? true : false;
	$option['scrollSmoothDuration'] = (!empty($settings['smoothDuration']['size'])) ? (int)$settings['smoothDuration']['size'] : 420;
	$option['scrollSmoothOffset'] = (!empty($settings['scrollOffset']['size'])) ? (int)$settings['scrollOffset']['size'] : 0;
	$option['orderedList'] = (!empty($settings['typeList']) && $settings['typeList']==='OL') ? true : false;
	$option['positionFixedSelector'] = null;
	if(!empty($settings['fixedPosition']) && $settings['fixedPosition']=='yes'){
		$option['positionFixedSelector'] = '.utofc-table-content';
	}
	$option['fixedSidebarOffset'] = (!empty($settings['fixedPosition']) && !empty($settings['fixedOffset']['size'])) ? (int)$settings['fixedOffset']['size'] : 'auto';	
	$option['hasInnerContainers'] = true;
	$openIcon=$closeIcon='';
	if(!empty($settings["openIcon"])){
		ob_start();
		\Elementor\Icons_Manager::render_icon($settings["openIcon"], [ 'aria-hidden' => 'true' ]);
		$openIcon = ob_get_contents();
		ob_end_clean();						
	}
	if(!empty($settings["closeIcon"])){
		ob_start();
		\Elementor\Icons_Manager::render_icon($settings["closeIcon"], [ 'aria-hidden' => 'true' ]);
		$closeIcon = ob_get_contents();
		ob_end_clean();						
	}
	$toggleClass=$toggleAttr='';
	if(!empty($ToggleIcon) && $ToggleIcon=='yes'){
		$toggleClass = 'table-toggle-wrap';	
			$toggleAttr .=' data-open="'.esc_html($openIcon).'"';
			$toggleAttr .=' data-close="'.esc_html($closeIcon).'"'; 
		$toggleAttr .=' data-default-toggle="'.htmlspecialchars(json_encode($DefaultToggle), ENT_QUOTES, 'UTF-8').'"';
	}
	$toggleActive=' active';
	if(!empty($settings["PrefixIcon"])){
		ob_start();
		\Elementor\Icons_Manager::render_icon($settings["PrefixIcon"], [ 'aria-hidden' => 'true' ]);
		 $PrefixIcon = ob_get_contents();
		ob_end_clean();						
	}
		$output = '<div class="utofc-table-content utofc-widget-'.esc_attr($uid_tblcontent).' table-'.esc_attr($Style).'" data-settings="'.htmlspecialchars(json_encode($option), ENT_QUOTES, 'UTF-8').'" >';
		$lz2 = function_exists('utofc_has_lazyload') ? sk_bg_lazyLoad($settings['boxBg_image'],$settings['boxBgHover_image']) : '';
		$output .= '<div class="utofc-toc-wrap '.esc_attr($toggleClass).$toggleActive.' '.esc_attr($lz2).'" '.$toggleAttr.' >';
					if((!empty($settings['showText']) && $settings['showText']=='yes') && !empty($settings['contentText']) ) {
				$table_desc='';
				if(!empty($TableDescText)){
					$table_desc= '<div class="utofc-table-desc">'.$TableDescText.'</div>';
				}	
				$Icon = ((!empty($settings['showIcon']) && $settings['showIcon']=='yes') && !empty($PrefixIcon)) ? $PrefixIcon : '';
				
				$lz1 = function_exists('utofc_has_lazyload') ? sk_bg_lazyLoad($settings['TextBg_image'],$settings['TextBgHover_image']) : '';
				$output .= '<div class="utofc-toc-heading '.esc_attr($lz1).'"><span class="table-prefix-icon">'. $Icon .'<span>'. $settings['contentText'] .$table_desc.'</span></span>';
				if(!empty($ToggleIcon) && $ToggleIcon=='yes'){
						if((!empty($settings["DefaultToggle"]) && $settings["DefaultToggle"]=='yes')){
						$output .= '<span class="table-toggle-icon">'.$openIcon.'</span>';
						}else{
							$output .= '<span class="table-toggle-icon">'.$closeIcon.'</span>';
						}
					}
					$output .= '</div>';
				}
				$output .= 'Ferdaus sk01';
				$output .= '<div class="utofc-toc toc"></div>';
		$output .= '</div>';
			$output .= '</div>';
			echo $output; 
	}

}