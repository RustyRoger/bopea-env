<?php
if ( ! function_exists( 'bopea_menu_layout' ) ) {
	function bopea_menu_layout( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'mega_grid',
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
			'posts_per_page'     => '2',
			'offset'             => '',
			'section_title'      => '',
			'section_sub_title'  => '',
			'pagination'         => 'next_prev',
			'g_cols'             => '',
			'posts_cols'         => '',
			'g_style'            => '',
			'show_excep'         => '',
			'tabs_link'       => '',
			'tabs_link_ids'   => '',
			'tabs_link_label' => '',
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

		$atts_style = implode( ' ', $atts_style ); ?>
		<div class="jl_clear_at jl-wp-mu jl_mega_post_<?php echo esc_attr($module['posts_cols']);?> <?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}
		?>
		<div class="jl_mega_c_wrap jl_wrap_eb jl_clear_at <?php echo esc_attr( $module['section_style'] ); ?> <?php echo esc_attr( $module['g_cols'] ); ?> <?php echo esc_attr( $module['g_style'] ); ?>">
			<div class="<?php echo esc_attr( $atts_style ); ?>">
			<?php
			switch ( $module['section_style'] ) {
				case 'mega_grid' :
					bopea_menu_g_listing( $module, $query_data );
				break;
				case 'mega_grid_overlay' :
					bopea_ov_listing( $module, $query_data );
				break;
				case 'mega_small_list' :
					bopea_sm_listing( $module, $query_data );
				break;
			}
			echo '</div>';
			bopea_blocknav( $module, $query_data );
			echo '</div></div>';
			wp_reset_postdata();
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'bopea_menu_g_listing' ) ) :
	function bopea_menu_g_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
				$post_style_mian   = array();
				$post_style_mian[] = 'p-wraper post-' . get_the_ID();
			?>
					<div class="jl_mega_cols">
							<div class="<?php echo join( ' ', $post_style_mian ); ?>">
							  <div class="jl_mega_p_inner jl_mega_gl">
								<?php if ( has_post_thumbnail()) {?>
						          <div class="jl_imgw jl_radus_e">
							          <?php echo bopea_post_type();?>
							          <div class="jl_imgin">
							          	<?php the_post_thumbnail('bopea_layouts');?>
							          </div>
												<?php bopea_video_media(get_the_ID());?>
							          <?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
							          <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
									  <?php bopea_post_tumb_cat(get_the_ID());?>
						          </div>
						          <?php }?>
						          <div class="jl_mega_text">
						          		<?php bopea_post_cat(get_the_ID());?>
						          		<h3 class="jl_fr_ptxt jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
						          		<?php bopea_post_meta(get_the_ID());?>
						          </div>
				       			</div>
							</div>
					</div>
			<?php
			endwhile;
		endif;
	}
endif;

if ( ! function_exists( 'bopea_ov_listing' ) ) :
	function bopea_ov_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
				$post_style_mian   = array();
				$post_style_mian[] = 'p-wraper post-' . get_the_ID();
		?>
					<div class="jl_mega_cols">
							<div class="<?php echo join( ' ', $post_style_mian ); ?>">
							  <div class="jl_mega_p_inner jl_mega_go jl_radus_e">
							  	<?php if ( has_post_thumbnail()) {?>
						          <div class="jl_imgw">
							          <?php echo bopea_post_type();?>
							          <div class="jl_imgin">
							          	<?php the_post_thumbnail('bopea_layouts');?>
							          </div>
												<?php bopea_video_media(get_the_ID());?>
												<?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
												<a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
						          </div>
						          <?php }?>
						          <div class="jl_mega_text">
								  		<?php bopea_post_ov_cat(get_the_ID());?>
						          		<h3 class="jl_fr_ptxt jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
						          		<?php bopea_post_meta(get_the_ID());?>
						          </div>
				       			</div>
							</div>
					</div>
				<?php
			endwhile;
		endif;
	}
endif;

if ( ! function_exists( 'bopea_sm_listing' ) ) :
	function bopea_sm_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
				$post_style_mian   = array();
				$post_style_mian[] = 'p-wraper post-' . get_the_ID();
		?>
					<div class="jl_mega_cols">
							<div class="<?php echo join( ' ', $post_style_mian ); ?>">
							  <div class="jl_mega_p_inner jl_mega_sml">
								<?php if ( has_post_thumbnail()) {?>
						          <div class="jl_imgw jl_radus_e">
							          <?php echo bopea_post_type();?>
							          <div class="jl_imgin">
									  <?php
                                $sm_list_auto_height = get_theme_mod('sm_list_auto_height');
                                if(!empty($sm_list_auto_height)){
                                    the_post_thumbnail('medium');
                                }else{
                                    the_post_thumbnail('bopea_small');
                                }
                                ?>
							          </div>
							          <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
						          </div>
						          <?php }?>
						          <div class="jl_mega_text">
								  		<?php bopea_post_small_cat(get_the_ID());?>
								  		<h3 class="jl_fr_ptxt jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
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
