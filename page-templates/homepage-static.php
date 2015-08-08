<?php
	global $wpgumby_data, $post;
	get_template_part( 'page-templates/camera', 'slider' );
?>
<?php if ($wpgumby_data['cta_text'] != "") { ?>
<div class="row call_to_action">
	<div class="twelve columns cta">
        <h4> <?php echo $wpgumby_data['cta_text']; ?> </h4>
        <?php if ($wpgumby_data['cta_link'] != "" && $wpgumby_data['cta_button'] != "") { ?>
            <div class="ctab"><div class="medium primary btn">
                <a href="<?php echo esc_url($wpgumby_data['cta_link']); ?>"<?php if ($wpgumby_data['cta_open'] == 1) { echo ' target="_blank"'; } ?> ><?php echo $wpgumby_data['cta_button']; ?></a>
            </div></div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if ($wpgumby_data['frontpage_lb'] != "" || $wpgumby_data['frontpage_cb'] != "" || $wpgumby_data['frontpage_rb'] != "") { ?>
<div class="row lb_cb_rb">
	<div class="four columns lb"><?php echo $wpgumby_data['frontpage_lb']; ?></div>
    <div class="four columns cb"><?php echo $wpgumby_data['frontpage_cb']; ?></div>
    <div class="four columns rb"><?php echo $wpgumby_data['frontpage_rb']; ?></div>
</div>
<?php } ?>
<div class="row content-home">
<?php

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
		
			echo "<div class=\"entry-content\">";
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpgumby' ) );
			echo "</div>";
		
		} //endwhile
	} //endif

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