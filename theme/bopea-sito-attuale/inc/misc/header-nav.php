<?php
add_action( 'wp_footer', 'bopea_head_nav' );
if ( ! function_exists( 'bopea_head_nav' ) ){
function bopea_head_nav() {
$custom_logo_link = get_theme_mod('custom_logo_link');
if(!empty($custom_logo_link)){
    $logo_brand_link = $custom_logo_link;
}else{
    $logo_brand_link = home_url('/');
}
?>
<div id="jl_sb_nav" class="jl_mobile_nav_wrapper">
            <div id="nav" class="jl_mobile_nav_inner">
               <div class="logo_small_wrapper_table">
                  <div class="logo_small_wrapper">
                     <a class="logo_link" href="<?php echo esc_url($logo_brand_link); ?>">                     
                        <?php if(empty(get_theme_mod('enable_logo_txt'))){?>
                           <?php $logo_n = get_theme_mod('bopea_logo'); ?>
                           <?php if (!empty($logo_n)): ?>
                           <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                           <?php else: ?>
                           <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                           <?php endif; ?>
                           <?php $logo_w = get_theme_mod('bopea_logow'); ?>
                           <?php if (!empty($logo_w)): ?>
                           <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                           <?php else: ?>
                           <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                           <?php endif; ?>
                        <?php }else{ echo esc_html( get_bloginfo( 'name' ) ); } ?>
                     </a>
                  </div>
                  <div class="menu_mobile_icons mobile_close_icons closed_menu"><span class="jl_close_wapper"><span class="jl_close_1"></span><span class="jl_close_2"></span></span></div>              
               </div>               
               <?php
               $custom_mobile_menu = get_post_meta( get_the_ID(), 'custom_mobile_menu', true );
               if(empty($custom_mobile_menu)) {
               if ( has_nav_menu( 'mobile_menu' ) ){
               $mobile_menu = array('theme_location' => 'mobile_menu', 'container' => '', 'menu_class' => 'menu_moble_slide', 'menu_id' => 'mobile_menu_slide', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($mobile_menu);?>
               <?php }else{?>
               <?php if ( has_nav_menu( 'main_menu' ) ){?>
               <?php $main_menu = array('theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'menu_moble_slide', 'menu_id' => 'mobile_menu_slide', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
               <?php }else{ ?>
               <?php if ( current_user_can( 'manage_options' ) ){ ?>
               <ul id="mobile_menu_slide" class="menu_moble_slide">
                  <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                     <?php esc_html_e( 'Click here to add menu', 'bopea' ); ?></a>
                  </li>
               </ul>
               <?php }}}}else{
                  $main_menu = array('menu' => $custom_mobile_menu, 'container' => '', 'menu_class' => 'menu_moble_slide', 'menu_id' => 'mobile_menu_slide', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);     
               }?>

               <?php if (is_active_sidebar('mobile-menu-sidebar')) : dynamic_sidebar('mobile-menu-sidebar'); endif; ?>
            </div>
            <div class="nav_mb_f">
            <?php get_template_part( 'inc/misc/section', 'social' );?>
            <div class="cp_txt"><?php echo wp_kses_post(get_theme_mod('jl_copyright')); ?></div>
            </div>            
         </div>
         <?php if(empty(get_theme_mod('jl_search_layout'))){?>
         <div class="search_form_menu_personal">
            <div class="menu_mobile_large_close"><span class="jl_close_wapper search_form_menu_personal_click"><span class="jl_close_1"></span><span class="jl_close_2"></span></span></div>
            <?php get_search_form(); ?>
         </div>
         <?php }?>
         <div class="mobile_menu_overlay"></div>
<?php }}?>