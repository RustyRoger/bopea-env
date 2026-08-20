<amp-sidebar id="amp-sb" layout="nodisplay" side="right">
	<span on="tap:amp-sb.close" class="amp-sb-close" role="button" tabindex="2"></span>
	<ul>
		<li>
			<div class="amp-sb-logo">
			<a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
				<?php $amp_head_logo = get_theme_mod('amp_head_logo'); ?>
				<?php if (!empty($amp_head_logo)){ ?>
					<div class="jl_logo_img">
					<img class="jl_logo_head" src="<?php echo esc_url($amp_head_logo); ?>" alt="<?php bloginfo('description'); ?>" />
					</div>
				<?php }else{?>                            
					<?php echo get_bloginfo(); ?>
				<?php }?>                            
			</a>
			</div>
		</li>
		<?php
		if ( has_nav_menu( 'mobile_menu' ) ) {
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $locations[ 'mobile_menu' ] );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			if ( ! empty( $menu_items ) ) {
				foreach ( $menu_items as $key => $menu_item ) { 
					?>
					<li><a href="<?php echo esc_url( $menu_item->url ); ?>"><?php echo esc_html( $menu_item->title ); ?></a></li>
					<?php 
				}
			}
		}
		?>
	</ul>
</amp-sidebar>
<header id="top" class="amp-wp-header">
	<div class="amp-header-inner">
	<div class="amp-header-logo">
	<a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
        <?php $amp_head_logo = get_theme_mod('amp_head_logo'); ?>
        <?php if (!empty($amp_head_logo)){ ?>
			<div class="jl_logo_img">
        	<img class="jl_logo_head" src="<?php echo esc_url($amp_head_logo); ?>" alt="<?php bloginfo('description'); ?>" />
			</div>
		<?php }else{?>                            
			<?php echo get_bloginfo(); ?>
		<?php }?>                            
	</a>
	</div>
	<div class="header-right" on='tap:amp-sb.toggle' role="button" tabindex="1">
		<span class="amp-sb-open"></span>		
	</div>
	</div>
</header>