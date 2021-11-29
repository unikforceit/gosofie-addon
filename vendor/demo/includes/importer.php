<?php

class gosofie_setup_demo_menu {

	private $importer_page = 'gosofie-demo';

	private $tabs;

	public final function get_tabs() {
		return $this->tabs;
	}

	public function admin_pages() {

		$temp = 'Demo Import';
		add_submenu_page(
			'gosofie-options',
			$temp,
			$temp,
			'manage_options',
			$this->importer_page,
			[ $this, 'display_import_page' ]
		);
	}

	public function display_import_page() {
		$current_demo = get_option('gosofie_activedemo');
		$demos=[
			[
			'id' => 'home-1',
			'dir' => 'home-1',
			'front' => '28',
			'url'=>'#'
			],
		];

		foreach($demos as $demo) {
			$id = $demo['id'];
			$screenshot = GOSOFIE_DEMO_URL . 'data/xml/'.$demo['dir'].'/screenshot.png';
			$title = ucwords(str_replace("-", " ", $demo['dir']));
			$current = $demo['dir']==$current_demo ? '<span class="demo-trend">Active</span>' : '';
			$out.='
	    		<div class="demo">
	    			<img class="xlspinner" src="'.admin_url().'/images/spinner.gif">
					<div class="theme-screenshot">
						<img src="'.$screenshot.'">'.$current.'

					</div>
					<a class="more-details" target="_blank" href="'.esc_url($demo['url']).'">Preview</a>
					<h3 class="theme-name">'.$title.'</h3>
					<div class="theme-actions">
						<a data-id="'.$id.'" data-dir="'.$demo['dir'].'" data-front="'.$demo['front'].'" class="button button-primary btn-import-xml" href="#">Import</a>
					</div>	

	    		</div>
			';
		}

		?>
	    <div class="xlimwrap">
	    	<div class="demo-inner">
	    		<?php echo $out;?>
	    	</div>
	      </div>

		<?php
	}

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_pages' ], 600 );
	}
}



new gosofie_setup_demo_menu();
