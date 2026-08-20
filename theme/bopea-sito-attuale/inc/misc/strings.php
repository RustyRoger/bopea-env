<?php
class bopeatxt {
	public static function bopea_s_home() {
		$string = get_theme_mod('bopea_s_home');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Home', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_load_more() {
		$string = get_theme_mod('bopea_s_load_more');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'load more', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_by() {
		$string = get_theme_mod('bopea_s_by');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'By', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_updated() {
		$string = get_theme_mod('bopea_s_updated');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Updated', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_ago() {
		$string = get_theme_mod('bopea_s_ago');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Ago', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_mins_read() {
		$string = get_theme_mod('bopea_s_mins_read');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Mins read', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_views() {
		$string = get_theme_mod('bopea_s_views');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Views', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_previous_post() {
		$string = get_theme_mod('bopea_s_previous_post');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Previous post', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_next_post() {
		$string = get_theme_mod('bopea_s_next_post');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Next post', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_written_by() {
		$string = get_theme_mod('bopea_s_written_by');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Written by', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_via() {
		$string = get_theme_mod('bopea_s_via');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Via:', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_soruce() {
		$string = get_theme_mod('bopea_s_soruce');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Sources:', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_summary() {
		$string = get_theme_mod('bopea_s_summary');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Summary', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_the_pros() {
		$string = get_theme_mod('bopea_s_the_pros');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('The Pros', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_the_cons() {
		$string = get_theme_mod('bopea_s_the_cons');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('The Cons', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_share() {
		$string = get_theme_mod('bopea_s_share');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Share', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_tweet() {
		$string = get_theme_mod('bopea_s_tweet');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Tweet', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_pin() {
		$string = get_theme_mod('bopea_s_pin');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Pin', 'bopea');
		}
		return $string;
	}

	public static function bopea_s_comments() {
		$string = get_theme_mod('bopea_s_comments');
		if ( !empty( $string ) ){
			$string = '%s '.$string;
		}else{
			$string = '%s '.esc_html__( 'Comments', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_comment() {
		$string = get_theme_mod('bopea_s_comment');
		if ( !empty( $string ) ){
			$string = '1 '.$string;
		}else{
			$string = '1 '.esc_html__( 'Comment', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_comments_box() {
		$string = get_theme_mod('bopea_s_comments');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Comments', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_old_comment() {
		$string = get_theme_mod('bopea_s_old_comment');
		if ( !empty( $string ) ){
			$string = '&larr; '.$string;
		}else{
			$string = esc_html__( 'Older Comments', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_new_comment() {
		$string = get_theme_mod('bopea_s_new_comment');
		if ( !empty( $string ) ){
			$string = $string.' &rarr;';
		}else{
			$string = esc_html__( 'Newer Comments', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_comment_closed() {
		$string = get_theme_mod('bopea_s_comment_closed');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Comments are closed.', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_leave_a_comment() {
		$string = get_theme_mod('bopea_s_leave_a_comment');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Leave a comment', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_your_name() {
		$string = get_theme_mod('bopea_s_your_name');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Your name', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_your_email() {
		$string = get_theme_mod('bopea_s_your_email');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Your email', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_your_website() {
		$string = get_theme_mod('bopea_s_your_website');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Your Website', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_related_articles() {
		$string = get_theme_mod('bopea_s_related_articles');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Related Articles', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_type_to_search() {
		$string = get_theme_mod('bopea_s_type_to_search');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Type to search...', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_search() {
		$string = get_theme_mod('bopea_s_search');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Search', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_articles() {
		$string = get_theme_mod('bopea_s_articles');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Articles', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_search_result_for() {
		$string = get_theme_mod('bopea_s_search_result_for');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__('Search Result for: ', 'bopea');
		}
		return $string;
	}	

	public static function bopea_s_404_title() {
		$string = get_theme_mod('bopea_s_404_title');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Oops! This page can’t be found', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_404_desc() {
		$string = get_theme_mod('bopea_s_404_desc');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'The page you are looking for doesn’t exist. It may have been moved or removed. Please try searching for some other page.', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_back_to_home() {
		$string = get_theme_mod('bopea_s_back_to_home');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Back to Home', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_filter_products() {
		$string = get_theme_mod('bopea_s_filter_products');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Filter products', 'bopea' );
		}
		return $string;
	}

	public static function bopea_clear_filter() {
		$string = get_theme_mod('bopea_clear_filter');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Clear Filters', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_shop() {
		$string = get_theme_mod('bopea_s_shop');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Shop', 'bopea' );
		}
		return $string;
	}

	public static function bopea_s_sponsored_by() {
		$string = get_theme_mod('bopea_s_sponsored_by');
		if ( !empty( $string ) ){
			$string = $string;
		}else{
			$string = esc_html__( 'Sponsored By', 'bopea' );
		}
		return $string;
	}

}
new bopeatxt();