<?php global $wpgumby_data; ?>
<footer class="footer"> 
	<div class="row">
		<?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) ) : ?>          
		<?php
			switch($wpgumby_data['columns_footer_radio']){
				case '1':
					echo '<section class="row">';
					echo '<div class="twelve columns">';
					dynamic_sidebar( 'sidebar-3' );
					echo '</div></section>';
					break;
				case '2':
					echo '<section class="row">';
					echo '<div class="six columns">';
					dynamic_sidebar( 'sidebar-3' );
					echo '</div>';
					echo '<div class="six columns">';
					dynamic_sidebar( 'sidebar-4' );
					echo '</div></section>';
					break;
				case '3':
					echo '<section class="row">';
					echo '<div class="four columns">';
					dynamic_sidebar( 'sidebar-3' );
					echo '</div>';
					echo '<div class="four columns">';
					dynamic_sidebar( 'sidebar-4' );
					echo '</div>';
					echo '<div class="four columns">';
					dynamic_sidebar( 'sidebar-5' );
					echo '</div></section>';
					break;
				case '4':
					echo '<section class="row">';
					echo '<div class="three columns">';
					dynamic_sidebar( 'sidebar-3' );
					echo '</div>';
					echo '<div class="three columns">';
					dynamic_sidebar( 'sidebar-4' );
					echo '</div>';
					echo '<div class="three columns">';
					dynamic_sidebar( 'sidebar-5' );
					echo '</div>';
					echo '<div class="three columns">';
					dynamic_sidebar( 'sidebar-6' );
					echo '</div></section>';
					break;
			} ?>
		<?php endif; ?>    
    </div>
    <?php
	$spoz = $wpgumby_data['social_position'];
	if ($spoz == "footer") {
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
    <div class="copy">
        <p>
        <?php _e('Powered by', 'wpgumby'); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wpgumby' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'wpgumby' ); ?>">WordPress</a>. 
        <a href="<?php echo esc_url( __( 'https://shopitpress.com/themes/wpgumby/', 'wpgumby' ) ); ?>" target="_blank"><?php _e('WPGumby', 'wpgumby'); ?></a> Theme by 
        <a href="<?php echo esc_url( __( 'https://shopitpress.com/', 'wpgumby' ) ); ?>" target="_blank"><?php _e('ShopitPress', 'wpgumby'); ?></a>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>