<?php 
add_action( 'wp_enqueue_scripts', 'bopea_child_enqueue_styles', 100);
function bopea_child_enqueue_styles() {
	wp_enqueue_style( 'bopea-child-style', get_stylesheet_directory_uri() . '/style.css', '', 1.0 );
}

add_action('wp_enqueue_scripts', 'jl_custom_script_fix', 100);
function jl_custom_script_fix()
{
    wp_dequeue_script('bopea-custom');
	wp_enqueue_script( 'bopea-custom2', get_stylesheet_directory_uri().'/js/custom2.min.js', array('jquery'));
	wp_localize_script( 'bopea-custom2', 'jlParamsOpt',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'opt_dark' => get_theme_mod('enable_dark_skin'),
      ));
      //wp_enqueue_script( 'mycustomscript', get_stylesheet_directory_uri().'/js/mycustom.js', array('jquery'));
}
function preload_lcp(){
if ( !is_front_page() ) {
        return;
    }
  $args = array( 
        'numberposts' => '3',
        'cat' => '-297' 
    );

    $recent_posts = wp_get_recent_posts( $args );

    foreach( $recent_posts as $recent ):
        $post_id        = $recent['ID'];
        $post_url       = get_permalink($recent['ID']);
        $post_title     = $recent['post_title'];
        $post_content   = $recent['post_content'];
        $post_thumbnail = get_the_post_thumbnail($recent['ID']);
        $imglink        = get_the_post_thumbnail_url($recent['ID'],'bopea_large');
        echo '<link rel="preload" fetchpriority="high" as="image" type="image/webp" href="'.$imglink.'" />';
    endforeach;

    echo '<link rel="preload" fetchpriority="high" as="image" type="image/webp" media="(max-width: 600px)" href="/wp-content/uploads/2024/10/main-solution-test-mobile.webp" />';
    echo '<link rel="preload" fetchpriority="high" as="image" type="image/webp" media="(min-width: 601px)" href="/wp-content/uploads/2024/10/main-solution-test-desktop-2.webp" />';
}
add_action('wp_head', 'preload_lcp', 1000);

function bannerpolyfill(){
    echo '<script src="https://unpkg.com/webp-hero@0.0.2/dist-cjs/polyfills.js"></script>
<script src="https://unpkg.com/webp-hero@0.0.2/dist-cjs/webp-hero.bundle.js"></script><script>
	var webpMachine = new webpHero.WebpMachine()
	webpMachine.polyfillDocument()
</script>';
}
add_action('wp_footer','bannerpolyfill');

function fb_image_meta() {
    return '<meta property="og:image" content="/wp-content/uploads/2024/08/dg-logo.webp" />';
}

add_action('wp_head', 'fb_image_meta', 10);



function fb_pixel() {
    echo <<<'EOD'
    <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1262270931863537');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1262270931863537&ev=PageView&noscript=1"
/></noscript>
EOD;
}

add_action('wp_head', 'fb_pixel', 10);

/*add_shortcode( 'attaccante-mobile','attaccantemobile'  );
function attaccantemobile() {
    return '<div id="banner-attaccante-mobile"><a id="link-banner-am" alt="" href="" target="_blank"  style="border-radius:10px;"><img id="img-banner-am" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'attaccante-desktop','attaccantedesktop'  );
function attaccantedesktop() {
    return '<div id="banner-attaccante-desktop"><a id="link-banner-ad" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-ad" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'centrocampo-mobile','centrocampomobile'  );
function centrocampomobile() {
    return '<div id="banner-centrocampo-mobile"><a id="link-banner-cm" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-cm" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'centrocampo-desktop','centrocampodesktop'  );
function centrocampodesktop() {
    return '<div id="banner-centrocampo-desktop"><a id="link-banner-cd" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-cd" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'difensore-mobile','difensoremobile'  );
function difensoremobile() {
    return '<div id="banner-difensore-mobile"><a id="link-banner-dm" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-dm" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'difensore-desktop','difensoredesktop'  );
function difensoredesktop() {
    return '<div id="banner-difensore-desktop"><a id="link-banner-dd" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-dd" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'contatti-desktop','contattidesktop'  );
function contattidesktop() {
    return '<div id="banner-contatti-desktop"><a id="link-banner-contatti-desktop" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-contatti-desktop" loading="lazy" alt="" src=""></img></a></div>';
}
add_shortcode( 'contatti-mobile','contattimobile'  );
function contattimobile() {
    return '<div id="banner-contatti-mobile"><a id="link-banner-contatti-mobile" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-contatti-mobile" loading="lazy" alt="" src=""></img></a></div>';
}*/


//VIEWS
if ( !function_exists( 'bopea_single_meta_list' ) ) {
  function bopea_single_meta_list() {
    $enable_sponsored_post = get_post_meta( get_the_ID(), 'enable_sponsored_post', true );
    $author_id = get_post_field( 'post_author', get_the_ID() );
    $jl_sg_author = get_theme_mod('jl_sg_author', 'jl_au_sm');
    if(!empty($enable_sponsored_post)){
      bopea_sponsored();
    }else{
      if($jl_sg_author == 'jl_au_l'){
          echo '<span class="jl_post_meta jl_slimeta jl_au_lw">';
          if(get_theme_mod('disable_post_meta_author') !=1){
              echo '<span class="jl_author_img_w '.$jl_sg_author.'">';
                echo '<span class="jl_aimg_in"><a href="'.get_author_posts_url( $author_id ).'">';            
                echo get_avatar(get_the_author_meta('ID'), 120, '', '', array( 'class' => 'lazyload' ));
                echo '</a></span>';              
              echo '</span>';
          }
          echo '<span class="jl_mt_rw">';
          echo '<span class="jl_mt_t">';
          if(get_theme_mod('disable_post_meta_author') !=1){
            echo '<span class="jl_author_img_w">';
            echo bopeatxt::bopea_s_by();
            echo the_author_posts_link();
            echo '</span>';
          }
          if(get_theme_mod('disable_post_date') !=1){
            $enable_updated_date = get_theme_mod('enable_updated_date');
            if ( !empty( $enable_updated_date ) ){
              $date_label = bopeatxt::bopea_s_updated().' ';
            }else{
              $date_label = '';
            }        
            echo '<span class="post-date">'.$date_label.get_the_date().'</span>';
          }
          echo '</span>';
          echo '<span class="jl_mt_b">';
          if(get_theme_mod('disable_post_readtime') !=1){
            echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
          }
          if(get_theme_mod('disable_post_view') !=1){
            if(function_exists('bopea_bac_PostViews')){
            /* echo '<span class="jl_view_options">'; */        
            bopea_bac_PostViews(get_the_ID());        
            /* echo '</span>'; */
            }
          }
          if(!empty(get_theme_mod('disable_post_view'))){
            if(function_exists('bopea_bac_PostViews')){
            /* echo '<span class="jl_view_none">'; */        
            bopea_bac_PostViews(get_the_ID());        
            /* echo '</span>'; */
            }
          }
          echo '</span>';
          echo '</span>';
          echo'</span>';

      }else{
        echo '<span class="jl_post_meta jl_slimeta">';
        if(get_theme_mod('disable_post_meta_author') !=1){
            echo '<span class="jl_author_img_w '.$jl_sg_author.'">';
            if($jl_sg_author == 'jl_au_sm' || $jl_sg_author == 'jl_au_md'){
              echo '<span class="jl_aimg_in"><a href="'.get_author_posts_url( $author_id ).'">';            
              echo get_avatar(get_the_author_meta('ID'), 50, '', '', array( 'class' => 'lazyload' ));
              echo '</a></span>';
            }else{
              echo bopeatxt::bopea_s_by();
            }
            echo the_author_posts_link();
            echo '</span>';
        }
        if(get_theme_mod('disable_post_date') !=1){
          $enable_updated_date = get_theme_mod('enable_updated_date');
          if ( !empty( $enable_updated_date ) ){
            $date_label = bopeatxt::bopea_s_updated().' ';
          }else{
            $date_label = '';
          }        
          echo '<span class="post-date">'.$date_label.get_the_date().'</span>';
        }
        if(get_theme_mod('disable_post_readtime') !=1){
          echo '<span class="post-read-time"><i class="jli-timer"></i>'.bopea_read_time().'</span>';
        }
        if(get_theme_mod('disable_post_view') !=1){
          if(function_exists('bopea_bac_PostViews')){
          /* echo '<span class="jl_view_options">';         */
          bopea_bac_PostViews(get_the_ID());        
          /* echo '</span>'; */
          }
        }

        if(!empty(get_theme_mod('disable_post_view'))){
          if(function_exists('bopea_bac_PostViews')){
          /* echo '<span class="jl_view_none">';      */   
          bopea_bac_PostViews(get_the_ID());        
          /* echo '</span>'; */
          }
        }
        echo'</span>';        
      }
    }
  }
}

function mypopup(){
?>
<div id="modal-container" class="relative hidden" style="z-index:99999999;">
    <div id="modal-background" class="modal-background" aria-hidden="true"></div>
    <div class="modal-wrapper">
        <div class="modal-centered">
            <div id="modal-panel" class="modal-panel">
                <div class="modal-content">
                    <div class="modal-image-container">
                        <picture class="mypopupimage">
                            <source media="(max-width: 600px)" srcset="/wp-content/uploads/2025/09/popup-un-milione-mobile.webp" />
                            <source media="(min-width: 601px)" srcset="/wp-content/uploads/2025/09/popup-un-milione-desktop.webp" />
                            <img src="/wp-content/uploads/2025/09/popup-un-milione-mobile.webp" 
                                 alt="Popup Un Milione" />
                        </picture>
                    </div>
                </div>
                
                <button type="button" id="modal-close-button" class="modal-close-btn" aria-label="Chiudi popup">
                    ✕
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Reset e base */
#modal-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99999999;
}

#modal-container.hidden {
    display: none;
}

/* Background overlay */
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.75);
    transition: opacity 200ms ease-in-out;
}

/* Wrapper principale */
.modal-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow-y: auto;
    z-index: 10;
}

/* Centraggio del modal */
.modal-centered {
    display: flex;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    text-align: center;
}

/* Pannello principale del modal */
.modal-panel {
    position: relative;
    background: white;
    border-radius: 10px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transition: all 200ms ease-in-out;
    transform: scale(1);
    opacity: 1;
    
    /* Dimensioni responsive */
    width: 100%;
    max-width: 90vw;
    max-height: 90vh;
    
    /* Margini di sicurezza */
    margin: 1rem;
}

/* Contenuto del modal */
.modal-content {
    background: white;
    border-radius: 10px;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Container dell'immagine */
.modal-image-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    max-height: 75vh;
}

/* Immagine */
.mypopupimage {
    width: 100%;
    height: 100%;
    max-height: 70vh;
    display: block;
}

.mypopupimage img {
    width: 100%;
    height: 100%;
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 6px;
}

/* Pulsante di chiusura */
.modal-close-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
	padding:0;
    background-color: #cd1316;
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 200ms ease-in-out;
    z-index: 20;
}

.modal-close-btn:hover {
    background-color: #a00f12;
    transform: scale(1.05);
}

.modal-close-btn:active {
    transform: scale(0.95);
}

/* Animazioni di chiusura */
.modal-container-hidden {
    opacity: 0 !important;
    transition: opacity 200ms ease-out;
}

.modal-background-hidden {
    opacity: 0 !important;
    transition: opacity 200ms ease-out;
}

.modal-panel-hidden {
    opacity: 0 !important;
    transform: scale(0.95) !important;
    transition: opacity 200ms ease-out, transform 200ms ease-out;
}

/* Responsive - Tablet */
@media (min-width: 640px) {
    .modal-centered {
        padding: 0;
    }
    
    .modal-panel {
        max-width: 85vw;
        max-height: 85vh;
        margin: 2rem;
    }
    
    .modal-image-container {
        max-height: 80vh;
    }
    
    .mypopupimage {
        max-height: 75vh;
    }
    
    .modal-close-btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}

/* Responsive - Desktop */
@media (min-width: 768px) {
    .modal-panel {
        max-width: 80vw;
        max-height: 80vh;
    }
}

@media (min-width: 1024px) {
    .modal-panel {
        max-width: 70vw;
        max-height: 80vh;
    }
    
    .modal-image-container {
    }
}

@media (min-width: 1280px) {
    .modal-panel {
        max-width: 60vw;
        max-height: 80vh;
    }
}

/* Schermi molto grandi */
@media (min-width: 1920px) {
    .modal-panel {
        max-width: 50vw;
        max-height: 70vh;
    }
}

/* Schermi molto piccoli */
@media (max-width: 320px) {
    .modal-panel {
        margin: 0.5rem;
        max-height: 95vh;
    }
    
    .modal-image-container {
        max-height: 85vh;
    }
    
    .mypopupimage {
        max-height: 80vh;
    }
    
    .modal-close-btn {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
}

/* Schermi bassi (landscape su mobile) */
@media (max-height: 600px) {
    .modal-panel {
        max-height: 95vh;
    }
    
    .modal-image-container {
        max-height: 80vh;
    }
    
    .mypopupimage {
        max-height: 70vh;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var mb = document.getElementById('modal-background');
    var mp = document.getElementById('modal-panel');
    var mcontainer = document.getElementById('modal-container');
    var mcb = document.getElementById('modal-close-button');
    
    // Tempo in millisecondi (3 ore = 10800000 ms)
    var expireTime = 3 * 60 * 60 * 1000;
    var lastClosed = localStorage.getItem('popupClosedTime');
    
    function showModal() {
        if (mcontainer && mb && mp) {
            mcontainer.style.display = 'block';
            mcontainer.classList.remove('hidden', 'modal-container-hidden');
            mb.classList.remove('modal-background-hidden');
            mp.classList.remove('modal-panel-hidden');
        }
    }
    
    function hideModal() {
        if (mcontainer && mb && mp) {
            mcontainer.classList.add('modal-container-hidden');
            mb.classList.add('modal-background-hidden');
            mp.classList.add('modal-panel-hidden');
            
            setTimeout(() => {
                if (mcontainer) {
                    mcontainer.style.display = 'none';
                    mcontainer.classList.add('hidden');
                }
            }, 200);
            
            // Salva timestamp della chiusura
            localStorage.setItem('popupClosedTime', new Date().getTime());
        }
    }
    
    // Controllo se mostrare il popup
    if (lastClosed) {
        var now = new Date().getTime();
        if (now - lastClosed < expireTime) {
            // Popup chiuso da meno di 3 ore → non mostrarlo
            if (mcontainer) {
                mcontainer.style.display = 'none';
                mcontainer.classList.add('hidden');
            }
        } else {
            // Scaduto il tempo → reset e mostra
            localStorage.removeItem('popupClosedTime');
            showModal();
        }
    } else {
        // Nessuna chiusura salvata → mostra popup
        showModal();
    }
    
    // Eventi di chiusura
    if (mcb) {
        mcb.addEventListener('click', hideModal);
    }
    
    // Chiusura cliccando sul background
    if (mb) {
        mb.addEventListener('click', hideModal);
    }
    
    // Chiusura con tasto ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mcontainer && !mcontainer.classList.contains('modal-container-hidden')) {
            hideModal();
        }
    });
    
    // Gestione ridimensionamento finestra
    window.addEventListener('resize', function() {
        if (mcontainer && !mcontainer.classList.contains('hidden')) {
            // Piccolo delay per permettere al browser di completare il resize
            setTimeout(() => {
                var img = mcontainer.querySelector('img');
                if (img && img.naturalHeight > 0) {
                    var maxHeight = Math.min(window.innerHeight * 0.7, img.naturalHeight);
                    img.parentElement.style.maxHeight = maxHeight + 'px';
                }
            }, 100);
        }
    });
});
</script>
<?php
}
//add_action('wp_body_open', 'mypopup');


function wpdocs_remove_website_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}

add_filter( 'comment_form_default_fields', 'wpdocs_remove_website_field' );

function script_adsense() {
    ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2912739048013110"
     crossorigin="anonymous"></script>
    <?php
}
add_action('wp_head', 'script_adsense');
?>