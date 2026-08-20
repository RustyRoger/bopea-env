<div class="jl_shead_tpl1">
    <div class="jl_shead_tpl_txt">
        <?php bopea_nav_guide();?>
        <?php bopea_post_single_cat(get_the_ID());?>
        <h1 class="jl_head_title">
            <?php the_title()?>
        </h1>
        <?php
        $post_sub_title_type = get_theme_mod('post_sub_title_type', 'jl_sub_title');
        $jl_sub_post_title = get_post_meta( get_the_ID(), 'single_post_subtitle', true );
        if($post_sub_title_type == "jl_excerpt"){
            if( has_excerpt() ){?>
                <p class="post_subtitle_text"><?php echo get_the_excerpt(); ?> </p>
            <?php }}else{ ?>
        <?php if ($jl_sub_post_title){?>
            <p class="post_subtitle_text"><?php echo get_post_meta( get_the_ID(), 'single_post_subtitle', true ); ?> </p>
        <?php }}?>
        <div class="jl_mt_wrap">
            <?php bopea_single_meta_list(get_the_ID()); ?>
            <?php bopea_sh_top(get_the_ID()); ?>
        </div>
    </div>
    <?php 
    if(has_post_format('gallery')){
        $jl_gallery_type = get_post_meta( get_the_ID(), 'jl_gallery_type', true );
        $image_gallery_val = get_post_meta( get_the_ID(), 'gallery_post_format' , true);
        $image_gallery_array = explode(',',$image_gallery_val);
        if($jl_gallery_type == "popup"){?>            
            <div class="jl_sgal_wrap">    
            <?php if ( has_post_thumbnail()) {?>
                <div class="jl_sifea_img">
                    <?php the_post_thumbnail('bopea_large');?>
                    <?php if(!empty( get_post(get_post_thumbnail_id())->post_excerpt ) ){?>
                        <div class="jl-sp-image-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
                    <?php }?>
                </div>
                <?php }                
                if( !empty($image_gallery_val) ){?>
                    <div class="jl_gals_w jl_galss">
                    <?php if(isset($image_gallery_array) && count($image_gallery_array)!= 0){
                        foreach($image_gallery_array as $gimg_id){
                            $the_image = wp_get_attachment_image_url( $gimg_id, 'bopea_large' ) ?>                                                    
                            <a class="jl_gal_img jl_gals_link" href="<?php echo esc_url($the_image);?>" title="<?php echo wp_kses_post(wp_get_attachment_caption( $gimg_id )); ?>">
                                <?php echo wp_get_attachment_image( $gimg_id, 'bopea_small', "", array( "class" => "jl_gallery_img" ) );?>
                            </a>                            
                    <?php }}?>
                    </div>
            <?php }?>
            </div>
        <?php }else{?>            
            <?php if( !empty($image_gallery_val) ){?>
                <div class="jl_slide_wrap_s hero-bg hero-bg-show jl_clear_at">
                    <div class="jl_ar_top swiper-container-wrapper jl_clear_at">
                        <div class="jl-w-slider jl_full_feature_w">
                        <div class="jl-pgal-slider swiper-container" data-swiper-options='{"slidesPerView": 1, "loop": true, "effect": "slide", "parallax": true, "navigation" : { "nextEl": ".jlc-navigation-<?php echo esc_attr(get_the_ID())?> .jl-swiper-button-next", "prevEl": ".jlc-navigation-<?php echo esc_attr(get_the_ID())?> .jl-swiper-button-prev" }, "speed": 400, "autoplay": { "delay": 5000 }}'>
                                <div class="swiper-wrapper">
                                    <?php if(isset($image_gallery_array) && count($image_gallery_array)!= 0){
                                    foreach($image_gallery_array as $gimg_id){ ?>
                                        <div class="jlc-mainslider-wrap swiper-slide">
                                            <div class="swiper-slide-inner" data-swiper-parallax="80%">
                                            <div class="jlc-mainslider-img-wrap">
                                                <?php echo wp_get_attachment_image( $gimg_id, 'bopea_large', "", array( "class" => "jl_gallery_img" ) );?>
                                            </div>
                                            <?php if(!empty( wp_kses_post(wp_get_attachment_caption( $gimg_id )) ) ){?>
                                                <div class="jl-sp-image-caption"><?php echo wp_kses_post(wp_get_attachment_caption( $gimg_id )); ?></div>
                                            <?php }?>
                                            </div>
                                        </div>
                                    <?php }}?>
                                </div>
                                <div class="jlc-navigation-<?php echo esc_attr(get_the_ID())?>"><div class="jl-swiper-button-next"><i class="jli-right-chevron"></i></div><div class="jl-swiper-button-prev"><i class="jli-left-chevron"></i></div></div>
                        </div>
                    </div>            
                </div>
            </div>  
            <?php }?>                                      
        <?php }?>
    <?php }elseif(has_post_format('quote')){?>
        <?php if( !empty( get_post_meta( get_the_ID(), 'quote_post_title', true ) ) ){?>
            <div class="jl_squote_w">
                <?php if ( has_post_thumbnail()) {?>
                    <div class="jl_imgw">
                        <div class="jl_imgin">
                            <?php the_post_thumbnail('bopea_large');?>                        
                        </div>
                    </div>
                <?php }?>
                <div class="jl_squote_in">
                    <i class="jli-quote-right" aria-hidden="true"></i>
                    <h3 class="quote_text_des">
                        <?php echo get_post_meta( get_the_ID(), 'quote_post_title', true ); ?>
                    </h3>
                    <p class="quote_source">
                        <?php echo get_post_meta( get_the_ID(), 'quote_post_author', true ); ?>
                    </p>
                </div>
            </div>
        <?php }?>
    <?php }elseif(has_post_format('video')){?>
            <?php bopea_single_video_media();?>        
    <?php }elseif(has_post_format('audio')){?>
        <?php 
        $jl_audio_type = get_post_meta( get_the_ID(), 'jl_audio_type', true );
        $audio_post_embed = get_post_meta( get_the_ID(), 'audio_post_embed', true );      
        $audio_local = get_post_meta( get_the_ID(), 'audio_local', true );
        $audio_local = wp_get_attachment_url( $audio_local );                    
        if($jl_audio_type == "audio_post_embed"){
            if(!empty($audio_post_embed)){?>
            <div class="jlvid_container">
                <?php echo get_post_meta( get_the_ID(), 'audio_post_embed', true );?>
            </div>
        <?php }}else{            
            if(!empty($audio_local)){?>
                <div class="jl_lau_w">
                    <div class="image-post-thumb jlsingle-title-above">
                        <?php if ( has_post_thumbnail()) {?>
                            <div class="jl_sifea_img">
                                <?php the_post_thumbnail('bopea_large');?>
                                <?php if(!empty( get_post(get_post_thumbnail_id())->post_excerpt ) ){?>
                                    <div class="jl-sp-image-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
                                <?php }?>
                            </div>
                        <?php }?>
                        <?php echo do_shortcode('[audio mp3="'.esc_url($audio_local).'"][/audio]');?>
                    </div>
                </div>
            <?php }}?>        
    <?php }else{?>
        <?php if ( has_post_thumbnail()) {?>
            <div class="jl_sifea_img">
                <?php the_post_thumbnail('bopea_large');?>
                <?php if(!empty( get_post(get_post_thumbnail_id())->post_excerpt ) ){?>
                    <div class="jl-sp-image-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
                <?php }?>
            </div>
        <?php }?>        
    <?php }?>
</div>