<?php
if ( ! function_exists( 'bopea_marquee' ) ) {
	function bopea_marquee( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_marquee',
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
			'jl_label_title'  	=> '',
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

		$jl_push_hover = $module['jl_push_hover'];       
       if($jl_push_hover == 'yes'){
        $jl_push_hover = 'jl-marquee-push';
       }else{
        $jl_push_hover = '';
       }
       $jl_section_list_layout = $module['jl_section_list_layout'];
       if($jl_section_list_layout == 'layout_left'){
        $jl_marquee = 'jl-marquee-left';
        $jl_marquee_clone = 'jl-marquee-cloned-left';        
       }else{
        $jl_marquee = 'jl-marquee-right';
        $jl_marquee_clone = 'jl-marquee-cloned-right';
       }
		
		
		$atts_style = implode( ' ', $atts_style ); ?>
		<div class="<?php echo esc_attr( $atts_style ); ?>">
		<?php if ( $query_data->have_posts() ) : ?>
			<div class="jl_mar_wp">
            	<?php if ( !empty($module['jl_label_title']) ) { ?>
				<div class="jl_mar_lbl"><?php echo esc_attr($module['jl_label_title']); ?></div>
				<?php }?>
            	<div class="jl-marquee-wrap <?php echo esc_attr($jl_push_hover);?>">            
					<ul class="jl-marquee-ul jl-marquee-text <?php echo esc_attr($jl_marquee);?>">
					<?php while ( $query_data->have_posts() ) :
						$query_data->the_post(); ?>
						<li class="jl-marquee-li">
						<h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>			        
						</li>
					<?php endwhile; ?>
					</ul>
					<ul class="jl-marquee-ul jl-marquee-text jl-marquee-cloned <?php echo esc_attr($jl_marquee_clone);?>">
					<?php while ( $query_data->have_posts() ) :
						$query_data->the_post(); ?>
						<li class="jl-marquee-li">
						<h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>			        
						</li>
					<?php endwhile; ?>
					</ul>
				</div>
        	</div>		
		<?php
		wp_reset_postdata();			
		endif;
		echo '</div>';
		return ob_get_clean();
	}
}