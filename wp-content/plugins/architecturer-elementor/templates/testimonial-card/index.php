<?php
	$widget_id = $this->get_id();
	$slides = $this->get_settings('slides');
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
		
		$pagination = 0;
		if($settings['pagination'] == 'yes')
		{
			$pagination = 1;
		}
?>
<div class="tg_testimonials_card_wrapper" data-pagination="<?php echo intval($pagination); ?>" data-beginning-slide="<?php echo esc_attr($settings['beginning_slide']); ?>">
	<div class="slider">
		<ul>
<?php
		$counter = 1;
	
		foreach ($slides as $slide) 
		{
?>
			<li>
				<div class="testimonial-info">
	            	<?php
					 	if(!empty($slide['slide_title']))
					 	{
					?>
			         	<h3><?php echo esc_html($slide['slide_title']); ?></h3>
			        <?php
				        }
				    ?>
					<span class="rating">
			          	<i class="fa fa-star"></i>
					  	<i class="fa fa-star"></i>
					  	<i class="fa fa-star"></i>
					  	<i class="fa fa-star"></i>
					  	<i class="fa fa-star"></i>
					</span>
					<?php
					 	if(!empty($slide['slide_name']))
					 	{
					?>
			         	<div class="author"><?php echo esc_html($slide['slide_name']); ?></div>
			        <?php
				        }
				    ?>
	          	</div>
	          	<?php
		          	if(!empty($slide['slide_description']))
					{
				?>
					<p><?php echo esc_html($slide['slide_description']); ?></p>
				<?php
					}
				?>
			</li>
<?php
			$counter++;
		}
?>
		</ul>
	</div>
</div>
<?php
	}
?>