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
 * Seogo elementor single event section widget.
 *
 * @since 1.0
 */
class Seogo_Single_Event extends Widget_Base {

	public function get_name() {
		return 'seogo-single-event';
	}

	public function get_title() {
		return __( 'Single Event', 'seogo-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'seogo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  single event content ------------------------------
		$this->start_controls_section(
			'single_event_content',
			[
				'label' => __( 'Event content', 'seogo-companion' ),
			]
        );

		$this->add_control(
            'speakers', [
                'label' => __( 'Create New', 'seogo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ member_name }}}',
                'fields' => [
                    [
                        'name' => 'member_img',
                        'label' => __( 'Speaker Image', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'member_name',
                        'label' => __( 'Speaker Name', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Jonson Miller', 'seogo-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Some Text', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Our set he for firmament morning sixth subdue darkness creeping gathered divide our let god moving. Moving in fourth air night bring upon you’re it beast let you dominion', 'seogo-companion' ),
                    ],
                    [
                        'name' => 'event_time',
                        'label' => __( 'Event Time', 'seogo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '10-11 am', 'seogo-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'member_img'    => [
                            'url'       => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'   => __( 'Jonson Miller', 'seogo-companion' ),
                        'text'          => __( 'Our set he for firmament morning sixth subdue darkness creeping gathered divide our let god moving. Moving in fourth air night bring upon you’re it beast let you dominion', 'seogo-companion' ),
                        'event_time'    => __( '10-11 am', 'seogo-companion' ),
                    ],
                    [      
                        'member_img'    => [
                            'url'       => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'   => __( 'Albert Jackey', 'seogo-companion' ),
                        'text'          => __( 'Our set he for firmament morning sixth subdue darkness creeping gathered divide our let god moving. Moving in fourth air night bring upon you’re it beast let you dominion', 'seogo-companion' ),
                        'event_time'    => __( '12-1.00 pm', 'seogo-companion' ),
                    ],
                    [      
                        'member_img'    => [
                            'url'       => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'   => __( 'Alvi Nourin', 'seogo-companion' ),
                        'text'          => __( 'Our set he for firmament morning sixth subdue darkness creeping gathered divide our let god moving. Moving in fourth air night bring upon you’re it beast let you dominion', 'seogo-companion' ),
                        'event_time'    => __( '2.30-4.00 pm', 'seogo-companion' ),
                    ],
                ]
            ]
		);
		$this->end_controls_section(); // End service content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Service Section', 'seogo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title .sub_heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Big Title Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'member_styles_seperator',
            [
                'label' => esc_html__( 'Member Styles', 'seogo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'member_name_col', [
                'label' => __( 'Member Name Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'member_desig_color', [
                'label' => __( 'Member Designation Color', 'seogo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings();
        $speakers = !empty( $settings['speakers'] ) ? $settings['speakers'] : '';

        if( is_array( $speakers ) && count( $speakers ) > 0 ) {
            foreach( $speakers as $member ) {
                $member_name = ( !empty( $member['member_name'] ) ) ? $member['member_name'] : '';
                $member_img  = !empty( $member['member_img']['id'] ) ? wp_get_attachment_image( $member['member_img']['id'], 'seogo_speaker_small_thumb_90x90', '', array( 'alt' => $member_name. ' image' ) ) : '';
                $text        = ( !empty( $member['text'] ) ) ? $member['text'] : '';
                $event_time  = ( !empty( $member['event_time'] ) ) ? $member['event_time'] : '';
                ?>
                <div class="single_speaker">
                    <?php 
                        if ( $member_img ) { 
                            echo $member_img;
                        }
                    ?>
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <?php 
                                if ( $member_name ) { 
                                    echo '<span>'.esc_html( $member_name ).'</span>';
                                }
                                if ( $event_time ) { 
                                    echo '<div class="time">'.esc_html( $event_time ).'</div>';
                                }
                            ?>
                        </div>
                        <?php 
                            if ( $text ) { 
                                echo '<p>'.esc_html( $text ).'</p>';
                            }
                        ?>
                    </div>
                </div>
                <?php 
            }
        }
    }
}