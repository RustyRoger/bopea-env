<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
   <html <?php language_attributes(); ?>>
      <head>
         <meta charset="<?php bloginfo( 'charset' ); ?>">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="profile" href="https://gmpg.org/xfn/11">
         <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
         <?php wp_head(); ?>         
      </head>
      <body <?php body_class();?>>
        <?php wp_body_open();
        $jl_header_tp =  get_post_meta( get_the_ID(), 'jl_header_tp', true );
        if($jl_header_tp){ $jl_header_tp = 'tp_head_on';}else{$jl_header_tp = 'tp_head_off';}
        ?>
         <div class="options_layout_wrapper jl_clear_at">
         <div class="options_layout_container <?php echo esc_attr($jl_header_tp);?>">
         <?php
         bopea_ads_above_head();
         get_template_part('inc/misc/header','layout');
         bopea_ads_below_head();
         ?>