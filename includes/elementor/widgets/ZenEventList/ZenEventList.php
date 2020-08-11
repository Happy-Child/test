<?php
namespace Zen\Elementor\Widgets\ZenEventList;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Controls_Manager;


class ZenEventList extends Widget_Base {

    public function __construct($data = [], $args = null) {

        parent::__construct($data, $args);
        wp_register_script('zen-event-script', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ZenEventList/assets/js/base-script.js', '', '1', true);
        wp_register_style('zen-event-style', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ZenEventList/assets/css/base-main.css', '', 1);
    }

    public function get_script_depends() {
        return ['zen-event-script', 'swiper'];
    }

    public function get_style_depends() {
        return ['zen-event-style'];
    }

	public function get_name() {
		return 'zen_event_list';
	}


	public function get_title() {
		return __( 'Zen Event List', 'elementor' );
	}


	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box', 'elementor' ),
			]
		);



		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_active_settings();

        $args = array(
            'post_type' => 'tribe_events',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );

        $posts = get_posts( $args );

        foreach ($posts as $post) {
			$start_date =  tribe_get_start_time ( $post->ID, 'l, F jS H:i A');
			$end_date = tribe_get_end_time ( $post->ID, 'l, F jS H:i A');
			$image =  tribe_event_featured_image($post->ID);
			$link =  tribe_get_event_link( $post->ID );


        }

            ?>

        <div class="zen-event-list">
            <div class="swiper-container zen-event-list__slider">
                <div class="swiper-wrapper">
                    <?php foreach( [1, 2, 3, 4, 5] as $post ) { ?>
                        <div class="swiper-slide">
                            <div class="zen-event-list__inner">
                                <div class="zen-event-list__wrap-img">
                                    <img src="http://zen.redcarlos.pro/wp-content/uploads/elementor/thumbs/donations-ot1eydgm3n3tyknwrta4dpyb5ubr77ia4udvgu1cj6.png" alt="">
                                </div>

                                <a href="#" class="zen-event-list__title">
                                    test title test title test title test title test title test title
                                </a>

                                <div class="zen-event-list__bottom">
                                    <div class="zen-event-list__date">
                                        Monday, March 9
                                    </div>
                                    <div class="zen-event-list__time">
                                        7.30PM - 12.00PM
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <button class='zen-event-list__nav_prev zen-event-list__nav'></button>
            <button class='zen-event-list__nav_next zen-event-list__nav'></button>
        </div>
        <?php
	}
}
