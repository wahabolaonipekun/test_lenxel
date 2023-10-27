<?php
  	$query = $this->query_posts();
  	$_random = lenxelthemesupport_random_id();
  	if ( ! $query->found_posts ) {
	 	return;
  	}

	$this->add_render_attribute('wrapper', 'class', ['event-layout-list clearfix']);
	
?>
  
  	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="lnx-content-items"> 
			<?php
				global $post;
				$count = 0;
				while ( $query->have_posts() ) { 
				  	$query->the_post();
				  	$post->loop = $count++;
				  	$post->post_count = $query->post_count;
				  	echo '<div class="event-list-item">';
					 	set_query_var( 'image_size', $settings['image_size'] );
					 	get_template_part('tribe-events/list/single', 'event' );
				  	echo '</div>';
				}
			?>
		</div>
		<?php if($settings['pagination'] == 'yes'): ?>
			<div class="pagination">
				<?php echo $this->pagination($query); ?>
			</div>
		<?php endif; ?>
  	</div>
  <?php

  wp_reset_postdata();