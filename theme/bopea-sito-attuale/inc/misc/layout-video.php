<?php
if ( ! function_exists( 'bopea_layout_video' ) ) {
	function bopea_layout_video( $attrs ) {
			$module = shortcode_atts( array(
			'blockid'               => '',
			'name'               		=> 'jl_lvideo',
			'post_type'          		=> 'post',
			'term_slugs'         		=> '',
			'post_type_tax'      		=> '',
			'category'           		=> '',
			'categories'         		=> '',
			'format'             		=> 'video',
			'tags'               		=> '',
			'author'             		=> '',
			'post_not_in'        		=> '',
			'post_in'            		=> '',
			'order'              		=> '',
			'posts_per_page'     		=> '',
			'offset'             		=> '',
			'pagination'         		=> false,
			'jl_hide_cat'        		=> '',
			'jl_hide_author'     		=> '',
			'jl_hide_date'       		=> '',
			'jl_hide_meta'       		=> '',
			'jl_hide_cat'        		=> '',
			'jl_hide_author'     		=> '',
			'jl_hide_date'       		=> '',
			'jl_hide_meta'       		=> '',
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',
		), $attrs );
		$query_data = bopea_query( $module );
		ob_start();
		$atts_style   = array();
		$atts_style[] = 'block-section';
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
		$atts_style = implode( ' ', $atts_style );
		?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="jl_clear_at <?php echo esc_attr( $atts_style ); ?>">
			<div id="jl-vid-alist-<?php echo esc_attr( $module['blockid'] ); ?>">
				<div class="jl_vidc_l">
			<?php
			if ( $query_data->have_posts() ) :
				bopea_layout_video_listing( $module, $query_data );
				wp_reset_postdata();
			endif;
			?>
			</div></div></div>
		<?php return ob_get_clean();
	}
}

if ( ! function_exists( 'bopea_layout_video_listing' ) ) :
	function bopea_layout_video_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
		?>
				<div class="jl_vidli_w jl_radus_e">
				<?php
				$counter = 0;
				$pnum = $query_data->post_count;
				while ( $query_data->have_posts() ) :
				$query_data->the_post();
				if($counter == 0){
					bopea_layout_video_m_listing( $module );
					echo '<div class="jl_vidsb"><div class="jl_vidsb_in">';
					bopea_layout_video_li_listing( $module );
				}else{
					bopea_layout_video_lic_listing( $module );
				}
				if(++$counter === $pnum) {
   					 echo "</div></div>";
  			}
				endwhile;?>
				</div>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'bopea_layout_video_m_listing' ) ) :
	function bopea_layout_video_m_listing( $module = array(), $query_data = null ) {?>
		<div class="jl_vid_msh">
			<div class="jl_vidfr jl_radus_e">
				<span class="jl_vid_sh jl_vid_mp" data-blockid="<?php echo esc_attr( $module['blockid'] ); ?>" data-vidtype="<?php bopea_media_type(get_the_ID());?>" data-<?php bopea_media_type(get_the_ID());?>="<?php bopea_media_url(get_the_ID());?>">
					<span class="jl_vid_mpin">
					<svg fill="currentColor" viewBox="0 0 22 27"><path d="M1 2.242 20.5 13.5 1 24.758V2.242Z" stroke="currentColor"></path></svg>
					</span>
				</span>
			<div class="jl_vid_mc jl_ov_el">
				    <?php if ( has_post_thumbnail()) {?>
				        <div class="jl_img_holder">
					        <div class="jl_imgw jl_radus_e">
					            <div class="jl_imgin">
									<?php
									if ($module['jl_cus_img'] != '' ) {
										the_post_thumbnail($module['jl_cus_img']);
									}else{
										the_post_thumbnail('bopea_medium');
									}?>
								</div>
					            <a class="jl_imgl" aria-label="<?php the_title()?>" href="<?php the_permalink();?>"></a>
					        </div>
				        </div>
				    <?php }?>
				    <div class="jl_fe_text">
				    	<div class="jl_fe_inner">
				    	<?php bopea_post_ov_cat(get_the_ID());?>
				        <h3 class="jl_fe_title jl_txt_2row"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
				        <?php bopea_post_meta(get_the_ID());?>
				        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title()?>" class="jl_cap_ov"></a>
				        </div>
				    </div>
				</div>
		</div>
		</div>
	<?php }
endif;

if ( ! function_exists( 'bopea_layout_video_li_listing' ) ) :
	function bopea_layout_video_li_listing( $module = array(), $query_data = null ) { ?>
		<article class="jl_ac_vid jl_vidsb_c">
			<div class="jl_vidfr">
				<span class="jl_vid_sh jl_vid_tar" data-blockid="<?php echo esc_attr( $module['blockid'] ); ?>" data-vidtype="<?php bopea_media_type(get_the_ID());?>" data-<?php bopea_media_type(get_the_ID());?>="<?php bopea_media_url(get_the_ID());?>"></span>
			</div>
			<div class="jl_cslist_layout jl_lisep">
				<div class="jl_li_in">
			    <?php if ( has_post_thumbnail()) {?>
			        <div class="jl_img_holder">
				        <div class="jl_imgw jl_radus_e">
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
				        </div>
								<span class="jl_vid_mp">
									<span class="jl_vid_mpin">
									<svg fill="currentColor" viewBox="0 0 22 27"><path d="M1 2.242 20.5 13.5 1 24.758V2.242Z" stroke="currentColor"></path></svg>
									</span>
								</span>
			        </div>
			    <?php }?>
			    <div class="jl_fe_text">
			        <h3 class="jl_fe_title jl_txt_2row"><?php the_title()?></h3>
			        <?php bopea_post_meta_date(get_the_ID());?>
			    </div>
			</div>
			</div>
		</article>
<?php }
endif;


if ( ! function_exists( 'bopea_layout_video_lic_listing' ) ) :
	function bopea_layout_video_lic_listing( $module = array(), $query_data = null ) { ?>
		<article class="jl_vidsb_c">
			<div class="jl_vidfr">
				<span class="jl_vid_sh jl_vid_tar" data-blockid="<?php echo esc_attr( $module['blockid'] ); ?>" data-vidtype="<?php bopea_media_type(get_the_ID());?>" data-<?php bopea_media_type(get_the_ID());?>="<?php bopea_media_url(get_the_ID());?>"></span>
			</div>
			<div class="jl_cslist_layout jl_lisep">
				<div class="jl_li_in">
			    <?php if ( has_post_thumbnail()) {?>
			        <div class="jl_img_holder">
				        <div class="jl_imgw jl_radus_e">
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
				        </div>
								<span class="jl_vid_mp">
									<span class="jl_vid_mpin">
									<svg fill="currentColor" viewBox="0 0 22 27"><path d="M1 2.242 20.5 13.5 1 24.758V2.242Z" stroke="currentColor"></path></svg>
									</span>
								</span>
			        </div>
			    <?php }?>
			    <div class="jl_fe_text">
			        <h3 class="jl_fe_title jl_txt_2row"><?php the_title()?></h3>
			        <?php bopea_post_meta_date(get_the_ID());?>
			    </div>
			</div>
			</div>
		</article>
<?php }
endif;