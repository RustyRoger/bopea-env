<?php
if ( ! function_exists( 'bopea_newsticker' ) ) {
	function bopea_newsticker( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_newsticker',
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
			'jl_hide_cat'        => '',
			'jl_hide_author'     => '',
			'jl_hide_date'       => '',
			'jl_hide_meta'       => '',
			'jl_push_hover'      => '',
			'jl_section_list_layout' => '',
			'slider_speed' 		 	=> '',
			'slider_loop' 		 	=> '',
			'slider_autoplay' 		=> '',
			'slider_autoplay_delay' => '',
			'slider_arrow' 		 	=> 'yes',
			'slider_dots' 		 	=> '',
			'sl_center_padding'  	=> '0',
			'jl_label_title'  	=> '',
			'pagination'         	=> false,
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',			
		), $attrs );				
		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';
		$total_posts = $module['posts_per_page'];		
		$query_data = bopea_query( $module );		
		$module['posts_per_page'] = $total_posts;		
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
		'loop'           	=> true,
		'autoplay'       	=> true,
		'autoplay_delay' 	=> absint( $module['slider_autoplay_delay'] ),
		'effect'         	=> 'fade',
		'parallax'         	=> false,
		'navigation'     	=> true,
		'pagination'     	=> false,
		'uniqid'         	=> $module['blockid']
		];
		
		
		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>">
		<?php if ( $query_data->have_posts() ) : ?>
			<div class="jl_ticker_wp">
				<?php if ( !empty($module['jl_label_title']) ) { ?>
				<div class="jl_ticker_lbl"><?php echo esc_attr($module['jl_label_title']); ?></div>
				<?php }?>
            	<div class="jl-eb-sl jl-eb-msl swiper-container" data-settings='<?php echo esc_attr(wp_json_encode( $slider_settings )); ?>'>
					<div class="swiper-wrapper jl-newsticker-wrap jl-newsticker-ul jl-newsticker-text">
							<?php bopea_newsticker_listing( $module, $query_data ); ?>
					</div>
					<?php if ( 'yes' === $module['slider_arrow'] ) {?>
	    				<div class="jl_arpw jlc-navigation-<?php echo esc_attr( $module['blockid'] ); ?>"><div class="jl-swiper-button-prev"><div class="jl-spn-inner"><i class="jli-left-chevron"></i></div></div><div class="jl-swiper-button-next"><div class="jl-spn-inner"><i class="jli-right-chevron"></i></div></div></div>
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

if ( ! function_exists( 'bopea_newsticker_listing' ) ) :
	function bopea_newsticker_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();
			?>
			<div class="swiper-slide">
          	  <div class="slide-inner jl-newsticker-li">
				<h6 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h6>
				<?php bopea_post_meta_date(get_the_ID());?>
          	</div>
      </div>
			<?php
			endwhile;
		endif;
	}
endif;