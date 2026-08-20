<?php
get_header(); 
$jl_archive_tag = get_theme_mod('jl_archive_tag', 'archive7');
get_template_part('inc/misc/tpl', $jl_archive_tag);    
get_footer();
?>