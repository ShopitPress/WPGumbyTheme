<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div class="three columns widgets_sidebar">
    <?php
	global $wpgumby_data;
	$spoz = $wpgumby_data['social_position'];
	if ($spoz == "sidebar") {
		$sfp = esc_url($wpgumby_data['social_fp']);
		$sgp = esc_url($wpgumby_data['social_gp']);
		$stw = esc_url($wpgumby_data['social_tw']);
		$syt = esc_url($wpgumby_data['social_yt']);
		$spi = esc_url($wpgumby_data['social_pi']);
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '<div class="social_icons">'; }
		if ($sfp != "") { echo '<a href="' . $sfp . '" target="_blank"><i class="icon-facebook"></i></a>'; }
		if ($sgp != "") { echo '<a href="' . $sgp . '" target="_blank"><i class="icon-gplus"></i></a>'; }
		if ($stw != "") { echo '<a href="' . $stw . '" target="_blank"><i class="icon-twitter"></i></a>'; }
		if ($syt != "") { echo '<a href="' . $syt . '" target="_blank"><i class="icon-video"></i></a>'; }
		if ($spi != "") { echo '<a href="' . $spi . '" target="_blank"><i class="icon-pinterest"></i></a>'; }
		if ($sfp != "" || $sgp != "" || $stw != "" || $syt != "" || $spi != "") { echo '</div>'; }
	}
	?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
<?php endif; ?>