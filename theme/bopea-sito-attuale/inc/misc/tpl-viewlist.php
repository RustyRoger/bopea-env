<div <?php post_class( 'jl_clist_layout jl_frsha');?>>
	<div class="jl_li_in">
		<?php if ( has_post_thumbnail()) {?>
			<div class="jl_img_holder">
				<div class="jl_imgw jl_radus_e">
				    <div class="jl_imgin">
								<?php
								if (!empty(get_theme_mod('jl_archive_img'))) {
									the_post_thumbnail(get_theme_mod('jl_archive_img'));
								}else{
									the_post_thumbnail('bopea_layouts');
								}
								?> 
					</div>
				        <?php bopea_video_media(get_the_ID());?>
				        <?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
				        <a class="jl_imgl" href="<?php the_permalink();?>"></a>
				</div> 
			</div>
		<?php }?>                            
		<div class="jl_fe_text">    
			<?php bopea_post_list_cat(get_the_ID());?>
			<h2 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
			<?php $excp = wp_trim_words( get_the_excerpt(), 23, '...' );
			if(!empty($excp)){?>
			<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 23, '...' );?> </p>
			<?php }?>
			<?php bopea_post_meta(get_the_ID());?>                
		</div>
	</div>
</div>