<?php
if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Repeater;

/**
 * Class LNXElement_Gallery
 */
class LNXElement_Slider_Images extends LNXElement_Base{

	public function get_name() {
		return 'lnx-slider-images';
	}

	public function get_title() {
		return __('LNX Slider Images', 'lenxel-theme-support');
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
		return 'eicon-slider-push';
	}

	public function get_keywords() {
		return [ 'slider', 'images', 'carousel' ];
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

	protected function register_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Query & Layout', 'lenxel-theme-support'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();
      $repeater->add_control(
         'image',
         [
            'label'       => __('Image', 'lenxel-theme-support'),
            'type'        => Controls_Manager::MEDIA,
            'show_label' => false,
            'default'    => [
               'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-2.jpg',
            ]
         ]
      );
		$this->add_control(
         'images',
         [
            'label'       => __('Testimonials Content Item', 'lenxel-theme-support'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
            'default'     => array(
              	array(
                  'image'    => [
                     'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
                  ],
                  'title' => esc_html__('The New Future of architecture', 'lenxel-theme-support'),
              	),
               array(
                  'image'    => [
                     'url' => LENXEL_PLUGIN_URL . 'elementor/assets/images/image-2.jpg',
                  ],
                  'title' => esc_html__('The New Future of architecture', 'lenxel-theme-support'),
              	),
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
			'image_size',
			[
				'label'     => __('Style', 'lenxel-theme-support'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'lenxel_medium'
			]
		);
	
		$this->end_controls_section();

	}

	 protected function render() {
		  $settings = $this->get_settings_for_display();
		  printf( '<div class="lnx-element-%s lnx-element">', $this->get_name() );
			include $this->get_template('slider-images.php');
		  print '</div>'; 

	 }
}

$widgets_manager->register_widget_type(new LNXElement_Slider_Images());
