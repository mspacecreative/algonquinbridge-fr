<?php

if ( ! function_exists( 'et_postinfo_meta' ) ) :
function et_postinfo_meta( $postinfo, $date_format, $comment_zero, $comment_one, $comment_more ){
	global $themename;

	$postinfo_meta = '';

	if ( in_array( 'author', $postinfo ) )
		$postinfo_meta .= ' ' . esc_html__('by',$themename) . ' ' . et_get_the_author_posts_link() . ' | ';

	if ( in_array( 'date', $postinfo ) )
		$postinfo_meta .= get_the_time( 'j/m/Y' ) . '  ';

	if ( in_array( 'categories', $postinfo ) )
		$postinfo_meta .= get_the_category_list(', ')  . ' | ';

	if ( in_array( 'comments', $postinfo ) )
		$postinfo_meta .= et_get_comments_popup_link( $comment_zero, $comment_one, $comment_more );

	echo $postinfo_meta;
}
endif;