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
class Architecturer_Portfolio_Timeline extends Widget_Base {

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
		return 'architecturer-portfolio-timeline';
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
		return __( 'Portfolio Timeline Horizontal', 'architecturer-elementor' );
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
						'name' => 'slide_date',
						'label' => __( 'Date', 'architecturer-elementor' ),
						'type' => Controls_Manager::DATE_TIME,
						'default' => __( '2018' , 'architecturer-elementor' ),
						'picker_options' => [
				            'enableTime' => false,
				            'allowInput' => true,
				        ],
					],
					[
						'name' => 'slide_date_format',
						'label' => __( 'Display Date Format', 'architecturer-elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'Y',
					    'options' => [
					     	'Y' => __( 'Year Only', 'architecturer-elementor' ),
					     	'M' => __( 'Month Only', 'architecturer-elementor' ),
					     	'd M' => __( 'Date & Month', 'architecturer-elementor' ),
					     	'M Y' => __( 'Month & Year', 'architecturer-elementor' ),
					     	'd M Y' => __( 'Date & Month and Year', 'architecturer-elementor' ),
					    ],
					],
					[
						'name' => 'slide_title',
						'label' => __( 'Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Title' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_subtitle',
						'label' => __( 'Sub Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Sub Title' , 'architecturer-elementor' ),
					],
					[
						'name' => 'slide_description',
						'label' => __( 'Description', 'architecturer-elementor' ),
						'type' => Controls_Manager::WYSIWYG,
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
		        'label' => __( 'Title font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content h2' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 24,
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
		            '{{WRAPPER}} div.cd-horizontal-timeline .events-content h2' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.cd-horizontal-timeline div.events-content h2' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .cd-horizontal-timeline div.events-content h2' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_subtitle_style',
			array(
				'label'      => esc_html__( 'Sub Title', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'subtitle_color',
		    [
		        'label' => __( 'Sub Title font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#888888',
		        'selectors' => [
		            '{{WRAPPER}} div.cd-horizontal-timeline .events-content em' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'subtitle_font_size',
		    [
		        'label' => __( 'Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 14,
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
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content em' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'subtitle_letter_spacing',
		    [
		        'label' => __( 'Sub Title Letter Spacing (in px)', 'architecturer-elementor' ),
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
		            '{{WRAPPER}} div.cd-horizontal-timeline div.events-content em' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'subtitle_text_transform',
			[
				'label' => __( 'Sub Title Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content ol li em' => 'text-transform: {{VALUE}}',
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
		    'content_font_color',
		    [
		        'label' => __( 'Content font Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events-content li .events-content-desc' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'content_font_size',
		    [
		        'label' => __( 'Content Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 16,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 40,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} div.cd-horizontal-timeline .events-content li .events-content-desc' => 'font-size: {{SIZE}}{{UNIT}};',
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
		        'default' => '#B8B8B8',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_timeline_link' => 'color: {{VALUE}}',
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
		            '{{WRAPPER}} .portfolio_timeline_link:hover' => 'color: {{VALUE}}',
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
		        'default' => '#e7e7e7',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .events' => 'background: {{VALUE}}',
		            '{{WRAPPER}} .cd-horizontal-timeline .events a::after' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .cd-timeline-navigation a' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'nav_active_color',
		    [
		        'label' => __( 'Navigation Active Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .cd-horizontal-timeline .filling-line' => 'background-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline .events a.selected::after' => 'background-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline div.events a.selected::after' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-horizontal-timeline .events a.older-event::after' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a:hover' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a.prev:hover:after' => 'color: {{VALUE}}',
		             '{{WRAPPER}} .cd-timeline-navigation a.next:hover:after' => 'color: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/portfolio-timeline/index.php');
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
