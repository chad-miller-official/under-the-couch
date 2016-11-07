<?
    db_include( 'access_allowed' );
	lib_include( 'ical_lib' );

    $now = new DateTime();
    $end = new DateTime();
    $now = $now->sub( new DateInterval( 'P1D' ) );
    $end = $end->add( new DateInterval( 'P3W' ) );

    $icsDates = ics_to_array( URL_ICAL_BOOKING );
    $events   = get_ics_events( $icsDates, $now, $end );

    usort( $events, 'compare_ics_events' );
?>

<aside>
	<?
        if( access_allowed( 'ui/sidebar_admin.php' ) )
            include( 'sidebar_admin.php' );
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
