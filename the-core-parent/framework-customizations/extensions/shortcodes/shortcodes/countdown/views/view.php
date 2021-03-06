<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}

$year = __('Year', 'the-core');
$month = __('Month', 'the-core');
$week = __('Week', 'the-core');
$day = __('Day', 'the-core');
$hour = __('Hour', 'the-core');
$minute = __('Minute', 'the-core');
$second = __('Second', 'the-core');

$years = __('Years', 'the-core');
$months = __('Months', 'the-core');
$weeks = __('Weeks', 'the-core');
$days = __('Days', 'the-core');
$hours = __('Hours', 'the-core');
$minutes = __('Minutes', 'the-core');
$seconds = __('Seconds', 'the-core');

if($atts['format']['selected'] == 'fw-countdown-style-2'){
	$years = $year = __('y', 'the-core');
	$months = $month = __('m', 'the-core');
	$weeks = $week = __('w', 'the-core');
	$days = $day = __('d', 'the-core');
	$hours = $hour = __('h', 'the-core');
	$minutes = $minute = __('m', 'the-core');
	$seconds = $second = __('s', 'the-core');
}

// for desktop
if( isset($atts['responsive']['desktop_display']['selected']) && $atts['responsive']['desktop_display']['selected'] == 'no' ) {
    $atts['class'] .= ' fw-desktop-hide-element';
}

// for tablet landscape
if( isset($atts['responsive']['tablet_landscape_display']['selected']) && $atts['responsive']['tablet_landscape_display']['selected'] == 'no' ) {
    $atts['class'] .= ' fw-tablet-landscape-hide-element';
}

// for tablet portrait
if( isset($atts['responsive']['tablet_display']['selected']) && $atts['responsive']['tablet_display']['selected'] == 'no' ) {
	$atts['class'] .= ' fw-tablet-hide-element';
}

// for display on smartphone
if( isset($atts['responsive']['smartphone_display']['selected']) && $atts['responsive']['smartphone_display']['selected'] == 'no' ) {
	$atts['class'] .= ' fw-mobile-hide-element';
}

/*----------------Animation option--------------*/
$data_animation = '';
if ( isset( $atts['animation_group'] ) ) {
	// get animation class and delay
	if ( $atts['animation_group']['selected'] == 'yes' ) {
		$atts['class'] .= ' fw-animated-element';
		// get animation
		if ( ! empty( $atts['animation_group']['yes']['animation']['animation'] ) ) {
			$data_animation .= ' data-animation-type="' . $atts['animation_group']['yes']['animation']['animation'] . '"';
		}

		// get delay
		if ( ! empty( $atts['animation_group']['yes']['animation']['delay'] ) ) {
			$data_animation .= ' data-animation-delay="' . (int) esc_attr( $atts['animation_group']['yes']['animation']['delay'] ) . '"';
		}
	}
}
/*----------------End Animation----------------*/
if( isset($atts['alignment']) ){
	$atts['class'] .= ' '.$atts['alignment'];
}
?>
<div class="fw-countdown-container tf-sh-<?php echo $atts['unique_id']; ?>">
	<div class="fw-countdown <?php echo $atts['format']['selected']; ?> <?php echo $atts['class']; ?>" data-countdown="<?php echo $atts['date']; ?>" data-year="<?php echo $year; ?>" data-month="<?php echo $month; ?>" data-week="<?php echo $week; ?>" data-day="<?php echo $day; ?>" data-hour="<?php echo $hour; ?>" data-minute="<?php echo $minute; ?>" data-second="<?php echo $second; ?>" data-years="<?php echo $years; ?>" data-months="<?php echo $months; ?>" data-weeks="<?php echo $weeks; ?>" data-days="<?php echo $days; ?>" data-hours="<?php echo $hours; ?>" data-minutes="<?php echo $minutes; ?>" data-seconds="<?php echo $seconds; ?>" <?php echo $data_animation; ?>></div>
	<div class="fw-countdown-expired <?php echo $atts['class']; ?>" style="display: none;"><?php if( isset($atts['text']) ) echo $atts['text']; ?></div>
</div>