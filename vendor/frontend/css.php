<?php
$preloader = get_customiser_op('preloader');

?>
#preloader {
	background-image:url(<?php echo $preloader;?>);
	background-color:<?php echo get_customiser_op('prebg');?>;
}
body:not(.page-template-elementor_canvas){
  background:<?php echo get_customiser_op('bgcolor');?>;
}