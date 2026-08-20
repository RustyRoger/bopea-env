<?php get_header(); ?>
<div class="jl_block_content">
    <div class="jlc-container">
        <div class="jlc-row main_content">
            <div class="jlc-col-md-12 jl_page_error">
                <h1 class="jl_not_found">
                    <?php echo bopeatxt::bopea_s_404_title(); ?>
                </h1>
                <p class="jl_error_desc">
                    <?php echo bopeatxt::bopea_s_404_desc(); ?>
                </p>
                <?php get_search_form(); ?>
                <a class="link_home404" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php echo bopeatxt::bopea_s_back_to_home(); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>