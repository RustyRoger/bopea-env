<?php
$custom_logo_link = get_theme_mod('custom_logo_link');
if(!empty($custom_logo_link)){
    $logo_brand_link = $custom_logo_link;
}else{
    $logo_brand_link = home_url('/');
}
$sub_footer = get_theme_mod('sub_footer', 'sub_footer0');
switch ( $sub_footer ) {         
case 'sub_footer1' :?>
<div class="jl_ft_mini jl_ft_min1">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">
                    <div class="footer-logo-holder">
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
                    <?php if ( has_nav_menu( 'footer_menu' ) ){ ?>
                    <?php $footer_menu = array('theme_location' => 'footer_menu', 'depth' => 1, 'container' => false, 'menu_class' => 'jl-menu-footer', 'menu_id' => 'jl-menu-footer-menu', 'fallback_cb' => false ); wp_nav_menu($footer_menu); ?>
                    <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="jl-menu-footer-menu" class="jl-menu-footer">
                            <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                    <?php esc_html_e( 'Click here to add footer menu', 'bopea' ); ?></a></li>
                        </ul>
                        <?php }}?>
                        <div class="cp_txt"><?php echo wp_kses_post(get_theme_mod('jl_copyright')); ?></div>
                        <?php get_template_part( 'inc/misc/section', 'social' );?>                        
                </div>
                </div>
            </div>
        </div>
</div>
<?php break;
case 'sub_footer2' :?>
<div class="ft_s2">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">                    
                        <div class="cp_txt"><?php echo wp_kses_post(get_theme_mod('jl_copyright')); ?></div>                        
                        <?php get_template_part( 'inc/misc/section', 'social' );?>                        
                    </div>
                </div>
            </div>
        </div>
</div>
<?php break;
case 'sub_footer3' :?>
<div class="ft_s3">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">                    
                    <div class="cp_txt"><?php echo wp_kses_post(get_theme_mod('jl_copyright')); ?></div>                        
                    <?php if ( has_nav_menu( 'footer_menu' ) ){ ?>
                        <?php $footer_menu = array('theme_location' => 'footer_menu', 'depth' => 1, 'container' => false, 'menu_class' => 'jl-menu-footer', 'menu_id' => 'jl-menu-footer-menu', 'fallback_cb' => false ); wp_nav_menu($footer_menu); ?>
                    <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="jl-menu-footer-menu" class="jl-menu-footer">
                            <li>
                                <a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                    <?php esc_html_e( 'Click here to add footer menu', 'bopea' ); ?>
                                </a>
                            </li>
                        </ul>
                    <?php }}?>
                </div>
                </div>
            </div>
        </div>
</div>
<?php break;
case 'sub_footer4' :?>
<div class="ft_s4">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">                    
                        <div class="cp_txt"><?php echo wp_kses_post(get_theme_mod('jl_copyright')); ?></div>                                                
                    </div>
                </div>
            </div>
        </div>
</div>
<?php break;
case 'sub_footer5' :?>
<div class="ft_s5">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">                    
                        <?php if ( has_nav_menu( 'footer_menu' ) ){ ?>
                            <?php $footer_menu = array('theme_location' => 'footer_menu', 'depth' => 1, 'container' => false, 'menu_class' => 'jl-menu-footer', 'menu_id' => 'jl-menu-footer-menu', 'fallback_cb' => false ); wp_nav_menu($footer_menu); ?>
                        <?php }else{ ?>
                            <?php if ( current_user_can( 'manage_options' ) ){ ?>
                            <ul id="jl-menu-footer-menu" class="jl-menu-footer">
                                <li>
                                    <a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                        <?php esc_html_e( 'Click here to add footer menu', 'bopea' ); ?>
                                    </a>
                                </li>
                            </ul>
                        <?php }}?>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php break;
}?>