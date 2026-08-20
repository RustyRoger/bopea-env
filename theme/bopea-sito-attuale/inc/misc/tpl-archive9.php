<?php
   $cat_param = bopea_blog_param();
?>
<div class="jl_block_content">
    <div class="jlc-container">
        <div class="jlc-row">
            <div class="jlc-col-md-8 jl_main_achv jl_achv_tpl_2ov">
            <?php bopea_nav_guide();?>
            <?php bopea_archive_head();?>
                <div class="jl_clear_at block-section jl-main-block jl_wrapper_cat" <?php echo esc_attr($cat_param);?>>
                 <div class="jl_clear_at">
                    <div class="jl_main_list_cw jl_wrap_eb jl_clear_at jl_lm_list">
                      <div class="jl_ovg_w jl-roww jl_contain jl-col-row">
                        <?php $bopea_qry = bopea_get_qry();
                        if ( $bopea_qry->have_posts() ) {
                          while ( $bopea_qry->have_posts() ) {
                            $bopea_qry->the_post();
                              $bopea_post_id = $post->ID;
                                get_template_part( 'inc/misc/tpl', 'viewgridov' );
                          }
                        }else{
                                get_template_part( 'inc/misc/section', 'notfound' );
                        }?>
                      </div>
                    </div>
                    <?php bopea_pagination( $bopea_qry );
                    wp_reset_postdata(); ?>
                </div>
              </div>
            </div>
            <div class="jlc-col-md-4 jl_smmain_side">
              <div class="jl_sidebar_w">
                <?php bopea_archive_opt_sidebar();?>
              </div>
            </div>
        </div>
    </div>
</div>