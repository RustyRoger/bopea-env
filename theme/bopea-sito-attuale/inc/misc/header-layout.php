<?php
$custom_logo_link = get_theme_mod('custom_logo_link');
if(!empty($custom_logo_link)){
    $logo_brand_link = $custom_logo_link;
}else{
    $logo_brand_link = home_url('/');
}
$mega_menu_layout = get_theme_mod('mega_menu_layout', 'jl_mega_boxed');
$jl_mh_type = get_theme_mod('jl_mh_type', 'jl_mm_lb');

$post_id = get_the_ID();
$header_page_layout = get_theme_mod('header_layout','default');
$custom_header_layout = get_post_meta( $post_id, 'custom_header_layout', true );
$header_sticky = get_theme_mod('header_sticky','default');
$custom_header_sticky = get_post_meta( $post_id, 'custom_header_sticky', true );

$header_layout_opt= get_theme_mod('header_layout_design','header_3');
$jl_opt_h1_home = get_theme_mod('jl_opt_h1_home');
if(empty($jl_opt_h1_home)){
    $logo_tag = (is_front_page() ? 'h1' : 'span');
}else{
    $logo_tag = 'span';
}

if(empty($custom_header_layout)) {
    $header_layout = $header_layout_opt;
} else {
    $header_layout = $header_layout_opt;
}

if(empty($custom_header_layout)) {
    $header_cus_layout = $header_page_layout;
} else {
    $header_cus_layout = $custom_header_layout;
}
if(empty($custom_header_sticky)) {
    $header_sticky = $header_sticky;
} else {
    $header_sticky = $custom_header_sticky;
}

if( !empty($header_cus_layout) && $header_cus_layout != 'default'){?>
<header class="jlc-hmain-w jlh-e jl_base_menu jl_md_main">
    <?php
    $header_template = bopea_elementor_content( $header_cus_layout );
    if ( $header_template ) {
        echo apply_filters( 'bopea_header_template', $header_template );
    }
    ?>    
</header>
<div class="jlc-stick-main-w jl_cus_sihead jl_r_menu">
    <?php
    $header_sticky_template = bopea_elementor_content( $header_sticky );
    if ( $header_sticky_template ) {
        echo apply_filters( 'bopea_header_sticky_template', $header_sticky_template );
    }
    ?>
</div>
<?php }else{
switch ( $header_layout ) {   
case 'header_1' :
?>
<header class="jlc-hmain-w jlh-d jlc-hop1 jl_base_menu jl_md_main">
    <div class="jlc-hmain-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap">            
                        <div class="logo_small_wrapper_table">
                            <div class="logo_small_wrapper">
                            <a class="logo_link" href="<?php echo esc_url($logo_brand_link); ?>">
                                <<?php echo esc_html($logo_tag); ?>>
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
                                </<?php echo esc_html($logo_tag); ?>>
                            </a>
                            </div>
                        </div>        
        <div class="jl_hd1_nav">
        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array(
                    'walker' => new jellywp_walker(),
                    'theme_location' => 'main_menu',
                    'container' => '',
                    'menu_class' => 'jl_main_menu',
                    'fallback_cb' => false,
                    'link_before'=>'<span class="jl_mblt">',
                    'link_after'=>'</span>');
                   wp_nav_menu($main_menu);
            ?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul class="jl_main_menu">
                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
            </ul>
            <?php }}?>
        </div>        
        <div class="search_header_menu jl_nav_mobile">                        
            <?php 
            get_template_part( 'inc/misc/section', 'switch' );
            get_template_part( 'inc/misc/section', 'basket' );                        
            get_template_part( 'inc/misc/section', 'searchsm' );?>                      
            <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<div class="jlc-stick-main-w jlc-hop1 jl_cus_sihead jl_r_menu">
    <div class="jlc-stick-main-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap">    
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
                        </div>
        <div class="jl_hd1_nav">
        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array(
                    'walker' => new jellywp_walker(),
                    'theme_location' => 'main_menu',
                    'container' => '',
                    'menu_class' => 'jl_main_menu',
                    'fallback_cb' => false,
                    'link_before'=>'<span class="jl_mblt">',
                    'link_after'=>'</span>');
                   wp_nav_menu($main_menu);
            ?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul class="jl_main_menu">
                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
            </ul>
            <?php }}?>
        </div>
        <div class="search_header_menu jl_nav_mobile">                        
            <?php 
            get_template_part( 'inc/misc/section', 'switch' );
            get_template_part( 'inc/misc/section', 'basket' );                        
            get_template_part( 'inc/misc/section', 'searchsm' );?>                        
            <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>
<?php
break;
case 'header_2' :
?>
<header class="jlc-hmain-w jlh-d jlc-hop2 jl_base_menu jl_md_main">
    <div class="jlc-hmain-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap">            
                        <div class="logo_small_wrapper_table">
                            <div class="logo_small_wrapper">
                            <a class="logo_link" href="<?php echo esc_url($logo_brand_link); ?>">
                                <<?php echo esc_html($logo_tag); ?>>
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
                                </<?php echo esc_html($logo_tag); ?>>
                            </a>
                            </div>
                        </div>        
        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array(
                    'walker' => new jellywp_walker(),
                    'theme_location' => 'main_menu',
                    'container' => '',
                    'menu_class' => 'jl_main_menu',
                    'fallback_cb' => false,
                    'link_before'=>'<span class="jl_mblt">',
                    'link_after'=>'</span>');
                   wp_nav_menu($main_menu);
            ?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul class="jl_main_menu">
                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
            </ul>
            <?php }}?>
        </div>        
        <div class="search_header_menu jl_nav_mobile">                        
            <?php 
            get_template_part( 'inc/misc/section', 'switch' );
            get_template_part( 'inc/misc/section', 'basket' );                        
            get_template_part( 'inc/misc/section', 'searchsm' );?>                        
            <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<div class="jlc-stick-main-w jlc-hop2 jl_cus_sihead jl_r_menu">
    <div class="jlc-stick-main-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap">    
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
                        </div>
        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array(
                    'walker' => new jellywp_walker(),
                    'theme_location' => 'main_menu',
                    'container' => '',
                    'menu_class' => 'jl_main_menu',
                    'fallback_cb' => false,
                    'link_before'=>'<span class="jl_mblt">',
                    'link_after'=>'</span>');
                   wp_nav_menu($main_menu);
            ?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul class="jl_main_menu">
                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
            </ul>
            <?php }}?>
        </div>
        <div class="search_header_menu jl_nav_mobile">                        
            <?php 
            get_template_part( 'inc/misc/section', 'switch' );
            get_template_part( 'inc/misc/section', 'basket' );                        
            get_template_part( 'inc/misc/section', 'searchsm' );?>
            <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>
<?php
break;
case 'header_3' :
?>
<header class="jlc-hmain-w jlh-d jlc-hop4 jl_base_menu jl_md_main">
    <div class="jlc-hmain-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap"> 
                    <div class="jl_hleftwrap">                                                                  
                        <div class="logo_small_wrapper_table">
                                <div class="logo_small_wrapper">
                                <a class="logo_link" href="<?php echo esc_url($logo_brand_link); ?>">
                                <<?php echo esc_html($logo_tag); ?>>
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
                                </<?php echo esc_html($logo_tag); ?>>
                                </a>
                                </div>
                        </div>     
                        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
                            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                            <?php $main_menu = array(
                                    'walker' => new jellywp_walker(),
                                    'theme_location' => 'main_menu',
                                    'container' => '',
                                    'menu_class' => 'jl_main_menu',
                                    'fallback_cb' => false,
                                    'link_before'=>'<span class="jl_mblt">',
                                    'link_after'=>'</span>');
                                wp_nav_menu($main_menu);
                            ?>
                            <?php }else{ ?>
                            <?php if ( current_user_can( 'manage_options' ) ){ ?>
                            <ul class="jl_main_menu">
                                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
                            </ul>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="search_header_menu jl_nav_mobile">                        
                        <?php 
                        get_template_part( 'inc/misc/section', 'switch' );
                        get_template_part( 'inc/misc/section', 'basket' );                        
                        get_template_part( 'inc/misc/section', 'searchsm' );?>
                        <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                    </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<div class="jlc-stick-main-w jlc-hop4 jl_cus_sihead jl_r_menu">
    <div class="jlc-stick-main-in">
    <div class="jlc-container">
            <div class="jlc-row">
                <div class="jlc-col-md-12">    
                    <div class="jl_hwrap">
                        <div class="jl_hleftwrap">
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
                        </div>
                        <div class="menu-primary-container navigation_wrapper <?php echo esc_attr($mega_menu_layout);?> <?php echo esc_attr($jl_mh_type);?>">
                            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                            <?php $main_menu = array(
                                    'walker' => new jellywp_walker(),
                                    'theme_location' => 'main_menu',
                                    'container' => '',
                                    'menu_class' => 'jl_main_menu',
                                    'fallback_cb' => false,
                                    'link_before'=>'<span class="jl_mblt">',
                                    'link_after'=>'</span>');
                                wp_nav_menu($main_menu);
                            ?>
                            <?php }else{ ?>
                            <?php if ( current_user_can( 'manage_options' ) ){ ?>
                            <ul class="jl_main_menu">
                                <li class="menu-item"><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                <?php esc_html_e( 'Click here to add navigation menu', 'bopea' ); ?></a></li>
                            </ul>
                            <?php }}?>
                        </div>                        
                        </div>
                    <div class="search_header_menu jl_nav_mobile">                        
                        <?php 
                        get_template_part( 'inc/misc/section', 'switch' );
                        get_template_part( 'inc/misc/section', 'basket' );                        
                        get_template_part( 'inc/misc/section', 'searchsm' );?>
                        <div class="menu_mobile_icons jl_tog_mob <?php if(!empty(get_theme_mod('show_mb_nav'))){echo esc_attr('jl_desk_show');}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>
<?php
break;
}
}