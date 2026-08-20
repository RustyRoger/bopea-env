<?php
get_header(); 
$jl_archive_search = get_theme_mod('jl_archive_search', 'archive7');
get_template_part('inc/misc/tpl', $jl_archive_search);    
get_footer();
?>