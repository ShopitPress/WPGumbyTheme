<?php
	global $wpgumby_data, $post;
	if ( !is_front_page() && is_home() ){ $id = get_option( 'page_for_posts' );	} else { $id = $post->ID; }
	//http://docs.woothemes.com/document/useful-functions/
	if(get_post_type() == 'product'){ $id = woocommerce_get_page_id('shop'); }
	if(isset($wpgumby_data['camera_slider']) && is_array($wpgumby_data['camera_slider']) && get_post_meta($id, 'slider', true) == 'show' ){		
		$slides = $wpgumby_data['camera_slider'];
		if( !empty($wpgumby_data['slider_animation']) ) { $css = $wpgumby_data['slider_animation']; }
?>      
<div class="row home-animation">
<div class="twelve columns">
<input class="hidden" hidden="hidden" id="slider_resize" value="<?php echo $wpgumby_data['slider_resize']; ?>" />
<input class="hidden" hidden="hidden" id="slider_width" value="<?php echo $slides[0]['width']; ?>" />
<input class="hidden" hidden="hidden" id="slider_height" value="<?php echo $slides[0]['height']; ?>" />
	<div id="camera_wrap">
	<?php	  
		  foreach ($slides as $slide) {
				echo '<div data-src="' . $slide['image'] . '">';
				if( !empty($slide['title']) || !empty($slide['description']) ) {
					echo '<div class="camera_caption ' . $css . '">';
					if( !empty($slide['title']) ) { echo '<strong>' . $slide['title'] . '</strong>'; }
					if( !empty($slide['title']) && !empty($slide['description']) ) { echo ' &mdash; '; }
					if( !empty($slide['url']) ) { echo '<a href="' . $slide['url'] . '">'; }
					if( !empty($slide['description']) ) { echo $slide['description']; }
					if( !empty($slide['url']) ) { echo '</a>'; }
					echo '</div>';
				}
				echo '</div>';
		  }
	?>
	</div>
</div>
</div>
<script type="text/javascript">
	//Start Camera Slider
	jQuery('#camera_wrap').camera({
		height: 'auto',
		pagination: false,
		thumbnails: false,
	});
</script>
<?php } //end if ?>