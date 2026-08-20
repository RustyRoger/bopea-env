<?php
get_header(); 
$jl_archive_layout = get_theme_mod('jl_archive_layout', 'archive7');
get_template_part('inc/misc/tpl', $jl_archive_layout );    
get_footer();
?>