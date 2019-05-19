<?php
namespace ArchitecturerElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget for blog posts
 *
 * @since 1.0.0
 */
class Architecturer_Slider_Multi_Layouts extends Widget_Base {

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
		return 'photographer-slider-multi-layouts';
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
		return __( 'Multi Layouts Slider', 'architecturer-elementor' );
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
		return [ 'anime', 'imagesloaded', 'mls', 'architecturer-elementor' ];
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
						'type' => Controls_Manager::GALLERY,
						'default' => [],
					],
					[
						'name' => 'image_size',
						'label' => __( 'Image Size', 'architecturer-elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'full',
					    'options' => [
					     	'medium_large' => __( 'Medium (default 768px x 768px max)', 'architecturer-elementor' ),
					     	'large' => __( 'Large (default 1024px x 1024px max)', 'architecturer-elementor' ),
					     	'full' => __( 'Original image resolution', 'architecturer-elementor' ),
					    ],
					],
					[
						'name' => 'slide_layout',
						'label' => __( 'Layout', 'architecturer-elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 1,
						'options' => [
					     	1 => __( 'Layout 1', 'architecturer-elementor' ),
					     	2 => __( 'Layout 2', 'architecturer-elementor' ),
					     	3 => __( 'Layout 3', 'architecturer-elementor' ),
					     	4 => __( 'Layout 4', 'architecturer-elementor' ),
					     	5 => __( 'Layout 5', 'architecturer-elementor' ),
					     	6 => __( 'Layout 6', 'architecturer-elementor' ),
					     	7 => __( 'Layout 7', 'architecturer-elementor' ),
					     ],
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
					],
					[
						'name' => 'slide_link_title',
						'label' => __( 'Link Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'View Project' , 'architecturer-elementor' ),
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
		    'width',
		    [
		        'label' => __( 'Width', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 100,
		            'unit' => '%',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 1600,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper.slideshow' => 'width: {{SIZE}}{{UNIT}} !important',
		        ],
		    ]
		);
		
		$this->add_control(
		    'height',
		    [
		        'label' => __( 'Height', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 800,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		    ]
		);
		
		$this->add_control(
		    'opacity',
		    [
		        'label' => __( 'Images Opacity', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0.5,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0.1,
		                'max' => 1,
		                'step' => 0.1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide-imgwrap' => 'opacity: {{SIZE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
			    'options' => [
			     	'left' => __( 'Left', 'architecturer-elementor' ),
			     	'center' => __( 'Center', 'architecturer-elementor' ),
			     	'right' => __( 'Right', 'architecturer-elementor' ),
			    ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			array(
				'label'      => esc_html__( 'Title', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title-main' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 100,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 20,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper h2.slide__title-main' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.tg_multi_layouts_slider_wrapper .slide__title h2' => 'font-weight: {{SIZE}};',
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
		                'min' => -10,
		                'max' => 10,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper h2' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title h2' => 'text-transform: {{VALUE}}',
		        ],
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
		    'description_color',
		    [
		        'label' => __( 'Description Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title-sub' => 'color: {{VALUE}}',
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
		                'min' => 12,
		                'max' => 30,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper p.slide__title-sub' => 'font-size: {{SIZE}}{{UNIT}};',
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
		                'min' => -10,
		                'max' => 10,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title p.slide__title-sub' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title p.slide__title-sub' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'link_font_color',
		    [
		        'label' => __( 'Link Font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#1C58F6',
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title .slide__title-sub .tg_multi_layouts_slide_link' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .slide__title p.slide__title-sub .tg_multi_layouts_slide_link' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
			array(
				'label'      => esc_html__( 'Navigation', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'nav_color',
		    [
		        'label' => __( 'Navigation Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .tg_multi_layouts_slider_wrapper .btn' => 'color: {{VALUE}}',
		            '.js {{WRAPPER}} .tg_multi_layouts_slider_wrapper::after' => 'border-top-color: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/slider-multi-layouts/index.php');
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
