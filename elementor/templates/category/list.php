<?php
    $query = $this->query_category();
    $_random = lenxelthemesupport_random_id();
    if ( ! $query ) {
       return;
    }
   $this->add_render_attribute('wrapper', 'class', ['lnx-course-list clearfix lnx-course']);

?>
  
  <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div class="lnx-content-items"> 
        <div class="list-course-content">
          <?php
                $count = 0;
				foreach ( $query as $category ) { 

                    $thumbnail = (isset($image_size) && $image_size) ? $image_size : 'post-thumbnail';
                    $column = (isset($settings['column'])) ? $settings['column'] : 3;
                ?>
                   <div class="item">
                        <a href="<?= get_category_link( $category->term_id ); ?>" class="image-cat-content cat-list-img" style="">
                            <div class="item-category gsc-heading">
                                <p class="title"> <?= $category->name; ?></p>
                            </div>
                        </a>

                    </div>
                <?php    
                }
          ?>
        </div>
      </div>
      <?php if($settings['pagination'] == 'yes'): ?>
          <div class="pagination">
              <?php echo $this->pagination($query); ?>
          </div>
      <?php endif; ?>
  </div>
  <?php

  wp_reset_postdata();

  