<?php
if ( ! function_exists( 'bopea_hover_case' ) ) {
	function bopea_hover_case( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'               	=> '',
			'name'               		=> 'jl_hover_case',
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
			'pagination'         		=> false,
			'jl_cus_img'     => '',
			'ignore_sticky_posts' => '',
		), $attrs );
		$module['classes']         	= 'jl-main-block';
		$module['content_classes'] 	= 'jl-col-row';
		$total_posts = $module['posts_per_page'];
		$query_data = bopea_query( $module );
		$module['posts_per_page'] = $total_posts;
		ob_start();
		$atts_style   = array();
		$atts_style[] = 'block-section';
		if ( ! empty( $module['classes'] ) ) {
			$atts_style[] = $module['classes'];
		}
		$atts_style = implode( ' ', $atts_style );
		?>				
		<div class="<?php echo esc_attr( $atts_style ); ?>" <?php bopea_get_ajax_attributes( $module, $query_data ); ?>>
		<?php		
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww content-inner';		
		if ( ! empty( $module['content_classes'] ) ) {
			$atts_style .= ' ' . $module['content_classes'];
		} ?>
			<div class="<?php echo esc_attr( $atts_style ); ?>">				
		    	<div class="jl-showcase-container">
        			<div class="jl-showcase-wrapper">
		    			<?php bopea_hover_con_listing( $module, $query_data );?>		    		
		    		</div>
		    		<div class="jl-img-wrap">
		    			<?php bopea_hover_img_listing( $module, $query_data );?>
						<div class="jl-img-ovb"></div>
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

if ( ! function_exists( 'bopea_hover_con_listing' ) ) :
	function bopea_hover_con_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 0;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<?php if($counter == 0){?>
				<div class="jl-showcase-content jl-showcase-active">
			<?php }else{?>
				<div class="jl-showcase-content">
			<?php }?>			    			 	  
          	  		<div class="jl-showcase-item-inner">
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
      	<?php
      	$counter++;
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'bopea_hover_img_listing' ) ) :
	function bopea_hover_img_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 0;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<?php if($counter == 0){?>
				<div class="jl-img-inner jl-showcase-active">
			<?php }else{?>
				<div class="jl-img-inner">
			<?php }?>			    
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
				</div>
			<?php
			$counter++;
			endwhile;			
		endif;
	}
endif;