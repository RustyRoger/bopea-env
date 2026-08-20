<div class="jl_shead_tpl11">
    <div class="jlc-container jl_single_tpl_w">
        <div class="jlc-row main_content jl_single_tpl6">            
            <div class="jlc-col-md-12">
    <div class="jl_shead_tpl_txt">
        <?php bopea_nav_guide();?>
        <?php bopea_post_single_cat(get_the_ID());?>
        <h1 class="jl_head_title">
            <?php the_title()?>
        </h1>
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
        <div class="jl_mt_wrap">
            <?php bopea_single_meta_list(get_the_ID()); ?>
            <?php bopea_sh_top(get_the_ID()); ?>
        </div>
    </div>
    </div>
</div>
</div>
</div>