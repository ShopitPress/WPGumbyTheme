<?php get_template_part( 'page-templates/camera', 'slider' ); ?>
<?php if (function_exists('wpgumby_breadcrumbs')) { wpgumby_breadcrumbs(); } ?>
<div class="row content-page">
<?php
	
	global $wpgumby_data, $post;
	if (get_post_meta($post->ID, 'p_sidebar', true) != '') {
		$custom_layout = get_post_meta($post->ID, 'p_sidebar', true);
	} else {
		$custom_layout = $wpgumby_data['layout'];
	}

	switch($custom_layout){
		case '2c-l':
			get_sidebar();
			echo '<div class="nine columns pl20">';
			break;
		case '2c-r':
			echo '<div class="nine columns pr20">';
			break;
		default:
			echo '<div class="twelve columns">';
	}

	if ( have_posts() ) {
		while ( have_posts() ) {
		the_post();
		
			get_template_part( 'page-templates/post', 'single' );
			comments_template('', true);
		
		} //endwhile
	} //endif;

	switch($custom_layout){
		case '2c-l':
			echo '</div>';
			break;
		case '2c-r':
			echo '</div>';
			get_sidebar();
			break;
		default:
			echo '</div>';
	}
?>
</div>