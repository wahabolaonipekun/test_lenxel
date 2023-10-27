<?php
   if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly.
   }
   use Elementor\Group_Control_Image_Size;
?>
   
<?php if( $settings['style'] == 'style-4' ){ 

   $this->add_render_attribute('wrapper', 'class', ['lnx-testimonial-carousel' , $settings['style'] ]);
   $this->add_render_attribute('carousel', 'class', ['init-carousel-owl owl-carousel']);

   ?>
   <style>
     .resize-height .owl-carousel .owl-stage-outer,.resize-height .owl-carousel .owl-stage,.resize-height .owl-carousel.owl-drag .owl-item{
         height:100%;
      }
   </style>
   <div class="row">
      <div class="col-md-6">
         <div class="current-slide"></div>        
      </div>
      <div class="col-md-6 resize-height" style="height:inherit;">
         <div <?php echo $this->get_render_attribute_string('wrapper'); ?> style="height:100%;">
            <div <?php echo $this->get_render_attribute_string('carousel') ?> <?php echo $this->get_carousel_settings() ?> style="height:100%;">
               <?php
               foreach ($settings['testimonials'] as $testimonial): ?>
                  <?php 
                     $avatar = (isset($testimonial['testimonial_image']['url']) && $testimonial['testimonial_image']['url']) ? $testimonial['testimonial_image']['url'] : '';
                  ?>
                  <div class="item" style="height:100%">
                     <div class="testimonial-item" style="height:100%">
                        <div class="testimonial-item-content" style="height:100%">
                           <div class="testimonial-meta" style="height:100%;width: 100%;overflow: hidden;">
                              <div class="testimonial-image" style="height:100%;width: 110%;">
                                 <img src="<?php echo esc_url($avatar) ?>" alt="<?php echo $testimonial['testimonial_name']; ?>" style="height:100%;" />
                                 <div class="content-profile" style="padding: 20px; display:none;">
                                 <div class="tutor-loop-rating-wrap">
                                    <div class="tutor-ratings-stars">
                                       <i class="tutor-icon-star-<?= ((int)$testimonial['testimonial_rating'] >= 1) ? 'bold' : 'line'; ?>" data-rating-value="1"></i>
                                       <i class="tutor-icon-star-<?= ((int)$testimonial['testimonial_rating'] >= 2) ? 'bold' : 'line'; ?>" data-rating-value="2"></i>
                                       <i class="tutor-icon-star-<?= ((int)$testimonial['testimonial_rating'] >= 3) ? 'bold' : 'line'; ?>" data-rating-value="3"></i>
                                       <i class="tutor-icon-star-<?= ((int)$testimonial['testimonial_rating'] >= 4) ? 'bold' : 'line'; ?>" data-rating-value="4"></i>
                                       <i class="tutor-icon-star-<?= ((int)$testimonial['testimonial_rating'] >= 5) ? 'bold' : 'line'; ?>" data-rating-value="5"></i>
                                    </div>
                                    </div>
                                    <?php if($testimonial['testimonial_title']){ ?>
                                       <div class="testimonial-title">
                                          <?php echo esc_html($testimonial['testimonial_title']) ?>
                                       </div>
                                    <?php } ?>
                                       <div class="testimonial-content">
                                          <?php  echo $testimonial['testimonial_content']; ?>
                                       </div>
                                       <div class="testimonial-information">
                                          <span class="testimonial-name"><?php echo $testimonial['testimonial_name']; ?></span>
                                       </div>
                                       <div class="testimonial-information2">
                                          <span class="testimonial-job"><?php echo $testimonial['testimonial_job']; ?></span>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </div>   
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
      </div>
      <script>
         var getEachSlide = setInterval(function () {var slideContent = jQuery('.resize-height .owl-stage-outer .owl-item.active.first .content-profile').html(); jQuery('.current-slide').html(slideContent)}, 1000);
      </script>
   </div>
   <?php
}