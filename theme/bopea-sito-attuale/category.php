<?php
get_header(); 
$jl_archive_category = get_theme_mod('jl_archive_category', 'archive7');
get_template_part('inc/misc/tpl', $jl_archive_category );    
get_footer();
?>