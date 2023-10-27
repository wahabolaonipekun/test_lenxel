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
class LNXElement_Course_learning extends LNXElement_Base {

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
		return 'lnx-learning';
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
		return __( 'LNX Continue Learning', 'lenxel-theme-support' );
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
		return [ 'course', 'filter', 'progress' ];
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
        $taxonomy = 'course-category';
        $tax_terms = get_terms( $taxonomy );
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
             'default' => 'grid',
             'options' => [
                 'grid'          => __( 'Grid', 'lenxel-theme-support' ),
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
      $this->add_control(
         'learning_per_page',
         [
            'label' => __( 'Course Per Page', 'lenxel-theme-support' ),
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
			'section_title_style',
			[
				'label' => __( 'Section Title', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-learning' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-heading .title-learning',
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
					'{{WRAPPER}} .gsc-heading .title-learning' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .gsc-heading .sub-title-learning' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_line_color',
			[
				'label' => __( 'Line Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title-learning:after' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .gsc-heading .sub-title-learning' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-heading .sub-title-learning',
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
                '{{WRAPPER}} .lns-style .image-cat-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                'separator' => 'before',
            ]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'learning_section_title_styless',
			[
				'label' => __( 'Learning Card Title', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'learning_title_color',
			[
				'label' => __( 'Learning Card Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .gsc-heading-learning .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_learning',
				'selector' => '{{WRAPPER}} .lns-style .gsc-heading-learning .title',
			]
		);
		$this->add_responsive_control(
			'learning_title_space',
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
					'{{WRAPPER}} .lns-style .gsc-heading-learning .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'learning_card_bg',
			[
				'label' => __( 'Learning Card BG Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .item-course .progress-card-bg-color' => 'background: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'learning_progress_bar',
			[
				'label' => __( 'Progress Bar', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'progress_bar',
			[
				'label' => __( 'Progress Bar Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .item-course .progress .progress-bar' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'learning_button_footer',
			[
				'label' => __( 'Button BG Color', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'learning-button_bg',
			[
				'label' => __( 'Learning Button BG Color ', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .item-course .tutor-course.tutor-course-loop .progress-card-bg-color .course-loop-footer .course-loop-hover' => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'learning_button_color',
			[
				'label' => __( 'Learning Button Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .item-course .tutor-course.tutor-course-loop .progress-card-bg-color .course-loop-footer .course-loop-hover .btn-purchase' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'lesson_section_title_styles',
			[
				'label' => __( 'Learning Lesson/Time', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'lesson_title_colors',
			[
				'label' => __( 'Learning Card Text Color', 'lenxel-theme-support' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lns-style .gsc-learning-lesson .title-lesson, .gsc-learning-lesson .title-lesson .tutor-meta-value' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_lesson',
				'selector' => '{{WRAPPER}} .lns-style .gsc-learning-lesson .title-lesson',
			]
		);
		$this->add_responsive_control(
			'lesson_title_space',
			[
				'label' => __( 'Lession/Duration Spacing', 'lenxel-theme-support' ),
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
					'{{WRAPPER}} .lns-style .course-loop-meta .learning-lesson' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'lesson_duration_space',
			[
				'label' => __( 'Lession/Duration Spacing', 'lenxel-theme-support' ),
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
					'{{WRAPPER}} .lns-style .course-loop-meta .learning-lesson' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .lns-style .gsc-heading .title-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .lns-style .gsc-heading .title-desc',
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
					'{{WRAPPER}} .lns-style .gsc-heading .title-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public static function get_query_args(  $settings, $in_post=array() ) {
        $defaults = [
            'orderby'         => 'date',
            'order'           => 'desc',
            'posts_per_page'  => 3,
            'offset'          => 0,
        ];
        $settings = wp_parse_args( $settings, $defaults );
        $query_args = [
            'post_type' => 'courses',
            'post__in' => $in_post,
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
        ];
     if(is_front_page()){
        $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
     }else{
        $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
     }

     return $query_args;
   }

    public function learning_query(){
        global $wpdb;
		$user_id = get_current_user_id();
        
        
		//$user_id    = $this->get_user_id( $user_id );
		$course_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT post_parent
			FROM 	{$wpdb->posts}
			WHERE 	post_type = %s
					AND post_status = %s
					AND post_author = %d
				ORDER BY post_date DESC;
			",
				'tutor_enrolled',
				'completed',
				$user_id
			)
		);
        return array_unique($course_ids);

    }

    public function query_posts() {
        $query_args = $this->get_query_args( $this->get_settings(), $this->learning_query() );
        $course_ids = $this->learning_query();
		if ( count( $course_ids ) ) {
        	$result = new WP_Query( $query_args );
			if(is_object($result) && is_array($result->posts)){

				// Sort courses according to the id list
				$new_array = array();

				foreach($course_ids as $id){
					foreach($result->posts as $post){
						$post->ID==$id ? $new_array[] = $post : 0;
					}
				}

				$result->posts = $new_array;
			}
			
			return $result;
		}
		return false;
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
                include $this->get_template('learning/' . $settings['layout'] . '.php');
        	}
		print '</div>';
	}
}

$widgets_manager->register_widget_type(new LNXElement_Course_learning());

