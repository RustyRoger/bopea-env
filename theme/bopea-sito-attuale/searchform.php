<form method="get" class="searchform_theme" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" placeholder="<?php echo bopeatxt::bopea_s_type_to_search(); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="search_btn" />
    <button type="submit" class="button"><span class="jl_sebtn"><?php echo bopeatxt::bopea_s_search(); ?></span></button>
</form>