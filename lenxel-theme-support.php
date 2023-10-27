<?php

/**
 * Plugin Name: Lenxel Theme Support
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.0.0
 * Author: Lenxelthemes Team
 * Text Domain: lenxel-theme-support
 * Copyright: © 2023 Ogunlabs
 */

define('LENXEL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('LENXEL_PLUGIN_DIR', plugin_dir_path(__FILE__));


class Lenxel_Theme_Support{

   private static $instance = null;
   public static function instance()
   {
      if (is_null(self::$instance)) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public function __construct()
   {
      $this->include_files();
      $this->include_post_types();
      add_filter('single_template', array($this, 'lenxel_single_template'), 99, 1);

      add_action('wp_head', array($this, 'lenxelthemesupport_ajax_url'));
      add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
      add_action('admin_enqueue_scripts', array($this, 'register_scripts_admin'));
      register_activation_hook(__FILE__, array($this, 'lnx_create_page_activate'));
      load_plugin_textdomain('lenxel-theme-support', false, 'lenxel-theme-support/languages/');
      $this->lenxel_plugin_update();



   }

   function lnx_create_page_activate() {
      $page_title = 'Sign In';
      $shortcode = '[lnx_login_form_shortcode]';
      if(get_option('sign_in_id')==false){
         $arg = array(
            'post_title' => $page_title,
            'post_content' => $shortcode,
            'post_status' => 'publish',
            'post_type' => 'page',
         );
         $sign_in_page_id=wp_insert_post($arg);
         update_option('sign_in_id',$sign_in_page_id);
      }
   }

   public function lenxelthemesupport_ajax_url(){
     echo '<script> var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';


   }


   public function include_files()
   {
      require_once('redux/admin-init.php');
      require_once('includes/functions.php');
      require_once('includes/hook.php');
      require_once('elementor/init.php');
      require_once('sample/init.php');
      require_once('add-ons/form-ajax/init.php');
      require_once('widgets/recent_posts.php');
   }

   public function include_post_types()
   {
      require_once('posttypes/footer.php');
      require_once('posttypes/header.php');
      require_once('posttypes/team.php');
      require_once('posttypes/portfolio.php');
   }

   public function lenxel_single_template($lenxel_single_template)
   {
      global $post;
      $post_type = $post->post_type;
      if ($post_type == 'footer') {
         $lenxel_single_template = trailingslashit(plugin_dir_path(__FILE__) . 'templates') . 'single-builder-footer.php';
      }
      if ($post_type == 'lnx_header') {
         $lenxel_single_template = trailingslashit(plugin_dir_path(__FILE__) . 'templates') . 'single-builder-header.php';
      }
      return $lenxel_single_template;
   }

   public function register_scripts(){
      $js_dir = plugin_dir_url( __FILE__ ).'assets/js';
      wp_register_script('lenxel-theme-support', $js_dir.'/main.js', array('jquery'), null, true);
      wp_enqueue_script('lenxel-theme-support');
   }


   public function register_scripts_admin()
   {
      $css_dir = plugin_dir_url(__FILE__) . 'assets/css';
      wp_enqueue_style('lenxel-icons-custom', LENXEL_PLUGIN_URL . 'assets/icons/flaticon.css');
   }

   public function lenxel_plugin_update()
   {
      require 'plugin-update/plugin-update-checker.php';
      Puc_v4_Factory::buildUpdateChecker(
         'http://lenxel.ogunlabs.com/plugins/dummy_data/lenxel-theme-support-update-plugin.json',
         __FILE__,
         'lenxel-theme-support'
      );
   }
}

new Lenxel_Theme_Support();
