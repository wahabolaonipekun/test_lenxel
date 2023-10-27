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
use Elementor\Repeater;

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class LNXElement_Pricing_Block extends LNXElement_Base {

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
		return 'lnx-pricing-block';
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
		return __( 'LNX Pricing Block', 'lenxel-theme-support' );
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
		return 'eicon-price-list';
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
		return [ 'pricing', 'block' ];
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
			'section_content',
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
					'style-1' 		=> __( 'Style I: Default', 'lenxel-theme-support' ),
					'style-2' 		=> __( 'Style II: Scale 0.95', 'lenxel-theme-support' )
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'lenxel-theme-support' ),
				'default' => __( 'Standard', 'lenxel-theme-support' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Private amenities', 'lenxel-theme-support' ),
				'default' => __( 'Private amenities', 'lenxel-theme-support' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_text',
			[
				'label' => __( 'Description', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Your Description', 'lenxel-theme-support' ),
				'default' => __( 'There are many new variatns of pasages of available text.', 'lenxel-theme-support' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '60.00', 'lenxel-theme-support' ),
				'default' => __( '60.00', 'lenxel-theme-support' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Currency', 'lenxel-theme-support' ),
				'default' => __( '$', 'lenxel-theme-support' ),
			]
		);
		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Monthly', 'lenxel-theme-support' ),
				'default' => __( 'Monthly', 'lenxel-theme-support' ),
			]
		);

		$repeater = new Repeater();
      $repeater->add_control(
         'pricing_features',
			[
	         'label'       => __('Pricing Features', 'lenxel-theme-support'),
	         'type'        => Controls_Manager::TEXT,
	         'default'     => 'Free text goes here',
	         'label_block' => true,
	         'rows'        => '10',
	     	]
	   );
		$this->add_control(
         'pricing_content',
         [
            'label'       => __('Pricing Features', 'lenxel-theme-support'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ pricing_features }}}',
            'default'     => array(
               array(
                  'pricing_features'  => esc_html__( '3D Visualization', 'lenxel-theme-support' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Planning Solution', 'lenxel-theme-support' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Selection of Materials', 'lenxel-theme-support' )
               ),
               array(
                  'pricing_features'  => esc_html__( '10 Construction Drawings', 'lenxel-theme-support' )
               )
            ),
         ]
      );

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_Button',
			[
				'label' => __( 'Button', 'lenxel-theme-support' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'lenxel-theme-support' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'lenxel-theme-support' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Read More'
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 		=> esc_html__('Button Theme', 'lenxel-theme-support'),
					'btn-theme-2' 		=> esc_html__('Button Theme Second', 'lenxel-theme-support'),
					'btn-white' 		=> esc_html__('Button White', 'lenxel-theme-support'),
					'btn-black' 		=> esc_html__('Button Black', 'lenxel-theme-support')
				],
				'default' => 'btn-white',
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
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-pricing .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price Text', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_price_text',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .icon' => 'color: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();
		printf( '<div class="lnx-element-%s lnx-element">', $this->get_name() );
         include $this->get_template('pricing-block.php');
      print '</div>';
	}

}

$widgets_manager->register_widget_type(new LNXElement_Pricing_Block());
