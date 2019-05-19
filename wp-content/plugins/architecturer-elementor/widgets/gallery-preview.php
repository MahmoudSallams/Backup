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
class Architecturer_Gallery_Preview extends Widget_Base {

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
		return 'photographer-gallery-preview';
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
		return __( 'Fullscreen Gallery Preview', 'architecturer-elementor' );
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
		return 'eicon-slider-full-screen';
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
		return [ 'slick', 'tweenmax', 'architecturer-elementor' ];
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
			'gallery',
			  [
			    'label' => __( 'Add Images', 'architecturer-elementor' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
			'size',
			[
				'label' => __( 'Image Size', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
			    'options' => [
			     	'contain' => __( 'Contain', 'architecturer-elementor' ),
			     	'cover' => __( 'Cover', 'architecturer-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'slideshow_content',
			[
				'label' => __( 'Image Content', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'title',
			    'options' => [
			     	'title' => __( 'Title', 'architecturer-elementor' ),
			     	'title_caption' => __( 'Title and Caption', 'architecturer-elementor' ),
			     	'none' 	=> __( 'None', 'architecturer-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'Show Pagination', 'architecturer-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'architecturer-elementor' ),
				'label_off' => __( 'No', 'architecturer-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_navigation',
			[
				'label' => __( 'Show Navigation', 'architecturer-elementor' ),
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
		    'background_color',
		    [
		        'label' => __( 'Background Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper' => 'background: {{VALUE}}',
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .tg_gallery_fullscreen_title' => 'color: {{VALUE}}',
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
		                'max' => 60,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper.slider-wrapper .tg_gallery_fullscreen_title' => 'font-size: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper.slider-wrapper .slider .tg_gallery_fullscreen_title' => 'letter-spacing: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slider .tg_gallery_fullscreen_title' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'caption_color',
		    [
		        'label' => __( 'Caption Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .tg_gallery_fullscreen_caption' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'caption_font_size',
		    [
		        'label' => __( 'Caption Font Size (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 11,
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper.slider-wrapper .tg_gallery_fullscreen_caption' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
		    'caption_letter_spacing',
		    [
		        'label' => __( 'Caption Letter Spacing (in px)', 'architecturer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 3,
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper.slider-wrapper .slider .tg_gallery_fullscreen_caption' => 'letter-spacing: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'caption_text_transform',
			[
				'label' => __( 'Caption Text Transform', 'architecturer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'uppercase',
			    'options' => [
			     	'none' => __( 'None', 'architecturer-elementor' ),
			     	'uppercase' => __( 'Uppercase', 'architecturer-elementor' ),
			     	'lowercase' => __( 'Lowercase', 'architecturer-elementor' ),
			     	'capitalize' => __( 'Capitalize', 'architecturer-elementor' ),
			    ],
			    'selectors' => [
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slider .tg_gallery_fullscreen_caption' => 'text-transform: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'navigation_color',
		    [
		        'label' => __( 'Navigation Color', 'architecturer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slick-arrow.slick-prev:before' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slick-arrow.slick-next:before' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slick-arrow:after' => 'background-color: {{VALUE}}',
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
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
		            '{{WRAPPER}} .tg_fullscreen_gallery_preview_wrapper .slick-dots li button' => 'border-color: {{VALUE}}',
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
		include(ARCHITECTURER_ELEMENTOR_PATH.'templates/gallery-preview/index.php');
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
