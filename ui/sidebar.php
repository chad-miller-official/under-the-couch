<?
	lib_include( 'ical_lib' );
?>

<aside>
	<? if( is_admin() ): ?>
		<center><b>Admin Control Panel</b></center>

		<ul class="admin_sidebar">
			<li><a href="/blog/writeblog.php">Write Blog Post</a></li>
		</ul>

		<hr />
	<? endif; ?>

	<?
		$now = new DateTime();
		$end = new DateTime();
		$now = $now->sub( new DateInterval( 'P1D' ) );
		$end = $end->add( new DateInterval( 'P3W' ) );

		$icsDates = ics_to_array( URL_ICAL_BOOKING );
		$events   = get_ics_events( $icsDates, $now, $end );

		usort( $events, 'compare_ics_events' );
	?>

	<center><b>Upcoming Events</b></center>

	<? foreach( $events as $key => $value ): ?>
		<br />
		<?= "{$value['Date']} {$value['Time']}" ?>
		<br />
		<?= $value['Summary'] ?>
		<br />
	<? endforeach; ?>
</aside>
