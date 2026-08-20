<?php
   get_header();
?>
<div class="jl_block_content">
    <div class="jlc-container">
        <div class="jlc-row main-content">
            <div class="jlc-col-md-8 jl_smmain_con">
            <?php
			echo '<div class="att-container-desktop" style="margin: 0 0 1rem">';
            echo do_shortcode('[attaccante-desktop]');
            echo '</div>';
            bopea_nav_guide();
            bopea_archive_head();
            $bopea_qry = bopea_get_qry();
			echo '<div class="att-container-mobile" style="margin: 0.5rem 0">';
            echo do_shortcode('[attaccante-mobile]');
            echo '</div>';
            echo '<div class="content_single_page jl_content page type-page status-publish hentry">';
            echo bopea_feature_layout_7(array('blockid' => 'blockid_8c66666', 'jl_hide_col_line'   => 'yes', 'pagination' => false));
			?>
			<div class="dif-category-desktop">
  				<?php echo do_shortcode('[difensore-desktop]'); ?>
			</div>      
			<?php
			echo '<div class="centrocampo-container-mobile" style="margin: 0.5rem 0">';
            echo do_shortcode('[centrocampo-mobile]');
            echo '</div>';
            
            echo bopea_m_list(array(
                'blockid' => 'blockid_8c77777', 
                
                'posts_per_page' => 4, 
                'offset' => 5, 
                'post_type_tax' => 'none',
                'tabs_link' => 'none',
                'author' => '',
                'order' => 'date_post',
                'pagination' => 'loadmore'
            ));
            ?>
            </div>
            <?php /* ZONA PORTIERE DESKTOP */ ?>
            </div>
            <div class="jlc-col-md-4 jl_smmain_side mobile-category-sidebar">
              <div class="jl_sidebar_w">
                <?php bopea_archive_opt_sidebar();?>
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
<div class="grid-category-heading">
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