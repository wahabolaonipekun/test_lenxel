<?php
if(!function_exists('lenxelthemesupport_random_id')){
  function lenxelthemesupport_random_id($length=4){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
  }
}  

function lenxelthemesupport_get_select_term( $taxonomy ) {
  global $wpdb;
  $cats = array();
  $query = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = '{$taxonomy}' and b.parent = 0";

  $categories = $wpdb->get_results($query);
  $cats['Choose Category'] = '';
  foreach ($categories as $category) {
     $cats[html_entity_decode($category->name, ENT_COMPAT, 'UTF-8')] = $category->slug;
  }
  return $cats;
}

  
function lenxel_theme_support_get_theme_option($key, $default = ''){
  $lenxel_theme_options = get_option( 'lenxel_theme_options' );
  if(isset($lenxel_theme_options[$key]) && $lenxel_theme_options[$key]){
     return $lenxel_theme_options[$key];
  }else{
     return $default;
  }
  return false;
}