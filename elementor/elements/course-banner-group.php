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

class LNXElement_Course_Banner_Group extends LNXElement_Base{

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
		return 'lnx-course-banner-group';
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
		 return __('LNX Course Banner Group', 'lenxel-theme-support');
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
		return [ 'course', 'banner', 'content', 'group', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'jquery.owl.carousel',
			'lenxel.elements'
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
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
				  'style-1' => esc_html__('Style I', 'lenxel-theme-support'),
				  'style-2' => esc_html__('Style II', 'lenxel-theme-support'),
				  'style-3' => esc_html__('Style III', 'lenxel-theme-support')
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label' => __( 'Style', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
				  'course-category' => esc_html__('Course Catgegory Taxonomy', 'lenxel-theme-support'),
				  'course-tag' => esc_html__('Course Tag Taxonomy', 'lenxel-theme-support'),
				],
				'default' => 'course-category',
			]
		);
		$repeater = new Repeater();
		
		$repeater->add_control(
			'title',
		  	[
			 	'label'       => __('Title', 'lenxel-theme-support'),
			 	'type'        => Controls_Manager::TEXT,
			 	'placeholder' => esc_html__( 'Add your Title', 'lenxel-theme-support' ),
			 	'label_block' => true,
			 	'default'     => 'Art & Design',
		  	]
		);
		$repeater->add_control(
			'term_slug',
		  	[
			 	'label'     => __( 'Category/Tag Course Slug', 'lenxel-theme-support' ),
			 	'type'      => Controls_Manager::TEXT,
			 	'label_block' => true,
			 	'placeholder' => __( 'Add term slug here', 'lenxel-theme-support' ),
		  	]
		);
		$repeater->add_control(
			'image',
		  [
			 'label'      => __('Choose Image', 'lenxel-theme-support'),
			 'default'    => [
				  'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-4.jpg',
			 ],
			 'dynamic' => [
				'active' => true,
			 ],
			 'type'       => Controls_Manager::MEDIA,
			 'show_label' => false,
		  ]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'      => __('Choose Icon (Optional of Style II)', 'lenxel-theme-support'),
				'type'       => Controls_Manager::ICONS,
				'default' => [
				  	'value' => 'fas fa-home',
				  	'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'sub_title',
		  	[
			 	'label'       => __('Sub Title (Optional of Style II)', 'lenxel-theme-support'),
			 	'type'        => Controls_Manager::TEXT,
			 	'placeholder' => esc_html__( 'Add your Sub-Title', 'lenxel-theme-support' ),
			 	'default'     => esc_html__('46 hours course time', 'lenxel-theme-support'),
			 	'label_block' => true,
		  	]
		);

		$repeater->add_control(
			'custom_link',
		  	[
			 	'label'       => __('Custom Link', 'lenxel-theme-support'),
			 	'type'        => Controls_Manager::URL,
			 	'placeholder' => esc_html__( 'Add Your Custom Link', 'lenxel-theme-support' ),
		  	]
		);
		
		$this->add_control(
			'content_banners',
			[
				'label'       => __('Course Banner Content Item', 'lenxel-theme-support'),
				'type'        => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  	array(
					 	'title'  		=> esc_html__('Art & Design', 'lenxel-theme-support'),
					 	'image'			=> [
					 		'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-4.jpg',
					 	]
				  	),
				  	array(
					 	'title'       => esc_html__('Lifestyle', 'lenxel-theme-support'),
					 	'image'			=> [
					 		'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-5.jpg',
					 	]
				  	),
				  	array(
					 	'title'  		=> esc_html__('Photography', 'lenxel-theme-support'),
					 	'image'			=> [
					 		'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-6.jpg',
					 	]
				  	),
				  	array(
					 	'title'  		=> esc_html__('Marketing', 'lenxel-theme-support'),
					 	'image'			=> [
					 		'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-5.jpg',
					 	]
				  	),
				  	array(
					 	'title'  		=> esc_html__('Business', 'lenxel-theme-support'),
					 	'image'			=> [
					 		'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-6.jpg',
					 	]
				  	)
				)
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
		 	'show_number_content',
		 	[
				'label'   => __( 'Show number content', 'lenxel-theme-support' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
		 	]
	  	);

	  	$this->add_control(
		 	'text_suffix_number',
		 	[
				'label'   => __( 'Text Suffix', 'lenxel-theme-support' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('Full Courses', 'lenxel-theme-support'),
				'condition' => [
					'style' => ['style-1']
				]
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
		 	'view',
		 	[
				'label'   => __('View', 'lenxel-theme-support'),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
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
			 include $this->get_template('course-banner-group/' . $settings['layout'] . '.php');
		  }
		print '</div>';
	 }

}

$widgets_manager->register_widget_type(new LNXElement_Course_Banner_Group());
