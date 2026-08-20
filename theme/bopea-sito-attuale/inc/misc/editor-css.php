<?php
$max_content_width = get_theme_mod('max_content_width','1260px');
// Logo
$logo_width = get_theme_mod('logo_width','120px');
$m_logo_width = get_theme_mod('m_logo_width','120px');
$s_logo_width = get_theme_mod('s_logo_width','120px');
$foot_logo_width = get_theme_mod('foot_logo_width','120px');

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
$section_menu_height = get_theme_mod('section_menu_height','70px');

//Menu
$bopea_menu_font_family = get_theme_mod('bopea_menu_font_family');
$bopea_menu_font_size = get_theme_mod('bopea_menu_font_size', '17px');
$bopea_menu_font_weight = get_theme_mod('bopea_menu_font_weight', '500');
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

//single post
$sg_head_title = get_theme_mod('sg_head_title', '40px');
$sg_head_title_md = get_theme_mod('sg_head_title_md', '34px');
$sg_head_title_sm = get_theme_mod('sg_head_title_sm', '26px');

$sg_head_excp = get_theme_mod('sg_head_excp', '20px');
$sg_head_excp_md = get_theme_mod('sg_head_excp_md', '20px');
$sg_head_excp_sm = get_theme_mod('sg_head_excp_sm', '17px');

$g_img_height = get_theme_mod('g_img_height','56.25%');
if(empty($g_img_height)){
    $g_img_height = '56.25%';
}

//cookie
$jl_cookie_dec_size = get_theme_mod('jl_cookie_dec_size', '13px');
$jl_cookie_btn_size = get_theme_mod('jl_cookie_btn_size', '12px');
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

$theme_text_color = get_theme_mod('theme_text_color');
if(empty($theme_text_color)){$theme_text_color = '#000';}

$theme_text_color_dark = get_theme_mod('theme_text_color_dark');
if(empty($theme_text_color_dark)){$theme_text_color_dark = '#FFF';}

// Menu color
$menu_bg_color = get_theme_mod('menu_bg_color');
if(empty($menu_bg_color)){ $menu_bg_color = '#070f2b';}

$menu_bg_color_dark = get_theme_mod('menu_bg_color_dark');
if(empty($menu_bg_color_dark)){ $menu_bg_color_dark = '#000f45';}

$menu_text_color = get_theme_mod('menu_text_color');
if(empty($menu_text_color)){ $menu_text_color = '#fff';}

$menu_text_color_dark = get_theme_mod('menu_text_color_dark');
if(empty($menu_text_color_dark)){ $menu_text_color_dark = '#FFF';}

$menu_text_hcolor = get_theme_mod('menu_text_hcolor');
if(empty($menu_text_hcolor)){ $menu_text_hcolor = '#fff';}

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
if(empty($cookie_bg_color)){ $cookie_bg_color = '#000';}

$cookie_text_color = get_theme_mod('cookie_text_color');
if(empty($cookie_text_color)){ $cookie_text_color = '#FFF';}

$cookie_bg_color_dark = get_theme_mod('cookie_bg_color_dark');
if(empty($cookie_bg_color_dark)){ $cookie_bg_color_dark = '#000';}

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
if(empty($post_line_color)){$post_line_color = '#e0e0e0';}

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
if(empty($footer_text_color)){$footer_text_color = '#a8a8aa';}

$footer_text_dark = get_theme_mod('footer_text_dark');
if(empty($footer_text_dark)){$footer_text_dark = '#fff';}

$footer_link_color = get_theme_mod('footer_link_color');
if(empty($footer_link_color)){$footer_link_color = '#dcdcdc';}

$footer_link_dark = get_theme_mod('footer_link_dark');
if(empty($footer_link_dark)){$footer_link_dark = '#dcdcdc';}

$footer_link_hcolor = get_theme_mod('footer_link_hcolor');
if(empty($footer_link_hcolor)){$footer_link_hcolor = '#7118ff';}

$footer_link_hdark = get_theme_mod('footer_link_hdark');
if(empty($footer_link_hdark)){$footer_link_hdark = '#7118ff';}

$footer_head_color = get_theme_mod('footer_head_color');
if(empty($footer_head_color)){$footer_head_color = '#FFF';}

$footer_head_color_dark = get_theme_mod('footer_head_color_dark');
if(empty($footer_head_color_dark)){$footer_head_color_dark = '#FFF';}

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
if(empty($bopea_menu_font_family)){
?>
/* latin-ext */
@font-face {
  font-family: 'Oxygen';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/oxygen/v15/2sDfZG1Wl4LcnbuKgE0mRUe0A4Uc.woff2) format('woff2');
  unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Oxygen';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/oxygen/v15/2sDfZG1Wl4LcnbuKjk0mRUe0Aw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* vietnamese */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_c6DptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_cqDptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_fKDptfpA4Q.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* vietnamese */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_c6DptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_cqDptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_fKDptfpA4Q.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* vietnamese */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_c6DptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_cqDptfpA4cD3.woff2) format('woff2');
  unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Work Sans';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/worksans/v19/QGYsz_wNahGAdqQ43Rh_fKDptfpA4Q.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
<?php }?>
.edit-post-visual-editor{
    background: #fff;
}
body{
    background: #fff;
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

    --jlgdpr-bg: <?php echo esc_attr($cookie_bg_color);?>;
    --jlgdpr-color: <?php echo esc_attr($cookie_text_color);?>;

    --jl-main-width: <?php echo esc_attr($max_content_width);?>;
    --jl-main-color: <?php echo esc_attr($theme_color);?>;
    --jl-bg-color: <?php echo esc_attr($theme_bg_color);?>;
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
    --jl-load-more-radius: <?php echo esc_attr($load_more_radius);?>;    

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
    --jl-single-title-small: <?php echo esc_attr($sg_head_title_sm);?>;
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
    --jl-cookie-des-size: <?php echo esc_attr($jl_cookie_dec_size);?>;
    --jl-cookie-btn-size: <?php echo esc_attr($jl_cookie_btn_size);?>;
    --jl-cookie-btn-space: <?php echo esc_attr($jl_cookie_btn_space);?>;
    --jl-cookie-btn-transform: <?php echo esc_attr($jl_cookie_btn_tranform);?>;

    --jl-widget-fsize: <?php echo esc_attr($bopea_widget_font_size);?>;
    --jl-widget-space: <?php echo esc_attr($bopea_widget_letter_spacing);?>;
    --jl-widget-transform: <?php echo esc_attr($bopea_widget_transform);?>;    

    <?php if(!empty(get_theme_mod('jl_ach_li_rimg'))){?>
    --jl-ache-pos: row-reverse;
    <?php }?>
}