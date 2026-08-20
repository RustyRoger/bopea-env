<?php
if ( ! function_exists( 'bopea_tab_slider' ) ) {
  function bopea_tab_slider( $attrs ) {
    $module = shortcode_atts( array(
      'blockid'                       => '',
      'name'                          => 'jl_tab_slider',
      'post_type'          		        => 'post',
			'term_slugs'         		        => '',
			'post_type_tax'      		        => '',
      'category'                      => '',
      'categories'                    => '',
      'format'                        => '',
      'tags'                          => '',
      'author'                        => '',
      'post_not_in'                   => '',
      'post_in'                       => '',
      'order'                         => '',
      'posts_per_page'                => '',
      'offset'                        => '',
      'car_effect'                    => 'fade',
      'slider_speed'                  => '',
      'slider_loop'                   => '',
      'slider_autoplay'               => '',
      'slider_autoplay_delay'         => '',
      'slider_arrow'                  => '',
      'slider_dots'                   => '',
      'sl_center_mode'                => 'false',
      'sl_center_padding'             => '0',
      'pagination'                    => false,
      'jl_hide_thumb'                   => '',
      'jl_hide_btn'                   => '',
      'jl_hide_cat'                   => '',
      'jl_hide_author'                => '',
      'jl_hide_date'                  => '',
      'jl_hide_meta'                  => '',
      'jl_hide_desc'                  => '',
      'btn_txt'                       => '',
      'jl_cus_img'                    => '',
      'jl_cus_sm_img'                    => '',
			'ignore_sticky_posts'           => '',
      ), $attrs );
      $module['classes']              = 'jl-main-block';
      $module['content_classes']      = 'jl-col-row';
      $total_posts = $module['posts_per_page'];
      $query_data = bopea_query( $module );
      $module['posts_per_page'] = $total_posts;
      ob_start();
      $atts_style   = array();
      $atts_style[] = 'block-section';
      if ( ! empty( $module['classes'] ) ) {
        $atts_style[] = $module['classes'];
      }
      if ( 'yes' === $module['jl_hide_cat'] ) {
        $atts_style[] = 'jl_hide_cat';
      }
      if ( 'yes' === $module['jl_hide_author'] ) {
        $atts_style[] = 'jl_hide_author';
      }
      if ( 'yes' === $module['jl_hide_date'] ) {
              $atts_style[] = 'jl_hide_date';
      }
      if ( 'yes' === $module['jl_hide_meta'] ) {
        $atts_style[] = 'jl_hide_meta';
      }
      if ( 'yes' === $module['jl_hide_desc'] ) {
        $atts_style[] = 'jl_hide_desc';
      }
      if ( $module['car_effect'] == 'parallax') {
        $effect   = "slide";
        $parallax = true;
        $atts_style[]= 'jl_slparallax';
      }else{
        $effect   = $module['car_effect'];
        $parallax = false;
      }
      $sl_center_mode = $module['sl_center_mode'];
      if($sl_center_mode == 'yes'){
        $sl_center_mode = "true";
      }else{
        $sl_center_mode = "false";
      }
      $sl_center_padding = $module['sl_center_padding'];
      $atts_style = implode( ' ', $atts_style );
      $items = [
                'desktop'           => 1,
                'tablet'            => 1,
                'small_mobile'      => 1,
                'large_mobile'      => 1,
                'landscape_mobile'  => 1,
        ];
        $slider_settings = [
                'slideitem'             => $items,
                'speed'                 => absint( $module['slider_speed'] ),
                'spacebetween'          => 0,
                'loop'                  => ( 'yes' === $module['slider_loop'] ),
                'autoplay'              => ( 'yes' === $module['slider_autoplay'] ),
                'autoplay_delay'        => absint( $module['slider_autoplay_delay'] ),
                'effect'                => $effect,
                'parallax'              => $parallax,
                'navigation'            => false,
                'pagination'            => true,
                'uniqid'                => $module['blockid']
        ];
        ?>
        <div class="<?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
        <?php
        if ( $query_data->have_posts() ) :
          $atts_style = 'jl-roww content-inner jl-stab-w';
        if ( ! empty( $module['content_classes'] ) ) {
          $atts_style .= ' ' . $module['content_classes'];
        } ?>
            <div class="<?php echo esc_attr( $atts_style ); ?>">
              <div class="jl-eb-sl jl-eb-tabsl swiper-container" data-settings="<?php echo esc_attr(wp_json_encode( $slider_settings )); ?>">
                  <div class="swiper-wrapper">
                      <?php bopea_stslider_a_listing( $module, $query_data );?>
                  </div>
                  <div class="jlc-pagination-<?php echo esc_attr( $module['blockid'] ); ?> jl_spw"><div class="swiper-pagination"></div></div>
              </div>
                <div class="jl-sltab-s">
                    <div class="jl-eb-sltab swiper-container">
                        <div class="swiper-wrapper">
                            <?php bopea_mslider_tab_listing( $module, $query_data );?>
                        </div>
                    </div>
                </div>
              </div>          
        <?php
        wp_reset_postdata();
        endif;
        echo '</div>';
    return ob_get_clean();
  }
}

if ( ! function_exists( 'bopea_stslider_a_listing' ) ) :
  function bopea_stslider_a_listing( $module = array(), $query_data = null ) {
    if ( method_exists( $query_data, 'have_posts' ) ) :
      while ( $query_data->have_posts() ) :
        $query_data->the_post();
        ?>
        <div class="swiper-slide jl_mslide">
          <div class="slide-inner jl_cs_overlay" <?php if ( $module['car_effect'] == 'parallax') {?>data-swiper-parallax="80%"<?php }?>>
            <div class="jl_ov_layout jl_ov_el">
              <?php if ( has_post_thumbnail()) {?>
                <div class="jl_img_holder">
                  <div class="jl_imgw">
                    <div class="jl_imgin">
                      <?php 
                      if ($module['jl_cus_img'] != '' ) {
                        the_post_thumbnail($module['jl_cus_img']);
                      }else{
                        the_post_thumbnail('bopea_large');
                      }?>
                    </div>
                    <?php bopea_video_media(get_the_ID());?>
                    <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
                  </div>
                </div>
              <?php }?>
              <div class="jl_fe_text">
                <div class="jl_fe_inner">
                  <?php bopea_post_ov_cat(get_the_ID());?>
                  <h2 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
                  <p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 20, '...' );?> </p>
                  <?php bopea_post_meta(get_the_ID());?>
                  <?php if(empty($module['jl_hide_btn'])){bopea_button_txt(get_the_ID());}?>
                  <a href="<?php the_permalink(); ?>" aria-label="<?php the_title()?>" class="jl_cap_ov"></a>
                </div>                
              </div>
            </div>
          </div>
      </div>
      <?php
      endwhile;
    endif;
  }
endif;

if ( ! function_exists( 'bopea_mslider_tab_listing' ) ) :
  function bopea_mslider_tab_listing( $module = array(), $query_data = null ) {
    if ( method_exists( $query_data, 'have_posts' ) ) :
      $counter = 0;
      while ( $query_data->have_posts() ) :
        $query_data->the_post();
        ?>
        <div class="swiper-slide jl_tabses">
          <div class="slide-inner">
            <div class="tab_labout">
              <div class="jl_mmlist_layout">
                <div class="jl_li_in">
                  <?php if ( has_post_thumbnail()) {
                    if(empty($module['jl_hide_thumb'])){?>
                    <div class="jl_img_holder">
                      <div class="jl_imgw jl_radus_e">
                        <div class="jl_imgin">
                        <?php 
                          if ($module['jl_cus_sm_img'] != '' ) {
                            the_post_thumbnail($module['jl_cus_sm_img']);
                          }else{
                            the_post_thumbnail('bopea_small');
                          }?>                        
                        </div>
                      </div>
                    </div>
                  <?php }}?>
                  <div class="jl_fe_text">
                    <h3 class="jl_fe_title jl_txt_2row"><span><?php the_title()?></span></h3>                      
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <?php
      endwhile;
    endif;
  }
endif;
