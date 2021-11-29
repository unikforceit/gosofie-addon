<?php if ( ! defined( 'ABSPATH' )  ) { die; }

$prefix_page_opts = 'gosofie_post_meta';

CSF::createMetabox( $prefix_page_opts, array(
  'title'        => 'Page Options',
  'post_type'    => ['page','post'],
  'show_restore' => false,
  'theme'=> 'light',
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'Header',
  'icon'   => 'fas fa-rocket',
  'fields' => array(

    array(
      'id'    => 'disable_header',
      'type'  => 'switcher',
      'title' => 'Enable custom header',
      'help'  => 'If you want to use custom header other than set in customiser',
    ),
    array(
      'id'          => 'header',
      'type'        => 'select',
      'title'       => 'Select header',
      'chosen'      => true,
      'multiple'    => false,
      'dependency' => array('disable_header', '==', 'true' ),
      'options'     => gosofie_footer_select('gosofie_template'),
    ),

  )
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'Footer',
  'icon'   => 'fas fa-tint',
  'fields' => array(

      array(
          'id'    => 'disable_footer',
          'type'  => 'switcher',
          'title' => 'Enable custom footer',
          'help'  => 'If you want to use custom footer other than set in customiser',
      ),
      array(
          'id'          => 'footer',
          'type'        => 'select',
          'title'       => 'Select footer',
          'chosen'      => true,
          'multiple'    => false,
          'dependency' => array( 'disable_footer', '==', 'true' ),
          'options'     => gosofie_footer_select('gosofie_template'),
      ),

  )
) );

