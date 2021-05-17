<?php
namespace Seogoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Seogo elementor contact info section section widget.
 *
 * @since 1.0
 */
class Seogo_Contact_Info_Section extends Widget_Base {

	public function get_name() {
		return 'seogo-emergency-contact-section';
	}

	public function get_title() {
		return __( 'Emergency Contact Section', 'seogo-companion' );
	}

	public function get_icon() {
		return 'eicon-play-o';
	}

	public function get_categories() {
		return [ 'seogo-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Emergency Contact Section ------------------------------
        $this->start_controls_section(
            'emergency_contact_section_content',
            [
                'label' => __( 'Emergency Contact Section', 'seogo-companion' ),
            ]
        );
        $this->add_control(
            'ec_bg_img',
            [
                'label' => esc_html__( 'BG Image', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );        
        $this->add_control(
            'ec_title',
            [
                'label' => esc_html__( 'Sec Title', 'seogo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'For Any Information Call Us', 'seogo-companion' ),
            ]
        );
        $this->add_control(
            'ec_text',
            [
                'label' => esc_html__( 'Sub Title', 'seogo-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Esteem spirit temper too say adieus who direct esteem.', 'seogo-companion' ),
            ]
        );
        $this->add_control(
            'ec_btn_label',
            [
                'label' => esc_html__( 'Phone', 'seogo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '+10 673 763 6786', 'seogo-companion' ),
            ]
        );
        
        $this->end_controls_section(); // End emergency_contact_section

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'left_sec_style', [
                'label' => __( 'Top Section Styles', 'seogo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Emergency_contact .single_emergency .info h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .Emergency_contact .single_emergency .info p' => 'color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'button_col', [
				'label' => __( 'Button Text & Border Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Emergency_contact .single_emergency .info_button .boxed-btn3-white' => 'color: {{VALUE}} !important; border-color: {{VALUE}};',
					'{{WRAPPER}} .Emergency_contact .single_emergency .info_button .boxed-btn3-white:hover' => 'color: {{VALUE}} !important; border-color: transparent;',
				],
			]
        );

        $this->add_control(
            'button_styles_seperator',
            [
                'label' => esc_html__( 'Button Styles', 'seogo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
			'button_hover_col', [
				'label' => __( 'Button Hover Bg Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Emergency_contact .single_emergency .info_button .boxed-btn3-white:hover' => 'background: {{VALUE}};',
				],
			]
        );

        $this->add_control(
            'overlay_color_styles_seperator',
            [
                'label' => esc_html__( 'Overlay Color Styles', 'seogo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
			'sec_title_col', [
				'label' => __( 'Bg Overlay Color', 'seogo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .Emergency_contact .single_emergency.overlay_skyblue::before' => 'background: {{VALUE}};',
				],
			]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings  = $this->get_settings();
    $ec_title = !empty( $settings['ec_title'] ) ? $settings['ec_title'] : '';
    $ec_bg_img    = !empty( $settings['ec_bg_img']['url'] ) ? $settings['ec_bg_img']['url'] : '';
    $ec_text = !empty( $settings['ec_text'] ) ? $settings['ec_text'] : '';
    $ec_btn_label = !empty( $settings['ec_btn_label'] ) ? $settings['ec_btn_label'] : '';
    ?>

    <!-- Information_area  -->
    <div class="Information_area overlay" <?php echo seogo_inline_bg_img( esc_url( $ec_bg_img ) ); ?>>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-8">
                    <div class="info_text text-center">
                        <?php 
                            if ( $ec_title ) { 
                                echo '<h3>'.esc_html($ec_title).'</h3>';
                            }
                            if ( $ec_text ) { 
                                echo '<p>'.esc_html($ec_text).'</p>';
                            }
                            if ( $ec_btn_label ) { 
                                echo '<a class="boxed-btn3" href="tel:'.esc_attr($ec_btn_label).'">'.esc_html($ec_btn_label).'</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Information_area  end -->
    <?php

    }
}
