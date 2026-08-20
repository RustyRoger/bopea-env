<?php
if ( ! function_exists( 'bopea_cslider' ) ) {
	function bopea_cslider( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'               => '',
			'name'               		=> 'jl_cslider',
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
			'car_type' 	     			=> 'jl_center_car1',
			'slider_speed' 				=> '',
			'slider_spacebetween' 		=> '',
			'slider_loop' 				=> '',
			'slider_autoplay' 			=> '',
			'slider_autoplay_delay' 	=> '',
			'slider_arrow' 				=> '',
			'slider_dots' 				=> '',
			'sl_center_mode' 			=> 'false',
			'sl_center_padding'  		=> '0',
			'pagination'         		=> false,
			'jl_hide_cat'        		=> '',
			'jl_hide_author'    		=> '',
			'jl_hide_date'       		=> '',
			'jl_hide_meta'       		=> '',
			'jl_hide_desc'       		=> '',
			'jl_hide_review'     		=> '',
			'jl_hide_line'       		=> '',
			'jl_cus_img'     			=> '',
			'tag'               		=> 'h2',
			'ignore_sticky_posts' 		=> '',
		), $attrs );
		$module['classes']         = 'jl-main-block';
		$module['content_classes'] = 'jl-col-row';
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
		$sl_center_mode = $module['sl_center_mode'];
		if($sl_center_mode == 'yes'){
			$sl_center_mode = "true";
		}else{
			$sl_center_mode = "false";
		}
		$sl_center_padding = $module['sl_center_padding'];
		$atts_style = implode( ' ', $atts_style );
		$items = [
                'desktop'           => 2.5,
                'tablet'            => 2.5,
                'small_mobile'      => 1,
                'large_mobile'      => 1,
                'landscape_mobile'  => 1,
        ];
        $slider_settings = [
                'slideitem'      	=> $items,
                'speed'          	=> absint( $module['slider_speed'] ),
                'spacebetween'   	=> absint( $module['slider_spacebetween'] ),
                'loop'           	=> ( 'yes' === $module['slider_loop'] ),
                'autoplay'       	=> ( 'yes' === $module['slider_autoplay'] ),
                'autoplay_delay' 	=> absint( $module['slider_autoplay_delay'] ),
                'effect'         	=> 'slide',
                'centered'   	   	=> true,
                'navigation'     	=> ( 'yes' === $module['slider_arrow'] ),
                'pagination'     	=> ( 'yes' === $module['slider_dots'] ),
                'uniqid'         	=> $module['blockid']
        ];
		?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php
		if ( empty( $module['car_type'] ) ) {
			$module['car_type'] = 'jl_center_car1';
			$atts_style .= ' ' . $module['car_type'];
		}
		if ( $query_data->have_posts() ) :

			$atts_style = 'jl-roww content-inner';
		if ( ! empty( $module['content_classes'] ) ) {
			$atts_style .= ' ' . $module['content_classes'];
		} ?>
			<div class="<?php echo esc_attr( $atts_style ); ?>">
				<div class="jl-eb-sl jl_cc_car swiper-container" data-settings='<?php echo esc_attr(wp_json_encode( $slider_settings )); ?>'>
				<div class="swiper-wrapper">
	    	<?php
				switch ( $module['car_type'] ) {
					case 'jl_center_car1' :
						bopea_cslider_a_listing( $module, $query_data );
					break;
					case 'jl_center_car2' :
						bopea_cslider_b_listing( $module, $query_data );
					break;
					case 'jl_center_car3' :
						bopea_cslider_c_listing( $module, $query_data );
					break;
				}
	    	?>
	    		</div>
	    		<?php if ( 'yes' === $module['slider_dots'] ) {?>
	    		<div class="jlc-pagination-<?php echo esc_attr( $module['blockid'] ); ?> jl_spw"><div class="swiper-pagination"></div></div>
	    		<?php }?>
	    		<?php if ( 'yes' === $module['slider_arrow'] ) {?>
	    		<div class="jlc-navigation-<?php echo esc_attr( $module['blockid'] ); ?>"><div class="jl-swiper-button-next"><div class="jl-spn-inner"><i class="jli-right-chevron"></i></div></div><div class="jl-swiper-button-prev"><div class="jl-spn-inner"><i class="jli-left-chevron"></i></div></div></div>
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

if ( ! function_exists( 'bopea_cslider_a_listing' ) ) :
	function bopea_cslider_a_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
			?>
			<div class="swiper-slide jl_cslide">
          <div class="slide-inner jl_cs_background">
          	<div class="jl_ov_layout jl_ov_bg jl_ov_el">
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
				        <<?php echo esc_html($module['tag']);?> class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></<?php echo esc_html($module['tag']);?>>
				        <?php bopea_post_meta(get_the_ID());?>
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


if ( ! function_exists( 'bopea_cslider_b_listing' ) ) :
	function bopea_cslider_b_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
			?>
			<div class="swiper-slide jl_cslide">
          		<div class="slide-inner jl_cs_classic jl_cs_center">
	          		<div class="jl_cgrid_layout">
				    	<?php if ( has_post_thumbnail()) {?>
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
				    	<?php }?>
					    	<div class="jl_fe_text">
					    		<div class="jl_fe_inner">
							<?php bopea_post_ov_cat(get_the_ID());?>
					        <<?php echo esc_html($module['tag']);?> class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></<?php echo esc_html($module['tag']);?>>
					        <?php bopea_post_meta(get_the_ID());?>
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

if ( ! function_exists( 'bopea_cslider_c_listing' ) ) :
	function bopea_cslider_c_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
			?>
		  <div class="swiper-slide jl_cslide">
          		<div class="slide-inner jl_cs_classic">
	          		<div class="jl_cgrid_layout">
				    	<?php if ( has_post_thumbnail()) {?>
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
				    	<?php }?>
					    	<div class="jl_fe_text">
					    		<div class="jl_fe_inner">
					        <?php bopea_post_list_cat(get_the_ID());?>
					        <<?php echo esc_html($module['tag']);?> class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></<?php echo esc_html($module['tag']);?>>
					        <?php bopea_post_meta(get_the_ID());?>
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