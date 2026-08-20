<?php
$sg_post_opt_full = get_post_meta( get_the_ID(), 'sg_post_opt_full', true );
$sg_post_full = get_theme_mod('sg_post_full', 'jl_sg_side');
if(empty($sg_post_opt_full)) {
    $full = $sg_post_full;
} else {
    $full = $sg_post_opt_full;
}
?>
<div class="jl_block_content jl_sp_con" id="<?php echo esc_attr(get_the_ID());?>">
<?php bopea_sp_rd();?>
    <div class="jlc-container">
        <div class="jlc-row main_content jl_single_tpl1">            
            <div class="<?php if( $full == 'jl_sg_full' ){ echo 'jlc-col-md-12 jl_opts_full'; }else{ echo 'jlc-col-md-8'; }?> jl_smmain_con">
                <div class="jl_smmain_w">
                        <div class="jl_smmain_in">                           
                            <?php get_template_part('inc/misc/single', 'head4' ); ?>
                            <?php get_template_part('inc/misc/template', 'single_content' ); ?>
                        </div>
                </div>
            </div>
            <?php if( $full != 'jl_sg_full' ){ ?>
                <div class="jlc-col-md-4 jl_smmain_side">
                    <div class="jl_sidebar_w">
                        <?php bopea_post_sidebar(); ?>
                    </div>
                </div>
            <?php }?>
        </div>        
    </div>
    <?php bopea_rel();?>
</div>