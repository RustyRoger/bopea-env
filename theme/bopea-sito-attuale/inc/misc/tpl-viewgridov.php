<div class="jl_ov_wr">
	<div class="jl_ov_layout jl_ov_el">
					<?php if ( has_post_thumbnail()) {?>
						<div class="jl_img_holder">
							<div class="jl_imgw">
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
							</div>
						</div>
					<?php }?>
					<div class="jl_fe_text">
						<div class="jl_fe_inner">
						<?php bopea_post_ov_cat(get_the_ID());?>
						<h2 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
						<?php bopea_post_meta(get_the_ID());?>
						<a href="<?php the_permalink(); ?>" class="jl_cap_ov"></a>
						</div>
					</div>
	</div>
</div>