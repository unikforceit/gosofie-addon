<?php if ( ! defined( 'ABSPATH' )  ) { die; } 

$prefix = 'gosofie_options';

// Create options
CSF::createOptions( $prefix, array(
    'menu_title' => 'Gosofie',
    'menu_slug'  => 'gosofie-options',
    'menu_position'  => 2,
    'menu_icon'  => 'dashicons-schedule',
    'framework_title'  => 'Gosofie Options',
) );

//
CSF::createSection( $prefix, array(
  'title'       => 'General',
  'fields'      => array(

    array(
      'id'      => 'bgcolor',
      'type'    => 'color',
      'title'   => 'Background color',
    ),

    array(
      'id'    => 'enb_share_tag',
      'type'  => 'switcher',
      'title' => 'Post tag & share',
    ),

    array(
      'id'    => 'enb_single_nav',
      'type'  => 'switcher',
      'title' => 'Single post navigation',
    ),

    array(
      'id'    => 'enb_pagination',
      'type'  => 'switcher',
      'title' => 'Post pagination',
    ),

    array(
      'id'    => 'enb_rpost',
      'type'  => 'switcher',
      'title' => 'Related post',
    ),

    array(
      'id'    => 'enb_authbox',
      'type'  => 'switcher',
      'title' => 'Author box',
    ),

    array(
      'id'      => 'tag_title',
      'type'    => 'text',
      'title'   => 'Tag title',
      'default' => 'Related tag',
      'dependency' => array( 'enb_share_tag', '==', 'true' ),
    ),

    array(
      'id'      => 'share_title',
      'type'    => 'text',
      'title'   => 'Share title',
      'default' => 'Social share',
      'dependency' => array( 'enb_share_tag', '==', 'true' ),
    ),

    array(
      'id'      => 'related_title',
      'type'    => 'text',
      'title'   => 'Related post title',
      'default' => 'Related post',
      'dependency' => array( 'enb_rpost', '==', 'true' ),
    ),

    array(
      'id'      => 'auth_title',
      'type'    => 'text',
      'title'   => 'Author box title',
      'default' => 'Written by',
      'dependency' => array( 'enb_authbox', '==', 'true' ),
    ),

  )
) );
//
CSF::createSection( $prefix, array(
  'title'       => 'Header & Footer',
  'fields'      => array(

    array(
      'id'    => 'enb_pre',
      'type'  => 'switcher',
      'title' => 'Preloader',
    ),

    array(
      'id'    => 'preloader',
      'type'  => 'upload',
      'title' => 'Preloader',
      'dependency' => array( 'enb_pre', '==', 'true' ),
    ),

    array(
      'id'      => 'prebg',
      'type'    => 'color',
      'title'   => 'Overlay background',
      'default' => '#fff',
      'dependency' => array( 'enb_pre', '==', 'true' ),
    ),

    array(
      'id'          => 'header',
      'type'        => 'select',
      'title'       => 'Header',
      'chosen'      => true,
      'multiple'    => false,
      'options'     => gosofie_footer_select('gosofie_template'),
    ),
 
    array(
      'id'          => 'footer',
      'type'        => 'select',
      'title'       => 'Footer',
      'chosen'      => true,
      'multiple'    => false,
      'options'     => gosofie_footer_select('gosofie_template'),
    ),

    array(
      'id'          => 'sidebar',
      'type'        => 'select',
      'title'       => 'Sidebar',
      'chosen'      => true,
      'multiple'    => false,
      'options'     => gosofie_footer_select('gosofie_template'),
    ),

    array(
      'type' => 'backup',
    ),

  )
) );

