<?php
if ( ! function_exists( 'bopea_feature_layout_12' ) ) {
	function bopea_feature_layout_12( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_feature_12',
			'post_type'          => 'post',
			'term_slugs'         => '',
			'post_type_tax'      => '',
			'category'           => '',
			'categories'         => '',
			'format'             => '',
			'tags'               => '',
			'author'             => '',
			'post_not_in'        => '',
			'post_in'            => '',
			'order'              => '',
			'posts_per_page'     => 5,
			'offset'             => '',
			'pagination'         => false,
			'jl_hide_cat'        => '',
			'jl_hide_author'     => '',
			'jl_hide_date'       => '',
			'jl_hide_meta'       => '',
			'jl_hide_desc'       => '',
			'jl_hide_review'     => '',
			'jl_hide_line'       => '',
			'jl_hide_col_line'   => '',
			'jl_light_mode'      => '',
			'jl_en_frame'   => '',
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',
		), $attrs );			       		
		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';		
		$query_data = bopea_query( $module );		
		ob_start();
		$atts_style   = array();
		$atts_style[] = 'block-section';		
		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
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
		if ( 'yes' === $module['jl_hide_col_line'] ) {
			$atts_style[] = 'jl_hide_col_line';
		}
		if ( 'yes' === $module['jl_light_mode'] ) {
			$atts_style[] = 'jl_light_mode';
		}		
		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain';		
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		} ?>
		<div class="jl_mb_wrap_f jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">
				<div class="jl_fr12_wrap">
					<div class="jl_fr12_inner">
						<?php bopea_feature_12_listing( $module, $query_data ); ?>			
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

if ( ! function_exists( 'bopea_feature_12_listing' ) ) :
	function bopea_feature_12_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 0;
			$pnum = $query_data->post_count;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if($counter == 0){
					jl_layout_m_r_12( $module );
					if ( 'yes' === $module['jl_en_frame'] ) { $gr_smg = 'jl_en_fr jl_frg'; }else{$gr_smg = "";}
					echo '<div class="jl_fli_con '.$gr_smg.'"><div class="jl_fli_wrap">';
				}else{
					jl_layout_m_r_sm_12( $module );
				}
				if(++$counter === $pnum) {
   					 echo "</div></div>";
  				}
			endwhile;
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_m_r_12' ) ) :
	function jl_layout_m_r_12( $module = array() ) {?>
		<div class="jl_p_fr12">
			    <?php if ( has_post_thumbnail()) {?>
			        <div class="jl_imgc">
				        <div class="jl_imgw jl_radus_e">
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
					<?php bopea_post_list_cat(get_the_ID());?>
			        <h2 class="jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
			        <?php bopea_post_meta(get_the_ID());?>                
			    </div>
			</div>
	<?php }
endif;

if ( ! function_exists( 'jl_layout_m_r_sm_12' ) ) :
	function jl_layout_m_r_sm_12( $module = array() ) {?>
			<div class="jl_cgrid_layout jl_frsha">
			    <?php if ( has_post_thumbnail()) {?>
			        <div class="jl_imgw jl_radus_e">
			            <div class="jl_imgin">
			                	<?php
								if ($module['jl_cus_img'] != '' ) {
									the_post_thumbnail($module['jl_cus_img']);
								}else{
									the_post_thumbnail('bopea_layouts');
								}?>
			            </div>
			            <?php bopea_video_media(get_the_ID());?>
			            <?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
			            <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
						<?php bopea_post_tumb_cat(get_the_ID());?>
			        </div> 
			    <?php }?>                            
			    <div class="jl_fe_text">    
			        <?php bopea_post_cat(get_the_ID());?>
			        <h3 class="jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
			        <?php bopea_post_meta(get_the_ID());?>                
			    </div>
			</div>
	<?php }
endif;