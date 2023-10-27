<?php

if (!defined('ABSPATH')) {
	 exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class LNXElement_Course_Banner extends LNXElement_Base{

	/**
	 	* Get widget name.
	 	*
	 	* Retrieve testimonial widget name.
	  	*
	  	* @since  1.0.0
	  	* @access public
	  	*
	  	* @return string Widget name.
	 */
	public function get_name() {
		return 'lnx-banner';
	}

	/**
	  * Get widget title.
	  *
	  * Retrieve testimonial widget title.
	  *
	  * @since  1.0.0
	  * @access public
	  *
	  * @return string Widget title.
	*/
	public function get_title() {
		 return __('LNX Banner', 'lenxel-theme-support');
	}

	/**
	  * Get widget icon.
	  *
	  * Retrieve testimonial widget icon.
	  *
	  * @since  1.0.0
	  * @access public
	  *
	  * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_keywords() {
		return [ 'course', 'banner', 'content' ];
	}

	public function get_script_depends() {
		return array();
	}

	public function get_style_depends() {
		return array();
	}

	/**
	  * Register testimonial widget controls.
	  *
	  * Adds different input fields to allow the user to change and customize the widget settings.
	  *
	  * @since  1.0.0
	  * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'lenxel-theme-support'),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'SubTitle', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__( 'Add your Sub Title', 'lenxel-theme-support' ),
				'default' => esc_html__('Inside Europe', 'lenxel-theme-support' )
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__( 'Add your Title', 'lenxel-theme-support' ),
				'default' => esc_html__("Let have dinner", 'lenxel-theme-support' )
			]
		);
		
		$this->add_control(
			'taxonomy',
			[
				'label' => __( 'Taxonomy', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
				  'course-category' => esc_html__('Course Category Taxonomy', 'lenxel-theme-support'),
				  'course-tag' => esc_html__('Course Tag Taxonomy', 'lenxel-theme-support'),
				],
				'default' => 'course-category',
			]
		);

		$this->add_control(
			'term_slug',
			[
				'label' => __( 'Region & Category Slug', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__( 'Term slug', 'lenxel-theme-support' ),
				'default' => ''
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Region & Category Slug', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'label'      => __('Choose Image', 'lenxel-theme-support'),
				'default'    => [
					 'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);

		$this->add_control(
			'link_custom',
			[
				'label' => __( 'Link Custom', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => ''
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'lenxel-theme-support'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'full'
			]
		);
		$this->add_control(
			'content_align',
			[
				'label' => __( 'Alignment Text', 'lenxel-theme-support' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'lenxel-theme-support' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'lenxel-theme-support' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'lenxel-theme-support' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'show_number_content',
			[
				'label'   => __( 'Show number content', 'lenxel-theme-support' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		 );
		$this->end_controls_section();


		  // Icon Styling
		  $this->start_controls_section(
			 'section_style_icon',
			 [
				'label' => __( 'Icon', 'lenxel-theme-support' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			 ]
		  );

		  $this->add_control(
			 'icon_color',
			 [
				'label' => __( 'Icon Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon i' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content svg' => 'fill: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_size',
			 [
				'label' => __( 'Size', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 60
				],
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_space',
			 [
				'label' => __( 'Spacing', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 0,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_padding',
			 [
				'label' => __( 'Padding', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			 ]
		  );

		  $this->end_controls_section();

		  $this->start_controls_section(
			 'section_style_content',
			 [
				'label' => __( 'Content', 'lenxel-theme-support' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			 ]
		  );

		  $this->add_control(
			 'heading_title',
			 [
				'label' => __( 'Title', 'lenxel-theme-support' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			 ]
		  );

		  $this->add_responsive_control(
			 'title_bottom_space',
			 [
				'label' => __( 'Spacing', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 100,
				  ],
				],
				'default' => [
				  'size'  => 5
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			 ]
		  ); 

		  $this->add_control(
			 'title_color',
			 [
				'label' => __( 'Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title a' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title, {{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title a',
			 ]
		  );

		  $this->add_control(
			 'heading_description',
			 [
				'label' => __( 'Description', 'lenxel-theme-support' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
				  'style' => ['style-2'],
				],
			 ]
		  );

		  $this->add_control(
			 'description_color',
			 [
				'label' => __( 'Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
				  'style' => ['style-2'],
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content',
				'condition' => [
				  'style' => ['style-2'],
				],

			 ]
		  );

		  $this->end_controls_section();
	 }

	 /**
	  * Render testimonial widget output on the frontend.
	  *
	  * Written in PHP and used to generate the final HTML.
	  *
	  * @since  1.0.0
	  * @access protected
	  */
	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="lnx-element-%s lnx-element">', $this->get_name() );
			include $this->get_template('course-banner.php');
		print '</div>';
	 }

}

$widgets_manager->register_widget_type(new LNXElement_Course_Banner());
