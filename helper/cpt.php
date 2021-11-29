<?php

	class gosofiecustom_post_type {
		
		function __construct() {
			
			add_action('init', array(&$this,'create_post_type'));
			add_action('init', array(&$this,'create_post_taxonomy'));				
		}
	  
		function create_post_type() {
			$labels = array(
				'name' => __('Header & Footer', 'gosoFie'),
				'singular_name' => __('Header & footer', 'gosoFie'),
				'add_new' => __('Add header & footer', 'gosoFie'),
				'add_new_item' => __('Add header & footer', 'gosoFie'),
				'edit_item' => __('Edit header & footer', 'gosoFie'),
				'new_item' => __('New header & footer', 'gosoFie'),
				'all_items' => __('All header & footer', 'gosoFie'),
				'view_item' => __('View header & footer', 'gosoFie'),
				'search_items' => __('Search header & footer', 'gosoFie'),
				'not_found' => __('No header & footer found', 'gosoFie'),
				'not_found_in_trash' => __('No portfolio found in the trash', 'gosoFie'),
				'parent_item_colon' => '',
				'menu_name' => __('Header & Footer', 'gosoFie')
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'menu_icon' => 'dashicons-format-image',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor'),
				'has_archive' => false,
			);
			register_post_type('gosofie_template', $args);
		}
		
		function create_post_taxonomy() {
			$labels = array(
				'name' => __('Category', 'gosoFie'),
				'singular_name' => __('Category', 'gosoFie'),
				'search_items' => __('Search categories', 'gosoFie'),
				'all_items' => __('Categories', 'gosoFie'),
				'parent_item' => __('Parent category', 'gosoFie'),
				'parent_item_colon' => __('Parent category:', 'gosoFie'),
				'edit_item' => __('Edit category', 'gosoFie'),
				'update_item' => __('Update category', 'gosoFie'),
				'add_new_item' => __('Add category', 'gosoFie'),
				'new_item_name' => __('New category', 'gosoFie'),
				'menu_name' => __('Category', 'gosoFie'),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'rewrite' => array('slug' => 'gosofie_template_cat'),
			);
			register_taxonomy('gosofie_template_cat', 'gosofie_template', $args);
		}
					
	}  

    new gosoFiecustom_post_type();

