<?php
get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <?php
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
            <div class="jl_shead_tpl4 jl_shead_mix10">
                <div class="jl_ov_layout jl_ov_el">
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="jl_img_holder">
                            <div class="jl_imgw">
                                <div class="jl_imgin">
                                    <?php the_post_thumbnail('bopea_large'); ?>
                                </div>
                                <?php bopea_video_bg(get_the_ID()); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="jl_fe_text">
                        <div class="jl_fe_inner">
                            <?php bopea_nav_guide(); ?>
                            <?php bopea_video_sg_pop(get_the_ID()); ?>
                            <?php bopea_post_single_cat(get_the_ID()); ?>
                            <h1 class="jl_head_title jl_fe_title"><?php the_title() ?></h1>
                            <?php
                            $post_sub_title_type = get_theme_mod('post_sub_title_type', 'jl_sub_title');
                            $jl_sub_post_title = get_post_meta(get_the_ID(), 'single_post_subtitle', true);
                            if ($post_sub_title_type == "jl_excerpt") {
                                if (has_excerpt()) { ?>
                                    <p class="post_subtitle_text"><?php echo get_the_excerpt(); ?> </p>
                                <?php }
                            } else { ?>
                                <?php if ($jl_sub_post_title) { ?>
                                    <p class="post_subtitle_text">
                                        <?php echo get_post_meta(get_the_ID(), 'single_post_subtitle', true); ?>
                                    </p>
                                <?php }
                            } ?>
                            <div class="jl_mt_wrap">
                                <?php bopea_single_meta_list(get_the_ID()); ?>
                                <?php bopea_sh_top(get_the_ID()); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jl_block_content">
                <div class="jlc-container jl_single_tpl_w">
                    <div class="jlc-row main_content jl_single_tpl10">
                        <div class="<?php if ($full == 'jl_sg_full') {
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
                                                                <?php if (function_exists('bopea_author_share_link')) { ?><span><?php if (!empty(get_the_author_meta('positions'))) {
                                                                       echo '- ' . esc_attr(get_the_author_meta('positions'));
                                                                   } ?></span><?php } ?>
                                                            </span>
                                                            <p class="jl_auth_desc"><?php echo get_the_author_meta('description'); ?>
                                                            </p>
                                                            <?php if (function_exists('bopea_author_share_link')) {
                                                                bopea_author_share_link(get_the_ID());
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php bopea_ads_content_author() ?>
                                            <?php }
                                        } ?>
                                        <div class="dif-category-desktop">
  <?php echo do_shortcode('[difensore-desktop]'); ?>
</div>
                                        <?php bopea_comment(); ?>
                                        
                                        <?php if (get_theme_mod('disable_post_nav') != 1) { ?>
                                            <div class="postnav_w">
                                                <?php $prev_post = get_previous_post();
                                                if (!empty($prev_post)) { ?>
                                                    <div class="jl_navpost postnav_left">
                                                        <a class="jl_nav_link"
                                                            href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" id="prepost">
                                                            <?php $thub_prev = get_the_post_thumbnail($prev_post->ID, 'thumbnail');
                                                            if (!empty($thub_prev)) { ?>
                                                                <span class="jl_nav_img">
                                                                    <?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?>
                                                                </span>
                                                            <?php } ?>
                                                            <span class="jl_nav_wrap">
                                                                <span
                                                                    class="jl_nav_label"><?php echo bopeatxt::bopea_s_previous_post(); ?></span>
                                                                <span
                                                                    class="jl_cpost_title"><?php echo esc_html($prev_post->post_title); ?></span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <?php $next_post = get_next_post();
                                                if (!empty($next_post)) { ?>
                                                    <div class="jl_navpost postnav_right">
                                                        <a class="jl_nav_link"
                                                            href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" id="nextpost">
                                                            <?php $thub_next = get_the_post_thumbnail($next_post->ID, 'thumbnail');
                                                            if (!empty($thub_next)) { ?>
                                                                <span class="jl_nav_img">
                                                                    <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?>
                                                                </span>
                                                            <?php } ?>
                                                            <span class="jl_nav_wrap">
                                                                <span
                                                                    class="jl_nav_label"><?php echo bopeatxt::bopea_s_next_post(); ?></span>
                                                                <span
                                                                    class="jl_cpost_title"><?php echo esc_html($next_post->post_title); ?></span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
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
        <?php
    }
}
get_footer();