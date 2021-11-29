<?php
/*
Plugin Name: Gosofie Addon
Plugin URI: https://gosofie.com/
Description: Gosofie Addon.
Author: UnikForce
Author URI: https://unikforce.com
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'PLUG_DIR', dirname(__FILE__).'/' );
define('PLUG_URL', plugin_dir_url(__FILE__));

function cs_framework_init_check() {

    if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
         
          require_once PLUG_DIR .'/vendor/codestar-framework/codestar-framework.php';
          require_once PLUG_DIR .'/vendor/configstar/customiser.php';
          require_once PLUG_DIR .'/vendor/configstar/postmeta.php';
          require_once PLUG_DIR .'/vendor/configstar/profile.php';
          require_once PLUG_DIR .'/vendor/demo/index.php';
          
    }
 
    if( ! class_exists( 'GosoFie_Elementor_Addons' ) ) {
         
          require_once PLUG_DIR .'/gosofie-elements/index.php';
    }

}

add_action( 'plugins_loaded', 'cs_framework_init_check' );
require_once ( 'helper/customiser-extra.php' );
require_once ( 'helper/cpt.php' );

function gosofie_footer_select($type='') {

        $type = $type ? $type :'elementor_library';
        global $post;
        $args = array('numberposts' => -1,'post_type' => $type,);
        $posts = get_posts($args);  
        $categories = array(
        ''  => __( 'Select', 'tj-caracraft-core' ),
        );
        foreach ($posts as $pn_cat) {
            $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
        }
        return $categories;   
}
 
add_action( 'template_redirect', function() {
    $instance = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
    remove_action( 'template_redirect', [ $instance, 'block_template_frontend' ] ); 
}, 9 ); 

function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/',' class="dropdown-menu clearfix"',$menu);     
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 

?>