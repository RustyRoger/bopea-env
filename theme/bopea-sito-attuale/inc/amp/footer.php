<footer class="amp-wp-footer">
	<div>
	<a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
        <?php $amp_foot_logo = get_theme_mod('amp_foot_logo'); ?>
        <?php if (!empty($amp_foot_logo)){ ?>
			<div class="jl_logo_img">
        	<img class="jl_logo_head" src="<?php echo esc_url($amp_foot_logo); ?>" alt="<?php bloginfo('description'); ?>" />
			</div>         			
		<?php }?>                            
	</a>
	<?php echo wp_kses_post(get_theme_mod('amp_copyright')); ?>
	<div>
			<a href="#top" class="back-top"><?php esc_html_e( 'Back to top', 'bopea' ); ?></a>
		</div>
	</div>
</footer>