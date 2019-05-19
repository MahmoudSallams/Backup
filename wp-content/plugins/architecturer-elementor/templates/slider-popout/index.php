<?php
	$widget_id = $this->get_id();
	$slides = $this->get_settings('slides');
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
?>
<div class="tg_popout_slide_container slider">
<?php
		$count = 1;
		$count_slide = count($slides);
		foreach ($slides as $slide) 
		{
?>
		<div class="slider__slide <?php if($count == 1) { ?>slider__slide--active<?php } ?>" data-slide="<?php echo intval($count); ?>">
		    <div class="slider__wrap">
		      <div class="slider__back" style="background-image:url(<?php echo esc_html($slide['slide_image']['url']); ?>);"></div>
		    </div>
		    <div class="slider__inner" style="background-image:url(<?php echo esc_html($slide['slide_image']['url']); ?>);">
			    <div class="slider__content">
			    	<?php
						if(!empty($slide['slide_title']))
						{
					?>
			        <h1><?php echo esc_html($slide['slide_title']); ?></h1>
			        <?php
						}
					?>
			        
			        <?php
				        if(!empty($slide['slide_description']))
						{
					?>
			        <p class="slider__desc"><?php echo esc_html($slide['slide_description']); ?></p>
			        <?php
				        }
				    ?>
				    <?php
						if(!empty($slide['slide_link']['url']))
						{
							$target = $slide['slide_link']['is_external'] ? 'target="_blank"' : '';
					?>
			        <a class="tg_popout_slide_link" href="<?php echo esc_url($slide['slide_link']['url']); ?>" <?php echo esc_attr($target); ?>><?php echo esc_html($slide['slide_link_title']); ?></a>
			        <?php
						}
					?>
					
					<?php
						if($count_slide > 1)
						{
					?>
			    	<br/><a class="go-to-next">next</a>
			    	<?php
				    	}
				    ?>
			    </div>
		    </div>
	  	</div>
<?php
			$count++;
		}
?>
</div>

<div class="slider__indicators"></div>
<?php
	}
?>