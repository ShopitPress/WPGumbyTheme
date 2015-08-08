<?php get_header(); ?>
<?php
	
	global $wpgumby_data;
	$portfolio_on = $wpgumby_data['portfolio_on'];
	if (isset($wpgumby_data['portfolio_category'])) { $portfolio_category = $wpgumby_data['portfolio_category']; } else { $portfolio_category = ''; }
	if (isset($wpgumby_data['portfolio_page'])) { $portfolio_page = $wpgumby_data['portfolio_page']; } else { $portfolio_page = ''; }
	if(!empty($portfolio_on) && !empty($portfolio_category) && !empty($portfolio_page) && $portfolio_on == 1){
		$show_portfolio = 1;
	} else {
		$show_portfolio = 0;
	}
	
if ( is_home() ){
	
	// Default homepage
	get_template_part( 'page-templates/homepage', 'default' );
	
} elseif (is_front_page()){
	
	//Static homepage
	get_template_part( 'page-templates/homepage', 'static' );
	
} else {
	
	if($show_portfolio == 1) {
		//Single page
		if(get_post_type() == 'page' && !is_search() && !is_page($portfolio_page)){
			get_template_part( 'page-templates/page', 'single' );
		}
		//Portfolio page
		if(get_post_type() == 'page' && !is_search() && is_page($portfolio_page)){
			get_template_part( 'page-templates/page', 'portfolio' );
		}
	} else {
		//Single page w/o portfolio enabled
		if(get_post_type() == 'page' && !is_search()){
			get_template_part( 'page-templates/page', 'single' );
		}
	}

	//Blog single post
	if(get_post_type() == 'post' && is_single()){
		get_template_part( 'page-templates/blog', 'single_post' );
	}
	
	//Blog Archive
	if(get_post_type() == 'post' && is_archive()){
		get_template_part( 'page-templates/blog', 'archive' );
	}
	
	//Search results
	if(is_search()){
		get_template_part( 'page-templates/search', 'results' );
	}
	
	//Error page
	if(is_404()){
		get_template_part( 'page-templates/error', '404' );
	}
	
	//Attachment
	if(is_attachment()){
		get_template_part( 'page-templates/page', 'single' );
	}
		
	//TODO
	if (1 == 0) { 
		comment_form();
		the_post_thumbnail();
	}
}	

?>
<?php get_footer(); ?>