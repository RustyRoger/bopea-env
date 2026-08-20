<?php
if ( ! function_exists( 'bopea_mslider' ) ) {
	function bopea_mslider( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'               	=> '',
			'name'               		=> 'jl_mslider',
			'post_type'          		=> 'post',
			'term_slugs'         		=> '',
			'post_type_tax'      		=> '',
			'category'           		=> '',
			'categories'         		=> '',
			'format'             		=> '',
			'tags'               		=> '',
			'author'             		=> '',
			'post_not_in'        		=> '',
			'post_in'            		=> '',
			'order'              		=> '',
			'posts_per_page'     		=> '',
			'offset'             		=> '',
			'car_type' 	     			=> 'mslider1',
			'car_effect' 	     		=> 'fade',
			'slider_speed' 		 		=> '',
			'slider_loop' 		 		=> '',
			'slider_autoplay' 			=> '',
			'slider_autoplay_delay' 	=> '',
			'slider_arrow' 		 		=> '',
			'slider_dots' 		 		=> '',
			'sl_center_mode' 	 		=> 'false',
			'sl_center_padding'  		=> '0',
			'pagination'         		=> false,
			'jl_hide_cat'        		=> '',
			'jl_hide_btn'               => '',
			'jl_hide_author'     		=> '',
			'jl_hide_date'       		=> '',
			'jl_hide_meta'       		=> '',
			'jl_hide_desc'       		=> '',
			'jl_hide_review'     		=> '',
			'jl_hide_line'       		=> '',
			'jl_cus_img'     			=> '',
			'car_arr_pos'     			=> '',
			'tag'               		=> 'h2',
			'ignore_sticky_posts' 		=> '',

		), $attrs );
		$module['classes']         	= 'jl-main-block';
		$module['content_classes'] 	= 'jl-col-row';
		$total_posts = $module['posts_per_page'];
		$sltype = $module['car_type'];
		$query_data = bopea_query( $module );
		$module['posts_per_page'] = $total_posts;
		$module['car_type'] = $sltype;
		ob_start();
		$atts_style   = array();
		$atts_style[] = 'block-section';
		$atts_style[] = $module['car_type'];
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
		if ( 'yes' === $module['jl_hide_review'] ) {
			$atts_style[] = 'jl_hide_review';
		}
		if ( 'yes' === $module['jl_hide_line'] ) {
			$atts_style[] = 'jl_hide_line';
		}		
		if ( ! empty( $module['car_arr_pos'] ) ) {
			$atts_style[] = $module['car_arr_pos'];
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
                'slideitem'      	=> $items,
                'speed'          	=> absint( $module['slider_speed'] ),
                'spacebetween'   	=> 0,
                'loop'           	=> ( 'yes' === $module['slider_loop'] ),
                'autoplay'       	=> ( 'yes' === $module['slider_autoplay'] ),
                'autoplay_delay' 	=> absint( $module['slider_autoplay_delay'] ),
                'effect'         	=> $effect,
                'parallax'         	=> $parallax,
                'navigation'     	=> ( 'yes' === $module['slider_arrow'] ),
                'pagination'     	=> ( 'yes' === $module['slider_dots'] ),
                'uniqid'         	=> $module['blockid']
        ];
		?>
		<div class="<?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php
		if ( empty( $module['car_type'] ) ) {
			$module['car_type'] = 'carousel1';
			$atts_style .= ' ' . $module['car_type'];
		}
		if ( $query_data->have_posts() ) :

			$atts_style = 'jl-roww content-inner';
		if ( ! empty( $module['content_classes'] ) ) {
			$atts_style .= ' ' . $module['content_classes'];
		} ?>
			<div class="<?php echo esc_attr( $atts_style ); ?>">
				<div class="jl-eb-sl jl-eb-msl jl_lg_opt swiper-container" data-settings='<?php echo esc_attr(wp_json_encode( $slider_settings )); ?>'>
				<div class="swiper-wrapper">
	    		<?php
				switch ( $module['car_type'] ) {
					case 'mslider1' :
						bopea_mslider_a_listing( $module, $query_data );
					break;
					case 'mslider2' :
						bopea_mslider_b_listing( $module, $query_data );
					break;
				}?>
	    		</div>
				<?php if ( 'yes' === $module['slider_dots'] ) {?>
	    		<div class="jlc-pagination-<?php echo esc_attr( $module['blockid'] ); ?> jl_spw"><div class="swiper-pagination"></div></div>
	    		<?php }?>
	    		<?php if ( 'yes' === $module['slider_arrow'] ) {?>
	    		<div class="jl_arpw jlc-navigation-<?php echo esc_attr( $module['blockid'] ); ?>"><div class="jl-swiper-button-next"><div class="jl-spn-inner"><i class="jli-right-chevron"></i></div></div><div class="jl-swiper-button-prev"><div class="jl-spn-inner"><i class="jli-left-chevron"></i></div></div></div>
	    		<?php }?>
				</div>
			</div>		
			<?php
			wp_reset_postdata();
		endif;
		echo '</div>';
		return ob_get_clean();
	}
}

if ( ! function_exists( 'bopea_mslider_a_listing' ) ) :
	function bopea_mslider_a_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post(); ?>
			<div class="swiper-slide jl_mslide">
          	  <div class="slide-inner" <?php if ( $module['car_effect'] == 'parallax') {?>data-swiper-parallax="80%"<?php }?>>
				<div class="jl_lg_op jl_lg_l2 jl_lasep">
					<div class="jl_lg_op_in">
						<div class="jl_ov_layout jl_ov_el jl_ov_mh">
						<?php if ( has_post_thumbnail()) {?>
							<div class="jl_img_holder">
								<div class="jl_imgw">
									<div class="jl_imgin">
										<?php
										if ($module['jl_cus_img'] != '' ) {
											the_post_thumbnail($module['jl_cus_img']);
										}else{
											the_post_thumbnail('bopea_medium');
										}?>
									</div>
									<?php bopea_video_media(get_the_ID());?>
									<?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
									<a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
								</div>
							</div>
						<?php }?>
							<div class="jl_fe_text">
								<div class="jl_fe_inner">
								<?php bopea_post_ov_cat(get_the_ID());?>
								<h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
								<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 22, '...' );?> </p>
								<?php bopea_post_meta(get_the_ID());?>
								<?php if(empty($module['jl_hide_btn'])){bopea_button_txt(get_the_ID());}?>
								<a href="<?php the_permalink(); ?>" aria-label="<?php the_title()?>" class="jl_cap_ov"></a>								
								</div>
								<a href="<?php the_permalink(); ?>" aria-label="<?php the_title()?>" class="jl_cap_ov jlcapvv"></a>
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

if ( ! function_exists( 'bopea_mslider_b_listing' ) ) :
	function bopea_mslider_b_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post(); ?>
			<div class="swiper-slide jl_mslide">
          	  <div class="slide-inner" <?php if ( $module['car_effect'] == 'parallax') {?>data-swiper-parallax="80%"<?php }?>>
				<div class="jl_lg_op jl_lg_l3 jl_lasep">
					<div class="jl_lg_op_in">
						<div class="jl_ov_layout jl_ov_el jl_ov_mh">
						<?php if ( has_post_thumbnail()) {?>
							<div class="jl_img_holder">
								<div class="jl_imgw">
									<div class="jl_imgin">
										<?php
										if ($module['jl_cus_img'] != '' ) {
											the_post_thumbnail($module['jl_cus_img']);
										}else{
											the_post_thumbnail('bopea_medium');
										}?>
									</div>
									<?php bopea_video_media(get_the_ID());?>
									<?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
									<a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
								</div>
							</div>
						<?php }?>
							<div class="jl_fe_text">
								<div class="jl_fe_inner">
								<?php bopea_post_ov_cat(get_the_ID());?>
								<h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
								<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 22, '...' );?> </p>
								<?php bopea_post_meta(get_the_ID());?>
								<?php if(empty($module['jl_hide_btn'])){bopea_button_txt(get_the_ID());}?>
								<a href="<?php the_permalink(); ?>" aria-label="<?php the_title()?>" class="jl_cap_ov"></a>
								</div>
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