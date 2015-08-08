<?php get_template_part( 'page-templates/camera', 'slider' ); ?>
<?php if (function_exists('wpgumby_breadcrumbs')) { wpgumby_breadcrumbs(); } ?>
<div class="row content-page">
<?php
	global $wp_query, $wpgumby_data, $post;
	
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
?>
<?php
	
	$portfolio_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$portfolio_on = $wpgumby_data['portfolio_on'];
	$portfolio_category = $wpgumby_data['portfolio_category'];
	$portfolio_page = $wpgumby_data['portfolio_page'];
	
	if(!empty($portfolio_on) && !empty($portfolio_category) && !empty($portfolio_page) && $portfolio_on == 1){
		$show_portfolio = 1;
	} else {
		$show_portfolio = 0;
		return;
	}
	
	//Portfolio Filter
	echo "<div class=\"row\"><div class=\"twelve columns portfolio_filter\">";
	echo "<span class=\"portfolio_filter_title\">" . __('Filter:', 'wpgumby') . "</span>";
	echo "<ul id=\"portfolio_filter_options\">";
	echo "<li class=\"active\"><a href=\"#\" class=\"all\">" . __('All', 'wpgumby') . "</a></li>";
	
	function custom_posts_per_tag($id, $portfolio_category){
		$args = array();
		$the_query = new WP_Query( $args );
		wp_reset_query();
		return sizeof($the_query->posts);
	}
	
	$tags = wpgumby_get_category_tags(array( 'categories' => $portfolio_category ));
	
	foreach ($tags as $tag){
		if (custom_posts_per_tag($tag->tag_id, $portfolio_category) == 0) {
			echo '<li><a href="#" class="' . esc_html($tag->tag_slug) . '">' . esc_html($tag->tag_name) . '</a></li>';
		}
	}
	
	echo "</ul>";
	echo "</div></div>";
?>
<?php

	switch($wpgumby_data['p_layout']){
		case '2c-p':
			$portfolio_column_class = "six";
			break;
		case '3c-p': 
			$portfolio_column_class = "four";
			break;
		case '4c-p':
			$portfolio_column_class = "three";
			break;
		default:
			$portfolio_column_class = "four";
	}
	
	//portfolio posts per page
	$pppp = $wpgumby_data['portfolio_count'];
	if ($pppp == '') { $pppp = -1; }
	if (!is_numeric($pppp)) { $pppp = -1; }
	
	global $paged;
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$loop_args = array(
		'cat'	=> $portfolio_category,
		'paged' => $paged,
		'posts_per_page' => $pppp,
	);
	
	$portfolio_query = new WP_Query( $loop_args );
	if ( $portfolio_query->have_posts() ) {
		
	echo '<div class="row content-portfolio">';
	
	while( $portfolio_query->have_posts() ) {
		
		$portfolio_query->the_post();
		$ptags = false;
		$tag_names = wp_get_post_tags( get_the_ID(), array( 'fields' => 'slugs' ) );
		foreach ($tag_names as $tagnames) { $ptags .= $tagnames . ' '; }

?>
    	<div class="portfolio-grid-block <?php echo $portfolio_column_class; ?> columns <?php echo $ptags; ?>">
            <div class="caption">
            	<?php
					
					$portfolio_large_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
					$portfolio_thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-thumb');
					$blank_post_image = get_stylesheet_directory_uri() . '/images/blank_grey.gif';
					
					if ($portfolio_thumb_image[0] == '' || $portfolio_large_image[0] == ''){
						$resize_thumb_dimensions = ' width="300" height="300" ';
						echo '<div class="hover-icon"><i class="icon-camera big_white"></i></div>';
						$thumb_image = $blank_post_image;
					} else {
						$resize_thumb_dimensions = '';
						echo '<div class="hover-icon"><a class="fancybox" rel="gallery" title="" href="' . $portfolio_large_image[0] . '"><i class="icon-search"></i></a></div>';
						$thumb_image = $portfolio_thumb_image[0];
					}
					
				?>
                <p><a href="<?php echo get_permalink( get_the_ID() ); ?>" class=""><?php the_title(); ?></a></p>
            </div>
            <?php
                echo '<img class="img-responsive" src="' . $thumb_image . '"' . $resize_thumb_dimensions . '>';
            ?>
		</div>

<?php

	} //endwhile
	
	echo '</div>'; //row content-portfolio
	
	
	$previous_posts = get_previous_posts_link( '<i class="icon-left-open"></i> ' . __( 'Newer posts', 'wpgumby' ), $portfolio_query->max_num_pages );
	$next_posts = get_next_posts_link( __( 'Older posts', 'wpgumby' ) . ' <i class="icon-right-open"></i>', $portfolio_query->max_num_pages );
	
	if (!empty( $previous_posts ) || !empty( $next_posts )){
		echo '<div class="row content-portfolio">';
		echo '<div class="entry-meta-nav">';
	
		if (!empty( $previous_posts )):
			echo '<div class="medium btn pill-left secondary">';
			echo $previous_posts;
			echo '</div> ';
		endif;
		
		if (!empty( $next_posts )):
			echo ' <div class="medium btn pill-right secondary">';
			echo $next_posts;
			echo '</div>';
		endif;
		
		echo '</div>';
		echo '</div>';
	}
	
	} //endif
	
	wp_reset_postdata();
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