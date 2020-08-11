<?php
namespace Zen\Elementor\Widgets\Zen_Info_Block;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Controls_Manager;


class ZenInfoBlock extends Widget_Base {

    public function __construct($data = [], $args = null) {

        parent::__construct($data, $args);
        wp_register_script('zen-info-script', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ZenInfoBlock/assets/js/base-script.js', '', '1', true);
        wp_register_style('zen-info-style', get_stylesheet_directory_uri() . '/includes/elementor/widgets/ZenInfoBlock/assets/css/base-main.css', '', 1);
    }

    public function get_script_depends() {
        return ['zen-info-script'];
    }

    public function get_style_depends() {
        return ['zen-info-style'];
    }

	public function get_name() {
		return 'zen_info_block';
	}


	public function get_title() {
		return __( 'Zen Info Block', 'elementor' );
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

        $this->add_responsive_control (
            'column_gap',
            [
                'label' => __( 'Height', 'elementor-pro' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .zen-info-block__item-inner' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Title typography', 'elementor-pro' ),
                'name' => 'title_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .zen-info-block__item-title',
            ]
        );

        $this->add_control(
            'info_title',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Heading', 'elementor' ),
                'label_block' => true,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Description typography', 'elementor-pro' ),
                'name' => 'text_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .zen-info-block__item-toggle-text',
            ]
        );

        $this->add_control(
            'info_text',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the text', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'info_padding',
            array(
                'label'      => 'Text padding',
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => array(
                    'unit' => 'em',
                ),
                'size_units' => array( 'px', 'em', '%' ),
                'selectors'  => array(
                    "{{WRAPPER}} .zen-info-block__item-toggle-text" =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Button typography', 'elementor-pro' ),
                'name' => 'button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .zen-info-block__item-button',
            ]
        );

        $this->add_control(
            'info_button_text',
            [
                'label' => __( 'Button text', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Read More', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'elementor' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_active_settings();

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'link', $settings['link'] );
            $this->add_render_attribute( 'link', 'class', 'zen-info-block__item-button' );
        }
        ?>
        <div class="zen-info-block__item">
            <div class="zen-info-block__item-inner">
<!--                <img class="zen-info-block__item-img" src="http://159.65.231.1/wp-content/uploads/2020/07/care-pillar.png" alt="">-->

                <div class="zen-info-block__item-content">
                    <div class="zen-info-block__item-content-text">
                            <span class="zen-info-block__item-title">
                                 <?php echo esc_html($settings['info_title']); ?>
                            </span>

                        <div class="zen-info-block__item-toggle">
                            <div class="zen-info-block__item-toggle-text">
                                <?php echo esc_html($settings['info_text']); ?>
                            </div>
                        </div>



                        <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
                            <?php echo esc_html($settings['info_button_text']); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
	}
}
