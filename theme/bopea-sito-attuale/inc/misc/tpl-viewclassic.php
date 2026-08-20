<div class="jl_lg_op jl_lg_l1">			
					<div class="jl_lg_op_in">                    					
						<?php if ( has_post_thumbnail()) {?>
						<div class="jl_img_holder">
						<div class="jl_imgw jl_radus_e">
							<div class="jl_imgin">								
								<?php
								if (!empty(get_theme_mod('jl_archive_img'))) {
									the_post_thumbnail(get_theme_mod('jl_archive_img'));
								}else{
									the_post_thumbnail('bopea_medium');
								}
								?>
							</div>
							<?php bopea_video_media(get_the_ID());?>
							<?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
							<a class="jl_imgl" href="<?php the_permalink();?>"></a>
							<?php bopea_post_tumb_cat(get_the_ID());?>
						</div>
						</div>
						<?php }?>
						<div class="jl_fe_text">
							<?php bopea_post_cat(get_the_ID());?>
							<h2 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
							<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 22, '...' );?> </p>
							<?php bopea_post_meta(get_the_ID());?>							
						</div>
					</div>			
</div>