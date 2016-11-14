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
<aside class="main-sidebar">
	<center id="main-sidebar-title"><b>Upcoming Events</b></center>
    <div id="main-sidebar-items">
    	<? foreach( $events as $key => $value ): ?>
    		<br />
    		<?= "{$value['Date']} {$value['Time']}" ?>
    		<br />
    		<?= $value['Summary'] ?>
    		<br />
    	<? endforeach; ?>
    </div>
</aside>
