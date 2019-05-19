<?php
//Required password to comment
if ( post_password_required() ) { ?>
	<p><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'architecturer' ); ?></p>
<?php
	return;
}
?>
<?php 
//Display Comments
if( have_comments() ) : ?> 

<h3 class="comment_title"><?php comments_number(esc_html__( 'Leave A Reply', 'architecturer' ), esc_html__( '1 Comment', 'architecturer' ), '% '.esc_html__( 'Comments', 'architecturer' )); ?></span></h3><br class="clear"/>
<div>
	<a name="comments"></a>
	<?php wp_list_comments( array('callback' => 'architecturer_comment', 'avatar_size' => '40') ); ?>
</div>

<!-- End of thread -->  
<div style="height:10px"></div>

<?php endif; ?> 


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

<div class="pagination"><p><?php previous_comments_link(esc_html__( 'Previous', 'architecturer' )); ?> <?php next_comments_link(esc_html__( 'Next', 'architecturer' )); ?></p></div><br class="clear"/>

<?php endif; // check for comment navigation ?>


<?php 
//Display Comment Form
if ('open' == $post->comment_status) : ?> 

<?php 
	$args = array(
		'title_reply' => esc_html__( 'Leave A Reply', 'architecturer' ),
 
        'comment_field' => '<p class="comment-form-comment input_wrapper"><label for="comment">' .esc_html__( 'Comment', 'architecturer' ). '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="input_effect"></textarea><span class="focus-border"></span></p>',
 
  'fields' => apply_filters( 'comment_form_default_fields', array(
 

 
    'author' =>
 
      '<p class="comment-form-author input_wrapper">' .
 
      '<label for="author">' .esc_html__( 'Name', 'architecturer' ). '</label> ' .
 
      ( $req ? '<span class="required">*</span>' : '' ) .
 
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
 
      '" size="30" aria-required="true" class="input_effect" /><span class="focus-border"></span></p>',
 

 
    'email' =>
 
      '<p class="comment-form-email input_wrapper"><label for="email">' .esc_html__( 'Email', 'architecturer' ). '</label> ' .
 
      ( $req ? '<span class="required">*</span>' : '' ) .
 
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30" aria-required="true" class="input_effect" /><span class="focus-border"></span></p>',
 

 
    'url' =>
 
      '<p class="comment-form-url input_wrapper"><label for="url">' .
 
      esc_html__( 'Website', 'architecturer' ). '</label>' .
 
      '<input id="url" name="url" type="text" value="' .esc_attr( $commenter['comment_author_url'] ).'" size="30" class="input_effect" /><span class="focus-border"></span></p>'
 
    )
 
),
 
);
 
comment_form( $args );
?>
			
<?php endif; ?>