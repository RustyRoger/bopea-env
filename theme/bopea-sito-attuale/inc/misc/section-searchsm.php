<?php if(!get_theme_mod('disable_top_search')==1){?>
        <?php if(!empty(get_theme_mod('jl_search_layout', true))){?><div class="jl_shwp jl_shsmb"><?php }else{?><div class="jl_shwp"><?php }?><div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
        <?php if(!empty(get_theme_mod('jl_search_layout', true))){?>
        <div class="jl_ajse search_form_menu_personal">
                <div class="jl_search_head jl_search_list">
                        <?php get_search_form(); ?>                                
                        <div class="jl_search_box_li"></div>
                </div>
        </div>
        <?php }?>
        </div>
<?php }?>