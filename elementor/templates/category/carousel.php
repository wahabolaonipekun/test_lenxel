<?php
	$query = $this->query_category();
    $_random = lenxelthemesupport_random_id();
    if ( ! $query ) {
       return;
    }

	$this->add_render_attribute('wrapper', 'class', ['lnx-category-carousel lnx-category']);

	$this->add_render_attribute('wrapper', 'data-filter', $_random);

	$this->add_render_attribute('carousel', 'class', 'init-carousel-owl owl-carousel stag'.$_random);
    $style = (isset($settings['style'])) ? $settings['style'] : '' ;
  ?>
	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div <?php echo $this->get_render_attribute_string('carousel') ?> <?php echo 'stag'.$_random; ?><?php echo $this->get_carousel_settings() ?>>
                
                <?php
                    foreach ( $query as $category ): ?>
                        <?php
                        $category_count = 0;
                            if(((int)$settings['category_per_page'] > 0) && ((int)$settings['category_per_page'] <= $category_count)){
                                break;
                            }
                            $thumbnail = (isset($image_size) && $image_size) ? $image_size : 'post-thumbnail';
                            $column = (isset($settings['column'])) ? $settings['column'] : 4;
                             // get the thumbnail id using the queried category term_id
                            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true ); 
                    
                            // get the image URL
                            if((int) $thumbnail_id > 0){
                                $image = wp_get_attachment_url( $thumbnail_id ); 
                            }else{
                                $image = '';
                            }
                        ?>
                        <div class="category-grid<?= $column; ?>">
                            <a href="<?= get_category_link( $category->term_id ); ?>" class="image-cat-content cat-bg-img" style="background: lightgreen url('<?= $image; ?>') no-repeat center; background-size: cover; display: block;border-radius:5px;">
                                <div class="item-category gsc-heading">
                                    <p class="title"> <?= $category->name; ?></p>
                                </div>
                            </a>
    
                        </div>
                    
                       
                <?php $category_count++; endforeach; ?>
        </div>
	</div>
    <script>var owl = jQuery('.owl-carousel.stag<?= esc_html($_random); ?>');
                    owl.owlCarousel({
                        items:3,
                        loop:true,
                        margin:10,
                        autoplay:true,
                        navigation:true,
                        mouseDrag:true,
                        touchDrag:true,
                        autoplayTimeout:5000,
                        autoplayHoverPause:true,
                        responsive:{
                            0:{
                                items:1,
                                nav:true,
                                loop:true,
                                navRewind:true,
                                navigation:true,
                                autoplayHoverPause:true,
                            },
                            600:{
                                items:2,
                                nav:true,
                                loop:true,
                                navRewind:true,
                                navigation:true,
                                autoplayHoverPause:true,
                            },
                            1000:{
                                items:<?= esc_html($settings['category_per_page']); ?>,
                                nav:true,
                                loop:true,
                                navRewind:true,
                                navigation:true,
                                autoplayHoverPause:true,
                            }
                        },
                        autoplaySpeed:500
                    }); jQuery('.owl-carousel.stag<?= esc_html($_random ); ?> .owl-nav .owl-prev').html('<i class=\"las la-arrow-left\"></i>'); 
                    jQuery('.owl-carousel.stag<?=esc_html($_random); ?> .owl-nav .owl-next').html('<i class=\"las la-arrow-right\"></i>')</script> <style>
                    .owl-carousel.stag<?= esc_html($_random); ?> .owl-nav{display: block !important;}</style>
            
  <?php
  wp_reset_postdata();

?>
  