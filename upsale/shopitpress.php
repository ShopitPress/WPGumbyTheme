<?php
/**
 * Menu admin class.
 *
 * @since 1.0.0
 *
 * @package sip_woocommerce_social_proof
 * @author  ShopitPress
 * @subpackage sip_woocommerce_social_proof/admin
 */
define('WP_GUMBY_VERSION', '1.0.8' );
define('WP_GUMBY_UTM_CAMPAIGN', 'wpgumby' );

if ( ! defined( 'SIP_PANEL' ) ) {
    define( 'SIP_PANEL' , TRUE);
    define( 'SIP_SP_PLUGIN', 'SIP Social Proof for WooCommerce' );
    define( 'SIP_WB_PLUGIN', 'SIP Front End Bundler for WooCommerce' );
    define( 'SIP_WR_PLUGIN', 'SIP Reviews Shortcode for WooCommerce' );
    define( 'SIP_WPGUMBY_THEME', 'WPGumby' );

    define( 'SIP_SP_PLUGIN_URL', 'https://shopitpress.com/plugins/sip-social-proof-woocommerce/' );
    define( 'SIP_WB_PLUGIN_URL', 'https://shopitpress.com/plugins/sip-front-end-bundler-woocommerce/' );
    define( 'SIP_WR_PLUGIN_URL', 'https://shopitpress.com/plugins/sip-reviews-shortcode-woocommerce/' );
    define( 'SIP_WPGUMBY_THEME_URL', 'https://shopitpress.com/themes/wpgumby/' );
}

class WPGhumby_Admin {

	/**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
	public function __construct() {
		
        // Build the custom admin page for managing addons, themes and licenses.
        add_action( 'admin_menu',  array( $this, 'sip_sp_custom_admin_menu' ) );		
 	}
            

	/**
     * Registers the admin menu for managing the ShopitPress options.
     *
     * @since 1.0.0
     */
    public function sip_sp_custom_admin_menu() {
	  
       //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        $this->hook = add_theme_page('ShopitPress Extras', '<span style="color:#FFFF00">ShopitPress Extras</span>', 'edit_theme_options', 'sip-themes-extras', array( $this, 'wpgumby_shopitpress_themes' ) );
        $this->hook = add_theme_page('Themes Support', 'Themes Support', 'edit_theme_options', 'http://shopitpress.com/community/' , '' );

        // Load global assets if the hook is successful.
        if ( $this->hook ) {
            // Enqueue custom styles and scripts.
            add_action( 'admin_enqueue_scripts',  array( $this, 'sip_sp_admin_assets' ) );            
        } 
	}
    

    /**
     * Loads assets for the settings page.
     *
     * @since 1.0.0
     */
    public function sip_sp_admin_assets() {
        wp_register_style( 'sip_gumby_custom_wp_admin_css', esc_url( get_template_directory_uri() .   '/upsale/assets/css/admin.css', false, '1.0.0' ) );
        wp_enqueue_style( 'sip_gumby_custom_wp_admin_css' );
    }

    /**
     * Outputs the main UI for handling and managing addons, themes and licenses.
     *
     * @since 1.0.0
     */
    public function wpgumby_shopitpress_themes() {

        $tabs = array( 
            'plugins'     => __( 'Plugins' ), 
            'themes'      => __( 'Themes' )
        );
        
        // Required for foreach
        if( !empty( $tabs ) && !is_array( $tabs ) ) { return; }
        
        // $_GET['page']
        $get_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
        
        // $_GET['tab']
        $get_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
        
        // Set current tab
        $current = isset( $_GET['tab'] ) ? $get_tab : key( $tabs );
        

        // Build out the necessary HTML structure.
        // Tabs HTML structure
        $admin_tabs = '<div id="icon-edit-pages" class="icon32"><br /></div>';
        $admin_tabs .= '<h2 class="nav-tab-wrapper">';
        
        foreach( $tabs as $tab => $name ) {
            
            // Current tab class
            $class      = ( $tab == $current ) ? ' nav-tab-active' : '';
            
            // Tab links
            $admin_tabs .= '<a href="?page='. $get_page .'&tab='. $tab .'" class="nav-tab'. $class .'">'. $name .'</a>';
        }

        $admin_tabs .= '</h2><br />';
        
        //echo $admin_tabs; /** use for do_action */
        echo $admin_tabs; /** use for echo function() */
        
        if( isset($_GET['tab']) ) {
            if ($_GET['tab'] == "themes")
            	include("ui/themes.php");
            else 
                include("ui/plugin.php");
           } else 
                include("ui/plugin.php");
    } // END menu_ui()	
		
}

$wpghumby_admin = new WPGhumby_Admin;
