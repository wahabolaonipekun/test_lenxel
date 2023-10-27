<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class LNXElement_Image_Content extends LNXElement_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'lnx-image-content';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'LNX Image Content', 'lenxel-theme-support' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-featured-image';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'image', 'content' ];
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'lenxel-theme-support' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'skin-v1' => esc_html__('Style I', 'lenxel-theme-support'),
					'skin-v2' => esc_html__('Style II', 'lenxel-theme-support'),
					'skin-v3' => esc_html__('Style III', 'lenxel-theme-support'),
					'skin-v4' => esc_html__('Style IV', 'lenxel-theme-support'),
					'skin-v5' => esc_html__('Style V', 'lenxel-theme-support'),
					'skin-v6' => esc_html__('Style VI', 'lenxel-theme-support'),
					'skin-v7' => esc_html__('Style VII', 'lenxel-theme-support'),
				],
				'default' => 'skin-v1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'lenxel-theme-support' ),
				'default' => __( 'Trusted by 8800 customers', 'lenxel-theme-support' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'lenxel-theme-support' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style' => ['skin-v1']
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'lenxel-theme-support' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-4.jpg',
				],
			]
		);

		$this->add_control(
			'image_second',
			[
				'label' => __( 'Choose Image Second', 'lenxel-theme-support' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-5.jpg',
				],
				'condition' => [
					'style' => ['skin-v1', 'skin-v4']
				],
			]
		);
		
		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
	         'condition' => [
					'style!' => ['skin-v1', 'skin-v4'],
				]
         ]
      );
		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'lenxel-theme-support' ),
				'condition' => [
					'style!' => ['skin-v1', 'skin-v2', 'skin-v3'],
				],
			]
		);
		
		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'lenxel-theme-support' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'lenxel-theme-support' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Text Link', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'lenxel-theme-support' ),
				'default' => __( 'Read More', 'lenxel-theme-support' ),
				'condition' => [
					'style!' => ['skin-v1', 'skin-v4', 'skin-v5'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v1 .box-content .content-inner .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v2 .box-content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v4 .image .line-color' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-image-content.skin-v5 .box-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content.skin-v1 .line-color:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['skin-v1'],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .title',
			]
		);

		$this->add_control(
			'title_space_bottom',
			[
				'label' => __( 'Space Bottom', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v2', 'skin-v4', 'skin-v5'],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-image-content .box-content .desc',
			]
		);

		$this->add_control(
			'content_space_bottom',
			[
				'label' => __( 'Space Bottom', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-image-content .box-content .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
      printf( '<div class="lnx-element-%s lnx-element">', $this->get_name() );
         include $this->get_template('image-content.php');
      print '</div>';
	}

}

 $widgets_manager->register_widget_type(new LNXElement_Image_Content());
