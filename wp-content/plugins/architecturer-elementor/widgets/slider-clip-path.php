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
class Architecturer_Slider_Clip_Path extends Widget_Base {

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
		return 'photographer-slider-clip-path';
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
		return __( 'Fullscreen Clip Path Slider', 'architecturer-elementor' );
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
		return [ 'architecturer-theme-widgets-category-fullscreen' ];
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
		return [ 'architecturer-elementor' ];
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
						'type' => Controls_Manager::WYSIWYG,
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);
		
		$this->add_control(
		    'background_overlay',
		    [
		        'label' => __( 'Background Overlay', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0, 0, 0, 0.2)',
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__inner:before' => 'background: {{VALUE}}',
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
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__heading' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 60,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container h2.slide__heading' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.tg_clip_path_slide_container .slide__content h2.slide__heading' => 'font-weight: {{SIZE}};',
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
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__content .slide__heading' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__content h2.slide__heading' => 'text-transform: {{VALUE}}',
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
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__content' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__content a' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__inner .slide__content a' => 'border-color: {{VALUE}}',
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
		            '{{WRAPPER}} .tg_clip_path_slide_container .slide__inner .slide__content .slide__text' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_clip_path_slide_container .slider__slides .slide__inner .slide__content' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_clip_path_slide_container.slider .slider__slides .slide__inner .slide__content' => 'text-transform: {{VALUE}};',
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
		    'navigation_bg_color',
		    [
		        'label' => __( 'Navigation Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container .slider__control' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'navigation_arrow_color',
		    [
		        'label' => __( 'Navigation Arrow Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#999999',
		        'selectors' => [
		            '{{WRAPPER}} .tg_clip_path_slide_container .slider__control-line:after' => 'background-color: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/slider-clip-path/index.php');
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
