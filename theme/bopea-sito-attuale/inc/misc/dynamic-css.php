<?php
$max_content_width = get_theme_mod('max_content_width','1260px');
$jl_boxed_space = get_theme_mod('jl_boxed_space','30px');
// Logo
$logo_width = get_theme_mod('logo_width','110px');
$m_logo_width = get_theme_mod('m_logo_width','110px');
$s_logo_width = get_theme_mod('s_logo_width','110px');
$foot_logo_width = get_theme_mod('foot_logo_width','110px');

$jl_logo_size = get_theme_mod('jl_logo_size', '32px');
$jl_logo_size_mob = get_theme_mod('jl_logo_size_mob', '30px');
$logo_txt_lspace = get_theme_mod('logo_txt_lspace');
$jl_logo_color = get_theme_mod('jl_logo_color','#fff');
$jl_logo_color_dark = get_theme_mod('jl_logo_color_dark','#fff');
$jl_logo_color_side = get_theme_mod('jl_logo_color_side','#000');
$jl_logo_color_side_dark = get_theme_mod('jl_logo_color_side_dark','#fff');
$jl_logo_color_foot = get_theme_mod('jl_logo_color_foot','#000');
$jl_logo_color_foot_dark = get_theme_mod('jl_logo_color_foot_dark','#fff');

// Header
$section_menu_height = get_theme_mod('section_menu_height','65px');

//Menu
$bopea_menu_font_family = get_theme_mod('bopea_menu_font_family', 'Work Sans');
$bopea_menu_font_size = get_theme_mod('bopea_menu_font_size', '17px');
$bopea_menu_font_weight = get_theme_mod('bopea_menu_font_weight', '600');
$bopea_menu_transform = get_theme_mod('bopea_menu_transform', 'capitalize');
$letter_spacing_menu = get_theme_mod('letter_spacing_menu', '-0.03em');
$spacing_menu = get_theme_mod('spacing_menu', '25px');
$ac_menu_line_height = get_theme_mod('ac_menu_line_height', '3px');
$jl_sub_radius = get_theme_mod('jl_sub_radius', '8px');

//Sub Menu
$bopea_sub_menu_font_size = get_theme_mod('bopea_sub_menu_font_size', '15px');
$bopea_sub_menu_font_weight = get_theme_mod('bopea_sub_menu_font_weight', '500');
$sub_menu_transform = get_theme_mod('sub_menu_transform', 'capitalize');
$sub_spacing_menu = get_theme_mod('sub_spacing_menu', '-0.02em');

//Paragraph
$bopea_p_font_family = get_theme_mod('bopea_p_font_family', 'Oxygen');
$bopea_p_font_size = get_theme_mod('bopea_p_font_size', '16px');
$bopea_p_font_weight = get_theme_mod('bopea_p_font_weight', '400');
$letter_spacing_content = get_theme_mod('letter_spacing_content', '0em');
$p_line_height = get_theme_mod('p_line_height', '1.7');
$body_font_size = get_theme_mod('body_font_size', '15px');
$letter_spacing_body = get_theme_mod('letter_spacing_body', '0em');
$body_line_height = get_theme_mod('body_line_height', '1.5');

//Title
$bopea_title_font_family = get_theme_mod('bopea_title_font_family', 'Work Sans');
$bopea_title_font_weight = get_theme_mod('bopea_title_font_weight', '700');
$bopea_title_transform = get_theme_mod('bopea_title_transform', 'none');
$letter_spacing_heading = get_theme_mod('letter_spacing_heading', '-0.02em');
$line_height_heading = get_theme_mod('line_height_heading', '1.2');
$jl_title_h = get_theme_mod('jl_title_h', '1px');
if(empty($jl_title_h)){
    $jl_title_h = '1px';
}

//Catgory, Meta, Button
$bopea_cat_font_size    = get_theme_mod('bopea_cat_font_size', '13px');
$bopea_cat_font_weight = get_theme_mod('bopea_cat_font_weight', '500');
$bopea_cat_transform	= get_theme_mod('bopea_cat_transform', 'capitalize');
$letter_spacing_cat 	= get_theme_mod('letter_spacing_cat', '-0.03em');
$bopea_meta_font_size 	= get_theme_mod('bopea_meta_font_size', '13px');
$bopea_meta_font_ssize 	= get_theme_mod('bopea_meta_font_ssize', '14px');
$bopea_meta_font_weight = get_theme_mod('bopea_meta_font_weight', '400');
$bopea_meta_a_font_weight = get_theme_mod('bopea_meta_a_font_weight', '500');
$bopea_meta_transform     = get_theme_mod('bopea_meta_transform', 'capitalize');
$letter_spacing_meta     = get_theme_mod('letter_spacing_meta', '-0.03em');

// Button setting
$bopea_button_font_size = get_theme_mod('bopea_button_font_size', '14px');
$bopea_button_font_weight = get_theme_mod('bopea_button_font_weight', '500');
$bopea_button_transform = get_theme_mod('bopea_button_transform', 'capitalize');
$letter_spacing_button = get_theme_mod('letter_spacing_button', '0em');
$button_radius = get_theme_mod('button_radius', '5px');

// Load more setting
$bopea_loadmore_font_size = get_theme_mod('bopea_loadmore_font_size', '13px');
$bopea_loadmore_font_weight = get_theme_mod('bopea_loadmore_font_weight', '500');
$bopea_loadmore_transform = get_theme_mod('bopea_loadmore_transform', 'capitalize');
$letter_spacing_loadmore = get_theme_mod('letter_spacing_loadmore', '0em');
$load_more_radius = get_theme_mod('load_more_radius', '0px');

// Form
$bopea_form_font_size = get_theme_mod('bopea_form_font_size', '15px');
$form_radius = get_theme_mod('form_radius', '5px');

// Other blog
$border_rounded = get_theme_mod('border_rounded', '5px');
$top_border_rounded = get_theme_mod('top_border_rounded', '6px');
$bopea_related_size = get_theme_mod('bopea_related_size', '18px');

$excpt_font_size = get_theme_mod('excpt_font_size', '14px');
$excpt_t_font_size = get_theme_mod('excpt_t_font_size', '14px');
$excpt_m_font_size = get_theme_mod('excpt_m_font_size', '14px');
$letter_spacing_excpt = get_theme_mod('letter_spacing_excpt', '0em');
$excpt_line_height = get_theme_mod('excpt_line_height', '1.5');
$excpt_num_row = get_theme_mod('excpt_num_row', '2');

$jl_pa_ach = get_theme_mod('jl_pa_ach', '33px');
$jl_pa_ach_sm = get_theme_mod('jl_pa_ach_sm', '30px');
$jl_pa_ach_excp = get_theme_mod('jl_pa_ach_excp', '16px');
$jl_pa_ach_excp_sm = get_theme_mod('jl_pa_ach_excp_sm', '15px');

// Archive post title size
$jl_ach_list_title = get_theme_mod('jl_ach_list_title', '20px');
$jl_ach_large_title = get_theme_mod('jl_ach_large_title', '35px');
$jl_ach_g2col_title = get_theme_mod('jl_ach_g2col_title', '22px');
$jl_ach_g3col_title = get_theme_mod('jl_ach_g3col_title', '22px');
$jl_ach_g4col_title = get_theme_mod('jl_ach_g4col_title', '17px');
$jl_ach_gov2col_title = get_theme_mod('jl_ach_gov2col_title', '23px');
$jl_ach_gov3col_title = get_theme_mod('jl_ach_gov3col_title', '22px');
$jl_ach_gov4col_title = get_theme_mod('jl_ach_gov4col_title', '18px');

//single post
$sg_head_title = get_theme_mod('sg_head_title', '35px');
$sg_head_title_md = get_theme_mod('sg_head_title_md', '34px');
$sg_head_title_sm = get_theme_mod('sg_head_title_sm', '26px');

$sg_head_excp = get_theme_mod('sg_head_excp', '17px');
$sg_head_excp_md = get_theme_mod('sg_head_excp_md', '17px');
$sg_head_excp_sm = get_theme_mod('sg_head_excp_sm', '17px');

$g_img_height = get_theme_mod('g_img_height','56.25%');
if(empty($g_img_height)){
    $g_img_height = '56.25%';
}

//cookie
$jl_cookie_wdith = get_theme_mod('jl_cookie_wdith', '700px');
$jl_cookie_space = get_theme_mod('jl_cookie_space', '10px');
$jl_cookie_radius = get_theme_mod('jl_cookie_radius', '10px');
$jl_cookie_padding = get_theme_mod('jl_cookie_padding', '15px');
$jl_cookie_pos = get_theme_mod('jl_cookie_pos', 'center');
$jl_cookie_dec_size = get_theme_mod('jl_cookie_dec_size', '13px');
$jl_cookie_btn_size = get_theme_mod('jl_cookie_btn_size', '12px');
$jl_cookie_btn_radius = get_theme_mod('jl_cookie_btn_radius', '5px');
$jl_cookie_btn_space = get_theme_mod('jl_cookie_btn_space', '0em');
$jl_cookie_btn_tranform = get_theme_mod('jl_cookie_btn_tranform', 'capitalize');

//progress bar
$sp_progress_height = get_theme_mod('sp_progress_height','5px');
$sp_progress_pos = get_theme_mod('sp_progress_pos','top');
$sp_color1 = get_theme_mod('sp_color1','#ae5eff');
$sp_color2 = get_theme_mod('sp_color2','#8100ff');

// Theme color
$theme_color = get_theme_mod('theme_color');
if(empty($theme_color)){$theme_color = '#7118ff';}

$ac_menu_line_color = get_theme_mod('ac_menu_line_color');
if(empty($ac_menu_line_color)){
    $ac_menu_line_color = $theme_color;
}else{
    $ac_menu_line_color = $ac_menu_line_color;
}

$theme_color_dark = get_theme_mod('theme_color_dark');
if(empty($theme_color_dark)){$theme_color_dark = '#7118ff';}

$theme_bg_color = get_theme_mod('theme_bg_color');
if(empty($theme_bg_color)){$theme_bg_color = '#FFF';}

$theme_bg_color_dark = get_theme_mod('theme_bg_color_dark');
if(empty($theme_bg_color_dark)){$theme_bg_color_dark = '#010617';}

$theme_boxed_bg_color = get_theme_mod('theme_boxed_bg_color');
if(empty($theme_boxed_bg_color)){$theme_boxed_bg_color = '#FFF';}

$theme_boxed_bg_color_dark = get_theme_mod('theme_boxed_bg_color_dark');
if(empty($theme_boxed_bg_color_dark)){$theme_boxed_bg_color_dark = '#010617';}

$theme_text_color = get_theme_mod('theme_text_color');
if(empty($theme_text_color)){$theme_text_color = '#000';}

$theme_text_color_dark = get_theme_mod('theme_text_color_dark');
if(empty($theme_text_color_dark)){$theme_text_color_dark = '#FFF';}

// Menu color
$menu_bg_color = get_theme_mod('menu_bg_color');
if(empty($menu_bg_color)){ $menu_bg_color = '#ffffff';}

$menu_bg_color_dark = get_theme_mod('menu_bg_color_dark');
if(empty($menu_bg_color_dark)){ $menu_bg_color_dark = '#000f45';}

$menu_text_color = get_theme_mod('menu_text_color');
if(empty($menu_text_color)){ $menu_text_color = '#000000';}

$menu_text_color_dark = get_theme_mod('menu_text_color_dark');
if(empty($menu_text_color_dark)){ $menu_text_color_dark = '#FFF';}

$menu_text_hcolor = get_theme_mod('menu_text_hcolor');
if(empty($menu_text_hcolor)){ $menu_text_hcolor = '#000000';}

$menu_text_hcolor_dark = get_theme_mod('menu_text_hcolor_dark');
if(empty($menu_text_hcolor_dark)){ $menu_text_hcolor_dark = '#FFF';}

$submenu_back_color = get_theme_mod('submenu_back_color');
if(empty($submenu_back_color)){ $submenu_back_color = '#fff';}

$submenu_back_color_dark = get_theme_mod('submenu_back_color_dark');
if(empty($submenu_back_color_dark)){ $submenu_back_color_dark = '#222';}

$submenu_text_color = get_theme_mod('submenu_text_color');
if(empty($submenu_text_color)){ $submenu_text_color = '#000';}

$submenu_text_color_dark = get_theme_mod('submenu_text_color_dark');
if(empty($submenu_text_color_dark)){ $submenu_text_color_dark = '#FFF';}

$menu_line_color = get_theme_mod('menu_line_color');
if(empty($menu_line_color)){ $menu_line_color = '#eeedeb';}

$menu_line_color_dark = get_theme_mod('menu_line_color_dark');
if(empty($menu_line_color_dark)){ $menu_line_color_dark = '#ffffff26';}

$submenu_line_color = get_theme_mod('submenu_line_color');
if(empty($submenu_line_color)){ $submenu_line_color = '#eeeeee';}

$submenu_line_color_dark = get_theme_mod('submenu_line_color_dark');
if(empty($submenu_line_color_dark)){ $submenu_line_color_dark = '#464646';}

$submenu_hbg = get_theme_mod('submenu_hbg');
if(empty($submenu_hbg)){ $submenu_hbg = '#f6f6f6';}

$submenu_hbg_dark = get_theme_mod('submenu_hbg_dark');
if(empty($submenu_hbg_dark)){ $submenu_hbg_dark = '#333';}

$submenu_hcolor = get_theme_mod('submenu_hcolor');
if(empty($submenu_hcolor)){ $submenu_hcolor = '#7118ff';}

$submenu_hcolor_dark = get_theme_mod('submenu_hcolor_dark');
if(empty($submenu_hcolor_dark)){ $submenu_hcolor_dark = '#7118ff';}


// Top menu color
$cookie_bg_color = get_theme_mod('cookie_bg_color');
if(empty($cookie_bg_color)){ $cookie_bg_color = '#fff';}

$cookie_text_color = get_theme_mod('cookie_text_color');
if(empty($cookie_text_color)){ $cookie_text_color = '#000';}

$cookie_bg_color_dark = get_theme_mod('cookie_bg_color_dark');
if(empty($cookie_bg_color_dark)){ $cookie_bg_color_dark = '#222';}

$cookie_text_color_dark = get_theme_mod('cookie_text_color_dark');
if(empty($cookie_text_color_dark)){ $cookie_text_color_dark = '#FFF';}

$section_top_bar_size = get_theme_mod('section_top_bar_size','15px');

// Logo section color
$head_logo_bg_color = get_theme_mod('head_logo_bg_color');
if(empty($head_logo_bg_color)){ $head_logo_bg_color = '#FFF';}

$head_logo_bg_color_dark = get_theme_mod('head_logo_bg_color_dark');
if(empty($head_logo_bg_color_dark)){ $head_logo_bg_color_dark = '#111';}

$head_logo_text_color = get_theme_mod('head_logo_text_color');
if(empty($head_logo_text_color)){ $head_logo_text_color = '#000';}

$head_logo_text_color_dark = get_theme_mod('head_logo_text_color_dark');
if(empty($head_logo_text_color_dark)){ $head_logo_text_color_dark = '#FFF';}

// Single color
$single_color = get_theme_mod('single_color');
if(empty($single_color)){$single_color = '#282828';}

$single_color_dark = get_theme_mod('single_color_dark');
if(empty($single_color_dark)){$single_color_dark = '#FFF';}

$single_link_color = get_theme_mod('single_link_color');
if(empty($single_link_color)){$single_link_color = '#7118ff';}

$single_link_color_dark = get_theme_mod('single_link_color_dark');
if(empty($single_link_color_dark)){$single_link_color_dark = '#7118ff';}

$single_link_hover_color = get_theme_mod('single_link_hover_color');
if(empty($single_link_hover_color)){$single_link_hover_color = '#7118ff';}

$single_link_hover_color_dark = get_theme_mod('single_link_hover_color_dark');
if(empty($single_link_hover_color_dark)){$single_link_hover_color_dark = '#7118ff';}

$post_meta_color = get_theme_mod('post_meta_color');
if(empty($post_meta_color)){$post_meta_color = '#0a0a0a';}

$post_meta_color_dark = get_theme_mod('post_meta_color_dark');
if(empty($post_meta_color_dark)){$post_meta_color_dark = '#fff';}

$post_except_color = get_theme_mod('post_except_color');
if(empty($post_except_color)){$post_except_color = '#666';}

$post_except_color_dark = get_theme_mod('post_except_color_dark');
if(empty($post_except_color_dark)){$post_except_color_dark = '#ddd';}

$post_line_color = get_theme_mod('post_line_color');
if(empty($post_line_color)){$post_line_color = '#e9e9e9';}

$post_line_color_dark = get_theme_mod('post_line_color_dark');
if(empty($post_line_color_dark)){$post_line_color_dark = '#494949';}

$category_label_padding = get_theme_mod('category_label_padding', '4px 10px');
$category_label_radius = get_theme_mod('category_label_radius', '16px');

// Footer color
$footer_bg_color = get_theme_mod('footer_bg_color');
if(empty($footer_bg_color)){$footer_bg_color = '#F9F9FA';}

$footer_bg_dark = get_theme_mod('footer_bg_dark');
if(empty($footer_bg_dark)){$footer_bg_dark = '#020D34';}

$footer_text_color = get_theme_mod('footer_text_color');
if(empty($footer_text_color)){$footer_text_color = '#000';}

$footer_text_dark = get_theme_mod('footer_text_dark');
if(empty($footer_text_dark)){$footer_text_dark = '#fff';}

$footer_link_color = get_theme_mod('footer_link_color');
if(empty($footer_link_color)){$footer_link_color = '#000';}

$footer_link_dark = get_theme_mod('footer_link_dark');
if(empty($footer_link_dark)){$footer_link_dark = '#fff';}

$footer_link_hcolor = get_theme_mod('footer_link_hcolor');
if(empty($footer_link_hcolor)){$footer_link_hcolor = '#7118ff';}

$footer_link_hdark = get_theme_mod('footer_link_hdark');
if(empty($footer_link_hdark)){$footer_link_hdark = '#7118ff';}

$footer_head_color = get_theme_mod('footer_head_color');
if(empty($footer_head_color)){$footer_head_color = '#000';}

$footer_head_color_dark = get_theme_mod('footer_head_color_dark');
if(empty($footer_head_color_dark)){$footer_head_color_dark = '#fff';}

$footer_line_color = get_theme_mod('footer_line_color');
if(empty($footer_line_color)){$footer_line_color = 'rgba(136,136,136,0.15)';}

$footer_line_color_dark = get_theme_mod('footer_line_color_dark');
if(empty($footer_line_color_dark)){$footer_line_color_dark = 'rgba(136,136,136,0.15)';}

$footer_menu_col = get_theme_mod('footer_menu_col', '1');
$footer_title_size = get_theme_mod('footer_title_size', '18px');
$footer_font_size = get_theme_mod('footer_font_size', '14px');
$footer_copyright_size = get_theme_mod('footer_copyright_size', '14px');
$footer_menu_size = get_theme_mod('footer_menu_size', '14px');

// Widget
$bopea_widget_font_size = get_theme_mod('bopea_widget_font_size', '18px');
$bopea_widget_letter_spacing = get_theme_mod('bopea_widget_letter_spacing', '-0.03em');
$bopea_widget_transform = get_theme_mod('bopea_widget_transform', 'capitalize');


// Theme heading and single heading color
$theme_head_color = get_theme_mod('theme_head_color');
if(empty($theme_head_color)){$theme_head_color = '#000';}
$theme_head_color_dark = get_theme_mod('theme_head_color_dark');
if(empty($theme_head_color_dark)){$theme_head_color_dark = '#fff';}

$single_head_color = get_theme_mod('single_head_color');
if(empty($single_head_color)){$single_head_color = '#000';}
$single_head_color_dark = get_theme_mod('single_head_color_dark');
if(empty($single_head_color_dark)){$single_head_color_dark = '#fff';}

$post_h1_color = get_theme_mod('post_h1_color');
if(empty($post_h1_color)){$post_h1_color = '#000';}
$post_h1_color_dark = get_theme_mod('post_h1_color_dark');
if(empty($post_h1_color_dark)){$post_h1_color_dark = '#fff';}

$post_h2_color = get_theme_mod('post_h2_color');
if(empty($post_h2_color)){$post_h2_color = '#000';}
$post_h2_color_dark = get_theme_mod('post_h2_color_dark');
if(empty($post_h2_color_dark)){$post_h2_color_dark = '#fff';}

$post_h3_color = get_theme_mod('post_h3_color');
if(empty($post_h3_color)){$post_h3_color = '#000';}
$post_h3_color_dark = get_theme_mod('post_h3_color_dark');
if(empty($post_h3_color_dark)){$post_h3_color_dark = '#fff';}

$post_h4_color = get_theme_mod('post_h4_color');
if(empty($post_h4_color)){$post_h4_color = '#000';}
$post_h4_color_dark = get_theme_mod('post_h4_color_dark');
if(empty($post_h4_color_dark)){$post_h4_color_dark = '#fff';}

$post_h5_color = get_theme_mod('post_h5_color');
if(empty($post_h5_color)){$post_h5_color = '#000';}
$post_h5_color_dark = get_theme_mod('post_h5_color_dark');
if(empty($post_h5_color_dark)){$post_h5_color_dark = '#fff';}

$post_h6_color = get_theme_mod('post_h6_color');
if(empty($post_h6_color)){$post_h6_color = '#000';}
$post_h6_color_dark = get_theme_mod('post_h6_color_dark');
if(empty($post_h6_color_dark)){$post_h6_color_dark = '#fff';}

// Canvas
$canvas_width = get_theme_mod('canvas_width','350px');
$canvas_bg = get_theme_mod('canvas_bg');
if(empty($canvas_bg)){$canvas_bg = '#fff';}
$canvas_bg_dark = get_theme_mod('canvas_bg_dark');
if(empty($canvas_bg_dark)){$canvas_bg_dark = '#010617';}

$canvas_color = get_theme_mod('canvas_color');
if(empty($canvas_color)){$canvas_color = '#000';}
$canvas_color_dark = get_theme_mod('canvas_color_dark');
if(empty($canvas_color_dark)){$canvas_color_dark = '#fff';}

$canvas_title = get_theme_mod('canvas_title');
if(empty($canvas_title)){$canvas_title = '#000';}
$canvas_title_dark = get_theme_mod('canvas_title_dark');
if(empty($canvas_title_dark)){$canvas_title_dark = '#fff';}

$canvas_meta = get_theme_mod('canvas_meta');
if(empty($canvas_meta)){$canvas_meta = '#0a0a0a';}
$canvas_meta_dark = get_theme_mod('canvas_meta_dark');
if(empty($canvas_meta_dark)){$canvas_meta_dark = '#ddd';}

$canvas_line = get_theme_mod('canvas_line');
if(empty($canvas_line)){$canvas_line = '#e9ecef';}
$canvas_line_dark = get_theme_mod('canvas_line_dark');
if(empty($canvas_line_dark)){$canvas_line_dark = '#303041';}

?>
body.options_dark_skin{
    --jl-logo-txt-color: <?php echo esc_attr($jl_logo_color_dark);?>;
    --jl-logo-txt-side-color: <?php echo esc_attr($jl_logo_color_side_dark);?>;
    --jl-logo-txt-foot-color: <?php echo esc_attr($jl_logo_color_foot_dark);?>;   
    
    --jl-sh-bg: #fff;

    --jl-theme-head-color: <?php echo esc_attr($theme_head_color_dark);?>;
    --jl-single-head-color: <?php echo esc_attr($single_head_color_dark);?>;
    --jl-single-h1-color: <?php echo esc_attr($post_h1_color_dark);?>;
    --jl-single-h2-color: <?php echo esc_attr($post_h2_color_dark);?>;
    --jl-single-h3-color: <?php echo esc_attr($post_h3_color_dark);?>;
    --jl-single-h4-color: <?php echo esc_attr($post_h4_color_dark);?>;
    --jl-single-h5-color: <?php echo esc_attr($post_h5_color_dark);?>;
    --jl-single-h6-color: <?php echo esc_attr($post_h6_color_dark);?>;

    --jl-main-color: <?php echo esc_attr($theme_color_dark);?>;
    --jl-bg-color: <?php echo esc_attr($theme_bg_color_dark);?>;
    --jl-boxbg-color: <?php echo esc_attr($theme_boxed_bg_color_dark);?>;
    --jl-txt-color: <?php echo esc_attr($theme_text_color_dark);?>;
    --jl-btn-bg: #454545;
    --jl-comment-btn-link: #454545;
    --jl-comment-btn-linkc: #FFF;
    
    --jlgdpr-bg: <?php echo esc_attr($cookie_bg_color_dark);?>;
    --jlgdpr-color: <?php echo esc_attr($cookie_text_color_dark);?>;
    
    --jl-menu-bg: <?php echo esc_attr($menu_bg_color_dark);?>;
    --jl-menu-line-color: <?php echo esc_attr($menu_line_color_dark);?>;
    --jl-menu-color: <?php echo esc_attr($menu_text_color_dark);?>;
    --jl-menu-hcolor: <?php echo esc_attr($menu_text_hcolor_dark);?>;
    --jl-sub-bg-color: <?php echo esc_attr($submenu_back_color_dark);?>;
    --jl-sub-menu-color: <?php echo esc_attr($submenu_text_color_dark);?>;
    --jl-sub-line-color: <?php echo esc_attr($submenu_line_color_dark);?>;
    --jl-sub-item-bg: <?php echo esc_attr($submenu_hbg_dark);?>;
    --jl-sub-hcolor: <?php echo esc_attr($submenu_hcolor_dark);?>;
    --jl-logo-bg: <?php echo esc_attr($head_logo_bg_color_dark);?>;
    --jl-logo-color: <?php echo esc_attr($head_logo_text_color_dark);?>;

    --jl-single-color: <?php echo esc_attr($single_color_dark);?>;
    --jl-single-link-color: <?php echo esc_attr($single_link_color_dark);?>;
    --jl-single-link-hcolor: <?php echo esc_attr($single_link_hover_color_dark);?>;
    --jl-except-color: <?php echo esc_attr($post_except_color_dark);?>;
    --jl-meta-color: <?php echo esc_attr($post_meta_color_dark);?>;
    --jl-post-line-color: <?php echo esc_attr($post_line_color_dark);?>;
    --jl-author-bg: #454545;

    --jl-foot-bg: <?php echo esc_attr($footer_bg_dark);?>;
    --jl-foot-color: <?php echo esc_attr($footer_text_dark);?>;
    --jl-foot-link: <?php echo esc_attr($footer_link_dark);?>;
    --jl-foot-hlink: <?php echo esc_attr($footer_link_hdark);?>;
    --jl-foot-head: <?php echo esc_attr($footer_head_color_dark);?>;
    --jl-foot-line: <?php echo esc_attr($footer_line_color_dark);?>;
}
body.admin-bar{
    --jl-stick-abar: 32px;
}
body{
    --jl-canvas-w: <?php echo esc_attr($canvas_width);?>;
    --jl-logo-size: <?php echo esc_attr($jl_logo_size);?>;
    --jl-logo-size-mob: <?php echo esc_attr($jl_logo_size_mob);?>;
    --jl-logo-txt-sps: <?php echo esc_attr($logo_txt_lspace);?>;
    --jl-logo-txt-color: <?php echo esc_attr($jl_logo_color);?>;    
    --jl-logo-txt-side-color: <?php echo esc_attr($jl_logo_color_side);?>;    
    --jl-logo-txt-foot-color: <?php echo esc_attr($jl_logo_color_foot);?>;  
    
    --jl-img-h: <?php echo esc_attr($g_img_height);?>;  
    --jl-sh-bg: #000;

    --jl-theme-head-color: <?php echo esc_attr($theme_head_color);?>;
    --jl-single-head-color: <?php echo esc_attr($single_head_color);?>;
    --jl-single-h1-color: <?php echo esc_attr($post_h1_color);?>;
    --jl-single-h2-color: <?php echo esc_attr($post_h2_color);?>;
    --jl-single-h3-color: <?php echo esc_attr($post_h3_color);?>;
    --jl-single-h4-color: <?php echo esc_attr($post_h4_color);?>;
    --jl-single-h5-color: <?php echo esc_attr($post_h5_color);?>;
    --jl-single-h6-color: <?php echo esc_attr($post_h6_color);?>;    

    --jl-main-width: <?php echo esc_attr($max_content_width);?>;
    --jl-boxed-p: <?php echo esc_attr($jl_boxed_space);?>;
    --jl-main-color: <?php echo esc_attr($theme_color);?>;
    --jl-cat-sk: <?php echo esc_attr($theme_color);?>;
    --jl-bg-color: <?php echo esc_attr($theme_bg_color);?>;
    --jl-boxbg-color: <?php echo esc_attr($theme_boxed_bg_color);?>;
    --jl-txt-color: <?php echo esc_attr($theme_text_color);?>;
    --jl-txt-light: <?php echo esc_attr($theme_text_color_dark);?>;
    --jl-btn-bg: #000;
    --jl-comment-btn-link: #F1F1F1;
    --jl-comment-btn-linkc: #000;
    --jl-desc-light: <?php echo esc_attr($post_except_color_dark);?>;
    --jl-meta-light: <?php echo esc_attr($post_meta_color_dark);?>;

    --jl-input-radius: <?php echo esc_attr($form_radius);?>;
    --jl-input-size: <?php echo esc_attr($bopea_form_font_size);?>;    

    --jl-button-radius: <?php echo esc_attr($button_radius);?>;
    --jl-fnav-radius: <?php echo esc_attr($load_more_radius);?>;    

    --jl-menu-bg: <?php echo esc_attr($menu_bg_color);?>;
    --jl-menu-line-color: <?php echo esc_attr($menu_line_color);?>;
    --jl-menu-color: <?php echo esc_attr($menu_text_color);?>;
    --jl-menu-hcolor: <?php echo esc_attr($menu_text_hcolor);?>;
    --jl-sub-bg-color: <?php echo esc_attr($submenu_back_color);?>;
    --jl-sub-menu-color: <?php echo esc_attr($submenu_text_color);?>;
    --jl-sub-line-color: <?php echo esc_attr($submenu_line_color);?>;
    --jl-sub-m-radius: <?php echo esc_attr($jl_sub_radius);?>;    

    --jl-menu-ac-color: <?php echo esc_attr($ac_menu_line_color);?>;    
    --jl-menu-ac-height: <?php echo esc_attr($ac_menu_line_height);?>;

    --jl-logo-bg: <?php echo esc_attr($head_logo_bg_color);?>;
    --jl-logo-color: <?php echo esc_attr($head_logo_text_color);?>;

    --jl-pa-ach: <?php echo esc_attr($jl_pa_ach);?>;
    --jl-pa-ach-excp: <?php echo esc_attr($jl_pa_ach_excp);?>;

    --jl-ache-4col: 25px;
    --jl-ache-3col: 35px;
    --jl-ache-2col: 35px;
    --jl-ach-excp: <?php echo esc_attr($excpt_font_size);?>;    
    --jl-ach-ls-excp: <?php echo esc_attr($letter_spacing_excpt);?>;
    --jl-ach-lh-excp: <?php echo esc_attr($excpt_line_height);?>;
    --jl-excpt-row: <?php echo esc_attr($excpt_num_row);?>;

    --jl-single-title-size: <?php echo esc_attr($sg_head_title);?>;
    --jl-sub-title-s: <?php echo esc_attr($sg_head_excp);?>;
    --jl-subt-max: <?php echo esc_attr(get_theme_mod('post_sub_title_width', '100%'));?>;
    
    --jl-single-color: <?php echo esc_attr($single_color);?>;
    --jl-single-link-color: <?php echo esc_attr($single_link_color);?>;
    --jl-single-link-hcolor: <?php echo esc_attr($single_link_hover_color);?>;
    --jl-except-color: <?php echo esc_attr($post_except_color);?>;
    --jl-meta-color: <?php echo esc_attr($post_meta_color);?>;
    --jl-post-line-color: <?php echo esc_attr($post_line_color);?>;
    --jl-author-bg: rgba(136,136,136,0.1);
    --jl-post-related-size: <?php echo esc_attr($bopea_related_size);?>;

    --jl-foot-bg: <?php echo esc_attr($footer_bg_color);?>;
    --jl-foot-color: <?php echo esc_attr($footer_text_color);?>;
    --jl-foot-link: <?php echo esc_attr($footer_link_color);?>;
    --jl-foot-hlink: <?php echo esc_attr($footer_link_hcolor);?>;
    --jl-foot-head: <?php echo esc_attr($footer_head_color);?>;
    --jl-foot-line: <?php echo esc_attr($footer_line_color);?>;    
    --jl-foot-menu-col: <?php echo esc_attr($footer_menu_col);?>;    
    --jl-foot-title-size: <?php echo esc_attr($footer_title_size);?>;
    --jl-foot-font-size: <?php echo esc_attr($footer_font_size);?>;        
    --jl-foot-copyright: <?php echo esc_attr($footer_copyright_size);?>;        
    --jl-foot-menu-size: <?php echo esc_attr($footer_menu_size);?>;        

    --jl-body-font: <?php echo esc_attr($bopea_p_font_family);?>, Verdana, Geneva, sans-serif;
    --jl-body-font-size: <?php echo esc_attr($body_font_size);?>;
    --jl-body-font-weight: <?php echo esc_attr($bopea_p_font_weight);?>;
    --jl-body-spacing: <?php echo esc_attr($letter_spacing_body);?>;
    --jl-body-line-height: <?php echo esc_attr($body_line_height);?>;
    --jl-logo-width: <?php echo esc_attr($logo_width);?>;
    --jl-m-logo-width: <?php echo esc_attr($m_logo_width);?>;
    --jl-s-logo-width: <?php echo esc_attr($s_logo_width);?>;
    --jl-fot-logo-width: <?php echo esc_attr($foot_logo_width);?>;
    --jl-title-font: <?php echo esc_attr($bopea_title_font_family);?>, Verdana, Geneva, sans-serif;
    --jl-title-font-weight: <?php echo esc_attr($bopea_title_font_weight);?>;
    --jl-title-transform: <?php echo esc_attr($bopea_title_transform);?>;
    --jl-title-space: <?php echo esc_attr($letter_spacing_heading);?>;
    --jl-title-line-height: <?php echo esc_attr($line_height_heading);?>;
    --jl-title-line-h: <?php echo esc_attr($jl_title_h);?>;
    --jl-content-font-size: <?php echo esc_attr($bopea_p_font_size);?>;
    --jl-content-spacing: <?php echo esc_attr($letter_spacing_content);?>;
    --jl-content-line-height: <?php echo esc_attr($p_line_height);?>;
    --jl-sec-menu-height: <?php echo esc_attr($section_menu_height);?>;
    --jl-stick-space: 20px;    
    --jl-stick-abar: 0px;
    --jl-stick-abmob: 46px;
    --jl-menu-font: <?php echo esc_attr($bopea_menu_font_family);?>, Verdana, Geneva, sans-serif;
    --jl-menu-font-size: <?php echo esc_attr($bopea_menu_font_size);?>;
    --jl-menu-font-weight: <?php echo esc_attr($bopea_menu_font_weight);?>;
    --jl-menu-transform: <?php echo esc_attr($bopea_menu_transform);?>;
    --jl-menu-space: <?php echo esc_attr($letter_spacing_menu);?>;
    --jl-spacing-menu: <?php echo esc_attr($spacing_menu);?>;
    --jl-submenu-font-size: <?php echo esc_attr($bopea_sub_menu_font_size);?>;
    --jl-submenu-font-weight: <?php echo esc_attr($bopea_sub_menu_font_weight);?>;
    --jl-submenu-transform: <?php echo esc_attr($sub_menu_transform);?>;
    --jl-submenu-space: <?php echo esc_attr($sub_spacing_menu);?>;
    --jl-sub-item-bg: <?php echo esc_attr($submenu_hbg);?>;
    --jl-sub-hcolor: <?php echo esc_attr($submenu_hcolor);?>;
    --jl-cat-font-size: <?php echo esc_attr($bopea_cat_font_size);?>;
    --jl-cat-font-weight: <?php echo esc_attr($bopea_cat_font_weight);?>;
    --jl-cat-font-space: <?php echo esc_attr($letter_spacing_cat);?>;
    --jl-cat-transform: <?php echo esc_attr($bopea_cat_transform);?>;
    --jl-meta-font-size: <?php echo esc_attr($bopea_meta_font_size);?>;
    --jl-meta-font-ssize: <?php echo esc_attr($bopea_meta_font_ssize);?>;
    --jl-meta-font-weight: <?php echo esc_attr($bopea_meta_font_weight);?>;
    --jl-meta-a-font-weight: <?php echo esc_attr($bopea_meta_a_font_weight);?>;
    --jl-meta-font-space: <?php echo esc_attr($letter_spacing_meta);?>;
    --jl-meta-transform: <?php echo esc_attr($bopea_meta_transform);?>;
    --jl-button-font-size: <?php echo esc_attr($bopea_button_font_size);?>;
    --jl-button-font-weight: <?php echo esc_attr($bopea_button_font_weight);?>;
    --jl-button-transform: <?php echo esc_attr($bopea_button_transform);?>;
    --jl-button-space: <?php echo esc_attr($letter_spacing_button);?>;
    --jl-loadmore-font-size: <?php echo esc_attr($bopea_loadmore_font_size);?>;
    --jl-loadmore-font-weight: <?php echo esc_attr($bopea_loadmore_font_weight);?>;
    --jl-loadmore-transform: <?php echo esc_attr($bopea_loadmore_transform);?>;
    --jl-loadmore-space: <?php echo esc_attr($letter_spacing_loadmore);?>;
    --jl-border-rounded: <?php echo esc_attr($border_rounded);?>;
    --jl-top-rounded: <?php echo esc_attr($top_border_rounded);?>;
    
    --jlgdpr-width: <?php echo esc_attr($jl_cookie_wdith);?>;
    --jlgdpr-space: <?php echo esc_attr($jl_cookie_space);?>;
    --jlgdpr-radius: <?php echo esc_attr($jl_cookie_radius);?>;    
    --jlgdpr-padding: <?php echo esc_attr($jl_cookie_padding);?>;
    --jlgdpr-pos: <?php echo esc_attr($jl_cookie_pos);?>;
    --jl-cookie-des-size: <?php echo esc_attr($jl_cookie_dec_size);?>;
    --jl-cookie-btn-size: <?php echo esc_attr($jl_cookie_btn_size);?>;
    --jlgdpr-btn: <?php echo esc_attr($jl_cookie_btn_radius);?>;
    --jl-cookie-btn-space: <?php echo esc_attr($jl_cookie_btn_space);?>;
    --jl-cookie-btn-transform: <?php echo esc_attr($jl_cookie_btn_tranform);?>;
    
    --jlgdpr-bg: <?php echo esc_attr($cookie_bg_color);?>;
    --jlgdpr-color: <?php echo esc_attr($cookie_text_color);?>;

    --jl-widget-fsize: <?php echo esc_attr($bopea_widget_font_size);?>;
    --jl-widget-space: <?php echo esc_attr($bopea_widget_letter_spacing);?>;
    --jl-widget-transform: <?php echo esc_attr($bopea_widget_transform);?>;    

    <?php if(!empty(get_theme_mod('jl_ach_li_rimg'))){?>
    --jl-ache-pos: row-reverse;
    <?php }?>
}
::selection {
    background-color: <?php echo esc_attr($theme_color_dark);?>;
    color: #FFF;
}
.jl_rel_posts .jl_imgw {
    padding-bottom: var(--jl-img-h, 66.66667%) !important;
    height: unset !important;
}
.jl_lg_opt .jl_ov_el .jl_fe_text .jl_fe_inner{
    position: relative !important;
    z-index: 1;
}
.jl_lg_opt .jl_cap_ov.jlcapvv{
    z-index: 0;
}
<?php if(!empty(get_theme_mod('jl_en_txt_smooth'))){ ?>
* {
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
<?php }?>

.jl_fr12_inner .jl_imgw, .jl_fr7_inner .jl_p_fr7 .jl_imgw, .jl_fr6_inner .jl_cgrid_layout .jl_imgw{
    padding-bottom: var(--jl-img-h, 66.66667%);
    height: unset;
}
.jl_fe_text{
    text-align: var(--jl-t-align, left);
}
.jl_sifea_img{max-width: fit-content;}

.jl_achv_tpl_list{
    --jl-ache-title: <?php echo esc_attr($jl_ach_list_title);?>;
}
.jl_achv_tpl_2grid{
    --jl-ache-title: <?php echo esc_attr($jl_ach_g2col_title);?>;
}
.jl_achv_tpl_3grid{
    --jl-ache-title: <?php echo esc_attr($jl_ach_g3col_title);?>;
}
.jl_achv_tpl_4grid{
    --jl-ache-title: <?php echo esc_attr($jl_ach_g4col_title);?>;
}
.jl_achv_tpl_classic{
    --jl-ache-title: <?php echo esc_attr($jl_ach_large_title);?>;
}
.jl_achv_tpl_2ov{
    --jl-ache-title: <?php echo esc_attr($jl_ach_gov2col_title);?>;
}
.jl_achv_tpl_3ov{
    --jl-ache-title: <?php echo esc_attr($jl_ach_gov3col_title);?>;
}
.jl_achv_tpl_4ov{
    --jl-ache-title: <?php echo esc_attr($jl_ach_gov4col_title);?>;
}
<?php if (!empty(get_theme_mod('p_dropcap'))){?>
    p.has-drop-cap:not(:focus):first-letter{
        margin-top: <?php echo esc_attr(get_theme_mod('p_dropcap')); ?>;
    }
<?php }?>

<?php
$jl_site_layout = get_post_meta( get_the_ID(), 'jl_site_layout', true );
$bopea_site_layout = get_theme_mod('bopea_site_layout', 'jl_lfull');
if(empty($jl_site_layout)) {
    $site_layout = $bopea_site_layout;
} else {
    $site_layout = $jl_site_layout;
}
if(!empty($site_layout) && $site_layout == 'jl_lbox') { ?>
<?php if (!empty(get_theme_mod('bopea_box_bg'))){?>
body{
    background-image: url(<?php echo esc_url(get_theme_mod('bopea_box_bg')); ?>);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}
<?php }?>
@media (min-width: 992px) {
.options_layout_wrapper{
    padding: var(--jl-boxed-p, 30px);
}
}
.options_layout_container{
    max-width: var(--jl-main-width);
    margin: 0 auto;
    background: var(--jl-boxbg-color);
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.3);
}
<?php }?>
.jl_tline .jl_fe_title a, .jl_tline .jl_wc_title a, .jl_tline .woocommerce-loop-product__title a, .jl_tline .jl_navpost .jl_cpost_title,
.jl_bgt .jl_fe_title a, .jl_bgt .jl_wc_title a, .jl_bgt .woocommerce-loop-product__title a, .jl_bgt .jl_navpost .jl_cpost_title{
    display: inline !important;
}
<?php
if(function_exists('bopea_e_template')){
$jl_cus_font = $bopea_menu_font_family.','.$bopea_p_font_family.','.$bopea_title_font_family;
$jl_cus_font_arr = explode( ',', $jl_cus_font );
$jl_cus_font_unique = array_unique($jl_cus_font_arr);
    if (strpos($jl_cus_font, 'jl_c_') !== false) {
        $fonts = bopea_font_tax::bopea_get_fonts();
        foreach ( $fonts as $font => $values ){
            foreach ($jl_cus_font_unique as $font_text) {
                 if($font_text == 'jl_c_'.$font ){
                ?>
                @font-face {
                  font-family: '<?php echo esc_attr('jl_c_'.$font);?>';
                  <?php if(!empty($values['font_eot-0'])){?>
                  src: url('<?php echo esc_url($values['font_eot-0']);?>');
                  <?php }?>
                  src:<?php if(!empty($values['font_eot-0'])){?> url('<?php echo esc_url($values['font_eot-0']);?>?#iefix') format('embedded-opentype'),
                       <?php }
                       if(!empty($values['font_woff_2-0'])){?>
                       url('<?php echo esc_url($values['font_woff_2-0']);?>') format('woff2'),
                       <?php }
                       if(!empty($values['font_woff-0'])){?>
                       url('<?php echo esc_url($values['font_woff-0']);?>') format('woff'),
                       <?php }
                       if(!empty($values['font_ttf-0'])){?>
                       url('<?php echo esc_url($values['font_ttf-0']);?>')  format('truetype'),
                       <?php }
                       if(!empty($values['font_svg-0'])){?>
                       url('<?php echo esc_url($values['font_svg-0']);?>#<?php echo esc_attr('jl_c_'.$font);?>') format('svg');
                       <?php }?>
                }
                <?php
                }
            }
        }
    }
}?>
body.options_dark_skin #jl_sb_nav{
    --jl-bg-color: <?php echo esc_attr($canvas_bg_dark);?>;
    --sect-t-color: <?php echo esc_attr($canvas_title_dark);?>;
    --jl-txt-color: <?php echo esc_attr($canvas_color_dark);?>;
    --jl-meta-color: <?php echo esc_attr($canvas_meta_dark);?>;
    --jl-post-line-color: <?php echo esc_attr($canvas_line_dark);?>;
    --jl-theme-head-color: var(--sect-t-color);
}
#jl_sb_nav{
    --jl-bg-color: <?php echo esc_attr($canvas_bg);?>;
    --sect-t-color: <?php echo esc_attr($canvas_title);?>;
    --jl-txt-color: <?php echo esc_attr($canvas_color);?>;
    --jl-meta-color: <?php echo esc_attr($canvas_meta);?>;
    --jl-post-line-color: <?php echo esc_attr($canvas_line);?>;
    --jl-theme-head-color: var(--sect-t-color);
}
.jl_sh_ctericons.jlshcolor li, .jl_sh_ctericons.jlshsc li{
    display: flex;
    align-items: center;
}
.jl_sh_ctericons.jlshcolor .jl_sh_i, .jl_sh_ctericons.jlshsc .jl_sh_i{
    display: flex;
}
.jl_encanw #jl_sb_nav .logo_small_wrapper a img.jl_logo_n{
    opacity: 0;
}
.jl_encanw #jl_sb_nav .logo_small_wrapper a img.jl_logo_w{
    opacity: 1;
}
.jl_enhew .jlc-hmain-in .logo_small_wrapper a img.jl_logo_n{
    opacity: 0;
}
.jl_enhew .jlc-hmain-in .logo_small_wrapper a img.jl_logo_w{
    opacity: 1;
}
.jl_enstew .jlc-stick-main-in .logo_small_wrapper a img.jl_logo_n{
    opacity: 0;
}
.jl_enstew .jlc-stick-main-in .logo_small_wrapper a img.jl_logo_w{
    opacity: 1;
}
.jl_ovt{
    height: 1px;
    visibility: hidden;
    margin: 0px;
    padding: 0px;
}
.jl_ads_wrap_sec *{
    margin: 0px;
    padding: 0px;
}
<?php
echo '.jl_ads_wrap_sec.jl_head_adsab{align-items:'.get_theme_mod('home_align_head_above','center').';}';
echo '.jl_ads_wrap_sec.jl_head_adsbl{margin-top: 40px; align-items:'.get_theme_mod('home_align_head_below','center').';}';
echo '.jl_ads_wrap_sec.jl_con_adsab{align-items:'.get_theme_mod('home_align_single_content_above','center').';}';
echo '.jl_ads_wrap_sec.jl_con_adsbl{align-items:'.get_theme_mod('home_align_single_content_below','center').';}';
echo '.jl_ads_wrap_sec.jl_auth_adsab{margin-top: 40px; align-items:'.get_theme_mod('home_align_single_author_above','center').';}';
echo '.jl_ads_wrap_sec.jl_auth_adsbl{align-items:'.get_theme_mod('home_align_single_author_below','center').';}';
echo '.jl_ads_wrap_sec.jl_rel_adsab{align-items:'.get_theme_mod('home_align_single_related_above','center').';}';
echo '.jl_ads_wrap_sec.jl_rel_adsbl{align-items:'.get_theme_mod('home_align_single_related_below','center').';}';
echo '.jl_ads_wrap_sec.jl_foot_adsab{margin-bottom: 40px; align-items:'.get_theme_mod('home_align_footer_above','center').';}';
echo '.jl_ads_wrap_sec.jl_foot_adsbl{padding: 40px 0px; align-items:'.get_theme_mod('home_align_footer_below','center').';}';

if(!empty(get_theme_mod('remove_hzoom_img', true))){echo '.jl_imgw:hover .jl_imgin img, .jl_ov_el:hover .jl_imgin img, .jl_box_info:hover .jl_box_bg img{transform: scale(1.01);}';}
if(!empty(get_theme_mod('disable_to_top'))){echo '#go-top{display: none !important;}';}
?>
.jlac_smseah.active_search_box{
    overflow: unset;
}
.jlac_smseah.active_search_box .search_header_wrapper .jli-search{
    transform: scale(.9);
}
.jlac_smseah.active_search_box .search_header_wrapper .jli-search:before{
    font-family: "jl_font" !important;
    content: "\e906" !important;
}
.jl_shwp{
    display: flex;
    height: 100%;
}
.jl_ajse{
    position: absolute !important;
    background: var(--jl-sub-bg-color);
    width: 350px;
    top: 100% !important;
    right: 0px;
    left: auto;
    padding: 15px 20px;
    height: unset;
    box-shadow: 0 0 25px 0 rgba(0,0,0,.08);
    border-radius: var(--jl-sub-m-radius, 8px);
    transform: translateY(-0.6rem);
}
.jl_ajse .searchform_theme{    
    padding: 0px;
    float: none !important;
    position: unset;
    transform: unset;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 0px;
    border-bottom: 0px !important;
}
.jl_ajse .jl_search_head{
    width: 100%;
    display: flex;
    flex-direction: column;
}
.jl_ajse.search_form_menu_personal .searchform_theme .search_btn{
    float: none;
    border: 0px !important;
    height: 30px;
    font-size: 14px;
    color: var(--jl-sub-menu-color) !important;
}
.jl_ajse .jl_shnone{
    font-size: 14px;
    margin: 0px;
}
.jl_ajse.search_form_menu_personal .searchform_theme .search_btn::-webkit-input-placeholder{
    color: var(--jl-sub-menu-color) !important;
}
.jl_ajse.search_form_menu_personal .searchform_theme .search_btn::-moz-placeholder{
    color: var(--jl-sub-menu-color) !important;
}
.jl_ajse.search_form_menu_personal .searchform_theme .search_btn:-ms-input-placeholder{
    color: var(--jl-sub-menu-color) !important;
}
.jl_ajse.search_form_menu_personal .searchform_theme .search_btn:-moz-placeholder{
    color: var(--jl-sub-menu-color) !important;
}
.jl_ajse .searchform_theme .button{
    height: 30px;
    position: unset;
    padding: 0px 12px !important;    
    background: var(--jl-main-color) !important;    
    border-radius: var(--jl-sbr, 4px);
    text-transform: capitalize;
    font-weight: var(--jl-button-font-weight);
    font-size: 14px;    
    width: auto;
    letter-spacing: var(--jl-submenu-space);
}
.jlc-hmain-w.jl_base_menu .jl_ajse .searchform_theme .button i.jli-search,
.jlc-stick-main-w .jl_ajse .searchform_theme .button i.jli-search{
    color: #fff !important;
    font-size: 12px;
}
.jl_ajse .jl_search_wrap_li{
    --jl-img-space: 10px;
    --jl-img-w: 90px;
    --jl-smimg-h: 70px;
    --jl-h-align: left;
    --jl-t-size: 14px;
    --jl-txt-color: var(--jl-sub-menu-color) !important;
    --jl-meta-color: var(--jl-sub-menu-color) !important;
    --jlrow-gap: 15px;
    --jl-img-m: 13px;
    --jl-post-line-color: transparent;
}
.jl_ajse .jl_search_wrap_li .jl-donut-front{
    top: 0px;
    right: 0px;
}
.jl_ajse .jl_search_wrap_li .jl_grid_wrap_f{
    width: 100%;
    display: grid;
    overflow: hidden;
    grid-template-columns: repeat(1,minmax(0,1fr));
    grid-row-gap: var(--jlrow-gap);
    border-top: 2px solid var(--jl-sub-line-color);
    padding-top: 20px;
    margin-top: 10px;
    margin-bottom: 6px;
}
.jl_ajse .jl_search_wrap_li .jl_li_in{
    flex-direction: row !important;
}
.jl_ajse .jl_search_wrap_li .jl_li_in .jl_img_holder{
    height: 70px !important;
    -webkit-flex: 0 0 var(--jl-img-w, 180px);
    -ms-flex: 0 0 var(--jl-img-w, 180px);
    flex: 0 0 var(--jl-img-w, 180px);
    width: var(--jl-img-w, 180px);
}
.jl_ajse .jl_search_wrap_li .jl_li_in .jl_img_holder .jl_imgw{
    height: 70px !important;
}
.jl_ajse .jl_post_meta{
    opacity: .5;
    margin-top: 5px !important;
}
.jl_ajse .jl_post_meta .jl_author_img_w, .jl_ajse .jl_post_meta .post-date:before{
    display: none;
}
.jl_item_bread i{font-size: inherit;}
.logo_link, .logo_link:hover{
    font-family: var(--jl-title-font);
    font-weight: var(--jl-title-font-weight);
    text-transform: var(--jl-title-transform);
    letter-spacing: var(--jl-logo-txt-sps);
    line-height: var(--jl-title-line-height);
    font-size: var(--jl-logo-size);
    color: var(--jl-logo-txt-color);
}
@media only screen and (max-width: 767px) {
    .logo_link, .logo_link:hover{
        font-size: var(--jl-logo-size-mob);
    }
}
.logo_link > h1, .logo_link > span{
    font-size: inherit;
    color: var(--jl-logo-txt-color);
}
.jl_mobile_nav_inner .logo_link, .jl_mobile_nav_inner .logo_link:hover{
    color: var(--jl-logo-txt-side-color);
}
.jl_ft_cw .logo_link, .jl_ft_cw .logo_link:hover{
    color: var(--jl-logo-txt-foot-color);
}
body, p, .jl_fe_des{
    letter-spacing: var(--jl-body-spacing);
}
.jl_content, .jl_content p{
    font-size: var(--jl-content-font-size);
    line-height: var(--jl-content-line-height);
    letter-spacing: var(--jl-content-spacing);
}
.jl_vid_mp.jl_livid.sgvpop{
    display: flex;
}
.jl_vid_mp.jl_livid.sgvpop .jl_pop_vid{
    position: absolute !important;
}
.jl_single_tpl7 .jl_vid_mp.jl_livid.sgvpop, .jl_shead_mix9 .jl_vid_mp.jl_livid.sgvpop, .jl_shead_mix12 .jl_vid_mp.jl_livid.sgvpop, .jl_shead_tpl3 .jl_vid_mp.jl_livid.sgvpop{
    transform: unset;
    position: unset;
    margin: 30px auto 0px auto;
}
<?php 
$disable_post_share = get_post_meta( get_the_ID(), 'disable_post_share', true );
$disable_post_share_opt = get_theme_mod('disable_post_share');
if($disable_post_share != 'on'){
    if(empty($disable_post_share_opt)){
        $jl_share = 'show';
    }else{
        $jl_share = 'hide';
    }
}else{
    if(empty($disable_post_share)){
        $jl_share = 'show';
    }else{
        $jl_share = 'hide';
    }
}
if($jl_share == 'hide'){?>
.post_sw{display: none;}
.jls_con_w{max-width: 100%;}    
<?php }?>
<?php if( get_theme_mod('sticky_header') == 'jl_sticky_fixed' ){?>
    .jl_nav_stick.menu-invisible.menu-detached .jl_r_menu{
        -moz-transform: translateY(0%);
        -ms-transform: translateY(0%);
        -webkit-transform: translateY(0%);
        transform: translateY(0%);
    }
    .jl_sticky_fixed .jl-sb-w .jl-sb-in, .jl_sticky_fixed .jl-sticky > *, .menu-detached .jl_sidebar_w, .jl_sticky_fixed .post_sw .post_s{
        top: calc(var(--jl-sec-menu-height) + var(--jl-stick-space) + var(--jl-stick-abar)) !important;
    }
<?php }?>
<?php if( !empty($category_label_padding) || !empty($category_label_radius) ){?>
.jl_lb3 .jl_cat_lbl, .jl_lb4 .jl_cat_lbl, .jl_lb5 .jl_cat_lbl, .jl_lb6 .jl_cat_lbl, .jl_lb7 .jl_cat_lbl{
    padding: <?php echo esc_attr($category_label_padding);?> !important;
    border-radius: <?php echo esc_attr($category_label_radius);?> !important;
}
<?php }?>
<?php if( !empty($max_content_width) ){?>
.jlc-container, .jl_shead_tpl4.jl_shead_mix10 .jl_fe_text{max-width: <?php echo esc_attr($max_content_width);?>;}
<?php }?>
<?php if(get_theme_mod('single_order_1', 'jl_sli_fb')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_1','jl_sli_fb'));?>{order: 1;}
<?php }?>
<?php if(get_theme_mod('single_order_2', 'jl_sli_tw')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_2','jl_sli_tw'));?>{order: 2;}
<?php }?>
<?php if(get_theme_mod('single_order_3', 'jl_sli_pi')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_3','jl_sli_pi'));?>{order: 3;}
<?php }?>
<?php if(get_theme_mod('single_order_4', 'jl_sli_din')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_4','jl_sli_din'));?>{order: 4;}
<?php }?>
<?php if(get_theme_mod('single_order_5', 'jl_sli_wapp')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_5','jl_sli_wapp'));?>{order: 5;}
<?php }?>
<?php if(get_theme_mod('single_order_6', 'jl_sli_tele')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_6','jl_sli_tele'));?>{order: 6;}
<?php }?>
.jl_sli_in .jl_sli_tumblr{order: 7;}
.jl_sli_in .jl_sli_line{order: 7;}
<?php if(get_theme_mod('single_order_7', 'jl_sli_mil')){?>
.jl_sli_in .<?php echo esc_attr(get_theme_mod('single_order_7','jl_sli_mil'));?>{order: 7;}
<?php }?>

<?php if(get_theme_mod('disable_l_share_fb') ==1){?>
.post_sw .jl_sli_in .jl_sli_fb, .jlp_hs .jl_sli_in .jl_sli_fb{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_tw') ==1){?>
.post_sw .jl_sli_in .jl_sli_tw, .jlp_hs .jl_sli_in .jl_sli_tw{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_pin') ==1){?>
.post_sw .jl_sli_in .jl_sli_pi, .jlp_hs .jl_sli_in .jl_sli_pi{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_in') ==1){?>
.post_sw .jl_sli_in .jl_sli_din, .jlp_hs .jl_sli_in .jl_sli_din{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_whatsapp') ==1){?>
.post_sw .jl_sli_in .jl_sli_wapp, .jlp_hs .jl_sli_in .jl_sli_wapp{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_telegram', 1) ==1){?>
.post_sw .jl_sli_in .jl_sli_tele, .jlp_hs .jl_sli_in .jl_sli_tele{display: none !important;}
<?php }?>

<?php if(get_theme_mod('disable_l_share_tumblr', 1) ==1){?>
.post_sw .jl_sli_in .jl_sli_tumblr, .jlp_hs .jl_sli_in .jl_sli_tumblr{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_l_share_line', 1) ==1){?>
.post_sw .jl_sli_in .jl_sli_line, .jlp_hs .jl_sli_in .jl_sli_line{display: none !important;}
<?php }?>

<?php if(get_theme_mod('disable_l_share_mail', 1) ==1){?>
.post_sw .jl_sli_in .jl_sli_mil, .jlp_hs .jl_sli_in .jl_sli_mil{display: none !important;}
<?php }?>

<?php if(get_theme_mod('disable_s_share_fb') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_fb{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_tw') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_tw{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_pin') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_pi{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_in') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_din{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_whatsapp') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_wapp{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_telegram') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_tele{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_tumblr', 1) ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_tumblr{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_line', 1) ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_line{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_mail') ==1){?>
.jl_sfoot .jl_sli_in .jl_sli_mil{display: none !important;}
<?php }?>
.jl_enltxt .logo_small_wrapper_table .logo_small_wrapper .logo_link *{
    max-width: unset;
    width: unset;
}
.logo_small_wrapper_table .logo_small_wrapper a .jl_logo_w {
    position: absolute;top: 0px;left: 0px;opacity: 0;
}
.logo_small_wrapper_table .logo_small_wrapper .logo_link *{
    max-width: var(--jl-logo-width);
    width: var(--jl-logo-width);
}
.jl_sleft_side .jl_smmain_side{
    order: 1;
    padding-left: 20px;
    padding-right: 30px;
}
.jl_sleft_side .jl_smmain_con{
    order: 2;
}
.jl_rd_wrap{
    <?php echo esc_attr($sp_progress_pos);?>: 0;    
}
.jl_rd_read{
    height: <?php echo esc_attr($sp_progress_height);?>;    
    background-color: <?php echo esc_attr($sp_color2);?>;
    background-image: linear-gradient(to right, <?php echo esc_attr($sp_color1);?> 0%, <?php echo esc_attr($sp_color2);?> 100%);
}
.jl_view_none{display: none !important;}
.jl_sifea_img, .jl_smmain_w .swiper-slide-inner{
    border-radius: var(--jl-border-rounded);
    overflow: hidden;
}
.jl_shead_mix12 .jl_ov_layout, .jl_shead_mix10 .jl_ov_layout, .jl_shead_mix9 .jl_ov_layout{
    border-radius: 0px;
}
/*share layout*/
.jl_fot_gwp{
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
}
.jl_fot_gwp .jl_post_meta{
    margin-top: 0px !important;
}
.jl_ma_layout .jl-ma-opt:nth-child(2) .jl_fot_gwp .jl_post_meta{
    margin-top: 13px !important;
}
@media only screen and (min-width: 769px) {
.jl_ma_layout .jl-ma-opt:nth-child(2) .jl_fot_gwp .jl_post_meta{
    margin-top: 0px !important;
}
}
.jl_fot_gwp .jl_fot_sh{
    display: flex;
}
.jl_fot_gwp .jl_fot_sh > span{
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #B5B5B5;
}
.jl_fot_gwp .jl_fot_sh .jl_book_mark.jl_saved_p{
    color: var(--jl-main-color);
}
.jl_fot_gwp .jl_fot_sh .jl_book_mark.jl_saved_p .jli-icon_save:before{
    content: "\e901";
}
.jl_fot_gwp .jl_fot_sh .jl_fot_share_i{
    margin-left: 13px;
}
.jls_tooltip {
    position: relative;
    display: inline-block;    
    cursor: pointer;
}
.jls_tooltip .jls_tooltip_w{
    visibility: hidden;
    position: absolute;
    z-index: 1;
    opacity: 0;
    transition: opacity .3s;
}
.jls_tooltip:hover .jls_tooltip_w{
	visibility: visible;
    opacity: 1;
}
.jls_tooltip .jls_tooltiptext {
	position: relative;
    display: flex;
    text-align: center;
    padding: 0px;
    justify-content: center;    
}
.jl_ov_el .jls_tooltip .jls_tooltiptext{
    --jl-sh-bg: #fff;
}
.jls_tooltip-top {
	padding-bottom: 10px !important;
    bottom: 100%;
    left: 50%;
    margin-left: -50px;
}
.jls_tooltiptext .jls_tooltip_in{
    position: relative;
    z-index: 2;
    background: var(--jl-sh-bg);
    padding: 5px 0px;
    font-weight: 400;
    border-radius: 7px;
}
.jls_tooltip_in .jl_sli_line.jl_shli{
    display: none !important;
}
.jls_tooltip > svg{
    width: 0.93em;
    height: 0.93em;    
}
.jls_tooltip > i{
    font-size: 90%;
}
.jl_share_l_bg .jls_tooltiptext .jl_sli_in{
    gap: 3px !important;
    display: flex;
}
.jls_tooltip-top .jls_tooltiptext::after {
    content: "";
    position: absolute;
    bottom: -2px;
    right: 5px;
    width: 10px;
    height: 10px;
    margin-left: -5px;
    background-color: var(--jl-sh-bg);
    z-index: 1;
    transform: rotate(45deg);
}
.jl_fot_share_i .jls_tooltip_w{
    width: auto;
    margin-left: 0px;
    right: 0px;
    bottom: auto;
    right: 1px;
    top: -46px;
    left: auto;
}
.jl_fot_share_i .jls_tooltip_w:before{
    display:none;
}
.jl_fot_share_i .jls_tooltip_in{
    padding: 6px 8px !important;
}
.jl_fot_share_i .jls_tooltip_in .post_sw{
    display: block;
    width: auto;
}
.jl_fot_share_i.jl_share_l_bg.jls_tooltip{
    z-index: 10;
    display: none;
    margin-left: var(--jl-sh-lp, auto);
}
.jl_fot_share_i.jl_share_l_bg.jls_tooltip:before{
    display: none;
}
.jls_tooltiptext .jl_shli a{
    flex: 0 0 25px;
    width: 25px !important;
    height: 25px !important;
    font-size: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #fff !important
}
.jls_tooltiptext .jl_shli:before{
    display: none;
}
.jl_share_l_bg .jls_tooltiptext .jl_sli_in .jl_shli a{
    border-radius: 7px !important;
    color: #fff !important;
    transition: unset;
    text-decoration: none !important;
}
.jls_tooltiptext .single_post_share_icon_post li a i{
    margin: 0px;
}
.jl_fot_gwp .jl_fot_sh .jl_fot_save > i,
.jl_fot_gwp .jl_fot_sh .jl_fot_share_i > i{
    transition: opacity 0.2s ease 0s;
}
.jl_fot_gwp .jl_fot_sh .jl_fot_save:hover > i,
.jl_fot_gwp .jl_fot_sh .jl_fot_share_i:hover > i{
    color: var(--jl-main-color);
}
<?php if(!empty(get_theme_mod('enable_share_btn'))){?>
.jl_main_achv .jl_fot_share_i.jl_share_l_bg.jls_tooltip{
    display: inline-flex;
}
<?php }?>
/*end share*/
<?php if(!empty(get_theme_mod('disable_author_box_img'))){?>
.jl_info_auth .author-avatar{display: none;}
<?php }?>
.jl_home_bw .image-post-thumb{
    margin-bottom: 30px;
}
<?php
$jl_cat_color = get_terms('category');
    if ($jl_cat_color) {
        foreach( $jl_cat_color as $tag) {
            $tag_link = get_category_link($tag->term_id);
            $cat_color = get_term_meta($tag->term_id, "category_color_options", true);
            if( !empty($cat_color) ){
                echo '.cat-item-'.$tag->term_id.' span{background: '.esc_attr($cat_color).'}';
                echo '.jl_cat_cid_'.esc_attr($tag->term_id).'{--jl-catc-bg: '.esc_attr($cat_color).' !important;}';
                echo '.jl_cat_opt4 .jl_cat_opt_w.jl_cat_cid_'.esc_attr($tag->term_id).'{--jl-catb-bg: '.esc_attr($cat_color).' !important;}';
                echo '.jl_f_cat .jl_cat'.esc_attr($tag->term_id).'{--jl-cat-sk: '.esc_attr($cat_color).';}';
            }
        }
    }
    $bopea_title_s_transform = get_theme_mod('bopea_title_s_transform', 'none');
    $letter_spacing_s_heading = get_theme_mod('letter_spacing_s_heading', '0em');
    $line_height_s_heading = get_theme_mod('line_height_s_heading', '1.2');
    
    $bopea_t_p_font_size = get_theme_mod('bopea_t_p_font_size', '15px');
    $bopea_m_p_font_size = get_theme_mod('bopea_m_p_font_size', '15px');
    $body_t_font_size = get_theme_mod('body_t_font_size', '15px');
    $body_m_font_size = get_theme_mod('body_m_font_size', '15px');    
?>
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{
    color: var(--jl-theme-head-color);
}
.jl_shead_tpl1 .jl_head_title,
.jl_single_tpl6 .jl_shead_tpl1 .jl_head_title,
.jl_shead_mix13 .jl_head_title{
    color: var(--jl-single-head-color);
}
.jl_content h1, .content_single_page h1, .jl_content h1 a, .content_single_page h1 a, .jl_content h1 a:hover, .content_single_page h1 a:hover{color: var(--jl-single-h1-color);}
.jl_content h2, .content_single_page h2, .jl_content h2 a, .content_single_page h2 a, .jl_content h2 a:hover, .content_single_page h2 a:hover{color: var(--jl-single-h2-color);}
.jl_content h3, .content_single_page h3, .jl_content h3 a, .content_single_page h3 a, .jl_content h3 a:hover, .content_single_page h3 a:hover{color: var(--jl-single-h3-color);}
.jl_content h4, .content_single_page h4, .jl_content h4 a, .content_single_page h4 a, .jl_content h4 a:hover, .content_single_page h4 a:hover{color: var(--jl-single-h4-color);}
.jl_content h5, .content_single_page h5, .jl_content h5 a, .content_single_page h5 a, .jl_content h5 a:hover, .content_single_page h5 a:hover{color: var(--jl-single-h5-color);}
.jl_content h6, .content_single_page h6, .jl_content h6 a, .content_single_page h6 a, .jl_content h6 a:hover, .content_single_page h6 a:hover{color: var(--jl-single-h6-color);}

.jl_content h1, .content_single_page h1, .jl_content h2, .content_single_page h2, .jl_content h3, .content_single_page h3, .jl_content h4, .content_single_page h4, .jl_content h5, .content_single_page h5, .jl_content h6, .content_single_page h6{
    text-transform: <?php echo esc_attr($bopea_title_s_transform);?>;
    letter-spacing: <?php echo esc_attr($letter_spacing_s_heading);?>;
    line-height: <?php echo esc_attr($line_height_s_heading);?>;
}
@media only screen and (min-width: 1025px) {
    .jl-h-d{display: none;}
    .jl_content h1, .content_single_page h1{font-size: <?php echo esc_attr(get_theme_mod('bopea_h1', '40px'));?>;}
    .jl_content h2, .content_single_page h2{font-size: <?php echo esc_attr(get_theme_mod('bopea_h2', '32px'));?>;}
    .jl_content h3, .content_single_page h3{font-size: <?php echo esc_attr(get_theme_mod('bopea_h3', '28px'));?>;}
    .jl_content h4, .content_single_page h4{font-size: <?php echo esc_attr(get_theme_mod('bopea_h4', '24px'));?>;}
    .jl_content h5, .content_single_page h5{font-size: <?php echo esc_attr(get_theme_mod('bopea_h5', '20px'));?>;}
    .jl_content h6, .content_single_page h6{font-size: <?php echo esc_attr(get_theme_mod('bopea_h6', '16px'));?>;}
}
@media only screen and (min-width:768px) and (max-width:1024px) {
    body{
        --jl-single-title-size: <?php echo esc_attr($sg_head_title_md);?>;
        --jl-sub-title-s: <?php echo esc_attr($sg_head_excp_md);?>;
        --jl-sg-ext: 0px;
        --jl-ach-excp: <?php echo esc_attr($excpt_t_font_size);?>;    
    }
    .jl-h-t{display: none;}
    .jl_content h1, .content_single_page h1{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h1', '40px'));?>;}
    .jl_content h2, .content_single_page h2{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h2', '32px'));?>;}
    .jl_content h3, .content_single_page h3{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h3', '28px'));?>;}
    .jl_content h4, .content_single_page h4{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h4', '24px'));?>;}
    .jl_content h5, .content_single_page h5{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h5', '20px'));?>;}
    .jl_content h6, .content_single_page h6{font-size: <?php echo esc_attr(get_theme_mod('bopea_t_h6', '16px'));?>;}
    body, p{ font-size: <?php echo esc_attr($body_t_font_size);?>}
    .jl_content, .jl_content p{ font-size: <?php echo esc_attr($bopea_t_p_font_size);?>}
}
@media only screen and (max-width: 768px) {
    body{
        --jl-single-title-size: <?php echo esc_attr($sg_head_title_sm);?>;
        --jl-sub-title-s: <?php echo esc_attr($sg_head_excp_sm);?>;
        --jl-sg-ext: 0px;
        --jl-pa-ach: <?php echo esc_attr($jl_pa_ach_sm);?>;
        --jl-pa-ach-excp: <?php echo esc_attr($jl_pa_ach_excp_sm);?>;
        --jl-ach-excp: <?php echo esc_attr($excpt_m_font_size);?>;
        --jl-ache-4col: 25px;
        --jl-ache-3col: 25px;
        --jl-ache-2col: 25px;
        --jl-ache-title: 20px;
        --jl-stp: 30px;
        --jl-sbp: 30px;
        --jl-jl-achspc: 30px;
        --jl-post-related-size: 17px;
    }
    .jl_achv_tpl_list, .jl_achv_tpl_2grid, .jl_achv_tpl_3grid, .jl_achv_tpl_4grid, .jl_achv_tpl_classic, .jl_achv_tpl_2ov, .jl_achv_tpl_3ov, .jl_achv_tpl_4ov{
        --jl-ache-title: 20px;
    }

    .jl_achv_tpl_list .jl_fli_wrap .jl_li_in{
        --jl-img-w: 100%;
        --jl-img-space: 20px;
        --jl-img-h: 56.25%;
    }
    .jl-h-m{display: none;}
    .jl_content h1, .content_single_page h1{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h1', '40px'));?>;}
    .jl_content h2, .content_single_page h2{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h2', '32px'));?>;}
    .jl_content h3, .content_single_page h3{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h3', '28px'));?>;}
    .jl_content h4, .content_single_page h4{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h4', '24px'));?>;}
    .jl_content h5, .content_single_page h5{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h5', '20px'));?>;}
    .jl_content h6, .content_single_page h6{font-size: <?php echo esc_attr(get_theme_mod('bopea_m_h6', '16px'));?>;}
    body, p, .jl_fe_des{ font-size: <?php echo esc_attr($body_m_font_size);?>}
    .jl_content, .jl_content p{ font-size: <?php echo esc_attr($bopea_m_p_font_size);?>}
    .jl_ajse{width: 300px;}    
}