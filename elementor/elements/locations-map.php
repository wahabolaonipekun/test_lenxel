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

class LNXElement_Locations_Map extends LNXElement_Base{

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
        return 'lnx-locations_map';
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
        return __('LNX Locations Map', 'lenxel-theme-support');
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
        return 'eicon-google-maps';
    }

    public function get_keywords() {
        return [ 'locations', 'content', 'map' ];
    }

    public function get_script_depends() {
      return [
         'gmap3',
         'google-maps-api',
         'map-ui',
      ];
    }

    public function get_style_depends() {
        return [];
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
            'section_locations',
            [
                'label' => __('Locations Content', 'lenxel-theme-support'),
            ]
        );
       
        $repeater = new Repeater();
        
        $repeater->add_control(
          'title',
          [
            'label'   => __('Location Title', 'lenxel-theme-support'),
            'default' => 'New York',
            'type'    => Controls_Manager::TEXT,
            'label_block' => true
          ]
        );
        $repeater->add_control(
          'content',
          [
              'label'       => __('Content', 'lenxel-theme-support'),
              'type'        => Controls_Manager::TEXTAREA,
              'placeholder' => '',
          ]
        );
        $repeater->add_control(
          'location_map',
          [
              'label'   => __('Latitude, Longitude', 'lenxel-theme-support'),
              'default' => '36.20485484481565,-115.20025440468748',
              'type'    => Controls_Manager::TEXT,
              'label_block' => true,
              'description' => esc_html__( 'Latitude, Longitude for Map, eg: 21.0173222,105.78405279999993', 'lenxel-theme-support' )
          ]
        );
        $repeater->add_control(
          'image',
          [
              'label'       => __('Choose Image', 'lenxel-theme-support'),
              'type'        => Controls_Manager::MEDIA,
              'default' => [
                  'url' => Elementor\Utils::get_placeholder_image_src(),
              ],
          ]
        );
        $repeater->add_control(
          'address',
          [
              'label'       => __('Address', 'lenxel-theme-support'),
              'type'        => Controls_Manager::TEXT,
              'placeholder' => '',
              'label_block' => true,
          ]
        );
        $repeater->add_control(
          'link',
          [
              'label'       => __('Link', 'lenxel-theme-support'),
              'type'        => Controls_Manager::URL,
          ]
        );

        $this->add_control(
            'locations',
            [
                'label'       => __('Location Content Item', 'lenxel-theme-support'),
                'type'        => Controls_Manager::REPEATER,
                 'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array(
                        'title'         => esc_html__( 'Singapore Office', 'lenxel-theme-support' ),
                        'content'       => 'Find all the entertainment you need for all ages on this island, where the fun doesn not cease and boredom retreats.',
                        'location_map'  => '36.20485484481565,-115.20025440468748',
                        'address'   => esc_html__( 'Bugis Junction Towers Singapore 188024', 'lenxel-theme-support' )
                    ),
                    array(
                        'title'         => esc_html__( 'Paris Office', 'lenxel-theme-support' ),
                        'content'       => 'Find all the entertainment you need for all ages on this island, where the fun doesn not cease and boredom retreats.',
                        'location_map'  => '36.14346850708669, -115.1650638224121',
                        'address'   => esc_html__( 'Office du Tourisme et des Congrès de Paris', 'lenxel-theme-support' )
                    ),
                   array(
                        'title'         => esc_html__( 'New York Office', 'lenxel-theme-support' ),
                        'content'       => 'Find all the entertainment you need for all ages on this island, where the fun doesn not cease and boredom retreats.',
                        'location_map'  => '36.100622034574165,-115.13605304970702',
                        'address'   => esc_html__( '2 Queen Street,California, USA', 'lenxel-theme-support' )
                    ),
                ),
            ]
        );

        $this->end_controls_section();
        
        $this->add_control_grid();

        // Style Box
        $this->start_controls_section(
            'section_style_box',
            [
                'label' => __('Box', 'lenxel-theme-support'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'box_background',
            [
                'label'     => __('Box Background', 'lenxel-theme-support'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lnx-locations-map .makers' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Title
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __('Title', 'lenxel-theme-support'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'lenxel-theme-support'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lnx-locations-map .makers .location-item .maker-item-inner .right .location-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .lnx-locations-map .makers .location-item .maker-item-inner .right .location-title',
            ]
        );

        $this->end_controls_section();

        // Style Content
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'lenxel-theme-support'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'content_color',
            [
                'label'     => __('Text Color', 'lenxel-theme-support'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .lnx-locations-map .makers .location-item .maker-item-inner .location-body' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .lnx-locations-map .makers .location-item .maker-item-inner .location-body',
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
        include $this->get_template('locations-map.php');
      print '</div>';
    }

}

$widgets_manager->register_widget_type(new LNXElement_Locations_Map());
