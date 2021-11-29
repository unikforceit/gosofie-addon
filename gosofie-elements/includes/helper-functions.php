<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

function get_builder_image($url='',$class=''){
    if ($url){
        return '<a class="'.$class.'" href="'.esc_url( home_url( '/' )).'"><img src="'. esc_url( $url).'" alt="'.get_bloginfo( 'name' ).'"></a>';
    }

}
function get_that_image($url){
    if ($url){
        return wp_get_attachment_image($url['id']);
    }

}

function get_customiser_op($opt){
    $options = get_option('gosofie_options');
    if (isset($options[$opt])){
        return $options[$opt];
    }
    
}


function ae_drop_taxolist(){

    $args = array(
      'public'   => true,
      '_builtin' => false
      
    ); 
    $output = 'names'; // or objects
    $operator = 'or'; // 'and' or 'or'

    $taxonomies = get_taxonomies( $args, $output, $operator ); 
    return $taxonomies;

}
    
function get_meta_custom($opt){

    global $wp_query;
    $postid = $wp_query->post->ID;
    $options = get_post_meta($postid, 'gosofie_post_meta', 'true');
    if (isset($options[$opt])){
        return $options[$opt];
    }   
}

function get_that_link($link){

    $url = $link['url'] ? 'href='.esc_url($link['url']). '' : '';
    $ext = $link['is_external'] ? 'target= _blank' : '';
    $nofollow = $link['nofollow'] ? 'rel="nofollow"' : '';
    $link = $url.' '.$ext.' '.$nofollow;
    return $link;
}

function king_buildermeta_to_string($items) {
    if (!is_array($items) || empty($items)){
        return;
    }
     foreach( $items as $item ){
        $metaf[] =$item['meta'];
      }
      return implode(',' , $metaf);
}

function king_menu_select_choices() {
    $menus = wp_get_nav_menus();
    $items = array();
    $i     = 0;
    foreach ( $menus as $menu ) {
        if ( $i == 0 ) {
            $default = $menu->slug;
            $i ++;
        }
        $items[ $menu->slug ] = $menu->name;
    }

    return $items;
}


function ae_image_size_choose() {
  $image_sizes = get_intermediate_image_sizes(); 

    $addsizes = array(
        "full" => 'Full size'
    );
    $newsizes = array_merge($image_sizes, $addsizes);

  return array_combine($newsizes, $newsizes);
}

/* Menu columns */

function fw_grid_col($column_size = 3) {

    $style_class = 'col-lg-3';

    $column_styles = array(
        1 => 'col-lg-12',
        2 => 'col-lg-6',
        3 => 'col-lg-4',
        4 => 'col-lg-3',
        5 => 'col-lg-15',
    );  

    if (array_key_exists($column_size, $column_styles) && !empty($column_styles[$column_size])) {
        $style_class = $column_styles[$column_size];
    }
    
    return $style_class;
}

function gosofie_template_select() {

        global $post;
        $args = array('numberposts' => -1,'post_type' => 'elementor_library',);
        $posts = get_posts($args);  

        foreach ($posts as $pn_cat) {
            $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
        }
        return $categories;   

} 

/*Meta Fields*/
function gosofie_animations(){
    return array(
        '' => esc_html__('No animation', 'gosofie') ,
        'reveal-top' => esc_html__('Animate from top', 'gosofie') ,
        'reveal-bottom' => esc_html__('Animate from bottom', 'gosofie') ,
        'reveal-left' => esc_html__('Animate from left', 'gosofie') ,
        'reveal-right' => esc_html__('Animate from right', 'gosofie') ,
    );  
}


/* Return the css class name to help achieve the number of columns specified */

function ae_get_column_class($column_size = 3, $no_margin = false) {

    $style_class = 'col-three';
    $column_styles = array(
        1 => 'col-one',
        2 => 'col-two',
        3 => 'col-three',
        4 => 'col-four',
        5 => 'col-five'
    );

    if (array_key_exists($column_size, $column_styles) && !empty($column_styles[$column_size])) {
        $style_class = $column_styles[$column_size];
    }

    $style_class = $no_margin ? ($style_class . ' has-padding') : $style_class;

    return $style_class;
}

/* Return the css class name to help achieve the number of columns specified */

function gosofie_gird_column($column_size = '3') {

    $style_class = 'col-md-3';

    $column_styles = array(
        1 => 'col-md-12',
        2 => 'col-md-6 col-sm-6 col-xs-12',
        3 => 'col-md-4 col-sm-6 col-xs-12',
        4 => 'col-md-3 col-sm-6 col-xs-12',
        5 => 'col-md-15',
    );  
    if (array_key_exists($column_size, $column_styles) && !empty($column_styles[$column_size])) {
        $style_class = $column_styles[$column_size];
    }
    
    return $style_class;
}

/* Return gallery grid */

function gosofie_gallery_column($column_size = 3) {

    $style_class = 'gallery-columns-1';

    $column_styles = array(
        2 => 'gallery-columns-2',
        3 => 'gallery-columns-3',
        4 => 'gallery-columns-4',
    );
    
    if (array_key_exists($column_size, $column_styles) && !empty($column_styles[$column_size])) {
        $style_class = $column_styles[$column_size];
    }

    return $style_class;
}

function ae_bg_images($thumbnail='full'){

    global $post;
    $post_id = $post->ID;   
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),$thumbnail);
    if ( !$featured_image) {
        return ;
    };  
    $image_url =  $featured_image[0];
    $lazy='data-bg='.$image_url.'';

    $bg_image = 'background-image:url('.$image_url.');';    
    $out = ($bg_image) ? 'style='.$bg_image.'' : '';    

    echo $out;

}

function ap_limited_excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)." ";
    return $excerpt;
}

function get_hansel_and_gretel_breadcrumbs(){
    // Set variables for later use
    $here_text        = __( '' );
    $home_link        = home_url('/');
    $home_text        = __( 'Home' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = '<span class="delimiter">|</span>';              // Delimiter between crumbs
    $before           = '<span class="current">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="xlbreadcrumb">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            $breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        //$breadcrumb_output_link .= $here_text . $delimiter;
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}

function xld_page_title($arg){

        if ( is_category() ) {
            /* translators: Category archive title. 1: Category name */
            $title = single_cat_title( $arg['cat'], false);
        } elseif ( is_tag() ) {
            /* translators: Tag archive title. 1: Tag name */
            $title = single_cat_title( $arg['tag'],false);
        } elseif ( is_author() ) {
            $title = sprintf( $arg['author'].'%s', '<span>' . get_the_author() . '</span>' );
            //$title = get_the_author( 'Author: ', true );
        } elseif ( is_year() ) {
            /* translators: Yearly archive title. 1: Year */
            $title = sprintf( $arg['yarchive'], '<span>' .get_the_date('F Y', 'yearly archives date format' ). '</span>' );
        } elseif ( is_month() ) {
            /* translators: Monthly archive title. 1: Month name and year */
            $title =  sprintf( $arg['marchive'], '<span>' .get_the_date('F Y', 'monthly archives date format' ). '</span>' );
        } elseif ( is_404() ) {
            /* translators: Daily archive title. 1: Date */
            $title = $arg['notfound'];
        }elseif ( is_post_type_archive() ) {
            /* translators: Post type archive title. 1: Post type name */
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = single_term_title( '', false ) ;
        } elseif (is_search()){
            $title = sprintf( $arg['search'].'%s','<span>' . get_search_query() . '</span>' );
        }elseif( is_home() && is_front_page() ){
          $title = esc_html__( 'Frontpage', 'niobis' );
        } elseif( is_singular() ){
          $title = get_the_title();
        }else {
            $title = esc_html__( 'Archives','niobis' );
        }

        return $title;

}
