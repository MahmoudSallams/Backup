<?php
namespace ArchitecturerElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget
 *
 * @since 1.0.0
 */
class Architecturer_Slider_Parallax extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'architecturer-slider-parallax';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Parallax Slider', 'architecturer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-slider';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'architecturer-theme-widgets-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tweenmax', 'architecturer-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'architecturer-elementor' ),
			]
		);
		
		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'architecturer-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'slide_image',
						'label' => __( 'Image', 'architecturer-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
					],
					[
						'name' => 'slide_title',
						'label' => __( 'Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Title' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_description',
						'label' => __( 'Description', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => __( 'Description' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_link_title',
						'label' => __( 'Link Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'View Detail' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_link',
						'label' => __( 'Link URL', 'architecturer-elementor' ),
						'type' => Controls_Manager::URL,
						'default' => [
					        'url' => '',
					        'is_external' => '',
					     ],
						'show_external' => true,
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);
		
		$this->add_control(
		    'height',
		    [
		        'label' => __( 'Height', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 900,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 5,
		                'max' => 2000,
		                'step' => 5,
		            ],
				            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ]
		    ]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'architecturer-elementor' ),
				'label_off' => __( 'No', 'architecturer-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
		    'timer',
		    [
		        'label' => __( 'Timer (in seconds)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 8,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 60,
		                'step' => 1,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Show Navigation', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'architecturer-elementor' ),
				'label_off' => __( 'No', 'architecturer-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Show Pagination', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'architecturer-elementor' ),
				'label_off' => __( 'No', 'architecturer-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_style',
			array(
				'label'      => esc_html__( 'Content', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'background_overlay',
		    [
		        'label' => __( 'Background OVerlay', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0,0,0,0.3)',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .image-container::before' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_width',
		    [
		        'label' => __( 'Title Width', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 50,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 30,
		                'max' => 100,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .caption' => 'width: {{SIZE}}%;',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .title h2' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 50,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slider_parallax_slides .slide .title h2' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_weight',
		    [
		        'label' => __( 'Title Font Weight', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 400,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 1000,
		                'step' => 100,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} div.slider_parallax_wrapper div.slider_parallax_inner .slider_parallax_slides .slide .caption .title h2' => 'font-weight: {{SIZE}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_line_height',
		    [
		        'label' => __( 'Line Height (in em)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 1.3,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0.1,
		                'max' => 10,
		                'step' => 0.1,
		            ],
		        ],
		        'size_units' => [ 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slider_parallax_inner .slide .title h2' => 'line-height: {{SIZE}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_letter_spacing',
		    [
		        'label' => __( 'Title Letter Spacing (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0,
		        ],
		        'range' => [
		            'px' => [
		                'min' => -20,
		                'max' => 20,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slider_parallax_inner .slider_parallax_slides .slide .title h2' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'title_text_transform',
			[
				'label' => __( 'Title Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slider_parallax_inner .slider_parallax_slides .slide .caption .title h2' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'description_color',
		    [
		        'label' => __( 'Description Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .text' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'description_font_size',
		    [
		        'label' => __( 'Description Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 18,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 8,
		                'max' => 40,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .caption .text' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'description_letter_spacing',
		    [
		        'label' => __( 'Description Letter Spacing (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0,
		        ],
		        'range' => [
		            'px' => [
		                'min' => -5,
		                'max' => 5,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .caption div.text' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'description_text_transform',
			[
				'label' => __( 'Description Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide div.caption div.text' => 'text-transform: {{VALUE}};',
		        ],
			]
		);
		
		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => __( 'Button Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .button' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .slider_parallax_wrapper .slide a.button' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_font_color',
		    [
		        'label' => __( 'Button Font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper div.slide a.button' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => __( 'Button Hover Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#555555',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .slide .button:hover' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .slider_parallax_wrapper .slide a.button:hover' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_font_color',
		    [
		        'label' => __( 'Button Hover Font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper div.slide a.button:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'pagination_color',
		    [
		        'label' => __( 'Pagination Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .slider_parallax_wrapper .pagination .item::before' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/slider-parallax/index.php');
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		return '';
	}
}
