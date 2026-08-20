<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bopea_ads_above_head' ) ) {
    function bopea_ads_above_head() {
        $bopea_ads_head_above = get_theme_mod('bopea_ads_head_above');
        $home_hide_head_above = get_theme_mod('home_hide_head_above');
        $archives_hide_head_above = get_theme_mod('archives_hide_head_above');
        $pages_hide_head_above = get_theme_mod('pages_hide_head_above');
        $posts_hide_head_above = get_theme_mod('posts_hide_head_above');                        
        if(empty($bopea_ads_head_above)){
            return;
        }
        if(!empty(get_theme_mod('posts_dhide_head_above'))){
            $atts_style[] = 'jl-h-d';
        }
        if(!empty(get_theme_mod('posts_thide_head_above'))){
            $atts_style[] = 'jl-h-t';
        }
        if(!empty(get_theme_mod('posts_mhide_head_above'))){
            $atts_style[] = 'jl-h-m';
        }
        $atts_style[] = 'jl_ads_wrap_sec jl_head_adsab';
        $atts_style = implode( ' ', $atts_style );
        echo '<div class="'.esc_attr( $atts_style ).'">';
        if ( is_category() ) {
            if(empty($archives_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
		} elseif ( is_tag() ) {
            if(empty($archives_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
		} elseif ( is_search() ) {   
            if(empty($archives_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        } elseif ( is_author() ) {
            if(empty($archives_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        } elseif ( is_front_page() ) {
            if(empty($home_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        } elseif ( is_single() ) {
            if(empty($posts_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        } elseif ( is_page() ) {
            if(empty($pages_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        } elseif ( is_page_template() ) {
            if(empty($pages_hide_head_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_above));
            }
        }        
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_below_head' ) ) {
    function bopea_ads_below_head() {
        $bopea_ads_head_below = get_theme_mod('bopea_ads_head_below');
        $home_hide_head_below = get_theme_mod('home_hide_head_below');
        $archives_hide_head_below = get_theme_mod('archives_hide_head_below');
        $pages_hide_head_below = get_theme_mod('pages_hide_head_below');
        $posts_hide_head_below = get_theme_mod('posts_hide_head_below');                        
        if(empty($bopea_ads_head_below)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_head_adsbl">';
        if ( is_category() ) {
            if(empty($archives_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
		} elseif ( is_tag() ) {
            if(empty($archives_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
		} elseif ( is_search() ) {   
            if(empty($archives_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        } elseif ( is_author() ) {
            if(empty($archives_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        } elseif ( is_front_page() ) {
            if(empty($home_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        } elseif ( is_single() ) {
            if(empty($posts_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        } elseif ( is_page() ) {
            if(empty($pages_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        } elseif ( is_page_template() ) {
            if(empty($pages_hide_head_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_head_below));
            }
        }        
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_above_footer' ) ) {
    function bopea_ads_above_footer() {
        $bopea_ads_footer_above = get_theme_mod('bopea_ads_footer_above');
        $home_hide_footer_above = get_theme_mod('home_hide_footer_above');
        $archives_hide_footer_above = get_theme_mod('archives_hide_footer_above');
        $pages_hide_footer_above = get_theme_mod('pages_hide_footer_above');
        $posts_hide_footer_above = get_theme_mod('posts_hide_footer_above');                        
        if(empty($bopea_ads_footer_above)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_foot_adsab">';
        if ( is_category() ) {
            if(empty($archives_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
		} elseif ( is_tag() ) {
            if(empty($archives_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
		} elseif ( is_search() ) {   
            if(empty($archives_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        } elseif ( is_author() ) {
            if(empty($archives_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        } elseif ( is_front_page() ) {
            if(empty($home_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        } elseif ( is_single() ) {
            if(empty($posts_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        } elseif ( is_page() ) {
            if(empty($pages_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        } elseif ( is_page_template() ) {
            if(empty($pages_hide_footer_above)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_above));
            }
        }        
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_below_footer' ) ) {
    function bopea_ads_below_footer() {
        $bopea_ads_footer_below = get_theme_mod('bopea_ads_footer_below');
        $home_hide_footer_below = get_theme_mod('home_hide_footer_below');
        $archives_hide_footer_below = get_theme_mod('archives_hide_footer_below');
        $pages_hide_footer_below = get_theme_mod('pages_hide_footer_below');
        $posts_hide_footer_below = get_theme_mod('posts_hide_footer_below');                        
        if(empty($bopea_ads_footer_below)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_foot_adsbl">';
        if ( is_category() ) {
            if(empty($archives_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
		} elseif ( is_tag() ) {
            if(empty($archives_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
		} elseif ( is_search() ) {   
            if(empty($archives_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        } elseif ( is_author() ) {
            if(empty($archives_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        } elseif ( is_front_page() ) {
            if(empty($home_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        } elseif ( is_single() ) {
            if(empty($posts_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        } elseif ( is_page() ) {
            if(empty($pages_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        } elseif ( is_page_template() ) {
            if(empty($pages_hide_footer_below)){            
                echo do_shortcode(wp_kses_post($bopea_ads_footer_below));
            }
        }        
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_content_above' ) ) {
    function bopea_ads_content_above() {    
        $bopea_ads_single_content_above = get_theme_mod('bopea_ads_single_content_above');        
        if(empty($bopea_ads_single_content_above)){
            return;
        }                            
        echo '<div class="jl_ads_wrap_sec jl_con_adsab">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_content_above));
        echo '</div>';    
    }
}

if ( ! function_exists( 'bopea_ads_content_below' ) ) {
    function bopea_ads_content_below() {
        $bopea_ads_single_content_below = get_theme_mod('bopea_ads_single_content_below');        
        if(empty($bopea_ads_single_content_below)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_con_adsbl">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_content_below));
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_content_above_author' ) ) {
    function bopea_ads_content_above_author() {
        $bopea_ads_single_author_above = get_theme_mod('bopea_ads_single_author_above');        
        if(empty($bopea_ads_single_author_above)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_auth_adsab">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_author_above));
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_content_author' ) ) {
    function bopea_ads_content_author() {
        $bopea_ads_single_author_below = get_theme_mod('bopea_ads_single_author_below');        
        if(empty($bopea_ads_single_author_below)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_auth_adsbl">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_author_below));
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_related_above' ) ) {
    function bopea_ads_related_above() {
        $bopea_ads_single_related_above = get_theme_mod('bopea_ads_single_related_above');        
        if(empty($bopea_ads_single_related_above)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_rel_adsab">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_related_above));
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_ads_related_below' ) ) {
    function bopea_ads_related_below() {
        $bopea_ads_single_related_below = get_theme_mod('bopea_ads_single_related_below');        
        if(empty($bopea_ads_single_related_below)){
            return;
        }
        echo '<div class="jl_ads_wrap_sec jl_rel_adsbl">';
            echo do_shortcode(wp_kses_post($bopea_ads_single_related_below));
        echo '</div>';
    }
}

if ( ! function_exists( 'bopea_found_post' ) ) {
    function bopea_found_post() {
        global $wp_query;
		$found_posts = $wp_query->found_posts;
        if ( $found_posts > 0 ) {?>            
            <span class="jl_auth_numw">
                <span class="jl_auth_num h1"><?php echo esc_attr($found_posts);?></span>
                <span class="jl_auth_txt"><?php echo bopeatxt::bopea_s_articles(); ?></span>
            </span>
        <?php }
    }
}

if ( ! function_exists( 'bopea_archive_head' ) ) {
    function bopea_archive_head() {
        if ( is_category() ) {
            echo '<div class="jl_ache_head">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			echo single_cat_title( '', false );
            echo '</h1>';
            if ( get_the_archive_description() ) {
                echo '<div class="post_subtitle_text">';
                the_archive_description(); 
                echo '</div>';
            }
            echo '</div>';
            bopea_found_post();
            echo '</div>';
		} elseif ( is_tag() ) {
            echo '<div class="jl_ache_head">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			echo single_tag_title( '', false );
            echo '</h1>';
            if ( get_the_archive_description() ) {
                echo '<div class="post_subtitle_text">';
                the_archive_description(); 
                echo '</div>';
            }
            echo '</div>';
            bopea_found_post();
            echo '</div>';
		} elseif ( is_search() ) {   
            echo '<div class="jl_ache_head">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			echo bopeatxt::bopea_s_search_result_for();            
            the_search_query();
            echo '</h1>';            
            echo '</div>';
            bopea_found_post();
            echo '</div>';
        } elseif ( is_tax() ) {
            echo '<div class="jl_ache_head">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			echo single_term_title( '', false );
            echo '</h1>';
            if ( term_description() ) {
            echo '<div class="post_subtitle_text">';
            echo term_description();
            echo '</div>';
            }
            echo '</div>';
            bopea_found_post();
            echo '</div>';
        } elseif ( is_post_type_archive() ) {
            echo '<div class="post_subtitle_text">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			post_type_archive_title( '', false );
            echo '</h1>';
            echo '</div>';
            bopea_found_post();
            echo '</div>';
        } elseif ( is_author() ) {?>
            <div class="jl_ache_auth jl_sep_dot jl_sep_b">
                <div class="author-info jl_auth_head jl_info_auth">
                    <div class="author-avatar">
                        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                            <?php echo get_avatar(get_the_author_meta('user_email'), 165); ?>
                        </a>
                    </div>
                    <div class="author-description">
                        <div class="jl_auth_lbl"><?php echo bopeatxt::bopea_s_written_by(); ?></div>
                        <h1 class="jl_auth_name jl_fe_title"><a itemprop="author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                        <?php if(function_exists('bopea_author_share_link')){?><span><?php if (!empty(get_the_author_meta('positions'))){echo '- '.esc_attr(get_the_author_meta('positions'));}?></span><?php }?></h1>
                            <?php if(!empty(get_the_author_meta('description'))){?>
                            <p class="jl_auth_desc">
                            <?php echo get_the_author_meta('description'); ?>
                            </p>
                            <?php }?>
                            <?php if(function_exists('bopea_author_contact')){echo bopea_author_contact(get_the_ID());}?>
                            <?php if(function_exists('bopea_author_share_link')){bopea_author_share_link(get_the_ID());}?>                            
                    </div>
                </div>
                <span class="jl_auth_numw">
                <span class="jl_auth_num h1"><?php echo count_user_posts( get_the_author_meta('ID') );?></span>
                <span class="jl_auth_txt"><?php echo bopeatxt::bopea_s_articles(); ?></span>
                </span>
            </div>
        <?php } elseif ( is_home() ) {
        }else{
            echo '<div class="post_subtitle_text">';
            echo '<div class="jl_pc_sec_title">';
            echo '<h1 class="jl_pc_sec_h">';
			echo get_the_archive_title();
            echo '</h1>';            
            echo '</div>';
            bopea_found_post();
            echo '</div>';
        }        
    }
}

if ( ! function_exists( 'bopea_is_amp' ) ) {
	function bopea_is_amp() {
		return function_exists( 'amp_is_request' ) && amp_is_request();
	}
}

if ( ! function_exists( 'bopea_elementor_content' ) ) {
	function bopea_elementor_content( $post_id ) {
		if ( ! class_exists('Elementor\Plugin') || bopea_is_amp() ){
	        return;
	    }

		$pluginElementor = \Elementor\Plugin::instance();
	    $response = $pluginElementor->frontend->get_builder_content_for_display($post_id);

	    return $response;
	}
}

if ( ! function_exists( 'bopea_search_tpl_view' ) ) {
	function  bopea_search_tpl_view() { ?>
        <div class="jl_cslist_layout jl_lisep">
            <div class="jl_li_in">
                    <?php if ( has_post_thumbnail()) { ?>
                        <div class="jl_img_holder">
                            <div class="jl_imgw jl_radus_e">
                                <div class="jl_imgin">
                                    <?php the_post_thumbnail('bopea_small');?>
                                </div>
                                <a class="jl_imgl" aria-label="<?php the_title(); ?>" href="<?php the_permalink(); ?>"></a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="jl_fe_text">
                        <h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php bopea_post_meta_date(get_the_ID()); ?>
                    </div>
            </div>
        </div>
<?php }
}
add_action( 'wp_ajax_nopriv_bopea_search_view', 'bopea_search_view' );
add_action( 'wp_ajax_bopea_search_view', 'bopea_search_view' );
if ( ! function_exists( 'bopea_search_view' ) ) {
	function  bopea_search_view() {
		if ( empty( $_POST['s'] ) ) {			
            wp_send_json( '' );
			wp_die();
		}
		$input = bopea_module_opt( $_POST['s'] );        
		$params = array(
			's'              => $input,
			'post_status'    => 'publish',
			'posts_per_page' => 5
		);
		$params['post_type'] = array( 'post');
		$query_data = new WP_Query( $params );
        if(empty(get_theme_mod('jl_opt_lazy_img', false))){
            if(function_exists('bopea_e_template')){
                add_filter( 'wp_get_attachment_image_attributes', 'bopea_lsmall_img', 10, 3 );
            }
        }
		ob_start();
		$response .= '<div class="jl_search_wrap_li">';
			if ( $query_data->have_posts() ) {
				$response .= '<div class="jl_grid_wrap_f jl_wrap_eb jl_sf_grid jl_clear_at">';
					while ( $query_data->have_posts() ) {
						$query_data->the_post();
						bopea_search_tpl_view();
		            } wp_reset_postdata();                    
            $response .= ob_get_clean();
            $response .= '</div>';
            }else{
				$response .= '<p class="jl_shnone">'.bopeatxt::bopea_s_404_title().'</p>';
            }
            $response .= '</div>';		
		wp_send_json( $response );        
	}
}

if ( ! function_exists( 'bopea_archive_opt_sidebar' ) ) {
    function bopea_archive_opt_sidebar() {
        if ( is_category() ) {
            bopea_category_sidebar();
          }
          if ( is_tag() ) {
            bopea_tag_sidebar();
          }
          if ( is_search() ) {
            bopea_search_sidebar();
          }
          if ( is_tax() ) {
            bopea_archive_sidebar();
          }
          if ( is_date() ) {
            bopea_archive_sidebar();
          }          
          if ( is_post_type_archive() ) {
            bopea_archive_sidebar();
          }
          if ( is_author() ) {
            bopea_author_sidebar();
          }
          if ( is_home() ) {
            bopea_archive_sidebar();
          }
    }
}
if ( ! function_exists( 'bopea_nav_guide' ) ) {
    function bopea_nav_guide() {

        if(!empty(get_theme_mod('hide_breadcrumb', true))){
            return;
        }

        if ( apply_filters( 'bopea_use_yoast_breadcrumbs', '' ) == true ) {
            if ( function_exists( 'yoast_breadcrumb' ) ) {
                $nav_3th = 'jl_breadcrumbs';			
                yoast_breadcrumb( '<div class="' . $nav_3th . '">', '</div>' );
            }
            return;
        }
        if ( apply_filters( 'bopea_use_rankmath_breadcrumbs', '' ) == true ) {
            if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
                $rank_math_class = 'jl_breadcrumbs';			
                $args = array(
                    'wrap_before' => '<div class="' . $rank_math_class . '">',
                    'wrap_after'  => '</div>',
                    'before'      => '',
                    'after'       => '',
                );
                echo rank_math_get_breadcrumbs( $args );
            }
            return;
        }
        if ( !empty(get_theme_mod( 'hide_breadcrumb', true )) || is_front_page() || class_exists( 'bbPress' ) && is_bbpress() ) {
            return;
        }
        $nav_gopt     = array();
        $i          = 1;
        $main_guide = array(
            bopeatxt::bopea_s_home() => get_home_url(),
        );
        $nav_filter = apply_filters( 'bopea_breadcrumbs_extension', '' );
        $guid_id    = ! empty( $_GET['ipl'] ) && ! empty( $_GET['pid'] ) ? $_GET['pid'] : '';
        if ( ! empty( $nav_filter ) ) {
            $nav_gopt = $main_guide;
            $nav_gopt = array_merge( $nav_gopt, $nav_filter );
        } elseif ( is_date() ) {
            $nav_gopt    = $main_guide;
            $year      = get_the_time( 'Y' );
            $month     = get_the_time( 'm' );
            $day       = get_the_time( 'd' );
            $month_url = get_month_link( $year, $month );
            $year_url  = get_year_link( $year );
            if ( is_day() ) {
                $nav_gopt[ $year ]  = $year_url;
                $nav_gopt[ $month ] = $month_url;
                $nav_gopt[ $day ]   = '';
            } elseif ( is_month() ) {
                $nav_gopt[ $year ]  = $year_url;
                $nav_gopt[ $month ] = '';
            } elseif ( is_year() ) {
                $nav_gopt[ $year ] = '';
            }
        } elseif ( bopea_check_woo() ) {
            $nav_gopt = $main_guide;
            $nav_gopt[ bopeatxt::bopea_s_shop() ] = '';
        } elseif ( is_archive() ) {
            $nav_gopt = $main_guide;

            $term = get_queried_object();
            if ( ! $term ) {
                return;
            }
            if ( is_category() || is_tax() ) {
                $current_crumb = bopea_cats( $term->term_id, $term->taxonomy );
                $nav_gopt        = $nav_gopt + $current_crumb;
            } elseif ( is_tag() ) {
                $nav_gopt[ single_tag_title( '', false ) ] = '';
            } elseif ( is_author() ) {
                $nav_gopt[ $term->data->display_name ] = '';
            }
        } elseif ( is_single() || ! empty( $guid_id ) ) {
            $nav_gopt = $main_guide;
            if ( ! empty( $guid_id ) ) {
                $post = get_post( $guid_id );
            } else {
                global $post;
            }
            if ( 'product' == $post->post_type && function_exists( 'wc_get_product_terms' ) ) {
                $terms = wc_get_product_terms(
                    $post->ID,
                    'product_cat',
                    array(
                        'orderby' => 'parent',
                        'order'   => 'DESC',
                    )
                );
                if ( ! empty( $terms ) ) {
                    $main_term     = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $current_crumb = bopea_cats( $main_term->term_id, 'product_cat' );
                    $nav_gopt        = array_merge( $nav_gopt, $current_crumb );
                }
            } else {
                $cats = get_the_category( $post->ID );
                if ( ! empty( $cats ) ) {
                    $current_crumb = bopea_cats( $cats[0]->term_id );
                    $nav_gopt = is_array( $current_crumb ) ? array_merge( $nav_gopt, $current_crumb ) : $nav_gopt;
                }
            }
            $nav_gopt[ get_the_title( $post->ID ) ] = '';		
        } elseif ( is_page() ) {
            $nav_gopt = $main_guide;
            global $post;
            $ancestors = get_post_ancestors( $post );
            if ( ! empty( $ancestors ) ) {
                $nav_gopt[ get_the_title( $ancestors[0] ) ] = get_permalink( $ancestors[0] );
            }
            $nav_gopt[ get_the_title( $post->ID ) ] = '';
        } elseif ( is_search() ) {
            $nav_gopt                       = $main_guide;
            $nav_gopt[ get_search_query() ] = '';
        }
        if ( empty( $nav_gopt ) ) { return; }	
        echo '<div class="jl_breadcrumbs">';
        foreach ( $nav_gopt as $key => $value ) { ?>
            <?php if ( 1 != $i ) {?>
            <i class="jli-right-chevron"></i>
            <?php } ?>
            <span class="jl_item_bread">
                <?php if ( ! empty( $value ) ) { ?>
                    <a href="<?php echo esc_url( $value ); ?>">
                <?php } ?>
                <?php echo wp_kses_post( $key ); ?>
                <?php if ( ! empty( $value ) ) { ?>
                    </a>
                <?php } ?>
            </span>
            <?php $i++; ?>
        <?php } ?>
        </div>
    <?php }
}
if ( ! function_exists( 'bopea_cats' ) ) {
    function bopea_cats( $id, $term_cat = 'category', $active = array() ) {
        $cat_term  = array();
        $main_term = get_term( $id, $term_cat );
        if ( empty( $main_term ) || is_wp_error( $main_term ) ) {
            return $main_term;
        }
        $name = $main_term->name;
        if ( $main_term->parent && $main_term->parent != $main_term->term_id && ! in_array( $main_term->parent, $active ) ) {
            $active[]    = $main_term->parent;
            $main_term_chain = bopea_cats( $main_term->parent, $term_cat, $active );
            $cat_term = $cat_term + $main_term_chain;
        }
        $cat_term[ $main_term->name ] = get_term_link( $main_term->term_id, $term_cat );
        return $cat_term;
    }
}
if ( ! function_exists( 'bopea_active_woo' ) ) {
    function bopea_active_woo() {
        if ( class_exists( 'woocommerce' ) ) {
            return true;
        } else {
            return false;
        }
    }
}
if ( ! function_exists( 'bopea_check_woo' ) ) {
    function bopea_check_woo() {
        if ( bopea_active_woo() && is_shop() ) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists( 'bopea_sponsored' ) ) {
    function bopea_sponsored() {
        $enable_sponsored_post = get_post_meta( get_the_ID(), 'enable_sponsored_post', true );
        $sponsored_post_url = get_post_meta( get_the_ID(), 'sponsored_post_url', true );
        $sponsored_logo = get_post_meta( get_the_ID(), 'sponsored_logo', true );        
        if(!empty($enable_sponsored_post)){
            echo '<span class="jl_spon_wrap">';
            echo '<span class="jl_spon_lbl">';
            echo bopeatxt::bopea_s_sponsored_by();
            echo '</span>';
            if(!empty($sponsored_post_url)){
                echo '<a href="'.esc_url($sponsored_post_url).'" target="_blank" rel="nofollow">';
            }
            if(!empty($sponsored_logo)){
                echo wp_get_attachment_image( $sponsored_logo, 'bopea_large', true );
            }
            if(!empty($sponsored_post_url)){
                echo '</a>';
            }
            echo '</span>';
        }        
    }
}

if ( ! function_exists( 'bopea_video_media' ) ) {
  function bopea_video_media() {
    if(has_post_format( 'video')){
        $jl_video_style = get_post_meta( get_the_ID(), 'jl_video_style', true );
        $jl_video_style_opt = get_theme_mod('jl_video_style', 'background');
        $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
        $video_post_embed = get_post_meta( get_the_ID(), 'video_post_embed', true );
        $video_local = get_post_meta( get_the_ID(), 'video_local', true );
        $attach_vid = wp_get_attachment_url( $video_local );
        if(empty($jl_video_style)) {
            $jl_video_layout = $jl_video_style_opt;
        } else {
            $jl_video_layout = $jl_video_style;
        }
        if ($jl_video_layout == 'popup') {
          if ($jl_vid_type == 'video_post_embed') {?>
            <span class="jl_vid_mp jl_livid">
                <span class="jl_vid_mpin">
                  <?php if(!empty($video_post_embed)){?>
                  <a class="jl_pop_vid" aria-label="<?php esc_html_e('Video', 'bopea');?>" data-gallery="<?php echo esc_attr(get_the_ID()); ?>" href="<?php echo esc_url($video_post_embed);?>"></a>
                  <?php }?>
                    <i class="jli-playbtn"></i>
                </span>
            </span>
          <?php }else{?>
            <span class="jl_vid_mp jl_livid">
                <span class="jl_vid_mpin">
                  <?php if(!empty($attach_vid)){?>
                  <a class="jl_pop_vid" aria-label="<?php esc_html_e('Video', 'bopea');?>" data-gallery="<?php echo esc_attr(get_the_ID()); ?>" href="<?php echo esc_url($attach_vid);?>"></a>
                  <?php }?>  
                  <i class="jli-playbtn"></i>
                </span>
            </span>
        <?php }
        }else{
            if ($jl_vid_type == 'video_post_embed') {
                if ( strpos( $video_post_embed, 'yout' ) !== false ) {
                    $type = 'yt';
                } elseif( strpos( $video_post_embed, 'vim' ) !== false ) {
                    $type = 'vim';
                } elseif ( strpos( $video_post_embed, 'dailymotion' ) !== false ) {
                    $type = 'daily';
                } else {
                    $type = '';
                }

                switch ( $type ) {
                    case 'vim':
                        $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                            $vid_args['autoplay']   = 1;
                            $vid_args['muted']      = 1;
                            $vid_args['loop']       = 1;
                            $vid_args['portrait']   = 0;
                            $vid_args['byline']     = 0;
                            $vid_args['dnt']        = 0;
                            $vid_args['background'] = 1;
                            $vid_args['title']      = 1;
                        $vid_url = add_query_arg($vid_args, 'https://player.vimeo.com/video/' . $video_post_embed);
                    break;
                    case 'daily':
                        $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                            $vid_args['autoplay']   = 1;
                            $vid_args['muted']      = 1;
                            $vid_args['loop']       = 1;
                        $vid_url = add_query_arg($vid_args, '"https://www.dailymotion.com/embed/' . $video_post_embed);
                    break;
                    case 'yt':
                        preg_match( '([-\w]{11})', $video_post_embed, $matches );
                        if ( ! empty( $matches ) ) {
                                $vid_args['autoplay']       = 1;
                                $vid_args['mute']           = 1;
                                $vid_args['loop']           = 1;
                                $vid_args['rel']            = 0;                                
                                $vid_args['playsinline']    = 1;
                                $vid_args['showinfo']       = 0;
                                $vid_args['modestbranding'] = 1;
                                $vid_args['controls']       = 0;
                                $vid_args['fs']             = 0;
                                $vid_args['iv_load_policy'] = 3;                                
                                $vid_args['playlist']       = $matches[0];
                            $vid_url = add_query_arg( $vid_args, 'https://www.youtube-nocookie.com/embed/' . $matches[0] );
                        }
                        break;
                }
                    if (!empty($vid_url)){
                    echo '<div class="video-wrap overlay-media"><iframe class="frame jl_fm_vid_load" title="media" src="about:blank" data-lazy-src="' . esc_url( $vid_url ) . '" frameborder="0" seamless="seamless" allowfullscreen></iframe></div>';
                    }
            }else{
                echo '<div class="video-wrap overlay-media"><video autoplay="autoplay" loop="loop" muted="muted" playsinline><source src="'.esc_url( $attach_vid ).'" type="video/mp4"></video></div>';
            }
        }
      }
  }
}

if ( ! function_exists( 'bopea_video_sg_pop' ) ) {
    function bopea_video_sg_pop() {
        if(has_post_format( 'video')){
            $jl_sg_video_style = get_post_meta( get_the_ID(), 'jl_sg_video_style', true );
            $jl_sg_video_style_opt = get_theme_mod('jl_sg_video_style', 'background');
            $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
            $video_post_embed = get_post_meta( get_the_ID(), 'video_post_embed', true );
            $video_local = get_post_meta( get_the_ID(), 'video_local', true );
            $attach_vid = wp_get_attachment_url( $video_local );
            if(empty($jl_sg_video_style)) {
                $jl_sg_video_layout = $jl_sg_video_style_opt;
            } else {
                $jl_sg_video_layout = $jl_sg_video_style;
            }
            if ($jl_sg_video_layout == 'popup') {                    
                if ($jl_vid_type == 'video_post_embed') {?>
                    <span class="jl_vid_mp jl_livid sgvpop">
                        <span class="jl_vid_mpin">
                          <?php if(!empty($video_post_embed)){?>
                          <a class="jl_pop_vid" aria-label="<?php esc_html_e('Video', 'bopea');?>" data-gallery="<?php echo esc_attr(get_the_ID()); ?>" href="<?php echo esc_url($video_post_embed);?>"></a>
                          <?php }?>
                            <i class="jli-playbtn"></i>
                        </span>
                    </span>
                  <?php }else{?>
                    <span class="jl_vid_mp jl_livid sgvpop">
                        <span class="jl_vid_mpin">
                          <?php if(!empty($attach_vid)){?>
                          <a class="jl_pop_vid" aria-label="<?php esc_html_e('Video', 'bopea');?>" data-gallery="<?php echo esc_attr(get_the_ID()); ?>" href="<?php echo esc_url($attach_vid);?>"></a>
                          <?php }?>  
                          <i class="jli-playbtn"></i>
                        </span>
                    </span>
                <?php }
            }
        }
    }
}

if ( ! function_exists( 'bopea_video_bg' ) ) {
    function bopea_video_bg() {
      if(has_post_format( 'video')){
            $jl_sg_video_style = get_post_meta( get_the_ID(), 'jl_sg_video_style', true );
            $jl_sg_video_style_opt = get_theme_mod('jl_sg_video_style', 'background');
            $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
            $video_post_embed = get_post_meta( get_the_ID(), 'video_post_embed', true );
            $video_local = get_post_meta( get_the_ID(), 'video_local', true );
            $attach_vid = wp_get_attachment_url( $video_local );          
            if(empty($jl_sg_video_style)) {
                $jl_sg_video_layout = $jl_sg_video_style_opt;
            } else {
                $jl_sg_video_layout = $jl_sg_video_style;
            }
            if ($jl_sg_video_layout == 'background') {
              if ($jl_vid_type == 'video_post_embed') {
                  if ( strpos( $video_post_embed, 'yout' ) !== false ) {
                      $type = 'yt';
                  } elseif( strpos( $video_post_embed, 'vim' ) !== false ) {
                      $type = 'vim';
                  } elseif ( strpos( $video_post_embed, 'dailymotion' ) !== false ) {
                      $type = 'daily';
                  } else {
                      $type = '';
                  }
  
                  switch ( $type ) {
                      case 'vim':
                          $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                              $vid_args['autoplay']   = 1;
                              $vid_args['muted']      = 1;
                              $vid_args['loop']       = 1;
                              $vid_args['portrait']   = 0;
                              $vid_args['byline']     = 0;
                              $vid_args['dnt']        = 0;
                              $vid_args['background'] = 1;
                              $vid_args['title']      = 1;
                          $vid_url = add_query_arg($vid_args, 'https://player.vimeo.com/video/' . $video_post_embed);
                      break;
                      case 'daily':
                          $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                              $vid_args['autoplay']   = 1;
                              $vid_args['muted']      = 1;
                              $vid_args['loop']       = 1;
                          $vid_url = add_query_arg($vid_args, '"https://www.dailymotion.com/embed/' . $video_post_embed);
                      break;
                      case 'yt':
                          preg_match( '([-\w]{11})', $video_post_embed, $matches );
                          if ( ! empty( $matches ) ) {
                                  $vid_args['autoplay']       = 1;
                                  $vid_args['mute']           = 1;
                                  $vid_args['loop']           = 1;
                                  $vid_args['rel']            = 0;                                
                                  $vid_args['playsinline']    = 1;
                                  $vid_args['showinfo']       = 0;
                                  $vid_args['modestbranding'] = 1;
                                  $vid_args['controls']       = 0;
                                  $vid_args['fs']             = 0;
                                  $vid_args['iv_load_policy'] = 3;                                
                                  $vid_args['playlist']       = $matches[0];
                              $vid_url = add_query_arg( $vid_args, 'https://www.youtube-nocookie.com/embed/' . $matches[0] );
                          }
                          break;
                  }
                      if (!empty($vid_url)){
                      echo '<div class="video-wrap overlay-media"><iframe class="frame jl_fm_vid_load" title="media" src="about:blank" data-lazy-src="' . esc_url( $vid_url ) . '" frameborder="0" seamless="seamless" allowfullscreen></iframe></div>';
                      }
              }else{
                  echo '<div class="video-wrap overlay-media"><video autoplay="autoplay" loop="loop" muted="muted" playsinline><source src="'.esc_url( $attach_vid ).'" type="video/mp4"></video></div>';
              }
            }          
        }
    }
  }

if ( ! function_exists( 'bopea_media_url' ) ) {
  function bopea_media_url() {
    if(has_post_format( 'video')){
        $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
        $video_post_embed = get_post_meta( get_the_ID(), 'video_post_embed', true );
        $video_local = get_post_meta( get_the_ID(), 'video_local', true );
        $attach_vid = wp_get_attachment_url( $video_local );
        if ($jl_vid_type == 'video_post_embed') {
            if ( strpos( $video_post_embed, 'yout' ) !== false ) {
                $type = 'yt';
            } elseif( strpos( $video_post_embed, 'vim' ) !== false ) {
                $type = 'vim';
            } elseif ( strpos( $video_post_embed, 'dailymotion' ) !== false ) {
                $type = 'daily';
            } else {
                $type = '';
            }

            switch ( $type ) {
                case 'vim':
                    $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                        $vid_args['autoplay']   = 1;
                    $vid_url = add_query_arg($vid_args, 'https://player.vimeo.com/video/' . $video_post_embed);
                break;
                case 'daily':
                    $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                        $vid_args['autoplay']   = 1;
                    $vid_url = add_query_arg($vid_args, '"https://www.dailymotion.com/embed/' . $video_post_embed);
                break;
                case 'yt':
                    preg_match( '([-\w]{11})', $video_post_embed, $matches );
                    if ( ! empty( $matches ) ) {
                            $vid_args['autoplay']       = 1;
                            $vid_args['mute']           = 0;
                            $vid_args['rel']            = 1;
                            $vid_args['modestbranding'] = 1;
                            $vid_args['controls']       = 1;
                            $vid_args['loop']           = 0;
                            $vid_args['playsinline']    = 1;
                            $vid_args['showinfo']       = 1;
                            $vid_args['fs']             = 1;
                            $vid_args['iv_load_policy'] = 3;
                            // $vid_args['playlist']       = $matches[0];
                        $vid_url = add_query_arg( $vid_args, 'https://www.youtube-nocookie.com/embed/' . $matches[0] );
                    }
                    break;
            }
                if (!empty($vid_url)){
                echo esc_url( $vid_url );
                }
        }else{
            echo esc_url( $attach_vid );
        }
      }
  }
}

if ( ! function_exists( 'bopea_media_type' ) ) {
  function bopea_media_type() {
    if(has_post_format( 'video')){
      $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
      if ($jl_vid_type == 'video_post_embed') {
        echo esc_attr('embedvid');
      }else{
        echo esc_attr('localvid');
      }
      }
  }
}

if ( ! function_exists( 'bopea_single_video_media' ) ) {
    function bopea_single_video_media() {
      if(has_post_format( 'video')){
          $jl_vid_type = get_post_meta( get_the_ID(), 'jl_vid_type', true );
          $video_post_embed = get_post_meta( get_the_ID(), 'video_post_embed', true );
          $video_local = get_post_meta( get_the_ID(), 'video_local', true );
          $attach_vid = wp_get_attachment_url( $video_local );                    
              if ($jl_vid_type == 'video_post_embed') {
                  if ( strpos( $video_post_embed, 'yout' ) !== false ) {
                      $type = 'yt';
                  } elseif( strpos( $video_post_embed, 'vim' ) !== false ) {
                      $type = 'vim';
                  } elseif ( strpos( $video_post_embed, 'dailymotion' ) !== false ) {
                      $type = 'daily';
                  } else {
                      $type = '';
                  }
  
                  switch ( $type ) {
                      case 'vim':
                          $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                              $vid_args['autoplay']   = 0;                              
                          $vid_url = add_query_arg($vid_args, 'https://player.vimeo.com/video/' . $video_post_embed);
                      break;
                      case 'daily':
                          $video_post_embed = substr( wp_parse_url( $video_post_embed, PHP_URL_PATH ), 1 );
                              $vid_args['autoplay']   = 0;
                              $vid_args['muted']      = 0;
                              $vid_args['loop']       = 0;
                          $vid_url = add_query_arg($vid_args, '"https://www.dailymotion.com/embed/' . $video_post_embed);
                      break;
                      case 'yt':
                          preg_match( '([-\w]{11})', $video_post_embed, $matches );
                          if ( ! empty( $matches ) ) {
                                  $vid_args['autoplay']       = 0;
                                  $vid_args['mute']           = 0;
                                  $vid_args['rel']            = 0;
                                  $vid_args['modestbranding'] = 1;
                                  $vid_args['controls']       = 1;
                                  $vid_args['loop']           = 0;
                                  $vid_args['playsinline']    = 1;
                                  $vid_args['showinfo']       = 1;
                                  $vid_args['fs']             = 1;
                                  $vid_args['iv_load_policy'] = 3;
                                //   $vid_args['playlist']       = $matches[0];
                              $vid_url = add_query_arg( $vid_args, 'https://www.youtube-nocookie.com/embed/' . $matches[0] );
                          }
                          break;
                  }
                      if (!empty($vid_url)){
                      echo '<div class="jlvid_container"><iframe title="media" src="' . esc_url( $vid_url ) . '" frameborder="0" seamless="seamless" allowfullscreen></iframe></div>';
                      }
              }else{                  
                  echo '<div class="jlvid_local">'.do_shortcode('[video src="'.esc_url($attach_vid).'"][/video]').'</div>';
              }
        }
    }
  }

if ( ! function_exists( 'bopea_button_txt' ) ) {
    function bopea_button_txt() {
        $btn_txt = get_theme_mod( 'btn_txt', 'Continue Reading' );
        if ( ! empty( $btn_txt ) ) {?>
            <a href="<?php the_permalink(); ?>" class="jl_cap_btn jl_btn_ani">
                <?php echo esc_html( $btn_txt ); ?>
            </a>
        <?php }
    }
  }

if ( ! function_exists( 'bopea_blog_param' ) ) {
  function bopea_blog_param() {
    global $wp_query;
    $str   = '';
    $param = array();
    $cur_cat_id = get_query_var('cat');
    $found_posts   = $wp_query->found_posts;
    $offset = NULL;
    $param['data-page_current'] = 1;
    $param['data-blockid'] = 'blockid_achise506db40';
    $param['data-author'] = 'none';
    if (!empty(get_search_query('s'))){
        $param['data-searchkey'] = get_search_query( 's' );
    }
    if ( get_query_var( 'paged' ) ) {
      $param['data-page_current'] = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
      $param['data-page_current'] = get_query_var( 'page' );
    }

    if ( ! empty( $wp_query->max_num_pages ) ) {
      $param['data-page_max'] = $wp_query->max_num_pages;
    }    
    $param['data-pagination'] = get_theme_mod( 'jl_archive_pagination', 'number' );
    $param['data-offset'] = 0;
    $param['data-order'] = 'date_post';
        
    if ( is_category() ) {
        $jl_archive_cat_num = get_theme_mod( 'jl_archive_cat_num' );
        if ( ! empty( $jl_archive_cat_num ) ) {
            $param['data-posts_per_page'] = intval( $jl_archive_cat_num );
            $post_per_page = intval( $jl_archive_cat_num );
        }else{
            $param['data-posts_per_page'] = get_option('posts_per_page');
            $post_per_page = get_option('posts_per_page');
        }        
        $bopea_total = ceil($found_posts / $post_per_page);
        $param['data-page_max'] = $bopea_total;
        $jl_archive_category = get_theme_mod( 'jl_archive_category', 'archive7' );
        switch ( $jl_archive_category ) {
            case 'archive1' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive2' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive3' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive4' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive5' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive6' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive7' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive8' :
                $param['data-section_style'] = 'large_layout1';
            break;
            case 'archive9' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive10' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive11' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
        }
        
    }elseif ( is_tag() ) {
        $jl_archive_tag_num = get_theme_mod( 'jl_archive_tag_num' );
        if ( ! empty( $jl_archive_tag_num ) ) {
            $param['data-posts_per_page'] = intval( $jl_archive_tag_num );
            $post_per_page = intval( $jl_archive_tag_num );
        }else{
            $param['data-posts_per_page'] = get_option('posts_per_page');
            $post_per_page = get_option('posts_per_page');
        }
        $bopea_total = ceil($found_posts / $post_per_page);
        $param['data-page_max'] = $bopea_total;
        $jl_archive_tag = get_theme_mod( 'jl_archive_tag', 'archive7' );
        switch ( $jl_archive_tag ) {
            case 'archive1' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive2' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive3' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive4' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive5' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive6' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive7' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive8' :
                $param['data-section_style'] = 'large_layout1';
            break;
            case 'archive9' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive10' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive11' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
        }
    }elseif ( is_search() ) {
        $jl_archive_search_num = get_theme_mod( 'jl_archive_search_num' );
        if ( ! empty( $jl_archive_search_num ) ) {
            $param['data-posts_per_page'] = intval( $jl_archive_search_num );
            $post_per_page = intval( $jl_archive_search_num );
        }else{
            $param['data-posts_per_page'] = get_option('posts_per_page');
            $post_per_page = get_option('posts_per_page');
        }
        $bopea_total = ceil($found_posts / $post_per_page);
        $param['data-page_max'] = $bopea_total;
        $jl_archive_search = get_theme_mod( 'jl_archive_search', 'archive7' );
        switch ( $jl_archive_search ) {
            case 'archive1' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive2' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive3' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive4' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive5' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive6' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive7' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive8' :
                $param['data-section_style'] = 'large_layout1';
            break;
            case 'archive9' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive10' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive11' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
        }
    }elseif ( is_author() ) {
        $jl_archive_author_num = get_theme_mod( 'jl_archive_author_num' );
        if ( ! empty( $jl_archive_author_num ) ) {
            $param['data-posts_per_page'] = intval( $jl_archive_author_num );
            $post_per_page = intval( $jl_archive_author_num );
        }else{
            $param['data-posts_per_page'] = get_option('posts_per_page');
            $post_per_page = get_option('posts_per_page');
        }
        $bopea_total = ceil($found_posts / $post_per_page);
        $param['data-page_max'] = $bopea_total;
        $jl_archive_author = get_theme_mod( 'jl_archive_author', 'archive7' );
        switch ( $jl_archive_author ) {
            case 'archive1' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive2' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive3' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive4' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive5' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive6' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive7' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive8' :
                $param['data-section_style'] = 'large_layout1';
            break;
            case 'archive9' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive10' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive11' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
        }
    }else{
        $jl_archive_num = get_theme_mod( 'jl_archive_num' );
        if ( ! empty( $jl_archive_num ) ) {
            $param['data-posts_per_page'] = intval( $jl_archive_num );
        }else{
            $param['data-posts_per_page'] = get_option('posts_per_page');
        }
        $jl_archive_layout = get_theme_mod( 'jl_archive_layout', 'archive7' );
        switch ( $jl_archive_layout ) {
            case 'archive1' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive2' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive3' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive4' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive5' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive6' :
                $param['data-section_style'] = 'jl_mgrid';
            break;
            case 'archive7' :
                $param['data-section_style'] = 'jl_m_list';
            break;
            case 'archive8' :
                $param['data-section_style'] = 'large_layout1';
            break;
            case 'archive9' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive10' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
            case 'archive11' :
                $param['data-section_style'] = 'jl_mgrid_overlay';
            break;
        }
    }
    
    if ( is_author() ) {
      $param['data-author'] = get_the_author_meta( 'ID' );
    } elseif ( is_tag() ) {
      $param['data-tags'] = get_queried_object()->slug;
    } elseif ( is_category() ) {
      global $wp_query;
      $param['data-categories'] = $wp_query->get_queried_object_id();
    }

    foreach ( $param as $k => $v ) {
      if ( ! empty( $k ) ) {
        $str .= esc_attr( $k ) . '= ' . esc_attr( $v ) . ' ';
      }
    }
    return $str;
  }
}
if ( ! function_exists( 'bopea_cat_listing' ) ) :
    function bopea_cat_listing( $module = array(), $query_data = null ) {

        if ( method_exists( $query_data, 'have_posts' ) ) :
            $counter = 1;
            while ( $query_data->have_posts() ) :
                $query_data->the_post();
                get_template_part( 'inc/misc/content', 'list' );
            endwhile;
        endif;
    }
endif;

if ( ! function_exists( 'bopea_search_opt' ) ) {
function bopea_search_opt($query) {
    if (!$query->is_search || !$query->is_main_query()) {
        return $query;
    }
    if(
        is_admin() 
        || class_exists( 'Buddypress', false )
        || (function_exists('is_bbpress') && is_bbpress()) 
        || (function_exists('is_shop') && is_shop())
    ){
        return $query;
    }
    if ($query->is_search) {
        $query->set('post_type', array('post'));
    }
    return $query;
}
add_filter('pre_get_posts','bopea_search_opt');
}

if ( !function_exists( 'bopea_rm_type' ) ){
add_action( 'template_redirect', 'bopea_rm_type' );
function bopea_rm_type() {
  ob_start( function ( $type ) {
    return preg_replace( "%[ ]type=['\"]text\/(javascript|css)['\"]%", '', $type );
  } );
}
}
if ( ! function_exists( 'bopea_source' ) ) {
    function bopea_source() {
        $source_options = get_post_meta( get_the_ID(), 'source_options', true );
        $output = '';
        if(!empty($source_options)){
            $output .= '<span class="jl_source_w">';
            $output .= bopeatxt::bopea_s_soruce();
            foreach ($source_options as $criteria) {
                if($criteria['c_label']){                    
                    $output .=  '<a href="'.esc_url($criteria['url']).'" target="_blank" rel="nofollow">'.esc_html($criteria['c_label']).'</a>';
                }
            }
            $output .= '</span>';
    }
        return $output;
    }
}

if ( ! function_exists( 'bopea_via' ) ) {
    function bopea_via() {
        $via_options = get_post_meta( get_the_ID(), 'via_options', true );
        $output = '';
        if(!empty($via_options)){
            $output .= '<span class="jl_via_w">';
            $output .= bopeatxt::bopea_s_via();
            foreach ($via_options as $criteria) {
                if($criteria['c_label']){                    
                    $output .= '<a href="'.esc_url($criteria['url']).'" target="_blank" rel="nofollow">'.esc_html($criteria['c_label']).'</a>';
                }
            }
            $output .= '</span>';
        }
        return $output;
    }
}

if ( ! function_exists( 'bopea_rel' ) ) {
    function bopea_rel() {
        // Se la sezione correlati è disabilitata, esci
        if ( get_theme_mod( 'disable_post_related' ) == 1 ) {
            return;
        }

        // Annuncio sopra
        bopea_ads_related_above();

        // Numero di post correlati dal Customizer, fallback = 4
        $related_num = absint( get_theme_mod( 'related_num', 4 ) );
        if ( $related_num <= 0 ) {
            $related_num = 4;
        }

        // ID del post corrente
        $current_id = get_queried_object_id();

        // Argomenti base query
        $args = array(
            'posts_per_page'      => $related_num * 2, // recupera più post in caso di duplicati
            'post__not_in'        => array( $current_id ),
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => true,
        );

        // Modalità di relazione: tag o categoria
        $jl_related_query = get_theme_mod( 'jl_related_query', 'category' );

        if ( $jl_related_query === 'tag' ) {
            $tags_ids = wp_get_post_terms( $current_id, 'post_tag', array( 'fields' => 'ids' ) );
            if ( ! empty( $tags_ids ) ) {
                $args['tag__in'] = $tags_ids;
            }
        } else {
            $cats_ids = wp_get_post_terms( $current_id, 'category', array( 'fields' => 'ids' ) );
            if ( ! empty( $cats_ids ) ) {
                $args['category__in'] = $cats_ids;
            }
        }

        // Query correlati
        $post_query = new WP_Query( $args );

        if ( $post_query->have_posts() ) :
            // Filtra eventuali duplicati di ID
            $unique_posts = array();
            foreach ( $post_query->posts as $p ) {
                if ( ! in_array( $p->ID, $unique_posts ) && $p->ID != $current_id ) {
                    $unique_posts[] = $p->ID;
                }
            }

            // Limita al numero impostato
            $unique_posts = array_slice( $unique_posts, 0, $related_num );

            if ( ! empty( $unique_posts ) ) : ?>
                <div class="jl_relsec_wrap">
                    <div class="jl_relsec">
                        <div class="jl_relsec_in jl_sep_dot">
                            <span class="rel_head h2"><?php echo bopeatxt::bopea_s_related_articles(); ?></span>
                            <div class="jl_rel_posts">
                                <?php
                                $args_filtered = array(
                                    'post__in'           => $unique_posts,
                                    'orderby'            => 'post__in',
                                    'posts_per_page'     => $related_num,
                                    'ignore_sticky_posts'=> 1,
                                    'no_found_rows'      => true,
                                );
                                $filtered_query = new WP_Query( $args_filtered );
                                while ( $filtered_query->have_posts() ) : $filtered_query->the_post();
                                    bopea_rgrid();
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;
        endif;

        // Annuncio sotto
        bopea_ads_related_below();
    }
}

if ( ! function_exists( 'bopea_rgrid' ) ) {
function bopea_rgrid() {?>
    <div class="jl_cgrid_layout">
		<?php if ( has_post_thumbnail()) {?>
			<div class="jl_img_holder">
			    <div class="jl_imgw jl_radus_e">
			        <div class="jl_imgin">
			                    <?php
								if (!empty(get_theme_mod('jl_related_img'))) {
									the_post_thumbnail(get_theme_mod('jl_related_img'));
								}else{
									the_post_thumbnail('bopea_layouts');
								}
								?> 
			        </div>
			        <?php bopea_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));?>
			        <a class="jl_imgl" href="<?php the_permalink();?>"></a>
                    <?php bopea_post_tumb_cat(get_the_ID());?>
			    </div>
			</div>
		<?php }?>
		<div class="jl_fe_text">
			<?php bopea_post_cat(get_the_ID());?>
			<h3 class="jl_fe_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
			<p class="jl_fe_des"><?php echo wp_trim_words( get_the_excerpt(), 12, '...' );?> </p>
			<?php bopea_post_meta(get_the_ID());?>
		</div>
	</div>
<?php }
}

if(!function_exists('bopea_vid_wrap')){
    add_filter('embed_oembed_html', 'bopea_vid_wrap', 10, 4);
    function bopea_vid_wrap($html, $url, $attr, $post_ID) {
        if (strpos($url, 'youtube') !== false || strpos($url, 'vimeo') !== false || strpos($url, 'soundcloud') !== false) {
            $html = '<div class="jlvid_container">'.$html.'</div>';
        }
        return $html;
    }
}

if ( !function_exists( 'bopea_generate_dynamic_css' ) ){
    function bopea_generate_dynamic_css() {
        ob_start();
        get_template_part( 'inc/misc/dynamic-css' );
        $output = ob_get_contents();
        $output = bopea_minify_css($output);
        ob_end_clean();
        return $output;
    }
}

if ( !function_exists( 'bopea_editor_dynamic_css' ) ){
    function bopea_editor_dynamic_css() {
        ob_start();
        get_template_part( 'inc/misc/editor-css' );
        $output = ob_get_contents();
        $output = bopea_minify_css($output);
        ob_end_clean();
        return $output;
    }
}

if ( ! function_exists( 'bopea_minify_css' ) ) {
    function bopea_minify_css( $output ) {
        return preg_replace( '@({)\s+|(\;)\s+|/\*.+?\*\/|\R@is', '$1$2 ', $output );
    }
}

function bopea_sanitize_wp_kses( $data ) {
    return wp_kses( $data, array(
        'a' => array(
            'href'  => array(),
            'class'  => array(),
            'style'    => array(),
            'id'  => array(),
            'target'  => array(),
            'rel' => array(),
            'data-format' => array(),
            'class' => array(),
            'data-source' => array(),
            'data-type' => array(),
            'data-src' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'p' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
            'br'    => array(),
            'a' => array(
                'href'  => array(),
                'class'  => array(),
                'style'    => array(),
                'id'  => array(),
                'target'  => array(),
                'rel' => array(),
                'data-format' => array(),
                'class' => array(),
                'data-source' => array(),
                'data-type' => array(),
                'data-src' => array(),
                'title' => array(),
            ),
        ),
        'h1' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'h2' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'h3' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'h4' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'h5' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'img' => array(
            'src'    => array(),
            'srcset' => array(),
            'alt'    => array(),
        ),
        'div' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'i' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'u' => array(
            'class' => array(),
            'id'    => array(),
            'style'    => array(),
        ),
        'br'     => array(),
        'b'     => array(
            'style'    => array(),
        ),
        'em'     => array(
            'class' => array(),
            'style'    => array(),
        ),
        'ul'     => array(
            'class' => array(),
            'style'    => array(),
        ),
        'ol'     => array(
            'class' => array(),
            'style'    => array(),
        ),
        'li'     => array(
            'class' => array(),
            'style'    => array(),
        ),
        'strong' => array(
            'class' => array(),
            'style'    => array(),
        ),
        'italic' => array(
            'class' => array(),
            'style'    => array(),
        ),
        'iframe'  => array(
            'class' => array(),
            'id'    => array(),
            'src'    => array(),
            'width'    => array(),
            'style'    => array(),
            'height'    => array(),
        ),
    ));
}

function bopea_review_score($num, $type, $star = false) {
    $review_cus_total = get_post_meta( get_the_ID(), 'review_cus_total', true );    
    if(!empty($review_cus_total)){
        $num = $review_cus_total;
    }
    
    switch ($type) :
      case 'star' :
        if(!$star == false){
          $num = $num / 2;          
          $half_star = '<svg fill="currentColor" width="13" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="2 2.46 20.02 19.08"><path d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9 	C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7 	c0.1,0.1,0.3,0.1,0.5,0.1v0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z M15.8,13.6 	c-0.2,0.2-0.3,0.6-0.3,0.9l0.7,4.2l-3.8-2c-0.1-0.1-0.3-0.1-0.5-0.1V5.7l1.9,3.8c0.1,0.3,0.4,0.5,0.8,0.5l4.2,0.6L15.8,13.6z"></path></svg>';

          if ( $num <= 0.6 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i">'.$half_star.'<i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 0.5 && $num <= 1 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 1 && $num <= 1.6 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i>'.$half_star.'<i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 1.6 && $num <= 2 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star"></i><i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 2 && $num <= 2.6 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i>'.$half_star.'<i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 2.6 && $num <= 3 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star"></i><i class="jli-star"></i></span>';
          if ( $num > 3 && $num <= 3.6 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i>'.$half_star.'<i class="jli-star"></i></span>';
          if ( $num > 3.6 && $num <= 4 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star"></i></span>';
          if ( $num > 4 && $num <= 4.6 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i>'.$half_star.'</span>';
          if ( $num > 4.6 && $num <= 5 )
          $output = '<span class="jl_star_val">'.$num.'</span><span class="jl_star_i"><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i><i class="jli-star-full"></i></span>';
        
        } else {
          $output = $num;
        }
        break;

      case 'letter' :
        if ( $num <= 2 ) $output = 'F';
        if ( $num > 2 && $num <= 4 ) $output = 'D';
        if ( $num > 4 && $num <= 6 ) $output = 'C';
        if ( $num > 6 && $num <= 8 ) $output = 'B';
        if ( $num > 8 && $num <= 10 ) $output = 'A';
        break;

      case 'percent';
        $output = $num * 10 . '<span class="jl_score_sign">%</span>';
        break;

      case 'percent_front';
        $output = $num * 10;
        break;

      case 'number';
        $output = $num + 0;
        break;

    endswitch;
    if(isset($output)){
    return $output;
    }
}

function bopea_review_box($post_id, $class) {
    $single_post_review = get_post_meta( $post_id, 'single_post_review', true );
    $review_box_title = get_post_meta( $post_id, 'review_box_title', true );
    $review_summary = get_post_meta( $post_id, 'review_summary', true );
    $review_imageid = get_post_meta( $post_id, 'review_image', true );
    $review_color = get_post_meta( $post_id, 'review_color', true );
    $review_pos = get_post_meta( $post_id, 'review_pos', true );
    $review_neg = get_post_meta( $post_id, 'review_neg', true );
    $rating_type = get_post_meta( $post_id, 'rating_type', true );
    $review_btn_label = get_post_meta( $post_id, 'review_btn_label', true );
    $review_btn_url = get_post_meta( $post_id, 'review_btn_url', true );
    $rating_type_front = esc_attr('percent_front');
    $rating_criteria = get_post_meta( $post_id, 'rating_criteria', true );
    // review bar
    $jl_review_bar = get_post_meta( $post_id, 'jl_review_bar', true );    
    if(empty($jl_review_bar)) {
        $jl_review_bar = get_theme_mod('jl_review_bar', 'show');
    }else{        
        $jl_review_bar = $jl_review_bar;
    }
    if($single_post_review){
    if(empty($rating_criteria)){
    }else{
    $rating_criteria_count = count($rating_criteria);
    // if(empty($rating_criteria)){
    //   $rating_criteria = '';
    //   $rating_criteria_count = '';
    // }else{
    //   $rating_criteria_count = count($rating_criteria);
    // }
    if(empty($review_color)){
      $review_color = esc_attr('#ffcd00');
    }
    $score_array = array();
    if($rating_criteria){
      foreach ($rating_criteria as $criteria) {
        $score_array []= $criteria['score'];
      }
    }
    $final_score = array_sum($score_array);
    $final_score = $final_score / $rating_criteria_count;
    $final_score = number_format($final_score, 1, '.', '');

    $value = bopea_review_score($final_score, $rating_type_front, true);
    $full = 180;
    if($value <= 50){
    $right = $value * 3.6;
    $right = $full-$right;
    $right = '-'. $right;
    }else{
    $right = 0;
    }
    if($value > 50){
    $left = $value -50;
    $left = $left * 3.6;
    $left = $full+$left;
    }else{
    $left = 0;
    }

    $output = '';
    $output .= '<div id="jl-review-box">';
    $output .= '<div class="jl_score_h">';
    if (!empty($review_imageid)) {
    $output .= wp_get_attachment_image( $review_imageid, 'bopea_medium', true );
    }
    $output .= '<div class="jl_score_main_w">';
    $output .= '<div class="jl_score_main">';
    if($rating_type == "star"){
    $output .= '<span class="jl_star_re_w"><span class="jl_star_re" style="background-color:'.esc_attr($review_color).';">'.bopea_review_score($final_score, $rating_type, true).'</span></span>';
    }else{
    $output .= '<div class="container-donut">';
    $output .= '<div class="jl-renut-container">';
    $output .= '<div class="jl-renut">';
    $output .= '<div class="jl-renut-sections" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-section jl-renut-section-right" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-filler" style="background-color:'.esc_attr($review_color).'; transform: rotate('.esc_attr($right).'deg);">';
    $output .= '</div>';
    $output .= '</div>';
    if($value > 50){
    $output .= '<div class="jl-renut-section jl-renut-section-left" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-filler" style="background-color:'.esc_attr($review_color).'; transform: rotate('.esc_attr($left).'deg);">';
    $output .= '</div>';
    $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '<div class="jl-renut-overlay">';
    $output .= '<div class="jl-renut-text">';
    $output .= '<div>';
    $output .= '<span>'.bopea_review_score($final_score, $rating_type, true).'</span>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '<div class="review-ht">';
    $output .= '<h5 class="itemreviewed">'.esc_html($review_box_title).'</h5>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="jl_rw_w">';
    if ( !empty( $review_summary ) || !empty( $review_pos ) || !empty( $review_neg ) ) {
    $output .= '<div class="jl_ideas_sum">';
    if(!empty($review_summary)){
    $output .= '<div class="jl_sub_title">';
    $output .= '<h6 class="jl_sum_title">'.bopeatxt::bopea_s_summary().'</h6>';
    $output .= '<p>'.esc_html($review_summary).'</p>';
    $output .= '</div>';
    }
    if ( !empty( $review_pos ) || !empty( $review_neg ) ) {
    $output .= '<div class="jl_pcw">';
    if($review_pos){
      $output .= '<div class="jl_review_pros">';
      $output .= '<h6>'.bopeatxt::bopea_s_the_pros().'</h6>';
      $output .= '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($review_pos,"\n\r")).'</span>';
      $output .= '</div>';
    }
    if($review_neg){
      $output .= '<div class="jl_review_cons">';
      $output .= '<h6>'.bopeatxt::bopea_s_the_cons().'</h6>';
      $output .= '<span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</span>\n<span>"),trim($review_neg,"\n\r")).'</span>';
      $output .= '</div>';
    }
    $output .= '</div>';
    }
    $output .= '</div>';
    }
    if($jl_review_bar == 'show'){
    $output .= '<ul>';
    if($rating_criteria){
      foreach ($rating_criteria as $criteria) {
        if($criteria['score']){
        $percentage_score = $criteria['score'] * 10;
        }else{
        $percentage_score = '';    
        }
        if($criteria['c_label']){
        $output .= '<li><div class="review-criteria-score clearfix"><span class="left">'.esc_html($criteria['c_label']).'</span><span class="right">'.bopea_review_score($criteria['score'], $rating_type, true).'</span></div>';
        $output .= '<div class="review-criteria-bar-container"><div class="review-criteria-bar" style="background:'.esc_attr($review_color).'; width:'.esc_attr($percentage_score).'%"></div></div></li>';
        }
      }
    }
    $output .= '</ul>';
    }
    if( !empty($review_btn_label) ){
    $output .= '<span class="rw_btnw"><a class="rw_btn" href="'.esc_url($review_btn_url).'" target="_blank">'.esc_html($review_btn_label).'<svg fill="none" stroke="currentColor" stroke-width="1.5px" xmlns="http://www.w3.org/2000/svg" width="23" viewBox="0 0 15.976 11.969"><path d="m9.469.527 5.447 5.516-5.447 5.392"></path><g><path d="M0 5.974h14.5"></path></g><g><path d="M0 5.974h14.5"></path></g></svg></a></span>';
}
    $output .= '</div>';
    $output .= '</div>';
    return $output;    
    }
}
}
function bopea_review_bar($post_id, $class, $echo = true) {
    $single_post_review = get_post_meta( $post_id, 'single_post_review', true );
    $review_box_title = get_post_meta( $post_id, 'review_box_title', true );
    $review_summary = get_post_meta( $post_id, 'review_summary', true );
    $review_color = get_post_meta( $post_id, 'review_color', true );
    $review_pos = get_post_meta( $post_id, 'review_pos', true );
    $review_neg = get_post_meta( $post_id, 'review_neg', true );
    $rating_type = get_post_meta( $post_id, 'rating_type', true );
    if($rating_type == 'star'){
        $rating_type = esc_attr('number');
    }else{
        $rating_type = get_post_meta( $post_id, 'rating_type', true );
    }
    $rating_type_front = esc_attr('percent_front');
    $rating_criteria = get_post_meta( $post_id, 'rating_criteria', true );
    if($single_post_review){
    if(empty($rating_criteria)){
      $rating_criteria = '';
      $rating_criteria_count = '';
    }else{
      $rating_criteria_count = count($rating_criteria);
    }
    if(empty($review_color)){
      $review_color = esc_attr('#ffcd00');
    }
    $score_array = array();
    if($rating_criteria){
      foreach ($rating_criteria as $criteria) {
        $score_array []= $criteria['score'];
      }

    $final_score = array_sum($score_array);
    $final_score = $final_score / $rating_criteria_count;
    $final_score = number_format($final_score, 1, '.', '');

    $value = bopea_review_score($final_score, $rating_type_front, true);

    $full = 180;
    if($value <= 50){
    $right = $value * 3.6;
    $right = $full-$right;
    $right = '-'. $right;
    }else{
    $right = 0;
    }
    if($value > 50){
    $left = $value -50;
    $left = $left * 3.6;
    $left = $full+$left;
    }else{
    $left = 0;
    }

    $output = '';

    $output .= '<div class="container-donut jl-donut-front">';
    $output .= '<div class="jl-renut-container">';
    $output .= '<div class="jl-renut">';
    $output .= '<div class="jl-renut-sections" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-section jl-renut-section-right" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-filler" style="background-color:'.$review_color.'; transform: rotate('.$right.'deg);">';
    $output .= '</div>';
    $output .= '</div>';
    if($value > 50){
    $output .= '<div class="jl-renut-section jl-renut-section-left" style="transform: rotate(0deg);">';
    $output .= '<div class="jl-renut-filler" style="background-color:'.$review_color.'; transform: rotate('.$left.'deg);">';
    $output .= '</div>';
    $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '<div class="jl-renut-overlay">';
    $output .= '<div class="jl-renut-text">';
    $output .= '<div>';
    $output .= '<span>'.bopea_review_score($final_score, $rating_type, true).'</span>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
}else{
    $output = '';
}

    if($echo == 'true') :
    print '<span class="jl_none"></span>'.$output;
    else :
    return $output;
    endif;
    }
}

if ( ! function_exists( 'bopea_sh_top' ) ) {
    function bopea_sh_top( $post_id ) {
        if(empty(get_theme_mod('disable_head_sh'))){
        if(function_exists('bopea_bac_PostViews')){?>
        <div class="jlp_hs">
            <?php bopea_shead(get_the_ID());?>
            <?php bopea_slink(get_the_ID());?>                
        </div>
        <?php }}
    }
}

if ( ! function_exists( 'bopea_shead' ) ) {
    function bopea_shead( $post_id ) {
        if(function_exists('bopea_bac_PostViews')){
        ?>
        <span class="jl_sh_t"><i class="jli-share"></i><span><?php echo bopeatxt::bopea_s_share();?></span></span>            
<?php }}}


if ( ! function_exists( 'bopea_front_slink' ) ) {
    function bopea_front_slink( $post_id ) {
        if(function_exists('bopea_bac_PostViews')){
        ?>
                <span class="jl_sli_in">
                    <span class="jl_sli_fb jl_shli"><a class="jl_sshl" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-facebook"></i></a></span>
                    <span class="jl_sli_tw jl_shli"><a class="jl_sshl" href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode(get_the_title());?>&url=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-x"></i></a></span>
                    <span class="jl_sli_pi jl_shli"><a class="jl_sshl" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo rawurlencode(get_permalink());?>&media=<?php if ( has_post_thumbnail()) {$thumbnail_pin_id = get_post_thumbnail_id(); if( !empty($thumbnail_pin_id) ){ $thumbnail_pin = wp_get_attachment_image_src( $thumbnail_pin_id , 'bopea_large' );} echo esc_attr($thumbnail_pin[0]);}?>" rel="nofollow"><i class="jli-pinterest"></i></a></span>
                    <span class="jl_sli_din jl_shli"><a class="jl_sshl" href="http://www.linkedin.com/shareArticle?url=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-linkedin"></i></a></span>
                    <span class="jl_sli_wapp jl_shli"><a class="jl_sshl" href="https://api.whatsapp.com/send?text=<?php echo rawurlencode(get_permalink()); ?>" data-action="share/whatsapp/share" rel="nofollow"><i class="jli-whatsapp"></i></a></span>                                        
                </span>            
    <?php }}}

if ( ! function_exists( 'bopea_slink' ) ) {
function bopea_slink( $post_id ) {
    if(function_exists('bopea_bac_PostViews')){
    ?>
        <span class="jl_sli_w">
            <span class="jl_sli_in">
                <span class="jl_sli_fb jl_shli"><a class="jl_sshl" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-facebook"></i></a></span>
                <span class="jl_sli_tw jl_shli"><a class="jl_sshl" href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode(get_the_title());?>&url=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-x"></i></a></span>
                <span class="jl_sli_pi jl_shli"><a class="jl_sshl" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo rawurlencode(get_permalink());?>&media=<?php if ( has_post_thumbnail()) {$thumbnail_pin_id = get_post_thumbnail_id(); if( !empty($thumbnail_pin_id) ){ $thumbnail_pin = wp_get_attachment_image_src( $thumbnail_pin_id , 'bopea_large' );} echo esc_attr($thumbnail_pin[0]);}?>" rel="nofollow"><i class="jli-pinterest"></i></a></span>
                <span class="jl_sli_din jl_shli"><a class="jl_sshl" href="http://www.linkedin.com/shareArticle?url=<?php echo rawurlencode(get_permalink());?>" rel="nofollow"><i class="jli-linkedin"></i></a></span>
                <span class="jl_sli_wapp jl_shli"><a class="jl_sshl" href="https://api.whatsapp.com/send?text=<?php echo rawurlencode(get_permalink()); ?>" data-action="share/whatsapp/share" rel="nofollow"><i class="jli-whatsapp"></i></a></span>
                <?php if ( is_single() ) {?><span class="jl_sli_tele jl_shli"><a class="jl_sshl" href="https://t.me/share/url?url=<?php echo rawurlencode(get_permalink()); ?>&title=<?php echo rawurlencode(get_the_title());?>" rel="nofollow"><i class="jli-telegram"></i></a></span>        
                <span class="jl_sli_tumblr jl_shli"><a class="jl_sshl" href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode(get_permalink()); ?>&name=<?php echo rawurlencode(get_the_title());?>" rel="nofollow"><i class="jli-tumblr"></i></a></span>
                <span class="jl_sli_line jl_shli"><a class="jl_sshl" href="https://social-plugins.line.me/lineit/share?url=<?php echo rawurlencode(get_permalink()); ?>" rel="nofollow"><span class="jli-line"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span></a></span>
                <span class="jl_sli_mil jl_shli"><a class="jl_sshm" href="mailto:?subject=<?php echo rawurlencode(get_the_title());?> <?php echo rawurlencode(get_permalink());?>" target="_blank" rel="nofollow"><i class="jli-mail"></i></a></span><?php }?>
            </span>
        </span>
<?php }}}
    
if ( ! function_exists( 'bopea_head_share' ) ) {
function bopea_head_share() {
if(!get_theme_mod('disable_social_icons')==1){?>
                            <ul class="social_icon_header_top jl_socialcolor">
                                <?php if(get_theme_mod('facebook')){?>
                                <li><a class="facebook" aria-label="<?php esc_html_e('facebook', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('facebook'));?>" target="_blank"><i class="jli-facebook"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('vk')){?>
                                <li><a class="vk" aria-label="<?php esc_html_e('vk', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('vk'));?>" target="_blank"><i class="jli-vk"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('telegram')){?>
                                <li><a class="telegram" aria-label="<?php esc_html_e('telegram', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('telegram'));?>" target="_blank"><i class="jli-telegram"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('behance')){?>
                                <li><a class="behance" aria-label="<?php esc_html_e('behance', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('behance'));?>" target="_blank"><i class="jli-behance"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('vimeo')){?>
                                <li><a class="vimeo" aria-label="<?php esc_html_e('vimeo', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('vimeo'));?>" target="_blank"><i class="jli-vimeo"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('youtube')){?>
                                <li><a class="youtube" aria-label="<?php esc_html_e('youtube', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('youtube'));?>" target="_blank"><i class="jli-youtube"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('instagram')){?>
                                <li><a class="instagram" aria-label="<?php esc_html_e('instagram', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('instagram'));?>" target="_blank"><i class="jli-instagram"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('linkedin')){?>
                                <li><a class="linkedin" aria-label="<?php esc_html_e('linkedin', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('linkedin'));?>" target="_blank"><i class="jli-linkedin"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('pinterest')){?>
                                <li><a class="pinterest" aria-label="<?php esc_html_e('pinterest', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('pinterest'));?>" target="_blank"><i class="jli-pinterest"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('twitter')){?>
                                <li><a class="twitter" aria-label="<?php esc_html_e('twitter', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('twitter'));?>" target="_blank"><i class="jli-x"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('deviantart')){?>
                                <li><a class="deviantart" aria-label="<?php esc_html_e('deviantart', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('deviantart'));?>" target="_blank"><i class="jli-deviantart"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('dribble')){?>
                                <li><a class="dribble" aria-label="<?php esc_html_e('dribble', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('dribble'));?>" target="_blank"><i class="jli-dribbble"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('dropbox')){?>
                                <li><a class="dropbox" aria-label="<?php esc_html_e('dropbox', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('dropbox'));?>" target="_blank"><i class="fjli-dropbox"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('rss')){?>
                                <li><a class="rss" aria-label="<?php esc_html_e('rss', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('rss'));?>" target="_blank"><i class="jli-rss"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('skype')){?>
                                <li><a class="skype" aria-label="<?php esc_html_e('skype', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('skype'));?>" target="_blank"><i class="jli-skype"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('stumbleupon')){?>
                                <li><a class="stumbleupon" aria-label="<?php esc_html_e('stumbleupon', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('stumbleupon'));?>" target="_blank"><i class="jli-stumbleupon"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('wordpress')){?>
                                <li><a class="wordpress" aria-label="<?php esc_html_e('wordpress', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('wordpress'));?>" target="_blank"><i class="jli-wordpress"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('yahoo')){?>
                                <li><a class="yahoo" aria-label="<?php esc_html_e('yahoo', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('yahoo'));?>" target="_blank"><i class="jli-yahoo"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('sound_cloud')){?>
                                <li><a class="sound_cloud" aria-label="<?php esc_html_e('sound_cloud', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('sound_cloud'));?>" target="_blank"><i class="jli-soundcloud"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('spotify_i')){?>
                                <li><a class="spotify_i" aria-label="<?php esc_html_e('spotify', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('spotify_i'));?>" target="_blank"><i class="jli-spotify"></i></a></li>
                                <?php }?>
                                <?php if(get_theme_mod('wechat')){?>
                                <li><a class="wechat" aria-label="<?php esc_html_e('wechat', 'bopea');?>" href="<?php echo esc_url(get_theme_mod('wechat'));?>" target="_blank"><i class="jli-wechat"></i></a></li>
                                <?php }?>
                            </ul>
                            <?php }
}
}
add_action( 'wp_ajax_nopriv_bopea_loadnavs', 'bopea_loadnavs' );
add_action( 'wp_ajax_bopea_loadnavs', 'bopea_loadnavs' );
if ( ! function_exists( 'bopea_loadnavs' ) ) {
    function bopea_loadnavs() {
        $module            = array();
        $response            = array();
        $response['content'] = '';
        $notice_class        = 'jl_end_wrp';

        if ( ! empty( $_POST['data'] ) ) {
            $module = bopea_module_opt( $_POST['data'] );
        }
        if ( empty( $module['page_next'] ) ) {
            $module['page_next'] = 2;
        }
        $query_data = bopea_query( $module, intval( $module['page_next'] ) );
        if(empty(get_theme_mod('jl_opt_lazy_img', false))){
            if(function_exists('bopea_e_template')){
                add_filter( 'wp_get_attachment_image_attributes', 'bopea_lsmall_img', 10, 3 );
            }
        }
        if ( $query_data->have_posts() ) {
            $response['page_max'] = $query_data->max_num_pages;

            if ( ! empty( $query_data->paged ) ) {
                $response['page_current'] = $query_data->paged;
            } else {
                $response['page_current'] = $module['page_next'];
            }
            if ( $response['page_current'] == $response['page_max'] ) {}

            $response['content'] = bopea_ajax_get_content( $module, $query_data );

            wp_reset_postdata();
        }

        wp_send_json( $response, null );
    }
}

if ( ! function_exists( 'bopea_menu_cat_opt' ) ) {
    add_action( 'wp_ajax_nopriv_bopea_menu_cat_opt', 'bopea_menu_cat_opt' );
    add_action( 'wp_ajax_bopea_menu_cat_opt', 'bopea_menu_cat_opt' );
    function bopea_menu_cat_opt() {
        $module                    = array();
        $data_response            = array();
        $data_response['content'] = '';
        if ( ! empty( $_POST['data'] ) ) {
            $module = bopea_module_opt( $_POST['data'] );
        }
        $data_query = bopea_query( $module );
        if ( ! empty( $data_query->max_num_pages ) ) {
            $data_response['page_max'] = $data_query->max_num_pages;
        }
        $data_response['content'] = bopea_ajax_get_content( $module, $data_query );
        wp_reset_postdata();
        die( json_encode( $data_response ) );
    }
}


if ( ! function_exists( 'bopea_module_opt' ) ) {
    function bopea_module_opt( $module ) {
        if ( is_array( $module ) ) {
            foreach ( $module as $key => $val ) {
                $key              = sanitize_text_field( $key );
                $module[ $key ] = sanitize_text_field( $val );
            }
        } elseif ( is_string( $module ) ) {
            $module = sanitize_text_field( $module );
        } else {
            $module = '';
        }
        return $module;
    }
}

if ( ! function_exists( 'bopea_ajax_get_content' ) ) :
    function bopea_ajax_get_content( $module = array(), $query_data = null ) {
        if ( empty( $module['section_style'] ) ) {
            $module['section_style'] = 'jl_mgrid';
        }
        ob_start();
        switch ( $module['section_style'] ) {
            case 'jl_lgrid' :
                bopea_lgrid_listing( $module, $query_data );
            break;
            case 'jl_mgrid' :
                bopea_mgrid_listing( $module, $query_data );
            break;
            case 'jl_c_grid' :
                bopea_cgrid_listing( $module, $query_data );
            break;            
            case 'jl_g_number' :
                bopea_g_number_listing( $module, $query_data );
            break;
            case 'jl_li_number' :
                bopea_li_number_listing( $module, $query_data );
            break;            
            case 'jl_magrid' :
                bopea_magrid_listing( $module, $query_data );
            break;
            case 'jl_mgrid_overlay' :
                bopea_mgrid_overlay_listing( $module, $query_data );
            break;
            case 'jl_m_list' :
                bopea_m_list_listing( $module, $query_data );
            break;
            case 'jl_sg' :
                bopea_sg_listing( $module, $query_data );
            break;
            case 'jl_xsli' :
                bopea_xsg_listing( $module, $query_data );
            break;
            case 'mega_grid' :
                bopea_menu_g_listing( $module, $query_data );
            break;
            case 'mega_grid_overlay' :
                bopea_ov_listing( $module, $query_data );
            break;
            case 'mega_small_list' :
                bopea_sm_listing( $module, $query_data );
            break;
            case 'jl_feature_15' :
                bopea_feature_15_listing( $module, $query_data );
            break;
            case 'jl_feature_16' :
                bopea_feature_16_listing( $module, $query_data );
            break;
            case 'jl_feature_17' :
                bopea_feature_17_listing( $module, $query_data );
            break;
            case 'large_layout1' :
                bopea_large_layout1( $module, $query_data );
            break;
            case 'large_layout2' :
                bopea_large_layout2( $module, $query_data );
            break;
            case 'large_layout3' :
                bopea_large_layout3( $module, $query_data );
            break;            
            case 'jl_main_ov_sm_li' :
                bopea_main_ov_sm_li_listing( $module, $query_data );
            break;
            case 'jl_feature_lig' :
                bopea_feature_lig_listing( $module, $query_data );
            break;
        }
        return ob_get_clean();
    }
endif;

if ( ! function_exists( 'bopea_get_ajax_attributes' ) ) :
    function bopea_get_ajax_attributes( $module = array(), $query_data = null ) {
        if ( null == $query_data ) {
            return;
        }

        if ( empty( $module['blockid'] ) || ( empty( $module['pagination'] ) && empty( $module['tabs_link'] ) ) ) {
            return;
        }
        if ( ! empty( $query_data->max_num_pages ) && ! isset( $module['page_max'] ) ) {
            $module['page_max'] = $query_data->max_num_pages;
        }
        $module['page_current'] = 1;
        $defaults = array(
            'blockid'          => '',
            'section_style'    => '',            
            'post_type'        => '',
            'term_slugs'       => '',
            'post_type_tax'    => '',
            'page_max'         => '',
            'page_current'     => '',
            'category'         => '',
            'categories'       => '',
            'tags'             => '',
            'format'           => '',
            'author'           => '',
            'post_not_in'      => '',
            'searchkey'        => '',
            'post_in'          => '',
            'order'            => '',
            'posts_per_page'   => '',
            'offset'           => '',
            'text_style'       => '',
            'post_columns'     => '',
            'tabs_link'        => '',
            'tabs_link_ids'    => '',
            'show_excep'       => '',
            'sl_type'          => '',
        );
        foreach ( $defaults as $key => $val ) {
            if ( ! empty( $module[ $key ] ) ) {
                echo 'data-' . $key . '="' . esc_attr( $module[ $key ] ) . '" ';
            }
        }
    }
endif;

if ( ! function_exists( 'bopea_block_tabs_link' ) ) :
	function bopea_block_tabs_link( $module ) {
		if ( empty( $module['tabs_link'] ) || empty( $module['blockid'] ) ) {
			return;
		}
		if ( empty( $module['tabs_link_ids'] ) ) {
			$module['tabs_link_ids'] = '';
		}

		if ( empty( $module['tabs_link_label'] ) ) {
			$module['tabs_link_label'] = esc_html__('all', 'bopea');
		}
		$data = bopea_add_settings_tabs_links( $module['tabs_link'], $module['tabs_link_ids'] );

		if ( empty( $data ) || ! is_array( $data ) ) {
			return;
		} ?>
		<div class="jl_ajax_w jl_clear_at">
			<div class="jl_ajax_c jl_clear_at">
				<span class="ajax_nav_item"><a href="#" class="jl-block-link jl-tab-link jl-ac-m" data-ajax_filter_val="0"><?php echo esc_html( $module['tabs_link_label'] ); ?></a></span><span class="ajax_nav_item jl_spn">/</span>
				<?php foreach ( $data as $item ) : ?>
					<span class="ajax_nav_item"><a href="#" class="jl-block-link jl-tab-link" data-ajax_filter_val="<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['name'] ); ?></a></span><span class="ajax_nav_item jl_spn">/</span>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
	}
endif;

if ( ! function_exists( 'bopea_blocknav' ) ) :
    function bopea_blocknav( $module, $query_data = null ) {
        if ( empty( $module['pagination'] ) ) {
            return false;
        }
        switch ( $module['pagination'] ) {
            case 'loadmore' :
                bopea_blocknav_loadmore( $query_data );
                break;
            case 'next_prev' :
                bopea_blocknav_nextprev( $query_data );
                break;
            case 'autoload' :
                bopea_blocknav_autoload( $query_data );
            break;
            default:
                return false;
        }
    }
endif;

if ( ! function_exists( 'bopea_blocknav_autoload' ) ):
    function bopea_blocknav_autoload( $query_data = null ) {

        if ( empty( $query_data ) || ! is_object( $query_data ) ) {
            global $wp_query;
            $query_data = $wp_query;
        }
        if ( $query_data->max_num_pages < 2 ) {
            return false;
        } ?>
        <div class="jl_el_nav_w">
           <div class="jl_lmore_wrap">
               <div class="jl_autoload">
               <span class="jl-load-animation"><span></span></span>
               </div>
           </div>
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_blocknav_loadmore' ) ) :
    function bopea_blocknav_loadmore( $query_data = null ) {

        if ( empty( $query_data ) || ! is_object( $query_data ) ) {
            global $wp_query;
            $query_data = $wp_query;
        }

        if ( $query_data->max_num_pages < 2 ) {
            return false;
        } ?>
        <div class="jl_el_nav_w">
           <div class="jl_lmore_wrap">
               <div class="jl_lmore_c">
               <a href="#" class="jl-load-link"><span><?php echo bopeatxt::bopea_s_load_more(); ?></span></a>
               <span class="jl-load-animation"><span></span></span>
               </div>
           </div>
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_blocknav_nextprev' ) ):
    function bopea_blocknav_nextprev( $query_data = null ) {

        if ( empty( $query_data ) || ! is_object( $query_data ) ) {
            global $wp_query;
            $query_data = $wp_query;
        }
        if ( $query_data->max_num_pages < 2 ) {
            return false;
        } ?>
        <div class="jl_el_nav_w jl_nxpre">
           <div class="pagination-wrap pagination-nextprev clearfix">
               <a href="#" class="jl-foot-nav jl-block-link jl-prev-nav jl_disable" aria-label="<?php esc_html_e('prev', 'bopea');?>" data-type="prev"><i class="jli-left-chevron"></i></a>
               <a href="#" class="jl-foot-nav jl-block-link jl-next-nav" aria-label="<?php esc_html_e('next', 'bopea');?>" data-type="next"><i class="jli-right-chevron"></i></a>
           </div>
        </div>
    <?php
    }
endif;


if ( ! function_exists( 'bopea_query' ) ) {
    function bopea_query( $data = array(), $paged = null ) {
        $defaults = array(
            'categories'          => '',
            'category'            => '',
            'author'              => '',
            'format'              => '',
            'tags'                => '',
            'tag_in'              => '',
            'posts_per_page'      => '',
            'paged'               => '',
            'no_found_rows'       => false,
            'offset'              => '',
            'order'               => 'date_post',
            'post_type'           => 'post',
            'meta_key'            => '',
            'post_in'             => '',
            'searchkey'           => '',
            'post_not_in'         => '',
            'tax_query'           => array(),
            'ignore_sticky_posts' => 1
        );

        $data = wp_parse_args( $data, $defaults );

        $params = array();

        $params['post_status']         = 'publish';
        if ( 'yes' == $data['ignore_sticky_posts'] ) {
        	$params['ignore_sticky_posts'] = 0;
		}else{
            $params['ignore_sticky_posts'] = 1;
        }
        $params['post_type']           = $data['post_type'];
        $params['no_found_rows']       = boolval( $data['no_found_rows'] );
        $params['tax_query']           = array();

        if ( ! empty( $data['posts_per_page'] ) ) {
            $params['posts_per_page'] = intval( $data['posts_per_page'] );
        }

        if ( ! empty( $data['post_in'] ) ) {
            if ( is_string( $data['post_in'] ) ) {
                $params['post__in'] = explode( ',', $data['post_in'] );
            } elseif ( is_array( $data['post_in'] ) ) {
                $params['post__in'] = $data['post_in'];
            }
        } elseif ( ! empty( $data['post_not_in'] ) ) {
            if ( is_array( $data['post_not_in'] ) ) {
                $params['post__not_in'] = $data['post_not_in'];
            } else {
                $params['post__not_in'] = explode( ',', $data['post_not_in'] );
            }
        }
        if ( ! empty( $data['categories'] ) && 'all' != $data['categories'] ) {
            if ( is_array( $data['categories'] ) ) {
                $params['cat'] = implode( ',', $data['categories'] );
            } elseif ( is_string( $data['categories'] ) ) {
                $params['cat'] = trim( $data['categories'] );
            }
        } elseif ( ! empty( $data['category'] ) && 'all' != $data['category'] ) {
            $params['cat'] = $data['category'];
        }

        if ( ! empty( $data['author'] ) ) {
            $params['author'] = $data['author'];
        }

        if ( ! empty( $data['format'] ) && 'post' == $data['post_type'] ) {
            if ( 'default' != $data['format'] ) {
                $params['tax_query'][] = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-' . trim( $data['format'] ) ),
                );
            } else {
                $params['tax_query'][] = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery', 'post-format-video', 'post-format-audio' ),
                    'operator' => 'NOT IN',
                );
            }
        }

            if ( ! empty( $data['searchkey'] ) ) {
                $params['s']   = sanitize_text_field($data['searchkey']);
            }

            if ( ! empty( $data['term_slugs'] ) && is_string( $data['term_slugs'] ) ) {
                $data['term_slugs'] = explode( ',', $data['term_slugs'] );
                if ( is_array( $data['term_slugs'] ) ) {
                    $params['tax_query'] = array( 'relation' => 'OR' );
                    foreach ( $data['term_slugs'] as $val ) {
                        array_push( $params['tax_query'], array(
                            'taxonomy' => $data['post_type_tax'],
                            'field'    => 'slug',
                            'terms'    => trim( $val )
                        ) );
                    }
                }
            }        

        if ( ! empty( $paged ) ) {
            $params['paged'] = intval( $paged );
        } elseif ( ! empty( $data['paged'] ) ) {
            $params['paged'] = intval( $data['paged'] );
        }

        if ( ! empty( $data['offset'] ) ) {
            if ( $paged > 1 ) {
                $params['offset'] = intval( $data['offset'] ) + intval( ( $paged - 1 ) * intval( $data['posts_per_page'] ) );
            } else {
                $params['offset'] = intval( $data['offset'] );
            }

            unset( $params['paged'] );
        }

        if ( ! empty( $data['tags'] ) ) {
            $data['tags']  = preg_replace( '/\s+/', '', $data['tags'] );
            $params['tag'] = $data['tags'];
        }

        if ( ! empty( $data['tag_in'] ) && is_array( $data['tag_in'] ) ) {
            $params['tag__in'] = $data['tag_in'];
        }

        if ( ! empty( $data['meta_key'] ) ) {
            $params['meta_key'] = $data['meta_key'];
            $params['orderby']  = 'meta_value_num';
        }

        switch ( $data['order'] ) {

            case 'date_post' :
                $params['orderby'] = 'date';
                $params['order']   = 'DESC';
            break;

            case 'comment_count' :
                $params['orderby'] = 'comment_count';
            break;            

            case 'rand':
                $params['orderby'] = 'rand';
            break;

            case 'update' :
                $params['orderby'] = 'modified';
                $params['order']   = 'DESC';
            break;

            case 'popular_most':
				$params['suppress_filters'] = false;
				$params['meta_key']           = 'post_views_count';
				$params['orderby']          = 'meta_value_num';
				$params['order']            = 'DESC';
			break;

			case 'popular_by_month':
				$params['suppress_filters'] = false;
				$params['meta_key']           = 'post_views_count';
				$params['orderby']          = 'meta_value_num';
				$params['order']            = 'DESC';
				$params['date_query']       = array(
					array(
						'after'  => '30 days ago',
						'column' => 'post_date_gmt',
					),
				);
			break;

			case 'popular_by_week':
				$params['suppress_filters'] = false;
				$params['meta_key']           = 'post_views_count';
				$params['orderby']          = 'meta_value_num';
				$params['order']            = 'DESC';
				$params['date_query']       = array(
					array(
						'after'  => '7 days ago',
						'column' => 'post_date_gmt',
					),
				);
			break;

            case 'alphabetical_order_decs':
                $params['orderby'] = 'title';
                $params['order']   = 'DECS';
                break;

            case 'alphabetical_order_asc':
                $params['orderby'] = 'title';
                $params['order']   = 'ASC';
            break;

            default :
                $params['orderby'] = 'date';
            break;
        }

        $query_data = new WP_Query( $params );
        do_action( 'bopea_after_post_query', $query_data );

        return $query_data;
    }
}

if ( ! function_exists( 'bopea_add_settings_tabs_links' ) ) {
    function bopea_add_settings_tabs_links( $type = 'category', $custom_data = '' ) {

        $data = array();

        switch ( $type ) {

            case 'category' :
                $data_cat = get_categories( array(
                    'include'    => esc_attr( $custom_data ),
                    'number'     => 10,
                    'hide_empty' => 1,
                ) );
                if ( ! empty( $custom_data ) ) {
                    $custom_cat_ids = explode( ',', $custom_data );
                    foreach ( $custom_cat_ids as $custom_cat_id_el ) {
                        $custom_cat_id_el = trim( $custom_cat_id_el );
                        foreach ( $data_cat as $data_cat_el ) {
                            if ( $custom_cat_id_el == $data_cat_el->cat_ID ) {
                                $data[] = array(
                                    'id'   => $data_cat_el->cat_ID,
                                    'name' => $data_cat_el->name
                                );
                            }
                        }
                    }
                } else {
                    foreach ( $data_cat as $data_cat_el ) {
                        $data[] = array(
                            'id'   => $data_cat_el->cat_ID,
                            'name' => $data_cat_el->name
                        );
                    }
                }
                break;

            case 'tag' :
                $data_tag = get_tags( array(
                        'include'    => esc_attr( $custom_data ),
                        'number'     => 10,
                        'hide_empty' => 1
                    )
                );
                if ( ! empty( $custom_data ) ) {
                    $custom_tag_ids = explode( ',', $custom_data );
                    foreach ( $custom_tag_ids as $custom_tag_id_el ) {

                        $custom_tag_id_el = trim( $custom_tag_id_el );
                        foreach ( $data_tag as $data_tag_el ) {
                            if ( $custom_tag_id_el == $data_tag_el->name ) {
                                $data[] = array(
                                    'id'   => $data_tag_el->slug,
                                    'name' => $data_tag_el->name
                                );
                            }
                        }
                    }
                } else {
                    foreach ( $data_tag as $data_tag_el ) {
                        $data[] = array(
                            'id'   => $data_tag_el->slug,
                            'name' => $data_tag_el->name
                        );
                    }
                }
                break;

            case 'author' :
                $data_author = get_users( array(
                        'who'     => 'authors',
                        'include' => esc_attr( $custom_data ),
                    )
                );
                if ( ! empty( $data_author ) && is_array( $data_author ) ) {
                    foreach ( $data_author as $data_author_el ) {
                        $data[] = array(
                            'id'   => $data_author_el->ID,
                            'name' => $data_author_el->display_name
                        );
                    };
                }
                break;
        };

        return $data;
    }
}

add_action( 'wp_ajax_nopriv_bopea_block_link', 'bopea_block_link' );
add_action( 'wp_ajax_bopea_block_link', 'bopea_block_link' );
if ( ! function_exists( 'bopea_block_link' ) ) {
    function bopea_block_link() {

        $module = array();
        $response = array( 'page_max' => '', 'content' => '' );
        if ( ! empty( $_POST['data'] ) ) {
            $module = bopea_module_opt( $_POST['data'] );
        }

        $query_data = bopea_query( $module );
        if ( $query_data->have_posts() ) {
            $response['page_max'] = $query_data->max_num_pages;
            $response['content']  = bopea_ajax_get_content( $module, $query_data );

            wp_reset_postdata();
        }

        wp_send_json( $response, null );
    }
}

if ( ! function_exists( 'bopea_sp_rd' ) ){
    function bopea_sp_rd( $query_data = null ) {
		if ( get_theme_mod('enable_read_progress', 0) == 0 ) {
			return;
		}
        ?>
        <div class="jl_rd_wrap">
            <div class="jl_rd_read" data-key=<?php echo esc_attr(get_the_ID());?>></div>
        </div>
    <?php
    }
}

if ( function_exists( 'amp_init' ) ){
	add_filter( 'amp_customizer_is_enabled', '__return_false' );
    add_filter( 'amp_post_template_file', 'bopea_amp_template_parts', 10, 3 );
	add_filter( 'amp_post_article_footer_meta', 'bopea_amp_args' );
    add_filter( 'amp_post_article_header_meta', 'bopea_amp_meta' );
	add_action( 'amp_post_template_css', 'bopea_amp_extra_css' );	
    add_action( 'amp_post_template_css', 'bopea_editor' );
}

function bopea_amp_template_parts( $file, $type, $post ) {
	if ( 'footer' === $type ) {
		$file = get_theme_file_path( 'inc/amp/footer.php' );
	} elseif ( 'article-footer' === $type ) {
		$file = get_theme_file_path( 'inc/amp/article-footer.php' );
	} elseif ( 'header-bar' === $type ) {
		$file = get_theme_file_path( 'inc/amp/header-bar.php' );
	}
	return $file;
}

function bopea_amp_args( $args ) {
	$args[] = 'article-footer';
	return $args;
}

function bopea_amp_meta( $meta_parts ) {
	if ( get_theme_mod( 'amp_author', 1 ) != 1 ) {
		foreach ( array_keys( $meta_parts, 'meta-author', true ) as $key ) {
			unset( $meta_parts[ $key ] );
		}
	}
	if ( get_theme_mod( 'amp_date', 1 ) != 1 ) {
		foreach ( array_keys( $meta_parts, 'meta-time', true ) as $key ) {
			unset( $meta_parts[ $key ] );
		}
	}
	return $meta_parts;
}

function bopea_amp_extra_css( $amp_template ) {?>
    .jl_logo_img{padding: 0px !important; max-width: <?php echo get_theme_mod( 'amp_head_logo_width', '100px' );?> !important; margin: 0px !important; display: flex;}
    .back-top{text-transform: uppercase; font-size: 11px; letter-spacing: 0.1em; color: <?php echo get_theme_mod( 'amp_footer_color', '#FFF' );?> !important; margin: 20px 0; right: 0; bottom: 0; position: relative;}
    .amp-sb-logo{color:<?php echo get_theme_mod( 'amp_sidebar_color', '#fff' );?>; font-weight: 700; margin-bottom: 20px;}
	amp-iframe { width: 100%; }
    .amp-wp-meta img{-o-object-fit: cover; object-fit: cover;}
    .amp-wp-byline amp-img, .amp-wp-byline .amp-wp-author, .amp-wp-meta{font-family: var(--jl-menu-font); letter-spacing: var(--jl-meta-font-space); font-size: var(--jl-meta-font-size); font-weight: var(--jl-meta-font-weight); text-transform: var(--jl-meta-transform);}
	.amp-wp-comments-link {padding: 0 20px; }
	.cb-aff-button .cb-icon-wrap { display: none; }
    .wp-block-quote p{font-family: var(--jl-title-font); font-weight: var(--jl-title-font-weight); text-transform: var(--jl-title-transform); letter-spacing: var(--jl-title-space) !important; line-height: var(--jl-title-line-height) !important; font-size: 22px !important; margin-bottom: 0px;}
    .wp-block-quote cite{margin-top: 15px; font-style: normal; font-size: 12px !important; line-height: 1.2; display: block; font-family: var(--jl-body-font); font-weight: var(--jl-body-font-weight);}
	.amp-wp-comments-link a { background: #111; border-radius: 0px; border: 0; color: #fff; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;  width: 100%; max-width: none; -webkit-box-sizing: border-box; box-sizing: border-box;}
	.amp-wp-comments-link a:hover, .amp-wp-comments-link a:visited, .amp-wp-comments-link a:focus { color: #fff; }
	.amp-wp-article-content{font-size: var(--jl-content-font-size); line-height: var(--jl-content-line-height); letter-spacing: var(--jl-content-spacing);font-family: var(--jl-body-font); font-weight: var(--jl-body-font-weight); }
    .amp-wp-article-content amp-img.alignleft { width: 50%; }
	.amp-wp-tax-category a, .amp-wp-tax-tag a { display: inline-block; border-radius: 20px; text-decoration: none; background: #111; color: #fff; padding: 0px 10px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; font-size: 9px; margin-left: 5px; margin-right: -5px;}
	body { background: <?php echo get_theme_mod( 'amp_content_bg', '#fff' );?>; color: <?php echo get_theme_mod( 'amp_content_color', '#000' );?>; }
	.amp-wp-title{font-size: var(--jl-single-title-small);font-family: var(--jl-title-font); font-weight: var(--jl-title-font-weight); text-transform: var(--jl-title-transform); letter-spacing: var(--jl-title-space); line-height: var(--jl-title-line-height); color: var(--jl-txt-color); margin-top: 0px; margin-bottom: 23px; clear: both; -ms-word-wrap: break-word; word-wrap: break-word;}
    .amp-wp-article, .amp-wp-title { color: <?php echo get_theme_mod( 'amp_content_color', '#000' );?>; }
	a, a:visited{ color: <?php echo get_theme_mod( 'amp_content_link', '#f00' );?>; }
	.amp-wp-footer { border-top: 0px; text-align: center; background: <?php echo get_theme_mod( 'amp_footer_bg', '#000' );?>; color: <?php echo get_theme_mod( 'amp_footer_color', '#FFF' );?>;}
	.amp-wp-footer .logo_link{display: flex; justify-content: center;}
    .amp-wp-footer .logo_link .jl_logo_img{margin-bottom: 20px !important; margin-top: 10px !important; max-width: <?php echo get_theme_mod( 'amp_footer_logo_width', '150px' );?> !important;}
    .amp-wp-article-content > p:first-child {margin-top:30px;}
    .amp-wp-article-content > p.has-drop-cap:first-letter {margin-top:10px; font-size: 90px;}
	.amp-wp-article-content .alignnone:not(figure), .amp-wp-article-content .aligncenter:not(figure) {  margin-right: -16px;   margin-left: -16px;   max-width: none; }	
    .amp-wp-footer a { color: <?php echo get_theme_mod( 'amp_footer_link', '#f00' );?>; }
	header.amp-wp-header, header.amp-wp-header a{ color: <?php echo get_theme_mod( 'amp_head_color', '#fff' );?>; }
    amp-sidebar#amp-sb a { color: <?php echo get_theme_mod( 'amp_sidebar_link', '#fff' );?>; }
    header.amp-wp-header .amp-header-inner{ max-width: 840px; display: flex; justify-content: space-between; padding: 0px 15px; margin: 0px auto; align-items: center;}	
	.related_posts_wrap {margin: 40px 0; padding: 0 20px; }
    .related_posts_wrap h3{color: <?php echo get_theme_mod( 'amp_content_color', '#000' );?>;}
    .related_posts_wrap h3, .related_posts_wrap h4, .amp-wp-footer div, amp-sidebar li *{font-family: var(--jl-title-font); font-weight: var(--jl-title-font-weight); text-transform: var(--jl-title-transform); letter-spacing: var(--jl-title-space); line-height: var(--jl-title-line-height); }
    .amp-wp-footer div{font-size: 14px;}
    .amp-wp-footer div div{padding: 10px 0px 0px 0px;}
    .related_post_items {margin-bottom: 20px; display: flex; align-items: center; gap: 15px;}
    .related_post_items a {text-decoration: none;display: flex; color: <?php echo get_theme_mod( 'amp_content_color', '#000' );?>;}
	.related_post_items .amp_img_w {line-height: 0; width: 75px; height: 75px; }	
	.related_post_items h4{margin: 0px;line-height: 1.2; font-size: 15px;}
    header.amp-wp-header {padding: 20px 0; top: 0; z-index: 2;}
	header.amp-wp-header { background: <?php echo get_theme_mod( 'amp_head_bg', '#000' );?>; }
    amp-sidebar { background: <?php echo get_theme_mod( 'amp_sidebar_bg', '#111' );?>; }
	header.amp-wp-header .logo {display: block; margin: 0 auto; padding: 0 20px; line-height: 0; }
	amp-sidebar {width: 80vw; padding: 30px 45px 30px 30px; -webkit-box-sizing: border-box; box-sizing: border-box; }
	amp-sidebar a {font-family: var(--jl-menu-font);font-size: var(--jl-menu-font-size); font-weight: var(--jl-menu-font-weight); text-transform: var(--jl-menu-transform); letter-spacing: var(--jl-menu-space); display: -webkit-box; display: -ms-flexbox; display: flex; -ms-flex-wrap: nowrap; flex-wrap: nowrap; -webkit-box-align: center; -ms-flex-align: center; align-items: center; white-space: nowrap;    text-decoration: none;}
	amp-sidebar li {margin-bottom: 7px; list-style: none; }
    .amp-wp-header .amp-header-logo{margin: 0px; max-width: unset; padding: 0px; font-weight: 700;}
	.amp-wp-header .header-right, .amp-wp-header .header-left {margin: 0; width: 30px; padding: 0px; cursor: pointer;max-width: unset;}
	.amp-sb-open {width: 30px; height: 2px; position: relative; margin: 0 auto; display: block; background: <?php echo get_theme_mod( 'amp_head_color', '#fff' );?>;}	
	.amp-sb-open:before, .amp-sb-open:after {width: inherit; display: block; height: inherit; background: inherit; content: ''; position: absolute; }
	.amp-sb-logo .logo {margin-bottom: 30px; }
	.amp-sb-open:before {top: -7px; }
	.amp-sb-open:after {top: 7px; }
	.amp-sb-close {width: 20px; height: 20px; position: absolute; top: 25px; right: 30px; cursor: pointer;}
	.amp-sb-close:before, .amp-sb-close:after {position: absolute; left: 10px; content: ''; height: 20px; width: 2px; background: <?php echo get_theme_mod( 'amp_sidebar_color', '#fff' );?>; }
	.amp-sb-close:before {transform: rotate(45deg); }
	.amp-sb-close:after {transform: rotate(-45deg); }
	.share-button-fb {background: #3b5998; margin-right: 20px; }
    .bopea-share-buttons { display: flex; gap: 10px; justify-content: space-between; padding: 20px;}
	amp-social-share.button__share {align-items: center; display: flex; justify-content: center; height: 44px !important; padding: 0px !important; margin: 0px !important; text-align: center; color: #fff; -webkit-transition: .2s ease-out; transition: .2s ease-out; list-style: none; flex-grow: 1; flex-basis: 0;}
	amp-social-share.button__share svg{width: 15px; height: auto; fill: #fff;}
    amp-social-share.button__share.share-button-pin svg{width: 12px;}
    .share-button-pin {margin-right: 20px; background: #bd081c; }
	.share-button-tw { background: #1da1f2; }
	.share-button-wa { background: #00ec67; }	
	.header-right { margin-left: auto; }
	.amp-ad-wrap { text-align: center; margin: 30px 0; }
	<?php
}

add_theme_support( 'woocommerce', array(
            'gallery_thumbnail_image_width' => 120,
            'thumbnail_image_width'         => 380,
            'single_image_width'            => 1000,
        ) );
add_action( 'woocommerce_before_shop_loop_item_title', 'bopea_buttons_wrapper_open', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bopea_buttons_wrapper_close', 95 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bopea_loop_product_thumbnail', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'bopea_loop_product_title', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 12 );
add_action( 'woocommerce_checkout_before_customer_details', 'bopea_checkout_customer_details_before' );
add_action( 'woocommerce_checkout_after_customer_details', 'bopea_checkout_customer_details_after' );
add_action( 'woocommerce_checkout_after_order_review', 'bopea_checkout_order_after' );
add_action( 'woocommerce_after_cart', 'bopea_cart_after', 20 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 25 );
add_action( 'woocommerce_before_single_product', 'bopea_single_product_before', 5 );
add_action( 'woocommerce_after_single_product', 'bopea_single_product_after', 25 );
add_action( 'woocommerce_before_single_product_summary', 'bopea_single_product_image_before', 1 );
add_action( 'woocommerce_before_single_product_summary', 'bopea_single_product_summary_before', 100 );
add_action( 'woocommerce_after_single_product_summary', 'bopea_single_product_summary_after', 1 );
add_action( 'woocommerce_after_main_content', 'woocommerce_get_sidebar', 5 );
add_action( 'woocommerce_before_shop_loop', 'bopea_wc_before_shop_loop', 5 );
add_action( 'woocommerce_no_products_found', 'bopea_wc_before_shop_loop', 5 );
add_action( 'woocommerce_after_shop_loop', 'bopea_wc_after_shop_loop', 99 );
add_action( 'woocommerce_no_products_found', 'bopea_wc_after_shop_loop', 99 );
add_action( 'woocommerce_after_main_content', 'bopea_wc_after_main_content', 10 );
add_action( 'woocommerce_before_shop_loop', 'bopea_wc_before_result_count', 19 );
add_action( 'woocommerce_before_shop_loop', 'bopea_wc_after_catalog_ordering', 31 );
add_action( 'woocommerce_before_main_content', 'bopea_remove_single_breadcrumb', 1 );
add_action( 'woocommerce_after_quantity_input_field', 'bopea_wc_quantity_button' );
add_filter( 'woocommerce_add_to_cart_fragments', 'bopea_wc_add_to_cart', 10 );
add_filter( 'woocommerce_output_related_products_args', 'bopea_wc_related_posts_per_page' );
add_filter( 'woocommerce_product_additional_information_heading', 'bopea_additional_information_heading' );
add_filter( 'woocommerce_get_image_size_single', 'bopea_wc_image_size_single', 10 );
add_filter( 'loop_shop_per_page', 'bopea_wc_shop_products_per_page', 99 );
add_filter( 'woocommerce_cross_sells_columns', 'bopea_wc_cross_sells_columns' );
add_filter( 'woocommerce_sale_flash', 'bopea_wc_sale_percent', 10, 3 );
add_filter( 'loop_shop_columns', 'bopea_wc_shop_columns' );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating' );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

if(function_exists('bopea_e_template')){
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); 
}

if ( ! function_exists( 'bopea_buttons_wrapper_open' ) ) :
    function bopea_buttons_wrapper_open() {
        echo '<div class="product-buttons  cart-tooltips">';
    }
endif;


if ( ! function_exists( 'bopea_buttons_wrapper_close' ) ) :
    function bopea_buttons_wrapper_close() {
        echo '</div>';
    }
endif;


if ( ! function_exists( 'bopea_loop_product_title' ) ) :
    function bopea_loop_product_title() {
        ?>
        <h2 class="woocommerce-loop-product__title h4">
            <a href="<?php echo get_the_permalink(); ?>" class="woocommerce-loop-product-link p-url"><?php the_title(); ?></a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_loop_product_thumbnail' ) ) :
    function bopea_loop_product_thumbnail() {
        ?>
        <a href="<?php echo get_the_permalink(); ?>" class="woocommerce-loop-product-link"> <?php echo woocommerce_get_product_thumbnail(); ?></a>
    <?php
    }
endif;


if ( ! function_exists( 'bopea_checkout_customer_details_before' ) ):
    function bopea_checkout_customer_details_before() {
        ?>
        <div class="checkout-col col-left">
    <?php
    }

endif;

if ( ! function_exists( 'bopea_checkout_customer_details_after' ) ):
    function bopea_checkout_customer_details_after() {
        ?>
        </div><div class="checkout-col col-right">
    <?php
    }

endif;


if ( ! function_exists( 'bopea_checkout_order_after' ) ):
    function bopea_checkout_order_after() {
        ?>
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_cart_after' ) ):
    function bopea_cart_after() {
        ?>
        <div class="clearfix"></div>
    <?php
    }
endif;


if ( ! function_exists( 'bopea_single_product_before' ) ):
    function bopea_single_product_before() {
        ?>
        <div class="single-product-wrap clearfix">
    <?php
    }

endif;

if ( ! function_exists( 'bopea_single_product_after' ) ):
    function bopea_single_product_after() {
        ?>
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_single_product_image_before' ) ):
    function bopea_single_product_image_before() {
        ?>
        <div class="jl-wc-wrap single-product-content"><div class="jl-wc-img"><div class="wc-single-featured">
    <?php
    }
endif;

if ( ! function_exists( 'bopea_single_product_summary_before' ) ):
function bopea_single_product_summary_before() {
    ?>
    </div></div>
    <div class="jl-wc-dec">
<?php
}
endif;

if ( ! function_exists( 'bopea_single_product_summary_after' ) ):
    function bopea_single_product_summary_after() {
        ?>
        </div></div>
    <?php
    }
endif;

if ( ! function_exists( 'bopea_additional_information_heading' ) ) :
    function bopea_additional_information_heading( $heading ) {
        return false;
    }
endif;


if ( ! function_exists( 'bopea_wc_image_size_single' ) ) :
    function bopea_wc_image_size_single( $size ) {

        if ( ! empty( $size['width'] ) ) {
            $size['height'] = intval( $size['width'] * 1.5 );
        }
        $size['crop'] = 1;

        return $size;
    }
endif;

if ( ! function_exists( 'bopea_wc_related_posts_per_page' ) ) :
    function bopea_wc_related_posts_per_page( $args ) {
        $total                  = 4;
        $args['posts_per_page'] = $total;
        $args['columns']        = 4;

        return $args;
    }

endif;

if ( ! function_exists( 'bopea_wc_cross_sells_columns' ) ) :
    function bopea_wc_cross_sells_columns( $columns ) {
        return 4;
    }

endif;

if ( ! function_exists( 'bopea_wc_before_shop_loop' ) ):
    function bopea_wc_before_shop_loop() {
        if ( is_shop() ):
            $bopea_wc_sidebar          = '';
            $bopea_wc_sidebar_position = '';
        elseif ( is_product_category() ) :
            $bopea_wc_sidebar          = '';
            $bopea_wc_sidebar_position = '';
        endif;
        if ( ! empty( $bopea_wc_sidebar ) && ! empty( $bopea_wc_sidebar_position ) ) : ?>
            <div class="page-content jl-content-section is-sidebar-<?php echo esc_attr( $bopea_wc_sidebar_position ) ?>">
            <div class="jl-container">
            <div class="jl-content">
            <div class="content-wrap">
        <?php else: ?>
            <div class="page-content jl-content-section none-sidebar">
            <div class="jl-container">
            <div class="jl-content">
            <div class="content-wrap">
        <?php endif;
    }
endif;

if ( ! function_exists( 'bopea_wc_after_shop_loop' ) ):
    function bopea_wc_after_shop_loop() {
        echo '</div></div>';
    }
endif;

if ( ! function_exists( 'bopea_wc_after_main_content' ) ) {
    function bopea_wc_after_main_content() {
        echo '</div></div>';
    }
}

if ( ! function_exists( 'bopea_wc_before_result_count' ) ) {
    function    bopea_wc_before_result_count() {
        echo '<aside class="result-wrap">';
    }
}

if ( ! function_exists( 'bopea_wc_after_catalog_ordering' ) ) {
    function bopea_wc_after_catalog_ordering() {
        echo '</aside>';
    }
}

if ( ! function_exists( 'bopea_wc_shop_columns' ) ) {
    function bopea_wc_shop_columns() {

        if ( is_shop() ):
            $bopea_wc_sidebar = '';
        elseif ( is_product_category() ) :
            $bopea_wc_sidebar = '';
        endif;
        if ( ! empty( $bopea_wc_sidebar ) ) {
            return 3;
        } else {
            return 4;
        }
    }
}

if ( ! function_exists( 'bopea_wc_sale_percent' ) ):
    function bopea_wc_sale_percent( $html, $post, $product ) {
        $sale_percent = '';
        if ( empty( $sale_percent ) || 0 == $product->get_regular_price() ) {
            return $html;
        } else {
            $attachment_ids = $product->get_gallery_image_ids();
            $atts_style     = 'onsale percent ';
            if ( empty( $attachment_ids ) ) {
                $atts_style = 'onsale percent without-gallery';
            }
            $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );

            return '<span class="' . esc_attr( $atts_style ) . '"><span class="onsale-inner"><strong>' . '-' . esc_html( $percentage ) . '</strong><i>&#37;' . '</i></span></span>';
        }
    }
endif;

if ( ! function_exists( 'bopea_wc_add_to_cart' ) ) {
    function bopea_wc_add_to_cart( $fragments ) {
        ob_start(); ?>
        <span class="cart-counter jl_count_cart"><?php echo sprintf( '%d', WC()->cart->cart_contents_count ); ?></span>
        <?php
        $fragments['.jl_i_cart .cart-counter'] = ob_get_clean();

        $mini_cart = $fragments['div.widget_shopping_cart_content'];
        unset( $fragments['div.widget_shopping_cart_content'] );
        $fragments['div.jl-cart-wrap'] = '<div class="jl-cart-wrap woocommerce">' . $mini_cart . '</div>';

        return $fragments;
    }
}

if ( ! function_exists( 'bopea_wc_shop_products_per_page' ) ) {
    function bopea_wc_shop_products_per_page( $total ) {
        $posts_per_page = 12;
        if ( ! empty( $posts_per_page ) ) {
            $total = $posts_per_page;
        }

        return $total;
    }
}

if ( ! function_exists( 'bopea_remove_single_breadcrumb' ) ) {
    function bopea_remove_single_breadcrumb() {
        if ( is_product() ) {
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
        }
    }
}

if ( ! function_exists( 'bopea_wc_quantity_button' ) ) {
    function bopea_wc_quantity_button() {
        ?>
        <span class="jlb-btn up"></span>
        <span class="jlb-btn down"></span>
    <?php
    }
}