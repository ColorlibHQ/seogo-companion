<?php
namespace Seogoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Seogo elementor hero section widget.
 *
 * @since 1.0
 */
class Seogo_Hero extends Widget_Base {

	public function get_name() {
		return 'seogo-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'seogo-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'seogo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'seogo-companion' ),
			]
        );
        $this->add_control(
            'img_settings_seperator',
            [
                'label' => esc_html__( 'BG Images Section', 'seogo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'left_circle',
            [
                'label' => esc_html__( 'Left Circle Image', 'seogo-companion' ),
                'description' => esc_html__( 'Best size is 605x552', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'right_triangle',
            [
                'label' => esc_html__( 'Right Triangle Image', 'seogo-companion' ),
                'description' => esc_html__( 'Best size is 25x23', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'right_circle',
            [
                'label' => esc_html__( 'Right Circle Image', 'seogo-companion' ),
                'description' => esc_html__( 'Best size is 679x1251', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'text_settings_seperator',
            [
                'label' => esc_html__( 'Banner Content Section', 'seogo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'banner_img',
            [
                'label' => esc_html__( 'Banner Image', 'seogo-companion' ),
                'description' => esc_html__( 'Best size is 920x464', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'seogo-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => 'BoostUp your Business & Get <br> top of Search Engine',
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Text', 'seogo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => __( 'Get Started', 'seogo-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'seogo-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'seogo-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'left_circle_img',
                'label' => __( 'Left Circle Image', 'seogo-companion' ),
                'description' => __( 'Upload The Left Circle Image. Best size is 724x767', 'seogo-companion' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .slider_area .single_slider::before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'right_circle_img',
                'label' => __( 'Right Top Circle Image', 'seogo-companion' ),
                'description' => __( 'Upload The Right Circle Image. Best size is 531x504', 'seogo-companion' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .slider_area .single_slider::after',
            ]
        );

        $this->add_control(
            'text_section_separator',
            [
                'label'     => __( 'Text Styles', 'seogo-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
		$this->add_control(
			'big_title_col', [
				'label' => __( 'Title Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text span' => 'color: {{VALUE}};',
				],
			]
        );
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings   = $this->get_settings();
    $sec_title    = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $left_circle    = !empty( $settings['left_circle']['id'] ) ? wp_get_attachment_image( $settings['left_circle']['id'], 'seogo_banner_left_circle_605x552', '', array( 'alt' => $sec_title . ' left circle' ) ) : '';
    $right_triangle    = !empty( $settings['right_triangle']['id'] ) ? wp_get_attachment_image( $settings['right_triangle']['id'], 'seogo_banner_right_triangle_25x23', '', array( 'alt' => $sec_title . ' right triangle' ) ) : '';
    $right_circle    = !empty( $settings['right_circle']['id'] ) ? wp_get_attachment_image( $settings['right_circle']['id'], 'seogo_banner_right_circle_679x1251', '', array( 'alt' => $sec_title . ' right circle' ) ) : '';
    $banner_img    = !empty( $settings['banner_img']['id'] ) ? wp_get_attachment_image( $settings['banner_img']['id'], 'seogo_banner_image_920x464', '', array( 'alt' => $sec_title . ' banner image' ) ) : '';
    $btn_label    = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <div class="shap_big_2 d-none d-lg-block">
        <?php 
            if ( $right_circle ) { 
                echo $right_circle;
            }
        ?>
    </div>
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="shap_img_1 d-none d-lg-block">
            <?php 
                if ( $left_circle ) { 
                    echo $left_circle;
                }
            ?>
        </div>
        <div class="poly_img">
            <?php 
                if ( $right_triangle ) { 
                    echo $right_triangle;
                }
            ?>
        </div>
        <div class="single_slider d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="slider_text text-center">
                            <div class="text">
                                <?php 
                                    if ( $sec_title ) { 
                                        echo '<h3>'.wp_kses_post( nl2br($sec_title) ).'</h3>';
                                    }
                                    if ( $btn_label ) { 
                                        echo '<a class="boxed-btn3" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_label ).'</a>';
                                    }
                                ?>
                            </div>
                            <div class="ilstrator_thumb">
                                <?php 
                                    if ( $banner_img ) { 
                                        echo $banner_img;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php
    } 
}