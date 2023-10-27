<?php
if(!function_exists('lenxel_post_type_portfolio')  ){
    function lenxel_post_type_portfolio(){
      $labels = array(
          'name'               => __( 'Portfolios', "lenxelthemesupport" ),
          'singular_name'      => __( 'Portfolio', "lenxelthemesupport" ),
          'add_new'            => __( 'Add New Portfolio', "lenxelthemesupport" ),
          'add_new_item'       => __( 'Add New Portfolio', "lenxelthemesupport" ),
          'edit_item'          => __( 'Edit Portfolio', "lenxelthemesupport" ),
          'new_item'           => __( 'New Portfolio', "lenxelthemesupport" ),
          'view_item'          => __( 'View Portfolio', "lenxelthemesupport" ),
          'search_items'       => __( 'Search Portfolios', "lenxelthemesupport" ),
          'not_found'          => __( 'No Portfolios found', "lenxelthemesupport" ),
          'not_found_in_trash' => __( 'No Portfolios found in Trash', "lenxelthemesupport" ),
          'parent_item_colon'  => __( 'Parent Portfolio:', "lenxelthemesupport" ),
          'menu_name'          => __( 'Portfolios', "lenxelthemesupport" ),
      );

      $args = array(
          'labels'              => $labels,
          'hierarchical'        => true,
          'description'         => 'List Portfolio',
          'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt', 'post-formats'  ), 
          'taxonomies'          => array( 'portfolio_category','post_tag' ),
          'post-formats'        => false,
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'menu_position'       => 5,
          'show_in_nav_menus'   => true,
          'publicly_queryable'  => true,
          'exclude_from_search' => false,
          'has_archive'         => true,
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => array(
            'slug'  => 'portfolio'
          ),
          'capability_type'     => 'post'
      );
      $slug = apply_filters('lenxel-post-type/slug-portfolio', '');
      if($slug){
        $args['rewrite']['slug'] = $slug;
      }
      register_post_type( 'portfolio', $args );

      $labels = array(
        'name'              => __( 'Categories', "lenxelthemesupport" ),
        'singular_name'     => __( 'Category', "lenxelthemesupport" ),
        'search_items'      => __( 'Search Category', "lenxelthemesupport" ),
        'all_items'         => __( 'All Categories', "lenxelthemesupport" ),
        'parent_item'       => __( 'Parent Category', "lenxelthemesupport" ),
        'parent_item_colon' => __( 'Parent Category:', "lenxelthemesupport" ),
        'edit_item'         => __( 'Edit Category', "lenxelthemesupport" ),
        'update_item'       => __( 'Update Category', "lenxelthemesupport" ),
        'add_new_item'      => __( 'Add New Category', "lenxelthemesupport" ),
        'new_item_name'     => __( 'New Category Name', "lenxelthemesupport" ),
        'menu_name'         => __( 'Categories', "lenxelthemesupport" ),
      );
      // Now register the taxonomy
      register_taxonomy('category_portfolio',array('portfolio'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'show_in_nav_menus' =>false,
              'rewrite'           => array( 'slug' => 'category-portfolio'
          ),
      ));
  }
  add_action( 'init','lenxel_post_type_portfolio' );
  add_action( 'init', 'lenxel_portfolio_remove_post_type_support', 10 );
  function lenxel_portfolio_remove_post_type_support() {
    remove_post_type_support( 'portfolio', 'post-formats' );
  }
}

  function lenxelthemesupport_portfolio_query( $args ){
    $ds = array(
      'post_type'   => 'portfolio',
      'posts_per_page'  =>  12
    );

    $args = array_merge( $ds , $args );
    $loop = new WP_Query($args);

    return $loop;
  }

 
  function lenxelthemesupport_profolio_terms(){
    return get_terms( 'category_portfolio',array('orderby'=>'id') );
  }


  function lenxelthemesupport_portfolio_terms_related( $postId ){
    $output = array();
    
    $item_cats = get_the_terms( $postId, 'category_portfolio' );

    foreach((array)$item_cats as $item_cat){
      if( !empty($item_cats) && !is_wp_error($item_cats) ){
        $output[] = $item_cat->slug;
      }
    }
      
    return $output;
  }

  if(!function_exists('moniathemer_related_portfolio')){
    function lenxelthemesupport_related_portfolio($per_page){
      $terms = get_the_terms( get_the_ID(),  'category_portfolio' );
      $termids =array();
     
      if(!empty($terms) && !is_wp_error($terms)){
          foreach($terms as $term){
              if( is_object($term) ){
                 $termids[] = $term->term_id;
              }
          }
      }

      $args = array(
          'post_type' => 'portfolio',
          'posts_per_page' => $per_page,
          'post__not_in' => array( get_the_ID() ),
          'tax_query' => array(
              'relation' => 'AND',
              array(
                  'taxonomy' => 'category_portfolio',
                  'field' => 'id',
                  'terms' => $termids,
                  'operator' => 'IN'
              )
          )
      );
      $results = new WP_Query( $args );
      return $results;
    }
  }

  function lenxelframeworkPortfolioAutocompleteSuggester( $query ) {
    global $wpdb;
    $id = (int) $query;
    $query = trim( $query );
    $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title, post_type 
            FROM {$wpdb->posts}   
            WHERE post_type = 'portfolio' AND (ID = '%d' OR post_title LIKE '%%%s%%' )", $id > 0 ? $id : - 1, stripslashes( $query ) ), ARRAY_A );
    if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
      foreach ( $post_meta_infos as $value ) {
        $data = array();
        $data['value'] = $value['ID'];
        $data['label'] = __( 'Id', 'lenxelframework' ) . ': ' . $value['ID']  . __( ' - Title', 'lenxelframework' ) . ': ' . $value['post_title'];
        $result[] = $data;
      }
    }
    return $result;
  }

   function lenxelframeworkPortfolioAutocompleteRender( $query ) {
    $query = trim( $query['value'] ); 
    if ( ! empty( $query ) ) {
      $post_object = get_post( (int) $query );
      if ( is_object( $post_object ) ) {
        $post_title = $post_object->post_title();
        $post_id = $post_object->ID();
        $post_title_display = '';
        if ( ! empty( $post_title ) ) {
          $post_title_display = ' - ' . __( 'Title', 'lenxelframework' ) . ': ' . $post_title;
        }
        $post_id_display = __( 'Id', 'lenxelframework' ) . ': ' . $post_id;
        $data = array();
        $data['value'] = $post_id;
        $data['label'] = $post_id_display . $post_title_display;
        return ! empty( $data ) ? $data : false;
      }
      return false;
    }
    return false;
  }

// -- Dynamic Social Teacher Metabox -- 
  add_action( 'add_meta_boxes', 'lenxelthemesupport_portfolio_information' );
  add_action( 'save_post', 'lenxelthemesupport_portfolio_save_postdata' );
  function lenxelthemesupport_portfolio_information() {
      add_meta_box(
          'lenxelthemesupport_portfolio_information',
          __( 'Information', 'lenxelframework' ),
          'lenxelthemesupport_portfolio_inner_custom_box',
          'portfolio');
  }
  function lenxelthemesupport_portfolio_inner_custom_box() {
      global $post;
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_lenxelthemesupport_portfolio_noncename' );
      ?>
      <div id="meta_inner">
      <?php

      $pinformations = get_post_meta($post->ID, 'pinformations', true);

      $c = 0;
      if ( ($pinformations) && count( $pinformations ) > 0 ) {
          foreach( $pinformations as $information ) {
              if ( isset( $information['label'] ) || isset( $information['value'] ) ) {
                  printf( '<p><input size="40" type="text" placeholder="Label" name="pinformations[%1$s][label]" value="%2$s" /><input size="80" type="text" placeholder="Value" name="pinformations[%1$s][value]" value="%3$s" /><a class="button remove">%4$s</a></p>', $c, $information['label'], $information['value'], __( 'Remove' ) );
                  $c = $c +1;
              }
          }
      }

      ?>
  <span id="pinformations-list"></span>
  <a class="add-information-item"><?php _e('Add Information'); ?></a>
  <script>
      var $ =jQuery.noConflict();
      $(document).ready(function() {
          var count = <?php echo $c; ?>;
          $(".add-information-item").click(function() {
              count = count + 1;
              $('#pinformations-list').append('<p> <input size="40" type="text" placeholder="Label" name="pinformations['+count+'][label]" value="" /><input size="80" type="text" placeholder="Value" name="pinformations['+count+'][value]" value="" /> <a class="remove button">Remove</a></p>' );
              return false;
          });
          $(".remove").on('click', function() {
              $(this).parent().remove();
          });
      });
      </script>
  </div><?php
  }

  function lenxelthemesupport_portfolio_save_postdata( $post_id ) {
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
     if ( !isset( $_POST['dynamic_lenxelthemesupport_portfolio_noncename'] ) )
          return;

     if ( !wp_verify_nonce( $_POST['dynamic_lenxelthemesupport_portfolio_noncename'], plugin_basename( __FILE__ ) ) )
          return;
     $pinformations = $_POST['pinformations'];
     update_post_meta($post_id,'pinformations', $pinformations);
  }