<?php
class Lenxel_Theme_Support_Footer{
  public static $post_type = 'footer';
  
  public static $instance;

  public static function getInstance() {
    if (!isset(self::$instance) && !(self::$instance instanceof Lenxel_Theme_Support_Footer)) {
      self::$instance = new Lenxel_Theme_Support_Footer();
    }
    return self::$instance;
  }

  public function __construct(){ 
    
  }

  public function register_post_type_footer(){
    add_action('init', array($this, 'args_post_type_footer'), 10);
  }

  public function args_post_type_footer(){
    $labels = array(
      'name' => __( 'Footer Builder', 'lenxelframework' ),
      'singular_name' => __( 'Footer Builder', 'lenxelframework' ),
      'add_new' => __( 'Add Footer Builder', 'lenxelframework' ),
      'add_new_item' => __( 'Add Footer Builder', 'lenxelframework' ),
      'edit_item' => __( 'Edit Footer', 'lenxelframework' ),
      'new_item' => __( 'New Footer Builder', 'lenxelframework' ),
      'view_item' => __( 'View Footer Builder', 'lenxelframework' ),
      'search_items' => __( 'Search Footer Profiles', 'lenxelframework' ),
      'not_found' => __( 'No Footer Profiles found', 'lenxelframework' ),
      'not_found_in_trash' => __( 'No Footer Profiles found in Trash', 'lenxelframework' ),
      'parent_item_colon' => __( 'Parent Footer:', 'lenxelframework' ),
      'menu_name' => __( 'Footer Builder', 'lenxelframework' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => __('List Footer', "lenxelthemesupport"),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'map_meta_cap'        => true
    );
    register_post_type( self::$post_type, $args );
  }



  public function get_footers(){
    $args = array(
      'post_type'        => 'footer',
      'posts_per_page'   => 100,
      'numberposts'      => 100,
      'post_status'     => 'publish',
    );
    $footers = array();
    $post_list = get_posts($args);
    foreach ( $post_list as $post ) {
      $footers[$post->post_name] = $post->post_title;
    }
    
    $footers['__default_option_theme'] = esc_html__('Default Option Theme', 'lenxel-theme-support');
    $footers['__disable_footer'] = esc_html__('Disable Footer', 'lenxel-theme-support');
    $footers['__default'] = __('Default Widget Footer', 'lenxel-theme-support');
    wp_reset_postdata();
    return apply_filters('lenxelthemes_list_footer', $footers );
  }

  public function render_footer_builder($footer_slug) {
    $footer = get_page_by_path($footer_slug, OBJECT, 'footer');
    if ($footer && $footer instanceof WP_Post) {
      return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer->ID );
    }
  }
}

Lenxel_Theme_Support_Footer::getInstance()->register_post_type_footer();