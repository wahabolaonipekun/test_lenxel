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
use Elementor\Repeater;

class LNXElement_Icon_Box_Group extends LNXElement_Base{
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
		return 'lnx-icon-box-group';
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
		return __('LNX Icon Box Group', 'lenxel-theme-support');
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
		  return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
	 }

	 public function get_script_depends() {
		return [
			 'jquery.owl.carousel',
			 'lenxel.elements',
		];
	 }

	 public function get_style_depends() {
		return array('owl-carousel-css');
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
		  $this->add_control( // xx Layout
				'layout_heading',
				[
					 'label'   => __( 'Layout', 'lenxel-theme-support' ),
					 'type'    => Controls_Manager::HEADING,
				]
		  );
			$this->add_control(
				'layout',
				[
					 'label'   => __( 'Layout Display', 'lenxel-theme-support' ),
					 'type'    => Controls_Manager::SELECT,
					 'default' => 'carousel',
					 'options' => [
						  'grid'      => __( 'Grid', 'lenxel-theme-support' ),
						  'carousel'  => __( 'Carousel', 'lenxel-theme-support' ),
					 ]
				]
		  );
  
		  $this->add_control(
				'style',
				[
					 'label' => __( 'Style', 'lenxel-theme-support' ),
					 'type' => Controls_Manager::SELECT,
					 'options' => [
						  'style-1' => esc_html__('Style I', 'lenxel-theme-support'),
						  'style-2' => esc_html__('Style II', 'lenxel-theme-support'),
					 ],
					 'default' => 'style-1',
				]
		  );
		  $repeater = new Repeater();
		  $repeater->add_control(
			 'title',
			 [
				'label'       => __('Title', 'lenxel-theme-support'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'desc',
			 [
				'label'       => __('Description', 'lenxel-theme-support'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Best & highly qualified',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'selected_icon',
			 [
				'label'      => __('Choose Icon', 'lenxel-theme-support'),
				'type'       => Controls_Manager::ICONS,
				'default' => [
				  'value' => 'fas fa-home',
				  'library' => 'fa-solid',
				]
			 ]
		  );
		  $repeater->add_control(
			 'link',
			 [
				'label'     => __( 'Link', 'lenxel-theme-support' ),
				'type'      => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'lenxel-theme-support' ),
				'label_block' => true
			 ]
		  );
		  $repeater->add_control(
			 'active',
			 [
				'label' => __( 'Active', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Active', 'lenxel-theme-support' ),
				'default' => 'no'
			 ]
		  );

		  $this->add_control(
			 'icon_boxs',
			 [
				'label'       => __('Brand Content Item', 'lenxel-theme-support'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  array(
					 'title'  => esc_html__( 'Learn Skills', 'lenxel-theme-support' ),
				  ),
				  array(
					 'title'       => esc_html__( 'Expert Teachers', 'lenxel-theme-support' ),
				  ),
				  array(
					 'title'  => esc_html__( 'Certificates', 'lenxel-theme-support' ),
				  )
				)
			 ]
		  );
		  
		  $this->end_controls_section();

		  $this->add_control_carousel(false, array('layout' => 'carousel'));

		  $this->add_control_grid(array('layout' => 'grid'));

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
		  if( !empty($settings['layout']) ){
			 include $this->get_template('icon-box-group/' . $settings['layout'] . '.php');
		  }
		print '</div>';
	 }

}

$widgets_manager->register_widget_type(new LNXElement_Icon_Box_Group());
