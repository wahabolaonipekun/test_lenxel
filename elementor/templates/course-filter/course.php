<?php
   $filter_order = $settings['filter_order'] == 'yes' ? 'order-disable' : ''; 
   $layout = 'filter-layout-top';
   if( $settings['layout'] == 'filter-layout-left'){
      $layout = 'course-filter-sidebar filter-layout-left';
   }else if($settings['layout'] == 'filter-layout-right'){
      $layout = 'course-filter-sidebar filter-layout-right';
   }

   $pagination = $settings['pagination'] == 'yes' ? 'enable-pagination' : 'disable-pagination';

   $this->add_render_attribute( 'block', 'class', ['el-course-filter', $filter_order, $layout, $pagination] );

   $course_filter = (bool) tutor_utils()->get_option('course_archive_filter', false);
   $supported_filters = tutor_utils()->get_option('supported_course_filters', array());
?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="content-inner">
         
         <?php if($course_filter && count($supported_filters)){ ?>
            <div class="tutor-widget-course-filter tutor-course-filter-wrapper tutor-wrap tutor-wrap-parent tutor-courses-wrap tutor-container course-archive-page" action-tutor-clear-filter>
               <div class="tutor-course-filter-container">
                  <?php //tutor_load_template('course-filter.filters'); ?>
                  <span class="filter-top"><a href="#" class="btn-close-filter"><i class="fas fa-times"></i></a></span>
                  <?php include $this->get_template('course-filter/filters.php'); ?>
               </div>
               <div class="filter-course-results clearfix">
                  <a href="#" class="btn-control-sidebar btn-theme"><i class="las la-bars"></i><?php echo esc_html__('Show Sidebar', 'lenxel-theme-support') ?></a>
                  <div class="<?php tutor_container_classes(); ?> tutor-course-filter-loop-container" data-column_per_row="<?php echo tutor_utils()->get_option( 'courses_col_per_row', 4 ); ?>">
                  
                        <?php include $this->get_template('course-filter/course-init.php'); ?>
                        
                        <?php
                        
                         ?>

                  </div><!-- .wrap -->
               </div>

  

               <div class="filter-sidebar-overlay"></div>
            </div>   
         <?php } ?>

      </div>
   </div>
