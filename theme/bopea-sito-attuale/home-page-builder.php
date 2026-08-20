<?php
/*
  Template Name: Home Page Builder
 */
?>
<?php get_header(); ?>
<div class="jl_home_bw">
    <?php if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif; ?>
</div>
<?php get_footer(); ?>