<?php
define( 'BOPEA_VERSION', '1.0.8' );
load_theme_textdomain('bopea', get_template_directory() . '/langs');
add_action( 'after_setup_theme', 'bopea_theme_setup', 1 );
if ( ! function_exists( 'bopea_theme_setup' ) ) {
  function bopea_theme_setup() {
    if ( ! isset( $GLOBALS['content_width'] ) ) {
      $GLOBALS['content_width'] = 1200;
    }
    add_theme_support( 'wc-product-gallery-zoom' );    
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'post-formats', array('gallery', 'quote', 'video', 'audio') );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( "title-tag" );
    add_theme_support('post-thumbnails');
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support(
      'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        )
    );    
  }
}

add_action( 'init', 'bopea_image_size' );
if ( !function_exists( 'bopea_image_size' ) ) {
	function bopea_image_size() {
    add_image_size('bopea_large', 1600, 0, false);
    add_image_size('bopea_medium', 1100, 0, false);    
    add_image_size('bopea_layouts', 680, 0, false);
    add_image_size('bopea_small', 200, 0, false);
    if(empty(get_theme_mod('jl_opt_lazy_img', false))){
      add_image_size('bopea_large_sload', 20, 0, false);
      add_image_size('bopea_medium_sload', 20, 0, false);    
      add_image_size('bopea_layouts_sload', 20, 0, false);
      add_image_size('bopea_small_sload', 20, 0, false);
    }
  }
}

add_action('init', 'bopea_register_menu');
if ( !function_exists( 'bopea_register_menu' ) ) {
  function bopea_register_menu() {
    register_nav_menus(
        array(
          'main_menu' => esc_html__('Main menu', 'bopea'),
          'mobile_menu' => esc_html__('Mobile main menu', 'bopea'),
        )
    );    
    $sub_footer = get_theme_mod('sub_footer', 'sub_footer0');
    if( $sub_footer == 'sub_footer1' || $sub_footer == 'sub_footer3' || $sub_footer == 'sub_footer5' ){
        register_nav_menus(
          array(
            'footer_menu' => esc_html__('Footer menu', 'bopea')
          )
        );
    }
  }
}

add_action( 'wp_ajax_ajax_action', 'bopea_day_night');
add_action( 'wp_ajax_nopriv_ajax_action', 'bopea_day_night' );
if ( !function_exists( 'bopea_day_night' ) ) {
    function bopea_day_night() {
        $jl_dn_option = isset( $_COOKIE['jlmode_dn'] ) ? $_COOKIE['jlmode_dn'] : '';
        if ( 'true' === $jl_dn_option ){
            return 'options_dark_skin';
        }
    }
}

add_filter( 'body_class','bopea_body_classes' );
if ( !function_exists( 'bopea_body_classes' ) ) {
  function bopea_body_classes( $classes ) {
      $jl_dn_option = isset( $_COOKIE['jlmode_dn'] ) ? $_COOKIE['jlmode_dn'] : '';
      $jl_header_tp = get_post_meta( get_the_ID(), 'jl_header_tp', true );
      $single_post_layout = get_post_meta( get_the_ID(), 'single_post_layout', true );
      $single_post_layout_options = get_theme_mod('single_post_layout_options','single1');
      $title_link = get_theme_mod('bopea_title_link','jl_uline');            
      $category_bg_dot_style = get_theme_mod('category_bg_dot_style','jl_cbgop');            
      $post_sidebar_opt = get_theme_mod('post_sidebar_position','jl_sright_side');
      $post_sidebar_meta = get_post_meta( get_the_ID(), 'post_sidebar_position', true );
      $footer_logo = get_theme_mod('footer_logo','logo_foot_normal');      
      $bopea_widget_font = get_theme_mod('bopea_widget_font','jl_weg_title');      
      $mb_nav_left = get_theme_mod('mb_nav_left');
      $mb_nav_right = get_theme_mod('mb_nav_right');      
      $post_sidebar = get_theme_mod('post_sidebar','default');
      $page_sidebar = get_theme_mod('page_sidebar','default');
      $category_sidebar = get_theme_mod('category_sidebar','default');
      $tag_sidebar = get_theme_mod('tag_sidebar','default');
      $archive_sidebar = get_theme_mod('archive_sidebar','default');
      $author_sidebar = get_theme_mod('author_sidebar','default');
      $search_sidebar = get_theme_mod('search_sidebar','default');

      if ($jl_header_tp == 'on'){
        $classes[] = 'jl_header_tp';
      }
      
      if(!empty($category_bg_dot_style)){
        $classes[] = $category_bg_dot_style;
      }
      if(!empty(get_theme_mod('enable_logo_txt'))){
        $classes[] = 'jl_enltxt';
      }
      if(!empty(get_theme_mod('category_dot_style', 'cat_dot_cir'))){
        $classes[] = get_theme_mod('category_dot_style', 'cat_dot_cir');
      }
      if(!empty(get_theme_mod('canvas_light_logo'))){
        $classes[] = 'jl_encanw';
      }
      
      if(!empty(get_theme_mod('enable_d_light', false))){
        $classes[] = 'jl_enhew';
      }

      if(!empty(get_theme_mod('sticky_logo', false))){
        $classes[] = 'jl_enstew';
      }       

      if(!empty(get_theme_mod('jl_search_layout'))){
        $classes[] = 'jlac_smseah';
      }
      if(!empty($single_post_layout)){
        $classes[] = 'jl_spop_'.$single_post_layout;
      }else{
        $classes[] = 'jl_spop_'.$single_post_layout_options;
      }      
      if(!empty(get_theme_mod('single_left_share_style'))){
        $classes[] = get_theme_mod('single_left_share_style');
      }
      if(!empty($mb_nav_left)){
        $classes[] = 'jl_mb_nav_pos_left';
      }
      if(!empty($mb_nav_right)){
        $classes[] = 'jl_mb_nav_pos_right';
      }
      $classes[] = $footer_logo;
      $classes[] = $bopea_widget_font;
      if(empty($post_sidebar_meta)){
        $classes[] = $post_sidebar_opt;
      }else{
        $classes[] = $post_sidebar_meta;
      }
      $classes[] = 'jl_nav_stick jl_nav_active jl_nav_slide mobile_nav_class is-lazyload';
      $classes[] = bopea_day_night();
      if ($jl_dn_option !='false') {
        if(get_theme_mod('enable_dark_skin')){
        $classes[] = 'options_dark_skin jl_en_day_night';
        }else{
        $classes[] = ' jl_en_day_night';
        }
      }else{
        $classes[] = ' jl_en_day_night';
      }      
      if($category_sidebar == "default" || $tag_sidebar == "default" || $archive_sidebar == "default" || $author_sidebar == "default" || $search_sidebar == "default"){
        if (is_active_sidebar('general-sidebar')) {
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_category() ) {
        if($category_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_tag() ) {
        if($tag_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_search() ) {
        if($search_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_tax() ) {
        if($archive_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_date() ) {
        if($archive_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_home() ) {
        if($archive_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_post_type_archive() ) {
        if($archive_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }
      if ( is_author() ) {
        if($author_sidebar != "default"){
          $classes[] = 'jl-has-sidebar';
        }
      }

      if ($title_link == 'jl_tline'){
        $classes[] = 'jl_tline';
      }elseif($title_link == 'jl_uline'){
        $classes[] = 'jl_uline';
      }elseif($title_link == 'jl_bgt'){
        $classes[] = 'jl_bgt';
      }else{
        $classes[] = 'jl_tcolor';
      }      
      if ( get_theme_mod('header_layout_design') == '' ){
        $classes[] = get_theme_mod('header_layout_design');
      }
      if ( get_theme_mod('sticky_header') ){
        $classes[] = get_theme_mod('sticky_header', 'jl_sticky_smart');
      }      
      return $classes;
  }
}

add_filter('nav_menu_item_id', 'bopea_my_css_attributes_filter', 100, 1);
if ( !function_exists( 'bopea_my_css_attributes_filter' ) ) {
  function bopea_my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
  }
}

add_filter('wp_list_categories', 'bopea_cat_count_span');
if ( !function_exists( 'bopea_cat_count_span' ) ) {
  function bopea_cat_count_span($links) {
    $links = str_replace('</a> (', '<span>', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
  }
}

add_filter( 'get_archives_link', 'bopea_archives_count_span' );
if ( !function_exists( 'bopea_archives_count_span' ) ) {
  function bopea_archives_count_span($links) {
    $links = str_replace( '</a>&nbsp;(', '<span>', $links );
    $links = str_replace(')', '</span></a>', $links);
    return $links;
  }
}

add_action('widgets_init', 'bopea_sidebar_register');
if ( !function_exists( 'bopea_sidebar_register' ) ) {
  function bopea_sidebar_register() {
      register_sidebar(array(
          'name' => esc_html__('General Sidebar', 'bopea'),
          'id' => 'general-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>',
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));
      register_sidebar(array(
          'name' => esc_html__('Mobile Section Sidebar', 'bopea'),
          'id' => 'mobile-menu-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>',
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));      
      register_sidebar(array(
          'name' => esc_html__('First Footer Sidebar', 'bopea'),
          'id' => 'footer1-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));
      register_sidebar(array(
          'name' => esc_html__('Second Footer Sidebar', 'bopea'),
          'id' => 'footer2-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));
      register_sidebar(array(
          'name' => esc_html__('Third Footer Sidebar', 'bopea'),
          'id' => 'footer3-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));
      register_sidebar(array(
          'name' => esc_html__('Fourth Footer Sidebar', 'bopea'),
          'id' => 'footer4-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));

      if ( class_exists( 'woocommerce' ) ) {
        register_sidebar(array(
          'name' => esc_html__('Shop Sidebar', 'bopea'),
          'id' => 'woos-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => "</div>",
          'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
          'after_title' => '</h2></div>',
      ));
      }

  }
}

if ( !function_exists( 'bopea_post_type' ) ) {
  function bopea_post_type(){
      if(has_post_format( 'video')){
          if (empty($videourl)){
            $post_type_image = '<span class="jl_post_type_icon"></span>';
          }
      }else{
          $post_type_image = '';
      }
      return $post_type_image;
  }
}

if(!function_exists('bopea_esc_data')){
  function bopea_esc_data() {
    $allowed_tags =
        array(
          'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array(),
            'data' => array(),
            'data-style' => array(),
            'rel'   => array()
          ),
          'div' => array(
            'class' => array(),
            'data' => array(),
            'data-style' => array()
          ),
          'span' => array(
            'class' => array(),
            'data' => array(),
            'data-style' => array()
          ),
          'iframe' => array(
            'src' => array(),
            'class' => array(),
            'data' => array(),
            'data-style' => array(),
            'allow' => array(),
            'allowfullscreen' => array(),
            'width' => array(),
            'height' => array(),
            'frameborder' => array()
          )
    );
    return $allowed_tags;
  }
}

if ( !function_exists( 'bopea_post_meta' ) ) {
  function bopea_post_meta() {
    if(get_theme_mod('hide_front_author_date') !=1){
      echo '<span class="jl_post_meta">';
  		if(get_theme_mod('hide_front_author') !=1){
        if( !empty( get_theme_mod('show_author_img', true ) ) ){
          echo '<span class="jl_author_img_w">';
          echo '<span class="jl_aimg_in">';
          echo get_avatar(get_the_author_meta('ID'), 50, '', '', array( 'class' => 'lazyload' ));
          echo '</span>';
          echo the_author_posts_link();
          echo '</span>';
        }else{
          echo '<span class="jl_author_img_w">';
          echo bopeatxt::bopea_s_by();
          echo the_author_posts_link();
          echo '</span>';
        }
      }
      if(empty(get_theme_mod('jl_sw_date_read'))){
        if(get_theme_mod('hide_front_date') !=1){
          echo '<span class="post-date">'.get_the_date().'</span>';
        }
      }else{
        if(get_theme_mod('disable_post_readtime') !=1){
          echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
        }
      }

      echo '<span class="jl_fot_share_i jl_share_l_bg jls_tooltip"><i class="jli-share"></i><span class="jls_tooltip_w jls_tooltip-top"><span class="jls_tooltiptext"><span class="jls_tooltip_in">';
      if(function_exists('bopea_front_slink')){
              bopea_front_slink(get_the_ID());            
      }
      echo '</span></span></span></span>';
  		echo'</span>';
    }
  }
}

if(!function_exists('bopea_author_date_meta')){
  function bopea_author_date_meta() {
    if(get_theme_mod('hide_front_author_date') !=1){
      echo '<span class="jl_post_meta">';
  		if(get_theme_mod('hide_front_author') !=1){
        echo '<span class="jl_author_img_w">';
        echo bopeatxt::bopea_s_by();
        echo the_author_posts_link();
        echo '</span>';
      }
      if(get_theme_mod('hide_front_date') !=1){
        echo '<span class="post-date">'.get_the_date().'</span>';
      }
  		echo'</span>';
    }
  }
}

if(!function_exists('bopea_post_meta_date')){
  function bopea_post_meta_date() {
    if(get_theme_mod('hide_front_author_date') !=1){
      echo '<span class="jl_post_meta">';      
      
      if(empty(get_theme_mod('jl_sw_date_read'))){
        if(get_theme_mod('hide_front_date') !=1){
          echo '<span class="post-date">'.get_the_date().'</span>';
        }
      }else{
        if(get_theme_mod('disable_post_readtime') !=1){
          echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
        }
      }
      echo '<span class="jl_fot_share_i jl_share_l_bg jls_tooltip"><i class="jli-share"></i><span class="jls_tooltip_w jls_tooltip-top"><span class="jls_tooltiptext"><span class="jls_tooltip_in">';
      if(function_exists('bopea_front_slink')){
              bopea_front_slink(get_the_ID());            
      }
      echo '</span></span></span></span>';
      echo'</span>';
    }
  }
}

if(!function_exists('bopea_post_ov_cat')){
  function bopea_post_ov_cat() {
    if(get_theme_mod('hide_front_cat') !=1){
      $cat_style = get_theme_mod('category_label_overlay', 'cat_label_3');      
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
      case 'cat_label_1' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_2' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_3' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb3">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;            
      }
    }
  }
}

if(!function_exists('bopea_post_list_cat')){
  function bopea_post_list_cat() {
    if(get_theme_mod('hide_front_cat') !=1){
      $cat_style = get_theme_mod('category_label_list', 'cat_label_3');      
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
      case 'cat_label_1' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_2' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_3' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb3">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;            
      }
    }
  }
}

if(!function_exists('bopea_post_small_cat')){
  function bopea_post_small_cat() {
    if(get_theme_mod('hide_front_cat') !=1){
      $cat_style = get_theme_mod('category_label_small_list', 'cat_label_1');      
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
      case 'cat_label_1' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_2' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;      
      case 'cat_label_3' :
        if ($categories) {
              echo '<span class="jl_f_cat jl_lb3">';
              foreach( $categories as $tag) {
                $tag_link = get_category_link($tag->term_id);
               echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
              }
              echo "</span>";
              }
        break;            
      }
    }
  }
}

if(!function_exists('bopea_post_tumb_cat')){
  function bopea_post_tumb_cat() {
    if(get_theme_mod('hide_front_cat') !=1){
      $cat_style = get_theme_mod('category_label_grid','cat_label_1');
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
			case 'cat_label_4' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb4">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
			break;
      case 'cat_label_5' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb5">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_6' :
        if ($categories) {
              echo '<span class="jl_f_cat jl_lb6">';
              foreach( $categories as $tag) {
                $tag_link = get_category_link($tag->term_id);
                echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
              }
              echo "</span>";
              }
        break;
        case 'cat_label_7' :
          if ($categories) {
                echo '<span class="jl_f_cat jl_lb7">';
                foreach( $categories as $tag) {
                  $tag_link = get_category_link($tag->term_id);
                  echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
                }
                echo "</span>";
                }
          break;
      }
    }
  }
}

if(!function_exists('bopea_post_cat')){
  function bopea_post_cat() {
    if(get_theme_mod('hide_front_cat') !=1){
      $cat_style = get_theme_mod('category_label_grid','cat_label_1');
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
			case 'cat_label_1' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
			break;
			case 'cat_label_2' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
			break;
			case 'cat_label_3' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb3">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
			break;	
      		      
      }
    }
  }
}

if ( !function_exists( 'bopea_single_meta_list' ) ) {
  function bopea_single_meta_list() {
    $enable_sponsored_post = get_post_meta( get_the_ID(), 'enable_sponsored_post', true );
    $author_id = get_post_field( 'post_author', get_the_ID() );
    $jl_sg_author = get_theme_mod('jl_sg_author', 'jl_au_sm');
    if(!empty($enable_sponsored_post)){
      bopea_sponsored();
    }else{
      if($jl_sg_author == 'jl_au_l'){
          echo '<span class="jl_post_meta jl_slimeta jl_au_lw">';
          if(get_theme_mod('disable_post_meta_author') !=1){
              echo '<span class="jl_author_img_w '.$jl_sg_author.'">';
                echo '<span class="jl_aimg_in"><a href="'.get_author_posts_url( $author_id ).'">';            
                echo get_avatar(get_the_author_meta('ID'), 120, '', '', array( 'class' => 'lazyload' ));
                echo '</a></span>';              
              echo '</span>';
          }
          echo '<span class="jl_mt_rw">';
          echo '<span class="jl_mt_t">';
          if(get_theme_mod('disable_post_meta_author') !=1){
            echo '<span class="jl_author_img_w">';
            echo bopeatxt::bopea_s_by();
            echo the_author_posts_link();
            echo '</span>';
          }
          if(get_theme_mod('disable_post_date') !=1){
            $enable_updated_date = get_theme_mod('enable_updated_date');
            if ( !empty( $enable_updated_date ) ){
              $date_label = bopeatxt::bopea_s_updated().' ';
            }else{
              $date_label = '';
            }        
            echo '<span class="post-date">'.$date_label.get_the_date().'</span>';
          }
          echo '</span>';
          echo '<span class="jl_mt_b">';
          if(get_theme_mod('disable_post_readtime') !=1){
            echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
          }
          if(get_theme_mod('disable_post_view') !=1){
            if(function_exists('bopea_bac_PostViews')){
            echo '<span class="jl_view_options">';        
            echo bopea_bac_PostViews(get_the_ID()).' '.bopeatxt::bopea_s_views();        
            echo '</span>';
            }
          }
          if(!empty(get_theme_mod('disable_post_view'))){
            if(function_exists('bopea_bac_PostViews')){
            echo '<span class="jl_view_none">';        
            echo bopea_bac_PostViews(get_the_ID());        
            echo '</span>';
            }
          }
          echo '</span>';
          echo '</span>';
          echo'</span>';

      }else{
        echo '<span class="jl_post_meta jl_slimeta">';
        if(get_theme_mod('disable_post_meta_author') !=1){
            echo '<span class="jl_author_img_w '.$jl_sg_author.'">';
            if($jl_sg_author == 'jl_au_sm' || $jl_sg_author == 'jl_au_md'){
              echo '<span class="jl_aimg_in"><a href="'.get_author_posts_url( $author_id ).'">';            
              echo get_avatar(get_the_author_meta('ID'), 50, '', '', array( 'class' => 'lazyload' ));
              echo '</a></span>';
            }else{
              echo bopeatxt::bopea_s_by();
            }
            echo the_author_posts_link();
            echo '</span>';
        }
        if(get_theme_mod('disable_post_date') !=1){
          $enable_updated_date = get_theme_mod('enable_updated_date');
          if ( !empty( $enable_updated_date ) ){
            $date_label = bopeatxt::bopea_s_updated().' ';
          }else{
            $date_label = '';
          }        
          echo '<span class="post-date">'.$date_label.get_the_date().'</span>';
        }
        if(get_theme_mod('disable_post_readtime') !=1){
          echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
        }
        if(get_theme_mod('disable_post_view') !=1){
          if(function_exists('bopea_bac_PostViews')){
          echo '<span class="jl_view_options">';        
          echo bopea_bac_PostViews(get_the_ID()).' '.bopeatxt::bopea_s_views();        
          echo '</span>';
          }
        }

        if(!empty(get_theme_mod('disable_post_view'))){
          if(function_exists('bopea_bac_PostViews')){
          echo '<span class="jl_view_none">';        
          echo bopea_bac_PostViews(get_the_ID());        
          echo '</span>';
          }
        }
        echo'</span>';        
      }
    }
  }
}

if(!function_exists('bopea_post_single_cat')){
  function bopea_post_single_cat() {
    if(get_theme_mod('disable_post_category') !=1){
      $cat_style = get_theme_mod('category_label_single', 'cat_label_3');      
      $categories = get_the_category(get_the_ID());
      switch ( $cat_style ) {
      case 'cat_label_1' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_2' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_txt jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;
      case 'cat_label_3' :
      if ($categories) {
            echo '<span class="jl_f_cat jl_lb3">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
             echo '<a class="jl_cat_lbl jl_cat'.esc_attr($tag->term_id).'" href="'.esc_url($tag_link).'"><span>'.esc_attr($tag->name).'</span></a>';
            }
            echo "</span>";
            }
      break;            
      }
    }
  }
}

if(!function_exists('bopea_post_sidebar')){
  function bopea_post_sidebar() {
      $sidebar_post_options = get_post_meta(get_the_ID(), 'single_post_sidebar', true);
      if(isset($sidebar_post_options)){
  		    $custom_sidebar = $sidebar_post_options;
  				$post_sidebar = get_theme_mod('post_sidebar');
  				if(!empty($post_sidebar)) {
  						$custom_sidebar = $post_sidebar;
  				}
  				global $wp_registered_sidebars;
  				foreach ( $wp_registered_sidebars as $sidebar ) {
    				if($sidebar['id'] == $custom_sidebar){
    							 $dyn_side = $sidebar['id'];
    				}
  				}
  		}
  		if(isset($dyn_side)) {
  					if (is_active_sidebar($dyn_side)) { dynamic_sidebar($dyn_side);}
  		} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
  		}
  }
}

if(!function_exists('bopea_page_sidebar')){
  function bopea_page_sidebar() {
  	   $sidebar_page_options = get_post_meta(get_the_ID(), 'single_page_sidebar', true);
  	   if(isset($sidebar_page_options)){
  			   $custom_sidebar = $sidebar_page_options;
  				$page_sidebar = get_theme_mod('page_sidebar');
  					if(!empty($page_sidebar)) {
  						$custom_sidebar = $page_sidebar;
  					}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $dyn_side = $sidebar['id'];
  						}
  					}
  			}
  			if(isset($dyn_side)) {
  					if (is_active_sidebar($dyn_side)) { dynamic_sidebar($dyn_side);}
  			} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
  			}
  }
}

if(!function_exists('bopea_category_sidebar')){
  function bopea_category_sidebar() {
        $category_sidebar = get_theme_mod('category_sidebar','default');
  			$custom_sidebar ='';
  				if(!empty($category_sidebar)) {	$custom_sidebar = $category_sidebar;	}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $custom_sidebar = $sidebar['id'];
  						}
  				}
  				if(!empty($custom_sidebar) && $custom_sidebar !='default') {
  					if (is_active_sidebar($custom_sidebar)) { dynamic_sidebar($custom_sidebar);}
  				} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar');}
  				}
  }
}

if(!function_exists('bopea_tag_sidebar')){
  function bopea_tag_sidebar() {
  $tag_sidebar = get_theme_mod('tag_sidebar','default');
  				$custom_sidebar ='';
  				if(!empty($tag_sidebar)) {	$custom_sidebar = $tag_sidebar;	}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $custom_sidebar = $sidebar['id'];
  						}
  				}
  				if(!empty($custom_sidebar) && $custom_sidebar !='default') {
  					if (is_active_sidebar($custom_sidebar)) { dynamic_sidebar($custom_sidebar);}
  				} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar');}
  				}
  }
}

if(!function_exists('bopea_archive_sidebar')){
  function bopea_archive_sidebar() {
  $archive_sidebar = get_theme_mod('archive_sidebar','default');
  				$custom_sidebar ='';
  				if(!empty($archive_sidebar)) {	$custom_sidebar = $archive_sidebar;	}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $custom_sidebar = $sidebar['id'];
  						}
  				}
  				if(!empty($custom_sidebar) && $custom_sidebar !='default') {
  					if (is_active_sidebar($custom_sidebar)) { dynamic_sidebar($custom_sidebar);}
  				} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar');}
  				}
  }
}

if(!function_exists('bopea_author_sidebar')){
  function bopea_author_sidebar() {
  $author_sidebar = get_theme_mod('author_sidebar','default');
  				$custom_sidebar ='';
  				if(!empty($author_sidebar)) {	$custom_sidebar = $author_sidebar;	}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $custom_sidebar = $sidebar['id'];
  						}
  				}
  				if(!empty($custom_sidebar) && $custom_sidebar !='default') {
  					if (is_active_sidebar($custom_sidebar)) { dynamic_sidebar($custom_sidebar);}
  				} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar');}
  				}
  }
}

if(!function_exists('bopea_search_sidebar')){
  function bopea_search_sidebar() {
  $search_sidebar = get_theme_mod('search_sidebar','default');
  				$custom_sidebar ='';
  				if(!empty($search_sidebar)) {	$custom_sidebar = $search_sidebar;	}
  					global $wp_registered_sidebars;
  					foreach ( $wp_registered_sidebars as $sidebar ) {
  					if($sidebar['name'] == $custom_sidebar){
  							 $custom_sidebar = $sidebar['id'];
  						}
  				}
  				if(!empty($custom_sidebar) && $custom_sidebar !='default') {
  					if (is_active_sidebar($custom_sidebar)) { dynamic_sidebar($custom_sidebar);}
  				} else{
  					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar');}
  				}
  }
}

if(!function_exists('bopea_read_time')){
  function bopea_read_time($postid = '') {
    if($postid == '') {
      $postid = get_the_ID();
    }
    $content = get_post_field( 'post_content', $postid );
    $post_words_count = str_word_count( strip_tags( $content ) );
    $readtime = round($post_words_count / 265);
    if($readtime < 1) {
      $readtime = 1;
    }
    $readtime_html = $readtime.' '.bopeatxt::bopea_s_mins_read();
    return $readtime_html;
  }
}

if ( ! function_exists( 'bopea_comment_heading' ) ) {
	function bopea_comment_heading( $post_id = '' ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		$output = bopeatxt::bopea_s_leave_a_comment();
		$count  = intval( get_comments_number( $post_id ) );

		if ( $count > 1 ) {
			$output = sprintf( bopeatxt::bopea_s_comments(), $count );
		} elseif ( 1 === $count ) {
			$output = bopeatxt::bopea_s_comment();
		}
		return $output;
	}
}
if ( ! function_exists( 'bopea_comment' ) ) {
	function bopea_comment( ) {
    if( !empty(get_theme_mod('disable_section_comment')) ){
			return false;
		}
    if ( post_password_required() ) {
			return false;
		}
    if ( comments_open() || get_comments_number() ) {
		$class_name = 'jl_comment_wrap';
		if ( ! get_comments_number() ) {
			$class_name .= ' jl_no_comment';
		}
		?>
        <div class="single_section_comment">
          <?php if( empty(get_theme_mod('disable_section_comment_title')) ){?>
            <div class="jl_comment_head">
              <h3 class="jl_comment_head_title"><?php echo bopea_comment_heading( get_the_ID() ); ?></h3>
            </div>
            <?php }?>
            <div class="<?php echo esc_attr( $class_name ); ?>"><?php comments_template(); ?></div>
        </div>
		<?php
	  }
  }
}

add_filter( 'comment_form_defaults', 'bopea_comment_placeholder', 10 );
if ( ! function_exists( 'bopea_comment_placeholder' ) ) {
	function bopea_comment_placeholder( $defaults ) {
		if ( ! empty( $defaults['fields']['author'] ) ) {
			$defaults['fields']['author'] = str_replace( '<input', '<input placeholder="' . bopeatxt::bopea_s_your_name() . '"', $defaults['fields']['author'] );
		}
		if ( ! empty( $defaults['fields']['email'] ) ) {
			$defaults['fields']['email'] = str_replace( '<input', '<input placeholder="' . bopeatxt::bopea_s_your_email() . '"', $defaults['fields']['email'] );
		}
		if ( ! empty( $defaults['fields']['url'] ) ) {
			$defaults['fields']['url'] = str_replace( '<input', '<input placeholder="' . bopeatxt::bopea_s_your_website() . '"', $defaults['fields']['url'] );
		}
		if ( ! empty( $defaults['comment_field'] ) ) {
			$defaults['comment_field'] = str_replace( '<textarea', '<textarea placeholder="' . bopeatxt::bopea_s_leave_a_comment() . '"', $defaults['comment_field'] );
		}
		return $defaults;
	}
}

if ( ! function_exists( 'bopea_pagination' ) ) {
  function bopea_pagination( $bopea_qry = NULL ) {    
      $jl_archive_pagination = get_theme_mod('jl_archive_pagination', 'number');
      if ( $bopea_qry == NULL ) {
          global $wp_query;
          $bopea_total = $wp_query->max_num_pages;
          $bopea_paged = get_query_var('paged');
      } else {
          if ( is_page() ) {
              global $wp_query;
              $bopea_paged = get_query_var('page');
              $bopea_total = $wp_query->max_num_pages;
          } else {
              global $wp_query;
              $bopea_paged = get_query_var('paged');
              $bopea_total = $wp_query->max_num_pages;
          }
      }      
      if ( is_category() ) {
        if ( $jl_archive_pagination == 'loadmore' ) {
          bopea_blocknav_loadmore( $bopea_qry );
        } elseif ( $jl_archive_pagination == 'autoload' ) {
          bopea_blocknav_autoload( $bopea_qry );
        }else {
            $jl_archive_cat_num = get_theme_mod( 'jl_archive_cat_num' );
            if ( ! empty( $jl_archive_cat_num ) ) {
              $post_per_page = intval( $jl_archive_cat_num );
            }else{
              $post_per_page = get_option('posts_per_page');
            }            
            $found_posts   = $wp_query->found_posts;
            $bopea_total   = ceil($found_posts / $post_per_page);
            $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $bopea_pagination = paginate_links( array(
                'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
                'format'   => '',
                'total'    => $bopea_total,
                'current'  => max(1, $bopea_paged),
                'mid_size' => 2,
                'prev_text' => '<i class="jli-left-chevron"></i>',
                'next_text' => '<i class="jli-right-chevron"></i>',
                'type' => 'list',
            ) );
            echo '<nav class="jellywp_pagination">' . $bopea_pagination . '</nav>';
       }
      } elseif ( is_tag() ) {
        if ( $jl_archive_pagination == 'loadmore' ) {
          bopea_blocknav_loadmore( $bopea_qry );
        } elseif ( $jl_archive_pagination == 'autoload' ) {
          bopea_blocknav_autoload( $bopea_qry );
        }else {
            $jl_archive_tag_num = get_theme_mod( 'jl_archive_tag_num' );
            if ( ! empty( $jl_archive_tag_num ) ) {
              $post_per_page = intval( $jl_archive_tag_num );
            }else{
              $post_per_page = get_option('posts_per_page');
            }            
            $found_posts   = $wp_query->found_posts;
            $bopea_total   = ceil($found_posts / $post_per_page);
            $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $bopea_pagination = paginate_links( array(
                'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
                'format'   => '',
                'total'    => $bopea_total,
                'current'  => max( 1, $bopea_paged ),
                'mid_size' => 2,
                'prev_text' => '<i class="jli-left-chevron"></i>',
                'next_text' => '<i class="jli-right-chevron"></i>',
                'type' => 'list',
            ) );
            echo '<nav class="jellywp_pagination">' . $bopea_pagination . '</nav>';
       }
      }elseif ( is_author() ) {
        if ( $jl_archive_pagination == 'loadmore' ) {
          bopea_blocknav_loadmore( $bopea_qry );
        } elseif ( $jl_archive_pagination == 'autoload' ) {
          bopea_blocknav_autoload( $bopea_qry );
        }else {
            $jl_archive_author_num = get_theme_mod( 'jl_archive_author_num' );
            if ( ! empty( $jl_archive_author_num ) ) {
              $post_per_page = intval( $jl_archive_author_num );
            }else{
              $post_per_page = get_option('posts_per_page');
            }            
            $found_posts   = $wp_query->found_posts;
            $bopea_total   = ceil($found_posts / $post_per_page);
            $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $bopea_pagination = paginate_links( array(
                'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
                'format'   => '',
                'total'    => $bopea_total,
                'current'  => max( 1, $bopea_paged ),
                'mid_size' => 2,
                'prev_text' => '<i class="jli-left-chevron"></i>',
                'next_text' => '<i class="jli-right-chevron"></i>',
                'type' => 'list',
            ) );
            echo '<nav class="jellywp_pagination">' . $bopea_pagination . '</nav>';
       }
      } elseif ( is_search() ) {
        if ( $jl_archive_pagination == 'loadmore' ) {
          bopea_blocknav_loadmore( $bopea_qry );
        } elseif ( $jl_archive_pagination == 'autoload' ) {
          bopea_blocknav_autoload( $bopea_qry );
        }else {
            $jl_archive_search_num = get_theme_mod( 'jl_archive_search_num' );
            if ( ! empty( $jl_archive_search_num ) ) {
              $post_per_page = intval( $jl_archive_search_num );
            }else{
              $post_per_page = get_option('posts_per_page');
            }
            $found_posts   = $wp_query->found_posts;
            $bopea_total   = ceil($found_posts / $post_per_page);
            $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $bopea_pagination = paginate_links( array(
                'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
                'format'   => '',
                'total'    => $bopea_total,
                'current'  => max( 1, $bopea_paged ),
                'mid_size' => 2,
                'prev_text' => '<i class="jli-left-chevron"></i>',
                'next_text' => '<i class="jli-right-chevron"></i>',
                'type' => 'list',
            ) );
            echo '<nav class="jellywp_pagination">' . $bopea_pagination . '</nav>';
       }
    }else{
          $bopea_pagination = paginate_links( array(
              'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
              'format'   => '',
              'total'    => $bopea_total,
              'current'  => max( 1, $bopea_paged ),
              'mid_size' => 2,
              'prev_text' => '<i class="jli-left-chevron"></i>',
              'next_text' => '<i class="jli-right-chevron"></i>',
              'type' => 'list',
          ) );
          echo '<nav class="jellywp_pagination">' . $bopea_pagination . '</nav>';      
    }
  }
}

if ( ! function_exists( 'bopea_get_qry' ) ) {
  function bopea_get_qry() {
    if ( is_category() ) {
        $jl_archive_cat_num = get_theme_mod( 'jl_archive_cat_num' );
        if ( ! empty( $jl_archive_cat_num ) ) {
          $jl_num_post = intval( $jl_archive_cat_num );
        }else{
          $jl_num_post = get_option('posts_per_page');
        }        
        $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $bopea_args = array(
          'cat' => get_query_var('cat'),
          'orderby' => 'date',
          'order' => 'DESC',
          'pagination' => true,
          'post_status' => 'publish',
          'ignore_sticky_posts' => 1,
          'paged' => $bopea_paged
        );
        
        $bopea_args['posts_per_page'] = $jl_num_post;
        $bopea_qry = new WP_Query( $bopea_args );
      }elseif ( is_tag() ) {
        $jl_archive_tag_num = get_theme_mod( 'jl_archive_tag_num' );
        if ( ! empty( $jl_archive_tag_num ) ) {
          $jl_num_post = intval( $jl_archive_tag_num );
        }else{
          $jl_num_post = get_option('posts_per_page');
        }
        $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;        
        $bopea_args = array(
          'tag' => get_queried_object()->slug,
          'orderby' => 'date',
          'order' => 'DESC',
          'post_status' => 'publish',
          'ignore_sticky_posts' => 1,
          'paged' => $bopea_paged
        );
        $bopea_args['posts_per_page'] = $jl_num_post;
        $bopea_qry = new WP_Query( $bopea_args );
      }elseif ( is_author() ) {
        $jl_archive_author_num = get_theme_mod( 'jl_archive_author_num' );
        if ( ! empty( $jl_archive_author_num ) ) {
          $jl_num_post = intval( $jl_archive_author_num );
        }else{
          $jl_num_post = get_option('posts_per_page');
        }
        $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;        
        $bopea_args = array(
          'author' => get_the_author_meta( 'ID' ),
          'orderby' => 'date',
          'order' => 'DESC',
          'post_status' => 'publish',
          'ignore_sticky_posts' => 1,
          'paged' => $bopea_paged
        );
        $bopea_args['posts_per_page'] = $jl_num_post;
        $bopea_qry = new WP_Query( $bopea_args );
      }elseif ( is_search() ) {
        $jl_archive_search_num = get_theme_mod( 'jl_archive_search_num' );
        if ( ! empty( $jl_archive_search_num ) ) {
          $jl_num_post = intval( $jl_archive_search_num );
        }else{
          $jl_num_post = get_option('posts_per_page');
        }
        $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $bopea_args = array(
          'orderby' => 'date',
          'order' => 'DESC',
          'post_status' => 'publish',
          'ignore_sticky_posts' => 1,
          'post_type' => "post",
          's' => get_search_query( 's' ),
          'paged' => $bopea_paged
        );
        $bopea_args['posts_per_page'] = $jl_num_post;
        $bopea_qry = new WP_Query( $bopea_args );
    } elseif ( is_page() ) {
          $bopea_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;          
          $bopea_args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'paged' => $bopea_paged,
          );
          $bopea_qry = new WP_Query( $bopea_args );
      } else {
          global $wp_query;
          $bopea_qry = $wp_query;          
      }

      return $bopea_qry;
  }
}

add_action( 'pre_get_posts', 'bopea_posts_per_page' );
if ( ! function_exists( 'bopea_posts_per_page' ) ){
	function bopea_posts_per_page( $query ) {
    $jl_ache_pagi = get_theme_mod('jl_archive_pagination', 'number');
    if( $query->is_main_query() && !is_admin() && $jl_ache_pagi == 'number') {
			if ( $query->is_search() ) {
				$jl_archive_search_num = get_theme_mod( 'jl_archive_search_num' );
				if ( ! empty( $jl_archive_search_num ) ) {
					$query->set( 'posts_per_page', intval( $jl_archive_search_num ) );
				}else{
          $query->set( 'posts_per_page', get_option('posts_per_page') );
        }
			} elseif ( $query->is_category() ) {
        $jl_archive_cat_num = get_theme_mod( 'jl_archive_cat_num' );
				if ( ! empty( $jl_archive_cat_num ) ) {
					$query->set( 'posts_per_page', intval( $jl_archive_cat_num ) );
				}else{
          $query->set( 'posts_per_page', get_option('posts_per_page') );
        }
			} elseif ( $query->is_tag() ) {
        $jl_archive_tag_num = get_theme_mod( 'jl_archive_tag_num' );
        if ( ! empty( $jl_archive_tag_num ) ) {
          $query->set( 'posts_per_page', intval( $jl_archive_tag_num ) );
        }else{
          $query->set( 'posts_per_page', get_option('posts_per_page') );
        }
      } elseif ( $query->is_author() ) {
				$jl_archive_author_num = get_theme_mod( 'jl_archive_author_num' );
				if ( ! empty( $jl_archive_author_num ) ) {
					$query->set( 'posts_per_page', intval( $jl_archive_author_num ) );
				}else{
          $query->set( 'posts_per_page', get_option('posts_per_page') );
        }
			}      
	}
}
}

include get_template_directory() . '/inc/misc/core.php';
include get_template_directory() . '/inc/misc/header-nav.php';
include get_template_directory() . '/inc/misc/layout-grid.php';
include get_template_directory() . '/inc/misc/layout-grid-circle.php';
include get_template_directory() . '/inc/misc/layout-list.php';
include get_template_directory() . '/inc/misc/layout-list-number.php';
include get_template_directory() . '/inc/misc/layout-small-list.php';
include get_template_directory() . '/inc/misc/layout-mini-list.php';
include get_template_directory() . '/inc/misc/layout-classic.php';
include get_template_directory() . '/inc/misc/layout-overlay.php';
include get_template_directory() . '/inc/misc/layout-slider.php';
include get_template_directory() . '/inc/misc/layout-slider-tab.php';
include get_template_directory() . '/inc/misc/layout-hover.php';
include get_template_directory() . '/inc/misc/layout-center-slider.php';
include get_template_directory() . '/inc/misc/layout-carousel.php';
include get_template_directory() . '/inc/misc/layout-featured-1.php';
include get_template_directory() . '/inc/misc/layout-featured-2.php';
include get_template_directory() . '/inc/misc/layout-featured-3.php';
include get_template_directory() . '/inc/misc/layout-featured-4.php';
include get_template_directory() . '/inc/misc/layout-featured-5.php';
include get_template_directory() . '/inc/misc/layout-featured-6.php';
include get_template_directory() . '/inc/misc/layout-featured-7.php';
include get_template_directory() . '/inc/misc/layout-featured-8.php';
include get_template_directory() . '/inc/misc/layout-featured-9.php';
include get_template_directory() . '/inc/misc/layout-featured-10.php';
include get_template_directory() . '/inc/misc/layout-featured-11.php';
include get_template_directory() . '/inc/misc/layout-featured-12.php';
include get_template_directory() . '/inc/misc/layout-featured-13.php';
include get_template_directory() . '/inc/misc/layout-featured-18.php';
include get_template_directory() . '/inc/misc/layout-featured-19.php';
include get_template_directory() . '/inc/misc/layout-featured-20.php';
include get_template_directory() . '/inc/misc/layout-marquee.php';
include get_template_directory() . '/inc/misc/layout-newsticker.php';
include get_template_directory() . '/inc/misc/layout-small-main-right-list.php';
include get_template_directory() . '/inc/misc/layout-small-main-below-2list.php';
include get_template_directory() . '/inc/misc/layout-small-main-below-list.php';
include get_template_directory() . '/inc/misc/layout-small-2main-below-list.php';
include get_template_directory() . '/inc/misc/layout-small-ov-main-below-list.php';
include get_template_directory() . '/inc/misc/layout-video.php';
include get_template_directory() . '/inc/misc/menu-p-layout.php';
include get_template_directory() . '/inc/misc/strings.php';
include get_template_directory() . '/inc/customizer/customizer.php';
include get_template_directory() . '/inc/functions/menu-option.php';
include get_template_directory() . '/inc/functions/class-tgm-plugin-activation.php';
include get_template_directory() . '/inc/functions/required-plugins.php';

if ( ! function_exists( 'bopea_fonts' ) ) {
  function bopea_fonts() {
  	  $google_font = '';
      $title_style_text = get_theme_mod('bopea_title_font_family', 'Work Sans');
      $bopea_title_font_weight = get_theme_mod('bopea_title_font_weight', '700');
      if (strpos($title_style_text, 'jl_c_') !== false){
        $title_style_text = '';
      }else{
        $title_style_text = $title_style_text.':'.$bopea_title_font_weight.'|';
      }
      $paragrap_style_text = get_theme_mod('bopea_p_font_family', 'Oxygen');
      $bopea_p_font_weight = get_theme_mod('bopea_p_font_weight', '400');
      if (strpos($paragrap_style_text, 'jl_c_') !== false){
        $paragrap_style_text = '';
      }else{
        $paragrap_style_text = $paragrap_style_text.':'.$bopea_p_font_weight.',700|';
      }
      $menu_font_style = get_theme_mod('bopea_menu_font_family', 'Work Sans');
      $bopea_menu_font_weight = get_theme_mod('bopea_menu_font_weight', '600');
      $bopea_sub_menu_font_weight = ','.get_theme_mod('bopea_sub_menu_font_weight', '500');
      $cat_font_weight = get_theme_mod('bopea_cat_font_weight', '500');
      $bopea_meta_font_weight = get_theme_mod('bopea_meta_font_weight', '400');
      if (strpos($menu_font_style, 'jl_c_') !== false){
        $menu_font_style = '';
      }else{
        $menu_font_style = $menu_font_style.':'.$bopea_menu_font_weight.','.$bopea_sub_menu_font_weight.','.$cat_font_weight.','.$bopea_meta_font_weight.',';
      }
      if (strpos($title_style_text, 'jl_c_') !== false && strpos($paragrap_style_text, 'jl_c_') !== false && strpos($menu_font_style, 'jl_c_') !== false) {
        $google_font ='';
      }else{
        $google_font = add_query_arg( array(
           'family' => urlencode ( $title_style_text.$paragrap_style_text.$menu_font_style ),
           'display' => 'swap',
        ), '//fonts.googleapis.com/css' );
      }
      return esc_url_raw($google_font);
  }
}

add_action( 'wp_enqueue_scripts', 'bopea_font_scripts' );
if ( ! function_exists( 'bopea_font_scripts' ) ) {
  function bopea_font_scripts() {
    $title_style_text = get_theme_mod('bopea_title_font_family', 'Work Sans');
    $paragrap_style_text = get_theme_mod('bopea_p_font_family', 'Oxygen');
    $menu_font_style = get_theme_mod('bopea_menu_font_family', 'Work Sans');
    if (strpos($title_style_text, 'jl_c_') !== false && strpos($paragrap_style_text, 'jl_c_') !== false && strpos($menu_font_style, 'jl_c_') !== false) {
    }else{
      wp_enqueue_style( 'bopea_fonts_url', bopea_fonts(), array(), BOPEA_VERSION );
    }
  }
}

add_action( 'enqueue_block_editor_assets', 'bopea_editor', 90 );
if ( ! function_exists( 'bopea_editor' ) ) {
  function bopea_editor() {
      wp_enqueue_style( 'bopea-editor-fonts', bopea_fonts(), array(), BOPEA_VERSION );      
      wp_enqueue_style( 'bopea-editor-style', get_template_directory_uri().'/css/editor.css', false, BOPEA_VERSION );            
      wp_add_inline_style( 'bopea-editor-style', bopea_editor_dynamic_css() );
  }
}

add_action( 'wp_enqueue_scripts', 'bopea_load_css' );
if ( ! function_exists( 'bopea_load_css' ) ) {
  function bopea_load_css() {
  		wp_enqueue_style( 'bopea_layout', get_template_directory_uri().'/css/layout.css', false, BOPEA_VERSION );
      wp_enqueue_style( 'bopea_style', get_template_directory_uri().'/style.css', false, BOPEA_VERSION );
      if ( is_rtl() ) {
      wp_enqueue_style( 'bopea_style_rtl', get_template_directory_uri().'/rtl-style.css', false, BOPEA_VERSION );
      }
      wp_enqueue_style( 'glightbox', get_template_directory_uri().'/css/glightbox.min.css', false, BOPEA_VERSION );
      wp_enqueue_style( 'swiper', get_template_directory_uri().'/css/swiper.min.css', false, BOPEA_VERSION );
      wp_add_inline_style( 'bopea_style', bopea_generate_dynamic_css() );
  }
}

add_action( 'wp_enqueue_scripts', 'bopea_enqueue_script' );
if ( ! function_exists( 'bopea_enqueue_script' ) ) {
  function bopea_enqueue_script() {
  	  wp_enqueue_script( 'swiper', get_template_directory_uri().'/js/swiper.min.js', array('jquery'), BOPEA_VERSION, true );
      wp_enqueue_script( 'cookie', get_template_directory_uri().'/js/cookie.min.js', array('jquery'), BOPEA_VERSION, true );
      wp_enqueue_script( 'lazysizes', get_template_directory_uri().'/js/lazysizes.min.js', array('jquery'), BOPEA_VERSION, true );
      wp_enqueue_script( 'glightbox', get_template_directory_uri().'/js/glightbox.min.js', array('jquery'), BOPEA_VERSION, true );
      wp_enqueue_script( 'bopea-custom', get_template_directory_uri().'/js/customs.js', array('jquery'), BOPEA_VERSION, true );
      wp_localize_script( 'bopea-custom', 'jlParamsOpt',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'opt_dark' => get_theme_mod('enable_dark_skin'),
      ));

    if(!empty(get_theme_mod('enable_pin_it'))){
      if(is_single() or is_page()){
        function bopea_pinit_process_selectors( $selectors = array() ) {
          if ( ! $selectors ) {
            $selectors = array();
          }
          if ( is_string( $selectors ) ) {
            $selectors = str_replace( "\r\n", ',', $selectors );
            $selectors = explode( ',', $selectors );
          }
          $selectors = array_filter( $selectors, 'strlen' );
          return $selectors;
        }
          wp_enqueue_script( 'bopea-pinterest', '//assets.pinterest.com/js/pinit.js', array( 'jquery' ), false, true );  
          wp_enqueue_script( 'bopea-pin-it', get_theme_file_uri( '/js/jquery-pin-it.js' ), array( 'jquery' ), BOPEA_VERSION, true );
      
          $image_selectors   = array( '.post_content img' );
          $exclude_selectors = array('.nopin');
      
          $image_selectors   = bopea_pinit_process_selectors( $image_selectors );
          $exclude_selectors = bopea_pinit_process_selectors( $exclude_selectors );
          
          $icon = '<i class="jli-pinterest"></i>';
          $iconclass = 'pinitsvg';      
          
          wp_localize_script( 'bopea-pin-it', 'bopea_pinit_localize', array(
            'image_selectors'   => implode( ',', $image_selectors ),
            'exclude_selectors' => implode( ',', $exclude_selectors ),
            'icon' => $icon,
            'iconclass' => $iconclass,
          ) );
      }
    }
  }
}
?>