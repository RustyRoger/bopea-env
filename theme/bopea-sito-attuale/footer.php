<?php
bopea_ads_above_footer();
$post_id = get_the_ID();
$footer_page = get_post_meta( $post_id, 'custom_footer_layout', true );
$footer_options = get_theme_mod('footer_layout', 'default');
if(empty($footer_page)){
	$footer = $footer_options;
}else{
	$footer = $footer_page;
}
?>
<?php if( !empty($footer) && $footer != 'default'){ ?>
  <footer id="jl-footer-custpl" class="jl_ftpls">
	<?php
  $footer_template = bopea_elementor_content( $footer );
  if ( $footer_template ) {
    echo apply_filters( 'bopea_footer_template', $footer_template );
  }?>
  </footer>
<?php }else{ ?>
<footer id="footer-container" class="jl_foot_wrap">
  <?php
  get_template_part('inc/misc/section','footermain');
  get_template_part('inc/misc/section','footersub');
  ?>
</footer>
<?php
}
bopea_ads_below_footer();
?>
<div id="go-top"><a href="#go-top"><i class="jli-up-chevron"></i></a></div>
</div>
</div>
<?php wp_footer();?>
</body>
</html>