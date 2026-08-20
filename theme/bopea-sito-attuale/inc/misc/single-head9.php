<div class="jl_shead_tpl3 jl_shead_mix9">
    <div class="jl_ov_layout jl_ov_el">
        <?php if ( has_post_thumbnail()) {?>
            <div class="jl_img_holder">
                <div class="jl_imgw">
                    <div class="jl_imgin">
                        <?php the_post_thumbnail('bopea_large');?>
                    </div>
                    <?php bopea_video_bg(get_the_ID());?>                    
                </div>
            </div>
        <?php }?>
        <div class="jl_fe_text">
            <div class="jl_fe_inner">
                <?php bopea_post_single_cat(get_the_ID());?>
                <h1 class="jl_head_title jl_fe_title"><?php the_title()?></h1>
                <?php
                $post_sub_title_type = get_theme_mod('post_sub_title_type', 'jl_sub_title');
                $jl_sub_post_title = get_post_meta( get_the_ID(), 'single_post_subtitle', true );
                if($post_sub_title_type == "jl_excerpt"){
                    if( has_excerpt() ){?>
                        <p class="post_subtitle_text"><?php echo get_the_excerpt(); ?> </p>
                    <?php }}else{ ?>
                <?php if ($jl_sub_post_title){?>
                    <p class="post_subtitle_text"><?php echo get_post_meta( get_the_ID(), 'single_post_subtitle', true ); ?> </p>
                <?php }}?>
                <?php bopea_single_meta_list(get_the_ID());?>
                <?php bopea_sh_top(get_the_ID()); ?>
                <?php bopea_video_sg_pop(get_the_ID());?>
            </div>
        </div>
    </div>
</div>