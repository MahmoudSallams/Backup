<?php
	$blog_featured_image_size = 'architecturer-gallery-list';
	
	if($counter == 1)
	{
?>
<div class="post_metro_left_wrapper">
<?php
	}
	else
	{
		$blog_featured_image_size = 'medium_large';
	}
?>
<?php
	if($counter == 2)
	{
		
?>
<div class="post_metro_right_wrapper layout_metro_masonry">
<?php
	}
?>
<!-- Begin each blog post -->
<div <?php post_class('blog-posts-'.$settings['layout']); ?>>

	<div class="post_wrapper">
		
		<?php
		    if(!empty($image_thumb))
		    {
		?>
		    <div class="post_img static">
			    <?php
					$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
				?>
			    <div class="post_img_hover <?php if(!empty($tg_enable_lazy_loading)) { ?>lazy<?php } ?>">
			     	<?php 
				     	$blog_featured_img_url = get_the_post_thumbnail_url($post_ID, $blog_featured_image_size); 
				     	$blog_featured_img_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), $blog_featured_image_size );
				     	$blog_featured_img_alt = get_post_meta(get_post_thumbnail_id($post_ID), '_wp_attachment_image_alt', true);
				     	$return_attr = architecturer_get_lazy_img_attr();
				     	
				     	if(!empty($blog_featured_img_url))
				     	{
				     ?>
				     <img <?php echo architecturer_get_blank_img_attr(); ?> <?php echo esc_attr($return_attr['source']); ?>="<?php echo esc_url($blog_featured_img_url); ?>" class="lazy_masonry" alt="<?php echo esc_attr($blog_featured_img_alt); ?>"/>
				     <?php
					     }
					?>
			     	<?php echo architecturer_get_post_format_icon($post_ID); ?>
			     	<a href="<?php the_permalink(); ?>"></a>
			    </div>
		    </div>
		<?php
		    }
		?>
	    
	    <div class="post_content_wrapper text_<?php echo esc_attr($settings['text_align']); ?>">
		    
		    <div class="post_header">
			    <?php
				  	if($settings['show_categories'] == 'yes') 
				  	{
				?>
			    <div class="post_detail single_post">
			    	<span class="post_info_cat">
						<?php
						   //Get Post's Categories
						   $post_categories = wp_get_post_categories($post_ID);
						   
						   $count_categories = count($post_categories);
						   $i = 0;
						   
						   if(!empty($post_categories))
						   {
						      	foreach($post_categories as $key => $c)
						      	{
						      		$cat = get_category( $c );
						?>
						      	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
						<?php
							   		if(++$i != $count_categories) 
							   		{
							   			echo '&nbsp;&middot;&nbsp;';
							   		}
						      	}
						   }
						?>
			    	</span>
			 	</div>
			 	<?php
				 	}
				?>
				<div class="post_header_title">
				    <h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				</div>
			</div>
	    
			<div class="post_header_wrapper">
				<?php
			    	switch($settings['text_display'])
			    	{
				    	case 'full_content':
				    		if($settings['strip_html'] == 'yes')
				    		{
					    		echo strip_tags(get_the_content());
				    		}
				    		else
				    		{
				    			echo get_the_content();
				    		}
				    	break;
				    	
				    	case 'excerpt':
				    		if($settings['strip_html'] == 'yes')
				    		{
					    		echo architecturer_limit_get_excerpt(strip_tags(get_the_excerpt()), $settings['excerpt_length']['size'], '...');
					    	}
					    	else
					    	{
				    			echo architecturer_limit_get_excerpt(get_the_excerpt(), $settings['excerpt_length']['size'], '...');
				    		}
				    	break;
			    	}
			    ?>
			    <?php
				  	if($settings['show_date'] == 'yes') 
				  	{
				?>
			    <div class="post_button_wrapper">
			    	<div class="post_attribute">
					    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo date_i18n(ARCHITECTURER_THEMEDATEFORMAT, get_the_time('U')); ?></a>
					</div>
			    </div>
			    <?php
				    }
				?>
			</div>
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->
<?php
	if($counter == 1)
	{
?>
</div>
<?php
	}
?>
<?php
	if($wp_query->current_post +1 == $wp_query->post_count)
	{
?>
</div><br class="clear"/>
<?php
	}
?>