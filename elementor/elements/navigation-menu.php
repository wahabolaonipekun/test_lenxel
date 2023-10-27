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
class LNXElement_Navigation_Menu extends LNXElement_Base {

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
		return 'lnx-navigation-menu';
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
		return __( 'LNX Navigation Menu', 'lenxel-theme-support' );
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
		return 'eicon-nav-menu';
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
		return [ 'menu', 'navigation' ];
	}

	public function get_all_menus(){
	   $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
	   $results = array();
	   foreach ($menus as $key => $menu) {
	   	$results[$menu->slug] = $menu->name;
	   }
	   return $results;
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
			'menu',
			[
				'label' 			=> __( 'Menu', 'lenxel-theme-support' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> $this->get_all_menus(),
				'label_block' 	=> true,
				'default'		=> 'main-menu'
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'lenxel-theme-support' ),
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
			'sub_menu_min_width',
			[
				'label' => __( 'Submenu Min Width (px)', 'lenxel-theme-support' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 250,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li .submenu-inner, .lnx-navigation-menu ul.lnx-nav-menu > li ul.submenu-inner' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
	
		$this->end_controls_section();

		//Styling Main Menu
		$this->start_controls_section(
			'section_main_menu_style',
			[
				'label' => __( 'Main Menu', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		//Tabs Styling Normal, Hover, Active
      $this->start_controls_tabs('tabs_main_menu_style');

      $this->start_controls_tab(
         'main_menu_style_normal',
         [
            'label' => __('Normal', 'lenxel-theme-support'),
         ]
      );
      $this->add_control(
         'main_menu_text_color',
         [
            'label'     => __('Text Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->add_control(
         'main_menu_color',
         [
            'label'     => __('Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li > a' => 'color: {{VALUE}}',
            ],
         ]
      );
      $this->end_controls_tab();

      $this->start_controls_tab(
         'main_menu_hover',
         [
            'label' => __('Hover', 'lenxel-theme-support'),
         ]
      );
      $this->add_control(
         'main_menu_hover_color',
         [
            'label'     => __('Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li > a:hover' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->end_controls_tab();

      $this->start_controls_tab(
         'main_menu_active',
         [
            'label' => __('Active', 'lenxel-theme-support'),
         ]
      );
      $this->add_control(
         'main_menu_active_color',
         [
            'label'     => __('Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li.current_page_parent > a' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->end_controls_tab();

      $this->end_controls_tabs();

      $this->add_control(
         'menu_top_line_color',
         [
            'label'     => __('Top Line Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} ul.lnx-nav-menu > li > a .menu-title:after' => 'background-color: {{VALUE}}', 
            ],
         ]
      );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li > a',
			]
		);

		$this->add_responsive_control(
			'main_menu_padding',
			[
				'label' => __( 'Menu Item Padding', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .lnx-navigation-menu ul.lnx-nav-menu > li > a' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
				],
			]
		);

		$this->end_controls_section();

		//Styling Sub Menu
		$this->start_controls_section(
			'section_sub_menu_style',
			[
				'label' => __( 'Sub Menu', 'lenxel-theme-support' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Tabs Styling Normal, Hover, Active
      $this->start_controls_tabs('tabs_sub_menu_style');

      $this->start_controls_tab(
         'sub_menu_style_normal',
         [
            'label' => __('Normal', 'lenxel-theme-support'),
         ]
      );
      $this->add_control(
         'sub_menu_text_color',
         [
            'label'     => __('Text Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->add_control(
         'sub_menu_color',
         [
            'label'     => __('Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner a' => 'color: {{VALUE}}',
            ],
         ]
      );
      $this->end_controls_tab();

      $this->start_controls_tab(
         'sub_menu_hover',
         [
            'label' => __('Hover', 'lenxel-theme-support'),
         ]
      );
      
      $this->add_control(
         'sub_menu_hover_color',
         [
            'label'     => __('Link Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner a:hover' => 'color: {{VALUE}}', 
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner a:active' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->end_controls_tab();

      $this->start_controls_tab(
         'sub_menu_active',
         [
            'label' => __('Active', 'lenxel-theme-support'),
         ]
      );
      $this->add_control(
         'sub_menu_active_color',
         [
            'label'     => __('Color', 'lenxel-theme-support'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner li.current_page_parent a:hover' => 'color: {{VALUE}}', 
            ],
         ]
      );
      $this->end_controls_tab();

      $this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_2',
				'selector' => '{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner li a',
			]
		);

		$this->add_responsive_control(
			'sub_menu_padding',
			[
				'label' => __( 'Menu Item Padding', 'lenxel-theme-support' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .lnx-navigation-menu ul.lnx-main-menu .submenu-inner li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        include $this->get_template('navigation-menu.php');
      print '</div>';
	}
}

$widgets_manager->register_widget_type(new LNXElement_Navigation_Menu());
