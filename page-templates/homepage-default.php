<?php get_template_part( 'page-templates/camera', 'slider' ); ?>
<div class="row content-home">
<?php
	global $wpgumby_data, $post;
	if ( !is_front_page() && is_home() ){ $id = get_option( 'page_for_posts' );	} else { $id = $post->ID; }
	if (get_post_meta($id, 'p_sidebar', true) != '') {
		$custom_layout = get_post_meta($id, 'p_sidebar', true);
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
?>
<?php
	
	$portfolio_on = $wpgumby_data['portfolio_on'];
	if (isset($wpgumby_data['portfolio_category'])) { $portfolio_category = $wpgumby_data['portfolio_category']; } else { $portfolio_category = ''; }
	if (isset($wpgumby_data['portfolio_remove'])) { $portfolio_remove = $wpgumby_data['portfolio_remove']; } else { $portfolio_remove = ''; }
	if (isset($wpgumby_data['portfolio_page'])) { $portfolio_page = $wpgumby_data['portfolio_page']; } else { $portfolio_page = ''; }
	
	if(!empty($portfolio_on) && !empty($portfolio_category) && !empty($portfolio_remove) && !empty($portfolio_page) && $portfolio_on == 1 && $portfolio_remove == 1 && is_numeric($portfolio_category)){
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts(array(
			'cat' 	=> ($portfolio_category * (-1)),
			'paged'	=> $paged
		));
	}	
	
	if ( have_posts() ) {
		while ( have_posts() ) {
		the_post();
			
			get_template_part( 'page-templates/blog', 'list_of_posts' );
			
		}
		
		get_template_part( 'page-templates/blog', 'navigation' );
		
	} else {
	
		echo "<h1 class=\"entry-title\">" . __( 'Nothing Found', 'wpgumby' ) . "</h1>";
		printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wpgumby' ), admin_url( 'post-new.php' ) );
		
	}
?>
<?php
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