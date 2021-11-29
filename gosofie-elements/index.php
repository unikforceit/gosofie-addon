<?php

namespace GosofieAddon;
// Exit if accessed directly
/*use GosofieAddon\Controls\GosoFie_Control_Checkbox;*/

if (!defined('ABSPATH'))
    exit;
 
if (!class_exists('GosoFie_Elementor_Addons')) :

    /**
     * Main GosoFie_Elementor_Addons Class
     *
     */
    final class GosoFie_Elementor_Addons {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main GosoFie_Elementor_Addons Instance
         *
         * Insures that only one instance of GosoFie_Elementor_Addons exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {

            if (!isset(self::$instance) && !(self::$instance instanceof GosoFie_Elementor_Addons)) {

                self::$instance = new GosoFie_Elementor_Addons;

                self::$instance->setup_constants();

                self::$instance->includes();

                self::$instance->hooks();

            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'gosofie'), '1.6');
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'gosofie'), '1.6');
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin version
            if (!defined('AE_VERSION')) {
                define('AE_VERSION', '1');
            }

            // Plugin Folder Path
            if (!defined('AE_PLUGIN_DIR')) {
                define('AE_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('AE_PLUGIN_URL')) {
                define('AE_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            // Plugin Folder Path
            if (!defined('AE_ADDONS_DIR')) {
                define('AE_ADDONS_DIR', plugin_dir_path(__FILE__) . 'includes/widgets/');
            }

            // Plugin Folder Path
            if (!defined('LAE_ADDONS_URL')) {
                define('LAE_ADDONS_URL', plugin_dir_url(__FILE__) . 'includes/widgets/');
            }

        }

        /**
         * Include required files
         *
         */
        private function includes() {


            require_once AE_PLUGIN_DIR . 'includes/helper-functions.php';
            require_once AE_PLUGIN_DIR . 'includes/query-functions.php';
            require_once AE_PLUGIN_DIR . 'includes/template-lib.php';

        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {


        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {

            add_action('plugins_loaded', array(self::$instance, 'load_plugin_textdomain'));

            add_action('elementor/widgets/widgets_registered', array(self::$instance, 'include_widgets'));

            add_action('elementor/frontend/after_register_scripts', array($this, 'register_frontend_scripts'), 10);
            add_action('elementor/frontend/after_enqueue_styles', array($this, 'register_frontend_styles'), 10);

            add_action('elementor/init', array($this, 'add_elementor_category')); 

            add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'add_material_icons_tabs' ) ); 
            add_action( 'elementor/element/section/section_layout/after_section_end', array( $this, 'register_section' ), 10, 2 );
                            
        }

        public function register_section( $element, $args ) {

            $element->start_controls_section(
                'gosofie_parallax',
                array(
                    'label' => esc_html__( 'Parallax', 'niobis' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
                )
            );

            $element->add_control(
                'gosofie_parallax_on',
                array(
                    'label'        =>   esc_html__( 'Parallax', 'gosofie' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     =>   esc_html__( 'Yes', 'gosofie' ),
                    'label_off'    =>   esc_html__( 'No', 'gosofie' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'prefix_class' => 'gosofie-parallax',
                )
            );

            $element->end_controls_section();

        }
            
        public function add_material_icons_tabs( $tabs = array() ) {

            $tabs['gosofieicon'] = array(
                'name'          => 'gosofieicon',
                'label'         => esc_html__( 'Gosofie', 'gosofie' ),
                'labelIcon'     => 'flaticon-line',
                'prefix'        => 'flaticon-',
                'displayPrefix' => 'acprs',
                'url'           => AE_PLUGIN_URL . 'assets/css/gosofie/gosofie.css',
                'fetchJson'     => AE_PLUGIN_URL . 'assets/css/gosofie/fonts/gosofie.json',
                'ver'           => '3.0.1',
            );

            return $tabs;
        } 

        /**
         * Load Frontend Scripts
         *
         */
        public function register_frontend_scripts() {

            foreach( glob( PLUG_DIR. 'gosofie-elements/assets/js/*.js' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_script( $filename, AE_PLUGIN_URL . 'assets/js/'.$filename, array('jquery'), '', true);
            }

        }

        public function register_frontend_styles() {

            foreach( glob( PLUG_DIR. 'gosofie-elements/assets/css/*.css' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_style( $filename, AE_PLUGIN_URL . 'assets/css/'.$filename);
                wp_enqueue_style( 'gosofie-icon', AE_PLUGIN_URL . 'assets/css/gosofie/gosofie.css');
                wp_enqueue_style( 'gosofie-metrial-icon', 'https://fonts.googleapis.com/icon?family=Material+Icons');
            }
        }
        public function add_elementor_category() {
            \Elementor\Plugin::instance()->elements_manager->add_category(
                'gosofie-addons',
                array(
                    'title' => __('Gosofie Addons', 'gosofie'),
                    'icon' => 'fa fa-plug',
                ),
                1);
        }
        
        public function include_widgets($widgets_manager) {
            $widgets[] = '';
            foreach( glob( PLUG_DIR. 'gosofie-elements/includes/widgets/*' ) as $file ) {

                $widgets[] = substr($file, strrpos($file, '/') + 1);
            }

            if (is_array($widgets)){
                $widgets = array_filter($widgets);
                foreach ($widgets as $key => $value){
                    if (!empty($value)) {
                        require_once AE_ADDONS_DIR . ''.$value.'/index.php';
                    }
                    
                }

            }
                                                                    
        }

    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true GosoFie_Elementor_Addons
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $ae = AE(); ?>
 */
function GosoFie() {
    return GosoFie_Elementor_Addons::instance();
}

// Get LAE Running
GosoFie();





