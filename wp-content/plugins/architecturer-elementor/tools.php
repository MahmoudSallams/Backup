<?php
if(!function_exists('architecturer_get_lazy_img_attr'))
{
	function architecturer_get_lazy_img_attr()
	{
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
		$return_attr = array('class' => '','source' => 'src');
		
		if(!empty($tg_enable_lazy_loading))
		{
			$return_attr = array('class' => 'lazy','source' => 'data-src');
		}
		
		return $return_attr;
	}
}
	
if(!function_exists('architecturer_get_blank_img_attr'))
{
	function architecturer_get_blank_img_attr()
	{
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
		$return_attr = '';
		
		if(!empty($tg_enable_lazy_loading))
		{
			$return_attr = 'src=""';
		}
		
		return $return_attr;
	}
}

if(!function_exists('architecturer_get_post_format_icon'))
{
	function architecturer_get_post_format_icon($post_id = '')
	{
		$return_html = '';
		
		if(!empty($post_id))
		{
			$post_format = get_post_format($post_id);
			
			if($post_format == 'video')
			{
				$return_html = '<div class="post_type_icon"><i class="fa fa-play"></i></div>';	
			}
		}
		
		return $return_html;
	}
}

if(!function_exists('architecturer_limit_get_excerpt'))
{
	function architecturer_limit_get_excerpt($excerpt = '', $limit = 50, $string = '...')
	{
		$excerpt = preg_replace(" ([.*?])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
		$excerpt = $excerpt.$string;
		
		return '<p>'.$excerpt.'</p>';
	}
}

if(!function_exists('architecturer_get_image_id'))
{
	function architecturer_get_image_id($url) 
	{
		$attachment_id = attachment_url_to_postid($url);
		
		if(!empty($attachment_id))
		{
			return $attachment_id;
		}
		else
		{
			return $url;
		}
	}
}
 
function architecturer_attachment_field_credit ($form_fields, $post) {
	$form_fields['architecturer-purchase-url'] = array(
		'label' => esc_html__('Purchase URL', 'architecturer-elementor'),
		'input' => 'text',
		'value' => esc_url(get_post_meta( $post->ID, 'architecturer_purchase_url', true )),
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'architecturer_attachment_field_credit', 10, 2 );

function architecturer_attachment_field_credit_save ($post, $attachment) {
	if( isset( $attachment['architecturer-purchase-url'] ) )
update_post_meta( $post['ID'], 'architecturer_purchase_url', esc_url( $attachment['architecturer-purchase-url'] ) );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'architecturer_attachment_field_credit_save', 10, 2 );
?>