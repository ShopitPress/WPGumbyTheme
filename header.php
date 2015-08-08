<?php global $wpgumby_data; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en" itemscope itemtype="http://schema.org/Product"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"  <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;
?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if(isset($wpgumby_data['custom_favicon'])) { ?><link rel="shortcut icon" href="<?php echo $wpgumby_data['custom_favicon']['url']; ?>" type="image/x-icon" /><?php } ?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	switch($wpgumby_data['logotype']){
		case 'image':
			$logot = '<img src="'.$wpgumby_data['hidden_uploader']['url'].'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"/>';
			$logod = '';
			break;
		case 'site_title':
			$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
			$logod = '';
			break;
		case 'custom_text':
			$logot = '<h2>' . $wpgumby_data['hidden_custom_text'] . '</h2>';
			$logod = '';
			break;
		case 'site_title_description':
			$logot = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
			$logod = get_bloginfo( 'description');
			break;
		default:
			$logot = '';
			$logod = '';
			break;
	}
?>
	<div class="navbar clearfix" id="nav">
		<div class="row valign">
			<a class="toggle" gumby-trigger=".menu_block>div>ul" href="#"><i class="icon-menu"></i></a>
            <div class="logo">
                <div class="logo_block"
                <?php
                    if ($wpgumby_data['logo_margin'] != "" || $wpgumby_data['logo_padding'] != "") {
                        echo ' style="';
                        
                        if ($wpgumby_data['logo_margin'] != "") { echo 'margin:' . $wpgumby_data['logo_margin'] . ';'; }
                        if ($wpgumby_data['logo_padding'] != "") { echo 'padding:' . $wpgumby_data['logo_padding'] . ';'; }
                        
                        echo '"';
                    }
                
                ?>
                >
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $logot; ?></a>
                    <?php if ($logod != "") { echo '<span>' . $logod . '</span>'; } ?>
                </div>
			</div>
            <div class="menu_block">
			<?php wp_nav_menu(array(
					'theme_location'	=> 'primary',
					'menu_class'		  => '',
					'depth'           => 3,
					'walker'        => new WPGumby_Nav_Walker,
					)
				);
			?>
            </div>
		</div>
	</div>