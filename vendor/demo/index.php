<?php

  if ( ! class_exists( 'gosofie_process_demo' ) ) {

	class gosofie_process_demo {

		private static $instance = null;

		private $plugin_url = null;

		private $plugin_path = null;
 
		public function __construct() {

			add_action( 'admin_print_scripts', array( $this, 'admin_scripts' ), 10 );
			add_action( 'admin_notices', array( $this, 'demo_import_notice' ), 10 );
			add_action( 'wp_ajax_gosofie_import_data', array( $this, 'gosofie_import_data' ), 10 );
			add_action( 'wp_ajax_gosofie_clean_data', array( $this, 'gosofie_clean_data' ), 10 );
			add_action( 'wp_ajax_gosofie_import_options', array( $this, 'gosofie_import_options' ), 10 );
		}

		public static function gosofie_clean_data(){

			global $wpdb;
			//delete posts
			$tables = ['commentmeta','comments','postmeta','posts','termmeta','terms','term_relationships','term_taxonomy'];

			foreach ( $tables as $table ) {
				$table  = $wpdb->prefix . $table;
				$wpdb->query( "TRUNCATE TABLE $table" );
			}

			$upload_dir = wp_upload_dir(date('Y/m'), true);
			$upload_dir['basedir'] = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $upload_dir['basedir']);
            gosofie_delete_upload_folder($upload_dir['basedir']);

		} 

		public static function gosofie_import_data(){

		    set_time_limit(0);
		    $demo_dir = $_POST['name'] ? $_POST['name'] : 'home-1';

		    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		    require_once GOSOFIE_DEMO_DIR .'/includes/vendor/wordpress-importer/wordpress-importer.php';
		       
		    $wp_import = new WP_Import();
		    $wp_import->fetch_attachments = true;
		    ob_start();  
		    $wp_import->import(GOSOFIE_DEMO_DIR .'/data/xml/'.$demo_dir.'/data.xml');
		    ob_end_clean();
		    update_option( 'gosofie_activedemo', $_POST['directory'] );
		    die();

		}  

		public static function gosofie_import_options(){

			$demo_dir = $_POST['name'] ? $_POST['name'] : 'home-1';
			$options_data = file_get_contents(GOSOFIE_DEMO_DIR .'/data/xml/'.$demo_dir.'/theme-option.txt');
		    $out = wp_kses_post_deep( json_decode( wp_unslash( trim( $options_data ) ), true ) );
		    update_option('gosofiedemo', $out );
		    update_option('page_on_front',$_POST['frontpage']);
		    update_option('show_on_front','page');
		    update_option('page_for_posts','30');
		    die();

		} 

		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
				self::$instance->constant();
				self::$instance->includes();
			}
			return self::$instance;
		}

        private function constant() {

            if (!defined('GOSOFIE_DEMO_DIR')) {
                define('GOSOFIE_DEMO_DIR', plugin_dir_path(__FILE__));
            }
            if (!defined('GOSOFIE_DEMO_BASE')) {
                define('GOSOFIE_DEMO_BASE', plugin_basename(__FILE__));
            }            
            if (!defined('GOSOFIE_DEMO_URL')) {
                define('GOSOFIE_DEMO_URL', plugin_dir_url(__FILE__));
            }

        }		

        public function includes(){
        	require( GOSOFIE_DEMO_DIR . 'includes/importer.php' );
        }

		public function admin_scripts() {

			if (isset($_GET['page']) && $_GET['page'] == 'gosofie-demo'){

		 		$data = array(
				   'ajax_url' => admin_url( 'admin-ajax.php' ),
				   'site_url' => home_url(),
				);				
				 wp_enqueue_script('gosofie_demo_admin', GOSOFIE_DEMO_URL.'assets/js/admin.js',array('jquery'), '', true);
				 wp_enqueue_style('gosofie_demo_admin', GOSOFIE_DEMO_URL.'assets/css/admin.css');
				 wp_localize_script('gosofie_demo_admin', 'gosofie', $data );
			 }
		}

		public function demo_import_notice(){

			if (isset($_GET['page']) && $_GET['page'] == 'gosofie-demo'){
			    ?>
			    <div class="notice notice-warning is-dismissible">
			        <p><?php _e( 'Please note that importing demo will erase all media files and content. Be sure to backup before importing demo', 'gosofie' ); ?></p>
			    </div>
			    <?php if ( class_exists( 'WP_Importer' ) ) { ?>

			    <div class="notice notice-error">
			        <p><?php _e( 'Please deactivate WordPress importer plugin to run demo import', 'gosofie' ); ?></p>
			    </div>

			   <?php }		

			}

		}

	} 
}

if ( ! function_exists( 'gosofie_process_demo' ) ) {

	function gosofie_process_demo() {
		return gosofie_process_demo::get_instance();
	}
}

gosofie_process_demo();

function gosofie_delete_upload_folder($path) {
    if(!empty($path) && is_dir($path) ){
        $dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS); 
        $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $f) {if (is_file($f)) {unlink($f);} else {$empty_dirs[] = $f;} } if (!empty($empty_dirs)) {foreach ($empty_dirs as $eachDir) {rmdir($eachDir);}} rmdir($path);
    }
}

$style = '
	@keyframes Gradient {
	  0%,
	  100% {
	    background-position: 0 50%
	  }
	  50% {
	    background-position: 100% 50%
	  }
	}

	a.toplevel_page_gosofie {
	  background:linear-gradient(-45deg, #EE7752, #E73C7E, #004fa0, #f3525a)!important;
	  animation: Gradient 15s ease infinite;
	  background-size: 400% 400%!important;
	  color: #fff!important;
	}
	.csf-wrapper .chosen-container{
	  width:100% !important;
	}
';
wp_register_style( 'gosofie-admin', false );
wp_enqueue_style( 'gosofie-admin' );
wp_add_inline_style( 'gosofie-admin', $style );
