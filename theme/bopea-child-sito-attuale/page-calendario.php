<?php
get_header();

$sg_post_opt_full = get_post_meta(get_the_ID(), 'sg_post_opt_full', true);
$sg_post_full = get_theme_mod('sg_post_full', 'jl_sg_side');
if (empty($sg_post_opt_full)) {
    $full = $sg_post_full;
} else {
    $full = $sg_post_opt_full;
}
?>
<div class="jl_sp_con" id="<?php echo esc_attr(get_the_ID()); ?>">
    <?php bopea_sp_rd(); ?>
    <?php get_template_part('inc/misc/single', 'head10'); ?>
    <div class="jl_block_content">
        <div class="jlc-container jl_single_tpl_w">
            <div class="jlc-row main_content jl_single_tpl10">
                <div
                    class="<?php if ($full == 'jl_sg_full') {
                        echo 'jlc-col-md-12 jl_opts_full';
                    } else {
                        echo 'jlc-col-md-8';
                    } ?> jl_smmain_con">
                    <div class="jl_smmain_w">
                        <div class="jl_smmain_in">
                            <?php
                            $tags = get_the_tags();
                            $source_options = get_post_meta(get_the_ID(), 'source_options', true);
                            $via_options = get_post_meta(get_the_ID(), 'via_options', true);
                            ?>
                            <div class="jl_sg_rgap">
                                <div class="post_content_w">
                                    <?php if (function_exists('bopea_e_template')) { ?>
                                        <span class="post_sw">
                                            <span class="post_s">
                                                <?php bopea_shead(get_the_ID()); ?>
                                                <?php bopea_slink(get_the_ID()); ?>
                                            </span>
                                        </span>
                                    <?php } ?>
                                    <div class="jls_con_w">
                                        <div class="post_content jl_content">
                                            <?php
                                            bopea_ads_content_above();
                                            the_content();
                                            bopea_ads_content_below();
                                            ?>
                                        </div>
                                        <?php echo bopea_review_box(get_the_ID(), get_post_meta(get_the_ID(), true)); ?>
                                        <?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="jl_nav_c">', 'link_after' => '</span>')); ?>
                                        <?php if (!empty($tags)) { ?>
                                            <div class="single_tag_share">
                                                <?php echo bopea_source(); ?>
                                                <?php echo bopea_via(); ?>
                                                <?php if (get_theme_mod('disable_post_tag') != 1) { ?>
                                                    <div class="tag-cat">
                                                        <?php the_tags('<ul class="single_post_tag_layout"><li>', '</li><li>', '</li></ul>'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } elseif (!empty($source_options) || !empty($via_options)) { ?>
                                            <div class="single_tag_share">
                                                <?php echo bopea_source(); ?>
                                                <?php echo bopea_via(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (get_theme_mod('disable_post_share_footer') != 1) {
                                    if (function_exists('bopea_e_template')) {
                                        echo '<div class="jl_sfoot">';
                                        bopea_shead(get_the_ID());
                                        bopea_slink(get_the_ID());
                                        echo '</div>';
                                    }
                                } ?>
                                <?php bopea_ads_content_above_author() ?>
                                <?php if (get_theme_mod('disable_post_author') != 1) {
                                    if (!empty(get_the_author_meta('description'))) { ?>
                                        <div class="jl_auth_single">
                                            <div class="author-info jl_info_auth">
                                                <div class="author-avatar">
                                                    <a
                                                        href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                        <?php echo get_avatar(get_the_author_meta('user_email'), 165); ?>
                                                    </a>
                                                </div>
                                                <div class="author-description">
                                                    <div class="jl_auth_lbl"><?php echo bopeatxt::bopea_s_written_by(); ?></div>
                                                    <span class="jl_auth_name h3 jl_fe_title">
                                                        <a
                                                            href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author_meta('display_name'); ?></a>
                                                        <?php if (function_exists('bopea_author_share_link')) { ?><span>-
                                                                <?php if (!empty(get_the_author_meta('positions'))) {
                                                                    echo esc_attr(get_the_author_meta('positions'));
                                                                } ?></span><?php } ?>
                                                    </span>
                                                    <p class="jl_auth_desc"><?php echo get_the_author_meta('description'); ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php bopea_ads_content_author() ?>
                                                        
                                    <?php }
                                } ?>
                                <?php bopea_comment(); ?>
                            </div>
                        </div>
                    </div>
                                <div class="dif-category-desktop">
  <?php echo do_shortcode('[difensore-desktop]'); ?>
</div>
                </div>
                <?php if ($full != 'jl_sg_full') { ?>
                    <div class="jlc-col-md-4 jl_smmain_side">
                        <div class="jl_sidebar_w">
                            <?php bopea_post_sidebar(); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php bopea_rel(); ?>
    </div>
</div>

<?php get_footer(); ?>