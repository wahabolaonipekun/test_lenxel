<?php
class Lenxel_Theme_Support_Header{
  public static $post_type = 'lnx_header';
  
  public static $instance;

  public static function getInstance() {
    if (!isset(self::$instance) && !(self::$instance instanceof Lenxel_Theme_Support_Header)) {
      self::$instance = new Lenxel_Theme_Support_Header();
    }
    return self::$instance;
  }

  public function __construct(){ 
    
  }

  public function register_post_type_header(){
    add_action('init', array($this, 'args_post_type_header'), 10);
  }

  public function args_post_type_header(){
    $labels = array(
      'name' => __( 'Header Builder', 'lenxelframework' ),
      'singular_name' => __( 'Header Builder', 'lenxelframework' ),
      'add_new' => __( 'Add Header Builder', 'lenxelframework' ),
      'add_new_item' => __( 'Add Header Builder', 'lenxelframework' ),
      'edit_item' => __( 'Edit Header', 'lenxelframework' ),
      'new_item' => __( 'New Header Builder', 'lenxelframework' ),
      'view_item' => __( 'View Header Builder', 'lenxelframework' ),
      'search_items' => __( 'Search Header Profiles', 'lenxelframework' ),
      'not_found' => __( 'No Header Profiles found', 'lenxelframework' ),
      'not_found_in_trash' => __( 'No Header Profiles found in Trash', 'lenxelframework' ),
      'parent_item_colon' => __( 'Parent Header:', 'lenxelframework' ),
      'menu_name' => __( 'Header Builder', 'lenxelframework' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => __('List Header', "lenxelthemesupport"),
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
        'capability_type'     => 'post'
    );
    register_post_type( self::$post_type, $args );
  }


  public function get_headers( $default = true ){
    $args = array(
      'post_type'         => 'lnx_header',
      'posts_per_page'   => 100,
      'numberposts'      => 100,
      'post_status'       => 'publish',
      'orderby'           => 'title',
      'order'             => 'asc'
    );
    $post_list = get_posts($args);
    $headers = array();
    if($default){
      $headers['__default_option_theme'] = esc_html__('Default Option Theme', 'lenxel-theme-support');
    }
    foreach ( $post_list as $post ) {
      $headers[$post->post_name] = $post->post_title;
    }
    wp_reset_postdata();
    return apply_filters('lenxelthemes_list_header', $headers );
  }

  public function render_header_builder($header_slug) {
    $header = get_page_by_path($header_slug, OBJECT, 'lnx_header');
    if ($header && $header instanceof WP_Post) {
      return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header->ID );
    }
  }
}

Lenxel_Theme_Support_Header::getInstance()->register_post_type_header();