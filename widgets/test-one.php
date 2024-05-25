<?php
namespace utofc_lottie_namespace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
  $this->end_controls_section();
  }

// 	protected function render() {
//     $settings = $this->get_settings_for_display();
// echo 'Working';
//     // Get the current page URL
//     $url = get_permalink();

//     // Get the HTML content of the current page
//     $html = file_get_contents($url);
// echo $html;
//     // Now, you can use DOMDocument and DOMXPath to extract the table of contents
//     $dom = new \DOMDocument();
//     @$dom->loadHTML($html);

//     $xpath = new \DOMXPath($dom);
//     $links = $xpath->query('//ul[@id="toc"]/li/a');

//     $tableOfContents = array();

//     foreach ($links as $link) {
//         $title = $link->nodeValue;
//         $href = $link->getAttribute('href');
//         $tableOfContents[] = array('title' => $title, 'href' => $href);
//     }

//     // Now you have the table of contents in the $tableOfContents array
//     // You can do further processing or display it as needed
//     // For example, you can use a loop to create HTML elements for the table of contents
//     foreach ($tableOfContents as $item) {
//         echo '<a href="'.$item['href'].'">'.$item['title'].'</a><br>';
//     }
// }
protected function render() {
  $settings = $this->get_settings_for_display();

  $channel_url = 'https://www.youtube.com/channel/UCMo2ZdKFTBhwsCq9GziFUoQ';

  $html = file_get_contents($channel_url);

  // Search for the subscriber count in the HTML content
  preg_match('/"subscriberCountText":{"simpleText":"(.*?)"/', $html, $matches);

  if (isset($matches[1])) {
      $subscriber_count = $matches[1];
      echo "Subscriber Count: " . $subscriber_count;
  } else {
      echo "Unable to fetch subscriber count.";
  }
}

}
// 
// you know it's a elementor widget. so here $url need to get current page