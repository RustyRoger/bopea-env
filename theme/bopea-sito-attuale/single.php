<?php
get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $post_layout_display = get_post_meta( get_the_ID(), 'single_post_layout', true );
        $single_post_layout_options = get_theme_mod('single_post_layout_options', 'single1');
        if(empty($post_layout_display)) {
            get_template_part('inc/misc/template', $single_post_layout_options );
        } else {
            get_template_part('inc/misc/template', $post_layout_display );            
        }
    }
}
get_footer();