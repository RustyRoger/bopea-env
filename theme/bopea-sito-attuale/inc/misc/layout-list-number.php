<?php
if ( ! function_exists( 'bopea_li_number' ) ) {
	function bopea_li_number( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_li_number',
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
			'jl_hide_line'       => '',
			'jl_hide_col_line'   => '',
			'jl_hide_cat'        => '',
			'jl_hide_meta'       => '',
			'jl_hide_desc'       => '',
			'jl_show_num'        => '',
			'jl_num_pos'        => '',
			'jl_light_mode'      => '',
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',
		), $attrs );		
		$module['style_mian']         = 'jl-main-block';
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
		if ( 'yes' === $module['jl_hide_meta'] ) {
			$atts_style[] = 'jl_hide_meta';
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
		if ( 'yes' === $module['jl_show_num'] ) {
			$atts_style[] = 'jl_sh_num';
		}
		if ( '' != $module['jl_num_pos'] ) {
			$atts_style[] = $module['jl_num_pos'];
		}
		if ( 'yes' === $module['jl_hide_desc'] ) {
			$atts_style[] = 'jl_hide_desc';
		}
		$atts_style = implode( ' ', $atts_style ); ?>		
		<div class="jl_clear_at <?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php bopea_block_tabs_link( $module ); ?>
		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain jl_cgrid_wrap jl_cli_num';		
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}		
		?>
		<div class="jl_grid_wrap_f jl_wrap_eb jl_wrap_eb jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">			
			<?php
			bopea_li_number_listing( $module, $query_data );					
			echo '</div>';
			bopea_blocknav( $module, $query_data );
			echo '</div>';
			wp_reset_postdata();			
		endif;
		echo '</div>';
		return ob_get_clean();
	}
}

if ( ! function_exists( 'bopea_li_number_listing' ) ) :
	function bopea_li_number_listing( $module = array(), $query_data = null ) {		
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				?>
				<div class="jl_mmlist_w jl_numl">
					<div class="jl_mmlist_layout jl_lisep jl_risep jl_in_num">
						<div class="jl_li_in jl_nun_i">
						<span class="jl_nun_d"></span>
					    <div class="jl_fe_text">    
							<?php bopea_post_small_cat(get_the_ID());?>
					        <h3 class="jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>	
							<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 23, '...' );?> </p>
					        <?php bopea_post_meta_date(get_the_ID());?>                
					    </div>
					</div>
					</div>
				</div>
			<?php
			endwhile;			
		endif;
	}
endif;