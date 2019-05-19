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
class Architecturer_Slider_Animated extends Widget_Base {

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
		return 'architecturer-slider-animated';
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
		return __( 'Animated Slider', 'architecturer-elementor' );
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
		return 'eicon-slideshow';
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
						'type' => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'slide_button_title',
						'label' => __( 'Button Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'View Project' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_button_link',
						'label' => __( 'Button Link URL', 'architecturer-elementor' ),
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
		        'label' => __( 'Height (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 700,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 5,
		                'max' => 2000,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ]
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
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper h2.slideshow__slide-caption-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 42,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .container h2.slideshow__slide-caption-title' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_weight',
		    [
		        'label' => __( 'Title Font Weight', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 600,
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
		            '{{WRAPPER}} div.tg_animated_slider_wrapper div.container h2.slideshow__slide-caption-title' => 'font-weight: {{SIZE}};',
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
		            '{{WRAPPER}} .tg_animated_slider_wrapper div.container h2.slideshow__slide-caption-title' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.tg_animated_slider_wrapper .container h2.slideshow__slide-caption-title' => 'text-transform: {{VALUE}}',
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
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .slideshow__slide p.slideshow__slide-caption-content' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'description_font_size',
		    [
		        'label' => __( 'Description Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 16,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 8,
		                'max' => 50,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper div.slideshow__slide p.slideshow__slide-caption-content' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.tg_animated_slider_wrapper .slideshow__slide p.slideshow__slide-caption-content' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.tg_animated_slider_wrapper div.slideshow__slide p.slideshow__slide-caption-content' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_link_style',
			array(
				'label'      => esc_html__( 'Link', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'link_color',
		    [
		        'label' => __( 'Link Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .slideshow__slide-caption-subtitle-label' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_animated_slider_wrapper .o-hsub::before' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'link_hover_color',
		    [
		        'label' => __( 'Link Hover Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .slideshow__slide-caption-subtitle:hover .slideshow__slide-caption-subtitle-label' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_animated_slider_wrapper .slideshow__slide-caption-subtitle.o-hsub:hover::before' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'link_font_size',
		    [
		        'label' => __( 'Link Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 16,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 8,
		                'max' => 50,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .slideshow__slide-caption-subtitle .slideshow__slide-caption-subtitle-label' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'link_letter_spacing',
		    [
		        'label' => __( 'Link Letter Spacing (in px)', 'architecturer-elementor' ),
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
		            '{{WRAPPER}} div.tg_animated_slider_wrapper .slideshow__slide-caption-subtitle .slideshow__slide-caption-subtitle-label' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'link_text_transform',
			[
				'label' => __( 'Link Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper div.slideshow__slide-caption-subtitle .slideshow__slide-caption-subtitle-label' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
			array(
				'label'      => esc_html__( 'Pagination & Navigation', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'navigation_color',
		    [
		        'label' => __( 'Navigation Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper button.js-slider-home-prev' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .tg_animated_slider_wrapper button.js-slider-home-next' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'pagination_color',
		    [
		        'label' => __( 'Pagination Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_animated_slider_wrapper .pagination__item.is-current' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .tg_animated_slider_wrapper .pagination__item' => 'border-color: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/slider-animated/index.php');
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
