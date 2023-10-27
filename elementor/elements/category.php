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
class LNXElement_Course_category extends LNXElement_Base {

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
		return 'lnx-category';
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
		return __( 'LNX Category', 'lenxel-theme-support' );
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
		return 'eicon-t-letter';
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
		return [ 'course', 'filter' ];
	}

	public function get_script_depends() {
      return [
          'jquery.owl.carousel',
          'lenxel.elements',
      ];
    }

    public function get_style_depends() {
        return [
            'owl-carousel-css',
        ];
    }

	private function get_categories_list(){
      $categories = array();

      $categories['none'] = __( 'None', 'lenxel-theme-support' );
      $taxonomy = [
        'taxonomy' =>'course-category', 
      'hide_empty' => 0, 
      'order' => 'ASC',
      'hide_empty' => 0,];
      $tax_terms = get_categories( $taxonomy );
      if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
         foreach( $tax_terms as $item ) {
            $categories[$item->term_id] = $item->name;
         }
      }
      return $categories;
   }

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(){
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Layout & Content', 'lenxel-theme-support' ),
			]
		);

		$this->add_control(
         'layout',
         [
             'label'   => __( 'Layout Display', 'lenxel-theme-support' ),
             'type'    => Controls_Manager::SELECT,
             'default' => 'carousel',
             'options' => [
                 'grid'          => __( 'Grid', 'lenxel-theme-support' ),
                 'carousel'      => __( 'Carousel', 'lenxel-theme-support' ),
                 'list'          => __( 'List', 'lenxel-theme-support' )
             ]
         ]
      );

      $this->add_control(
         'image_size',
         [
            'label'     => __('Image Style', 'lenxel-theme-support'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'options'   => $this->get_thumbnail_size(),
            'default'   => 'post-thumbnail'
         ]
     );

		$this->add_control( // xx Layout
         'query_heading',
         [
            'label'   => __( 'Query', 'lenxel-theme-support' ),
            'type'    => Controls_Manager::HEADING,
         ]
      );
      $this->add_control(
         'category_ids',
         [
            'label' 			=> __( 'Select By Category', 'lenxel-theme-support' ),
            'type' 			=> Controls_Manager::SELECT2,
            'multiple'    	=> true,
            'default' 		=> '',
            'label_block' 	=> true,
            'options'   	=> $this->get_categories_list()
         ]
      );
      $this->add_control(
         'category_per_page',
         [
            'label' => __( 'Category Per Page', 'lenxel-theme-support' ),
            'type' => Controls_Manager::NUMBER,
            'default' => 6,
         ]
      );
     	$this->add_control(
         'orderby',
         [
            'label'   => __( 'Order By', 'lenxel-theme-support' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'name',
            'options' => [
              	'category_title' => __( 'Name', 'lenxel-theme-support' ),
              	'rand'       => __( 'Random', 'lenxel-theme-support' ),
            ]
         ]
      );

      $this->add_control(
         'order',
         [
            'label'   => __( 'Order', 'lenxel-theme-support' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => [
             	'asc'  => __( 'ASC', 'lenxel-theme-support' ),
             	'desc' => __( 'DESC', 'lenxel-theme-support' )
            ]
         ]
     	);

      $this->add_control(
         'pagination',
         [
            'label'     => __('Pagination', 'lenxel-theme-support'),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'no',
            'condition' => [
               'layout' => 'grid'
            ]
         ]
      );

      $this->end_controls_section();

      $this->add_control_carousel(false, array('layout' => 'carousel'));

      $this->add_control_grid(array('layout' => 'grid'));

		$this->start_controls_section(
			'section_video_style',
			[
				'label' => __( 'Video Button', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video' => 'yes',
				],
			]
		);
		$this->add_control(
			'video_background_primary',
			[
				'label' => __( 'Primary Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_background_second',
			[
				'label' => __( 'Primary Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_color',
			[
				'label' => __( 'Text Button Video Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'video_size',
			[
				'label' => __( 'Video Button Size', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 92,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'bg_over_cat_box_color',
			[
				'label' => __( 'Background Overlay Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-category.gsc-heading' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_space',
			[
				'label' => __( 'Card Element Space Bottom', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_space_divider',
			[
				'label' => __( 'Card Element Space Divider', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lnx-category .owl-carousel .owl-item, {{WRAPPER}} .lnx-category-grid .category-grid4' => 'padding: 0px {{SIZE}}{{UNIT}} 0px {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_contain_width',
			[
				'label' => __( 'Card container width', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'max-width: {{SIZE}}% !important;width: {{SIZE}}% !important;',
				],
			]
		);
		$this->add_responsive_control(
			'box_space_card',
			[
				'label' => __( 'Card Padding Spacing', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
				  'top'       => 90,
				  'right'     => 10,
				  'left'      => 10,
				  'bottom'    => 90,
				  'unit'      => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .item-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_box_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .item-category' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		//Title
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
					'{{WRAPPER}} .gsc-heading .title' => 'color: {{VALUE}};',
				],
			]
		);
		
		//typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-heading .title',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Title Spacing', 'lenxel-theme-support' ),
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
					'{{WRAPPER}} .gsc-heading .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => __( 'Sub Title', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_line_color',
			[
				'label' => __( 'Line Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_space',
			[
				'label' => __( 'Sub Title Spacing', 'lenxel-theme-support' ),
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
					'{{WRAPPER}} .gsc-heading .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-heading .sub-title',
			]
		);

		$this->end_controls_section();
        $this->start_controls_section(
            'section_image_style',
			[
				'label' => __( 'Image Border Radius', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'image_cat_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'lenxel-theme-support' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                '{{WRAPPER}} .image-cat-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
                'separator' => 'before',
            ]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => __( 'Description', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-heading .title-desc',
			]
		);

		$this->add_responsive_control(
			'description_space',
			[
				'label' => __( 'Description Spacing', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
				  'top'       => 20,
				  'right'     => 0,
				  'left'      => 0,
				  'bottom'    => 0,
				  'unit'      => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public static function get_query_args(  $settings ) {
      $defaults = [
         'category_ids'    => '',
         'orderby'         => 'date',
         'order'           => 'ASC',
         'category_per_page'  => 3,
         'offset'          => 0,
      ];
      
      $settings = wp_parse_args( $settings, $defaults );
      $cats    = $settings['category_ids'];
      $query_args = [
         'taxonomy' => 'course-category',
         'orderby' => $settings['orderby'],
         'order' => $settings['order'],
         'hide_empty'               => 0,
    //      'child_of'                 => 0,
    //      'parent'                   => '',
    //    'taxonomy'                 => 'dining-category',
    //    'pad_counts'               => false
      ];
      if($cats){
         if( is_array($cats) && count($cats) > 0 ){
            $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
            $query_args['include'] = $category_ids;
         }
      }
      return $query_args;
   }


    public function query_category() {
        $query_args = $this->get_query_args( $this->get_settings() );
        
        //return new WP_Query( $query_args );
        return get_categories($query_args);
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
			if( !empty($settings['layout']) ){
            include $this->get_template('category/' . $settings['layout'] . '.php');
        	}
		print '</div>';
	}
}

$widgets_manager->register_widget_type(new LNXElement_Course_category());
