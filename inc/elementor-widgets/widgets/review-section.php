<?php
namespace Seogoelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Seogo Review Contents section widget.
 *
 * @since 1.0
 */
class Seogo_Review_Contents extends Widget_Base {

	public function get_name() {
		return 'seogo-review-contents';
	}

	public function get_title() {
		return __( 'Review Contents', 'seogo-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'seogo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Review contents  ------------------------------
		$this->start_controls_section(
			'reviews_content',
			[
				'label' => __( 'Review Contents', 'seogo-companion' ),
			]
        );

        $this->add_control(
            'sec_bg',
            [
                'label' => esc_html__( 'Section Bg Image', 'seogo-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
            ]
        );
        
		$this->add_control(
            'reviews', [
                'label' => __( 'Create New', 'seogo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ reviewer_name }}}',
                'fields' => [
                    [
                        'name' => 'review_txt',
                        'label' => __( 'Review Text', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.'
                    ],
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                    ],
                    [
                        'name' => 'reviewer_name',
                        'label' => __( 'Client Name', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Robert Thomson', 'seogo-companion' ),
                    ],
                    [
                        'name' => 'reviewer_designation',
                        'label' => __( 'Client Designation', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Business Owner', 'seogo-companion' ),
                    ],
                ],
                'default'   => [
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Robert Thomson', 'seogo-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'seogo-companion' ),
                    ],
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Jonathan Doe', 'seogo-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'seogo-companion' ),
                    ],
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'John Doe', 'seogo-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'seogo-companion' ),
                    ],
                ]
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
                'label' => __( 'Style Review Section', 'seogo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_overlay_col', [
                'label' => __( 'Section Overlay Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-testmonial.overlay2::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_text_col', [
                'label' => __( 'Review Text Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_name_col', [
                'label' => __( 'Reviewer Name Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script(); 
    $settings       = $this->get_settings();
    $sec_bg         = !empty( $settings['sec_bg']['url'] ) ? $settings['sec_bg']['url'] : '';
    $reviews        = !empty( $settings['reviews'] ) ? $settings['reviews'] : '';
    ?>

    <!-- testimonial_area  -->
    <div class="testimonial_area" <?php echo seogo_inline_bg_img( esc_url( $sec_bg ) ); ?>>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <?php
                        if( is_array( $reviews ) && count( $reviews ) > 0 ){
                            foreach ( $reviews as $review ) {
                                $review_txt    = !empty( $review['review_txt'] ) ? $review['review_txt'] : '';
                                $reviewer_name = !empty( $review['reviewer_name'] ) ? $review['reviewer_name'] : '';
                                $reviewer_designation = !empty( $review['reviewer_designation'] ) ? $review['reviewer_designation'] : '';
                                $client_img = !empty( $review['client_img']['id'] ) ? wp_get_attachment_image( $review['client_img']['id'], 'seogo_np_thumb', '', array( 'alt' => $reviewer_name. ' image' ) ) : '';
                                $quote_icon = SEOGO_DIR_ICON_IMG_URI . 'quote-icon.svg';
                                ?>
                                <div class="single_carousel">
                                    <div class="single_testmonial text-center">
                                        <?php 
                                            echo '
                                            <div class="quote">
                                                <img src="'.esc_url($quote_icon).'" alt="quote icon">
                                            </div>
                                            ';
                                            if ( $review_txt ) { 
                                                echo '<p>'.wp_kses_post( nl2br( $review_txt ) ).'</p>';
                                            }
                                            echo '<div class="testmonial_author">';
                                                if ( $client_img ) { 
                                                    echo '
                                                    <div class="thumb">
                                                        '.$client_img.'
                                                    </div>
                                                    ';
                                                }
                                                if ( $reviewer_name ) { 
                                                    echo '<h3>'.esc_html( $reviewer_name ).'</h3>';
                                                }
                                                if ( $reviewer_designation ) { 
                                                    echo '<span>'.esc_html( $reviewer_designation ).'</span>';
                                                }
                                            echo '</div>';
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial_area_end  -->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.testmonial_active').owlCarousel({
            loop:true,
            margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive:{
                0:{
                    items:1,
                    dots:false,
                    nav:false,
                },
                767:{
                    items:1,
                    dots:false,
                    nav:false,
                },
                992:{
                    items:1,
                    nav:false
                },
                1200:{
                    items:1,
                    nav:false
                },
                1500:{
                    items:1
                }
            }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}
