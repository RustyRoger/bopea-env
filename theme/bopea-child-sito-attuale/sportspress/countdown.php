<?php
/**
 * Countdown
 *
 * @author      ThemeBoy
 * @package     SportsPress/Templates
 * @version   2.7.9
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$defaults = array(
	'team' => null,
	'calendar' => null,
	'order' => null,
	'orderby' => null,
	'league' => null,
	'season' => null,
	'id' => null,
	'title' => null,
	'live' => get_option('sportspress_enable_live_countdowns', 'yes') == 'yes' ? true : false,
	'link_events' => get_option('sportspress_link_events', 'yes') == 'yes' ? true : false,
	'link_teams' => get_option('sportspress_link_teams', 'no') == 'yes' ? true : false,
	'link_venues' => get_option('sportspress_link_venues', 'no') == 'yes' ? true : false,
	'show_logos' => get_option('sportspress_countdown_show_logos', 'no') == 'yes' ? true : false,
	'show_thumbnail' => get_option('sportspress_countdown_show_thumbnail', 'no') == 'yes' ? true : false,
);

if (isset($show_excluded) && $show_excluded) {
	$excluded_statuses = array();
} else {
	$excluded_statuses = apply_filters(
		'sp_countdown_excluded_statuses',
		array(
			'postponed',
			'cancelled',
		)
	);
}

if (isset($id)):
	$post = get_post($id);
elseif ($calendar):
	$calendar = new SP_Calendar($calendar);
	if ($team) {
		$calendar->team = $team;
	}
	$calendar->status = 'future';
	if ($order) {
		$calendar->order = $order;
	} else {
		$calendar->order = 'ASC';
	}
	if ($orderby) {
		$calendar->orderby = $orderby;
	}
	$data = $calendar->data();

	/**
	 * Exclude postponed or cancelled events.
	 */
	while ($post = array_shift($data)) {
		$sp_status = get_post_meta($post->ID, 'sp_status', true);
		if (!in_array($sp_status, $excluded_statuses)) {
			break;
		}
	}
else:
	$args = array();
	if (isset($team)) {
		$args['meta_query'] = array(
			array(
				'key' => 'sp_team',
				'value' => $team,
			),
		);
	}
	if (isset($league) || isset($season)) {
		$args['tax_query'] = array('relation' => 'AND');

		if (isset($league)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'sp_league',
				'terms' => $league,
			);
		}

		if (isset($season)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'sp_season',
				'terms' => $season,
			);
		}
	}

	/**
	 * Exclude postponed or cancelled events.
	 */
	$args['meta_query'][] = array(
		'key' => 'sp_status',
		'compare' => 'NOT IN',
		'value' => $excluded_statuses,
	);

	$post = sp_get_next_event($args);
endif;

extract($defaults, EXTR_SKIP);

if (!isset($post) || !$post) {
	return;
}

if ($title) {
	echo '<h4 class="sp-table-caption">' . wp_kses_post($title) . '</h4>';
}

$title = $post->post_title;
if ($link_events) {
	$title = '<a href="' . get_post_permalink($post->ID, false, true) . '">' . $title . '</a>';
}
if (isset($show_status) && $show_status) {
	$sp_status = get_post_meta($post->ID, 'sp_status', true);
	// Avoid Undefined index warnings if no status is set (i.e. during import)
	if ($sp_status == '') {
		$sp_status = 'ok';
	}
	$statuses = apply_filters(
		'sportspress_event_statuses',
		array(
			'ok' => esc_attr__('On time', 'sportspress'),
			'tbd' => esc_attr__('TBD', 'sportspress'),
			'postponed' => esc_attr__('Postponed', 'sportspress'),
			'cancelled' => esc_attr__('Canceled', 'sportspress'),
		)
	);
	$title = $title . ' (' . $statuses[$sp_status] . ')';
}

?>
<div class="custom-countdown-wrapper">
	<div class="title-logo-container">
		<div class="loghi-partita-container">
			<?php
			if ($show_logos) {
				$teams = array_unique((array) get_post_meta($post->ID, 'sp_team'));
				$i = 0;

				if (is_array($teams)) {
					foreach ($teams as $team) {
						$i++;
						if (has_post_thumbnail($team)) {
							if ($link_teams) {
								echo '<a class="logo-squadra logo-' . ($i % 2 ? 'odd' : 'even') . '" href="' . esc_url(get_post_permalink($team)) . '" title="' . esc_attr(get_the_title($team)) . '">' . get_the_post_thumbnail($team, 'sportspress-fit-icon') . '</a>';
							} else {
								echo get_the_post_thumbnail($team, 'sportspress-fit-icon', array('class' => 'team-logo logo-squadra-img logo-' . ($i % 2 ? 'odd' : 'even')));
							}
						}
					}
				}
			}
			?>
			<span class="versus-text">VS</span>
		</div>
		
		
	</div>
	<div class="tds-wrapper">
	<div class="title-partita-container">
			<?php echo wp_kses_post($title); ?>
		</div>
	<?php
	if (isset($show_date) && $show_date):
		?>
		<div class="stadio-data-wrapper">
		<div class="data-partita-container">
        <h5 class="data-partita" style="font-weight: bold;">
			<?php
			echo wp_kses_post(get_the_time(get_option('time_format'), $post));
			?>
		</h5>
		<h5 class="data-partita">
			<?php
			echo wp_kses_post(get_the_time(get_option('date_format'), $post));
			?>
		</h5>
		</div>
		<?php
	endif;

	if (isset($show_venue) && $show_venue):
		$venues = get_the_terms($post->ID, 'sp_venue');
		if ($venues):
			?>
			<div class="stadio-partita-container">
			<h5 class="stadio-partita">
				<?php
				if ($link_venues) {
					the_terms($post->ID, 'sp_venue');
				} else {
					$venue_names = array();
					foreach ($venues as $venue) {
						$venue_names[] = $venue->name;
					}
					echo wp_kses_post(implode('/', $venue_names));
				}
				?>
			</h5>
			</div>
			</div>
			</div>
			<?php
		endif;
	endif;

	if (isset($show_league) && $show_league):
		$leagues = get_the_terms($post->ID, 'sp_league');
		if ($leagues):
			foreach ($leagues as $league):
				$term = get_term($league->term_id, 'sp_league');
				?>
				<h5 class="lega-partita"><?php echo wp_kses_post($term->name); ?></h5>
				<?php
			endforeach;
		endif;
	endif;

	$now = new DateTime(current_time('mysql', 0));
	$date = new DateTime($post->post_date);
	$interval = date_diff($now, $date);

	$days = $interval->invert ? 0 : $interval->days;
	$h = $interval->invert ? 0 : $interval->h;
	$i = $interval->invert ? 0 : $interval->i;
	$s = $interval->invert ? 0 : $interval->s;
	?>
	<div class="countdown-container
		<?php
		if ($days >= 10):
			?>
			 long-countdown<?php endif; ?>">
		<time datetime="<?php echo esc_attr($post->post_date); ?>" <?php
		   if ($live):
			   ?>
				data-countdown="<?php echo esc_attr(str_replace('-', '/', get_gmt_from_date($post->post_date))); ?>" <?php endif; ?>>
			<span><?php echo wp_kses_post(sprintf('%02s', $days)); ?>
				<small><?php esc_attr_e('days', 'sportspress'); ?></small></span>
			<span><?php echo wp_kses_post(sprintf('%02s', $h)); ?>
				<small><?php esc_attr_e('hrs', 'sportspress'); ?></small></span>
			<span><?php echo wp_kses_post(sprintf('%02s', $i)); ?>
				<small><?php esc_attr_e('mins', 'sportspress'); ?></small></span>
			<span><?php echo wp_kses_post(sprintf('%02s', $s)); ?>
				<small><?php esc_attr_e('secs', 'sportspress'); ?></small></span>
		</time>
	</div>
</div>
<style>
	[data-widget_type="wp-widget-sportspress-countdown.default"]
	{
		height: 100%;
	}
	[data-widget_type="wp-widget-sportspress-countdown.default"] .sp-widget-align-none {
		height: 100%;
		display: flex;
		flex-direction: column;
	}
	body.wp-night-mode-on .custom-countdown-wrapper{
		background: #302E28;
		border: 1px solid #4a4943;
	}
	
	body.wp-night-mode-on .tds-wrapper,
	body.wp-night-mode-on .custom-countdown-wrapper time{
		background: #302E28 !important;
		border: 1px solid #4a4943 !important;
	}
	body.wp-night-mode-on .loghi-partita-container{
		background: #302E28 !important;

	}
	.custom-countdown-wrapper {
		background: rgba(255, 255, 255, 0.75);
		border-radius: 10px;
		border: 1px solid #e9e9e9;
		padding: 0.5rem;
		/* box-shadow: 0 8px 32px 0 rgba(38, 38, 38, 0.37); */
		box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;
		display: grid;
		gap: 0.5rem;
		flex: 1;
	}

	.title-logo-container{
		display: grid;
		gap:0.5rem;
	}

	.loghi-partita-container {
		display: grid;
		grid-template-columns: auto auto auto;
		/* background-color: #CD1316; */
		gap: 0.5rem;
		background: rgba(255, 255, 255, 0.25);
		border-radius: 10px;
		/* border: 1px solid #e9e9e9; */
		padding: 0.5rem;
		place-content: center;
	}

	.title-partita-container {
		display:grid;
		place-items: center;
		/*background-color: #CD1316;*/
		
		font-family: var(--jl-title-font);
		font-weight: var(--jl-title-font-weight);
		text-transform: var(--jl-title-transform);
		letter-spacing: var(--jl-title-space);
		line-height: var(--jl-title-line-height);
		

	}
	.tds-wrapper{
		display:grid;
		gap: 0.5rem;
		border-radius: 10px;
		border: 1px solid #e9e9e9;
		padding: 0.5rem;
	}

	/* .logo-squadra-img {
		height: 80px !important;
		width: auto !important;
	} */
	.logo-squadra.logo-even {
		grid-column-start: 3;
	}

	.versus-text {
		grid-column-start: 2;
		grid-row: 1;
		place-self: center;
		font-family: var(--jl-title-font);
		font-weight: var(--jl-title-font-weight);
		text-transform: var(--jl-title-transform);
		letter-spacing: var(--jl-title-space);
		line-height: var(--jl-title-line-height);
	}
	.stadio-data-wrapper{
		display: grid;
		gap:0.5rem;
		/* padding: 0.5rem;
		border: 1px solid #e9e9e9;
		border-radius: 10px;

		background: rgba(255, 255, 255, 0.25); */
	}
	.stadio-partita-container,
	.data-partita-container {
		display: grid;
		place-items: center;
		
	}
	.stadio-partita,
	.data-partita {
		margin: 0;
		text-align: center;
		font-family: var(--jl-title-font);
		font-weight: 400;
		letter-spacing: var(--jl-title-space);
		line-height: var(--jl-title-line-height);
	}
	.data-partita{
		font-size: 18px;
	}
	.stadio-partita{
		font-size: 13px;
	}

	.custom-countdown-wrapper time {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		background: rgba(255, 255, 255, 0.25);
		border-radius: 10px;
		border: 1px solid #e9e9e9;
		padding: 0.5rem;
	}

	.custom-countdown-wrapper time > span {
		display: grid;
		grid-template-rows: 1fr 1fr;
		place-items: center;
		/*background-color: #606060;*/
		border-radius: 10px;
		font-weight: bold !important;
	}
	@media only screen and (max-width: 767px){
		.loghi-partita-container{
			gap: 2.5rem;
		}
		.title-partita-container{
			font-size: 18px;
		}
		.logo-squadra-img{
			height: 70px !important;
			width: auto !important;
		}
	}
</style>