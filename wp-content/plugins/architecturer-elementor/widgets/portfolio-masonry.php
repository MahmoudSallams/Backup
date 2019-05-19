<?php
namespace ArchitecturerElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Portfolio Classic
 *
 * Elementor widget for portfolio posts
 *
 * @since 1.0.0
 */
class Architecturer_Portfolio_Masonry extends Widget_Base {

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
		return 'architecturer-portfolio-masonry';
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
		return __( 'Portfolio Masonry', 'architecturer-elementor' );
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
		return 'eicon-posts-masonry';
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
		return [ 'imagesloaded', 'architecturer-elementor' ];
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
						'name' => 'slide_subtitle',
						'label' => __( 'Sub Title', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
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
					[
						'name' => 'slide_tag',
						'label' => __( 'Tag', 'architecturer-elementor' ),
						'description' => __( 'Enter tag for this item for filterable option (optional)', 'architecturer-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);

		$this->add_control(
		    'columns',
		    [
		        'label' => __( 'Columns', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 2,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 2,
		                'max' => 4,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'filterable',
			[
				'label' => __( 'Filterable', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'architecturer-elementor' ),
				'label_off' => __( 'No', 'architecturer-elementor' ),
				'return_value' => 'yes',
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
		    'content_bg_color',
		    [
		        'label' => __( 'Content Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper figcaption' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'content_border_hover_color',
		    [
		        'label' => __( 'Content Border Hover Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper .border:before' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper .border:after' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper .border div:before' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper .border div:after' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper h3' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_font_size',
		    [
		        'label' => __( 'Title Font Size (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 20,
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
		            '{{WRAPPER}} div.portfolio_masonry_grid_wrapper h3' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_line_height',
		    [
		        'label' => __( 'Title Line Height (in em)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 1.3,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0.1,
		                'max' => 2,
		                'step' => 0.1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_masonry_grid_wrapper .portfolio_masonry_content h3' => 'line-height: {{SIZE}};',
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
		            '{{WRAPPER}} div.portfolio_masonry_grid_wrapper .portfolio_masonry_content h3' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.portfolio_masonry_grid_wrapper div.portfolio_masonry_content h3' => 'text-transform: {{VALUE}}',
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
		        'label' => __( 'Sub Title Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#B8B8B8',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_masonry_subtitle' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'subtitle_font_size',
		    [
		        'label' => __( 'Sub Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 14,
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
		            '{{WRAPPER}} .portfolio_masonry_content .portfolio_masonry_subtitle' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .portfolio_masonry_content div.portfolio_masonry_subtitle' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} div.portfolio_masonry_content div.portfolio_masonry_subtitle' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_filterable_style',
			array(
				'label'      => esc_html__( 'Filterable', 'architecturer-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'filterable_text_align',
			[
				'label' => __( 'Alignment', 'architecturer-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'architecturer-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'architecturer-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'architecturer-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
		            '{{WRAPPER}} .portfolio_filter_wrapper' => 'text-align: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'filterable_color',
		    [
		        'label' => __( 'Filterable Title Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#666666',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_filter_wrapper a.filter_tag_btn' => 'color: {{VALUE}}',
		            '{{WRAPPER}} div.elementor-widget-container .portfolio_filter_wrapper a.filter_tag_btn' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_hover_color',
		    [
		        'label' => __( 'Filterable Title Hover Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio_filter_wrapper a.filter_tag_btn:hover' => 'color: {{VALUE}}',
		            '{{WRAPPER}} div.portfolio_filter_wrapper .filter_tag_btn:hover' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_active_color',
		    [
		        'label' => __( 'Filterable Title Active Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} div.portfolio_filter_wrapper .filter_tag_btn.active' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio_filter_wrapper a.filter_tag_btn.active' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_font_size',
		    [
		        'label' => __( 'Filterable Title Font Size', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 12,
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
		            '{{WRAPPER}} div.portfolio_filter_wrapper a.filter_tag_btn' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'filterable_letter_spacing',
		    [
		        'label' => __( 'Filterable Title Letter Spacing (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 2,
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
		            '{{WRAPPER}} div.portfolio_filter_wrapper .filter_tag_btn' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'filterable_text_transform',
			[
				'label' => __( 'Filterable Title Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'uppercase',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .portfolio_filter_wrapper .filter_tag_btn' => 'text-transform: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/portfolio-masonry/index.php');
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
