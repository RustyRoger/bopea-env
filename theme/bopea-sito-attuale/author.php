<?php
get_header(); 
$jl_archive_author = get_theme_mod('jl_archive_author', 'archive7');
get_template_part('inc/misc/tpl', $jl_archive_author );    
get_footer();
?>