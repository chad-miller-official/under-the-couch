<?
	/*
	 * Gets an array of iCal events given a date range.
	 *
	 * Params:
	 *   $icsEvents     : array of iCal events from ics_to_array() - a list of iCal
	 *                    events.
	 *   $startDateTime : date - a date that no returned events should begin earlier than.
	 *   $endDateTime   : date - a date that no returned events should begin later than.
	 * Returns:
	 *   <<an array of events with the given date range>>
	 */
	function get_ics_events( $icsEvents, $startDateTime, $endDateTime )
	{
		foreach( $icsEvents as $key => $value )
		{
			// If the event's "BEGIN" value begins with "VEVENT", it is a valid event
			if( strpos( $value['BEGIN'], 'VEVENT' ) === 0 )
			{
				// Get the time zone for the event
				if( isset( $value['DTSTART'] ) )
				{
					$currDateStr = substr( $value['DTSTART'], 0, 8 );
					$currTimeStr = substr( $value['DTSTART'], 9, 6 );
					$timeZone = new DateTimeZone( 'UTC' );
				}
				else if( isset( $value['DTSTART;VALUE=DATE'] ) )
				{
					$currDateStr = $value['DTSTART;VALUE=DATE'];
					$currTimeStr = 'All Day';
					$timeZone = new DateTimeZone( 'America/New_York' );
				}
				else if( isset( $value['DTSTART;TZID=America/New_York'] ) )
				{
					$currDateStr = substr( $value['DTSTART;TZID=America/New_York'], 0, 8 );
					$currTimeStr = substr( $value['DTSTART;TZID=America/New_York'], 9 );
					$timeZone = new DateTimeZone( 'America/New_York' );
				}
				else
					echo( 'Unexpected value for DSTART!<br />' );

				$currDateStr = trim( $currDateStr );
				$currTimeStr = trim( $currTimeStr );

				// Construct the datetime string
				if( $currTimeStr != 'All Day' )
					$currDateTime = DateTime::createFromFormat( 'YmdGis', $currDateStr . $currTimeStr, $timeZone );
				else
					$currDateTime = DateTime::createFromFormat( 'Ymd', $currDateStr, $timeZone );

				if( $currDateTime->getTimezone()->getName() == 'UTC' )
					$currDateTime = $currDateTime->sub( new DateInterval('PT5H') );

				// Insert the event into the events list if it is within the date range
				if( $startDateTime <= $currDateTime && $currDateTime <= $endDateTime )
				{
					// Get the date part of the datetime
					$events[$key]['Date'] = $currDateTime->format( 'n-j-Y' );

					// Get the time part of the datetime
					if( $currTimeStr != 'All Day' )
						$events[$key]['Time'] = $currDateTime->format( 'g:i A' );
					else
						$events[$key]['Time'] = $currTimeStr;

					// Get the event description
					$events[$key]['Summary'] = $value['SUMMARY'];
				}
			}
		}

		return $events;
	}
?>
