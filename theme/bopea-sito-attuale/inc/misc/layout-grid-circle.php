<?php
if ( ! function_exists( 'bopea_g_circle' ) ) {
	function bopea_g_circle( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_c_grid',
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
			'posts_per_page'     => '',
			'offset'             => '',
			'pagination'         => '',
			'show_excep'         => '',
			'tabs_link'       	 => '',
			'tabs_link_ids'   	 => '',
			'tabs_link_label' 	 => '',
			'jl_hide_cat'        => '',
			'jl_hide_author'     => '',
			'jl_hide_date'       => '',
			'jl_hide_meta'       => '',
			'jl_hide_desc'       => '',
			'jl_hide_review'     => '',
			'jl_hide_line'       => '',
			'jl_hide_col_line'   => '',
			'jl_show_num'        => '',
			'jl_num_pos'        => '',
			'jl_en_frame'   => '',
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',
		), $attrs );
		$module['style_mian']     = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';
		$total_posts = $module['posts_per_page'];
		$query_data = bopea_query( $module );
		$show_excep = $module['show_excep'];
		$module['posts_per_page'] = $total_posts;
		$module['show_excep'] = $show_excep;		
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
			$atts_style[] = 'jl_hide_line';
			$atts_style[] = 'jl_hide_col_line';
		
		if ( 'yes' === $module['jl_en_frame'] ) {
			$atts_style[] = 'jl_en_fr jl_frg';
		}		
		if ( '' === $module['jl_en_frame'] ) {
			if ( 'yes' === $module['jl_show_num'] ) {
				$atts_style[] = 'jl_sh_num';
			}
			if ( '' != $module['jl_num_pos'] ) {
				$atts_style[] = $module['jl_num_pos'];
			}
		}
		
		$atts_style = implode( ' ', $atts_style ); ?>
		<div class="jl_clear_at <?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>		
		<?php
		bopea_block_tabs_link( $module );
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain jl_cgrid_wrap jl_gcir_w';
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}
		?>
		<div class="jl_grid_wrap_f jl_wrap_eb jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">
			<?php
			bopea_cgrid_listing( $module, $query_data );
			echo '</div>';
			bopea_blocknav( $module, $query_data );
			echo '</div>';
			wp_reset_postdata();
		endif;
		echo '</div>';
		return ob_get_clean();
	}
}

if ( ! function_exists( 'bopea_cgrid_listing' ) ) :
	function bopea_cgrid_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post(); ?>
				<div class="jl_cgrid_layout">
			    <?php if ( has_post_thumbnail()) {?>
			        <div class="jl_img_holder">
			        <div class="jl_imgw jl_radus_e">
			            <div class="jl_imgin">
								<?php
								if ($module['jl_cus_img'] != '' ) {
									the_post_thumbnail($module['jl_cus_img']);
								}else{
									the_post_thumbnail('bopea_layouts');
								}?>
			            </div>
			            <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
			        </div>
			        </div>
			    <?php }?>
			    <div class="jl_fe_text">
					<?php bopea_post_small_cat(get_the_ID());?>
			        <h3 class="jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>			        
			        <?php bopea_post_meta(get_the_ID());?>
			    </div>
			</div>
			<?php
			endwhile;
		endif;
	}
endif;
