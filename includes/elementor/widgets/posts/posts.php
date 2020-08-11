<?php
namespace Zen\Elementor\Widgets\Zen_Posts;

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include_once ( 'posts-base.php');
include_once ( 'skins/skin-base.php');
include_once ( 'skins/skin1.php');


/**
 * Class Zen_Posts
 */
class Zen_Posts extends Posts_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script('zen-posts-script', get_stylesheet_directory_uri() . '/includes/elementor/widgets/posts/assets/js/base-script.js', '', '1', true);
        wp_register_style('zen-posts-style', get_stylesheet_directory_uri() . '/includes/elementor/widgets/posts/assets/css/base-main.css', '', 1);
    }

    public function get_script_depends() {
        return ['zen-posts-script', 'zen-posts-isotope'];
    }

    public function get_style_depends() {
        return ['zen-posts-style'];
    }

	public function get_name() {
		return 'zen_posts';
	}

	public function get_title() {
		return __( 'Zen Posts', 'elementor-pro' );
	}

	public function get_keywords() {
		return [ 'posts', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type' ];
	}

	public function on_import( $element ) {
		if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
			$element['settings']['posts_post_type'] = 'post';
		}

		return $element;
	}

	protected function _register_skins() {
		$this->add_skin( new Skin1( $this ) );
//		$this->add_skin( new Skin_Classic( $this ) );
//		$this->add_skin( new Skins\Skin_Full_Content( $this ) );
	}

	protected function _register_controls() {
		parent::_register_controls();

		$this->register_query_section_controls();
		$this->register_pagination_section_controls();
	}

	public function query_posts() {

		$query_args = [
			'posts_per_page' => $this->get_current_skin()->get_instance_value( 'posts_per_page' ),
			'paged' => $this->get_current_page(),
		];

		/** @var Module_Query $elementor_query */
		$elementor_query = Module_Query::instance();
		$this->query = $elementor_query->get_query( $this, 'posts', $query_args, [] );
	}

	protected function register_query_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Related::get_type(),
			[
				'name' => $this->get_name(),
				'presets' => [ 'full' ],
				'exclude' => [
					'posts_per_page', //use the one from Layout section
				],
			]
		);

		$this->end_controls_section();


	}

}
