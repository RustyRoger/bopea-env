<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( post_password_required() ) {
	return false;
}?>
    <div id="comments" class="comments-area">
		<?php if ( have_comments() ) : ?>
            <div class="jl_commentlist_wrap">
                <ul class="jl_commentlist">
					<?php wp_list_comments( array(
							'avatar_size' => 100,
							'style'       => 'ul',
							'short_ping'  => true,
						)
					);
					?>
                </ul>
				<?php the_comments_pagination( array(
						'prev_text' => '<span class="jl_nav_previous">' . bopeatxt::bopea_s_old_comment() . '</span>',
						'next_text' => '<span class="jl_nav_next">' . bopeatxt::bopea_s_new_comment() . '</span>',
					)
				); ?>
            </div>
		<?php endif;
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
            <p class="no-comments"><?php echo bopeatxt::bopea_s_comment_closed(); ?></p>
		<?php endif; ?>
		<?php comment_form(); ?>
    </div>