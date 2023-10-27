<?php
	$query = $this->query_posts();
	$_random = lenxelthemesupport_random_id();
	if ( ! $query->found_posts ) {
		return;
	}

	$this->add_render_attribute('wrapper', 'class', ['lnx-teams-carousel']);

	$this->add_render_attribute('wrapper', 'data-filter', $_random);

	$this->add_render_attribute('carousel', 'class', 'init-carousel-owl owl-carousel');
  
  ?>

	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div <?php echo $this->get_render_attribute_string('carousel') ?> <?php echo $this->get_carousel_settings() ?>>
			<?php
			  	global $post;
			  	$count = 0;
			  	while ( $query->have_posts() ) { 
			  	$query->the_post();
					$post->loop = $count++;
					$post->post_count = $query->post_count;
					set_query_var( 'settings', $settings );
					$this->lenxel_get_template_part('templates/content/item', $settings['style'], array(
					  	'thumbnail_size' => $settings['image_size'],
					  	'show_skills'	  => $settings['show_skills']
					));
			  	}
			?>
		</div>
	</div>
  <?php
  wp_reset_postdata();