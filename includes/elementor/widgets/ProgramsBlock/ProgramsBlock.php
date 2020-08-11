<?php
namespace Zen\Elementor\Widgets\ProgramsBlock;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Frontend;


class ProgramsBlock extends Widget_Base {

    public function __construct($data = [], $args = null) {

        parent::__construct($data, $args);
        wp_register_script('programs-script', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ProgramsBlock/assets/js/base-script.js', '', '1', true);
        wp_register_style('programs-style', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ProgramsBlock/assets/css/base-main.css', '', 1);
    }

    public function get_script_depends() {
        return ['programs-script', 'swiper'];
    }

    public function get_style_depends() {
        return ['programs-style'];
    }

	public function get_name() {
		return 'program_block';
	}


	public function get_title() {
		return __( 'Zen Programs Block', 'elementor' );
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


//        $repeater = new Repeater();
//
//
//        $repeater->add_control(
//            'slider_title',
//            [
//                'label' => __( 'Slider Title', 'elementor' ),
//                'type' => Controls_Manager::TEXT,
//                'label_block' => true,
//                'placeholder' => __( '', 'elementor' ),
//                'default' => __( '', 'elementor' ),
//                'description' => __( 'Leave it empty if default', 'elementor' ),
//                'dynamic' => [
//                    'active' => true,
//                ],
//            ]
//        );
//
//        $repeater->add_control(
//            'title',
//            [
//                'label' => __( 'Title', 'elementor' ),
//                'type' => Controls_Manager::TEXT,
//                'label_block' => true,
//                'placeholder' => __( '', 'elementor' ),
//                'default' => __( '', 'elementor' ),
//                'description' => __( 'Leave it empty if default', 'elementor' ),
//                'dynamic' => [
//                    'active' => true,
//                ],
//            ]
//        );
//
//        $repeater->add_control(
//            'description',
//            [
//                'label' => __( 'Description', 'elementor' ),
//                'type' => \Elementor\Controls_Manager::WYSIWYG,
//                'label_block' => true,
//                'placeholder' => __( '', 'elementor' ),
//                'default' => __( '', 'elementor' ),
//                'description' => __( 'Leave it empty if default', 'elementor' ),
//                'dynamic' => [
//                    'active' => true,
//                ],
//            ]
//        );
//
//        $repeater->add_control(
//            'image',
//            [
//                'label' => __( 'Choose Image', 'elementor' ),
//                'type' => Controls_Manager::MEDIA,
//                'dynamic' => [
//                    'active' => true,
//                ],
//                'default' => [
//                    'url' => Utils::get_placeholder_image_src(),
//                ],
//            ]
//        );

//        $this->add_control(
//            'program_data',
//            [
//                'label' => '',
//                'type' => Controls_Manager::REPEATER,
//                'fields' => $repeater->get_controls(),
////                'default' => [
////                    [
////                        'label' => __( '', 'elementor' ),
////                        'agent_meta_key' => 'agent_company_name',
////                    ],
////                    [
////                        'label' => __( '', 'elementor' ),
////                        'agent_meta_key' => 'agent_mobile',
////                    ],
////                    [
////                        'label' => __( '', 'elementor' ),
////                        'agent_meta_key' => 'agent_email',
////                    ],
////                    [
////                        'label' => __( '', 'elementor' ),
////                        'agent_meta_key' => 'agent_service_areas',
////                    ],
////
////                ],
//                'title_field' => '{{{ title }}}',
//            ]
//        );




//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            [
//                'label' => __( 'Slider Title typography', 'elementor-pro' ),
//                'name' => 'program_slider_title_typography',
//                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
//                'selector' => '{{WRAPPER}} .zen-programs__dot-text',
//            ]
//        );
//
//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            [
//                'label' => __( 'Title typography', 'elementor-pro' ),
//                'name' => 'program_title_typography',
//                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
//                'selector' => '{{WRAPPER}} .zen-programs__content-title',
//            ]
//        );
//
//
//
//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            [
//                'label' => __( 'Description typography', 'elementor-pro' ),
//                'name' => 'text_typography',
//                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
//                'selector' => '{{WRAPPER}} .zen-programs__content',
//            ]
//        );
//
//
//
//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            [
//                'label' => __( 'Button typography', 'elementor-pro' ),
//                'name' => 'button_typography',
//                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
//                'selector' => '{{WRAPPER}} .zen-programs__btn',
//            ]
//        );
//
//        $this->add_control(
//            'button_text',
//            [
//                'label' => __( 'Button text', 'elementor' ),
//                'type' => Controls_Manager::TEXTAREA,
//                'dynamic' => [
//                    'active' => true,
//                ],
//                'default' => __( 'Read More', 'elementor' ),
//                'label_block' => true,
//            ]
//        );
//
//        $this->add_control(
//            'link',
//            [
//                'label' => __( 'Link', 'elementor' ),
//                'type' => Controls_Manager::URL,
//                'dynamic' => [
//                    'active' => true,
//                ],
//                'placeholder' => __( 'https://your-link.com', 'elementor' ),
//                'default' => [
//                    'url' => '#',
//                ],
//            ]
//        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_active_settings();
//        $program_data = $settings[ 'program_data' ];

        $args = array(
            'post_type' => 'zen_programs',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );

        $posts = get_posts( $args );


        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
            $this->add_render_attribute( 'link', 'class', 'zen-programs__btn' );
        }
        ?>
        <div class="zen-programs">
            <div class="swiper-button-next swiper-button"></div>
            <div class="swiper-button-prev swiper-button"></div>

            <div class="swiper-container gallery-thumbs">
                <div class="swiper-wrapper">
                    <?php foreach( $posts as $post ) { ?>
                        <div class="swiper-slide">
                            <span class="zen-programs__dot-text">
                                <?php echo esc_html( $post->post_title ); ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="swiper-container gallery-main">
                <div class="swiper-wrapper">
                    <?php foreach( $posts as $post ) { ?>
                        <div class="swiper-slide">
                            <?php echo Plugin::instance()->frontend->get_builder_content_for_display($post->ID); ?>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
	}
}
