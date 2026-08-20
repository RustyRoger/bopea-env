<?php
/*
  Template Name: Custom Page with Fullwidth
 */
?>
<?php get_header(); ?>
<div class="jl-main-content">
    <div class="jlc-container">
        <div class="jlc-row main_content">
            <div class="jlc-col-md-12">
              <?php
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
                <div class="jl_home_bw">
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
                </div>
            </div>            
        </div>
    </div>
</div>
<?php get_footer(); ?>