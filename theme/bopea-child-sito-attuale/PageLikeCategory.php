<?php
/* Template Name: Page Like Category */ 
   get_header();
?>
<div class="jl_block_content">
    <div class="jlc-container">
        <div class="jlc-row main_content">
            <div class="jlc-col-md-8 jl_smmain_con">              
              <?php
				echo '<div class="att-container-desktop" style="margin: 0 0 1rem">';
            echo do_shortcode('[attaccante-desktop]');
            echo '</div>';
              bopea_nav_guide();
              $single_page_subtitle = get_post_meta( get_the_ID(), 'single_page_subtitle', true );
              echo '<div class="jl_pc_sec_title">';
                echo '<h1 class="jl_pc_sec_h">';
                  echo get_the_title();
                echo '</h1>';
                if ($single_page_subtitle){
                  echo '<p class="post_subtitle_text">';
                    echo get_post_meta( get_the_ID(), 'single_page_subtitle', true );
                  echo '</p>';
                }
              echo '</div>';
              ?>
                <div <?php post_class( 'content_single_page jl_content'); ?>>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php
                    $jl_hide_featured = get_post_meta( get_the_ID(), 'jl_hide_featured', true );
                    if ( empty($jl_hide_featured) ) {
                      if ( has_post_thumbnail()) {
                        echo '<div class="image-post-thumb">';
                        the_post_thumbnail('bopea_featurelarge');
                        echo '</div>';
                      }
                    }?>
                    <?php the_content(); ?>
                    <?php endwhile;?>
                    <?php endif; ?>
                    <?php bopea_comment(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="jl_nav_c">', 'link_after' => '</span>' ) ); ?>
                </div>
                  <?php  /* ZONA PORTIERE DESKTOP */ ?>
            </div>         
            <div class="jlc-col-md-4 jl_smmain_side mobile-category-sidebar">
                <div class="jl_sidebar_w">
                    <?php bopea_page_sidebar();?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bottom-section-category">
<div class="dif-category-mobile">
  <?php echo do_shortcode('[difensore-mobile]'); ?>
</div>
<div class="grid-category-wrapper jlc-container">
<div class="plc-heading">
  <h1>Articoli suggeriti</h1>
</div>
<?php 
echo bopea_mgrid(array(
                'blockid' => 'blockid_8c77777', 
                'posts_per_page' => 4, 
                'post_type_tax' => 'none',
                'tabs_link' => 'none',
                'author' => '',
                'order' => 'rand',
                'pagination' => false
            ));
?>
</div>


</div>
<?php 
get_footer();
?>