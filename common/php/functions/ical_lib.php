<?
    /*
     * Compares two iCal events by their event date.
     *
     * Params:
     *   $o1 : iCal event from get_ics_events() - the first event.
     *   $o2 : iCal event from get_ics_events() - the second event.
     * Returns:
     *   <<a positive integer>> if $o1 > $o2;
     *   <<zero>> if $o1 == $o2;
     *   <<a negative integer> if $o1 < o2.
     */
    function compare_ics_events( $o1, $o2 )
    {
        $d1 = $o1['Date'];
        $d2 = $o2['Date'];
        $t1 = $o1['Time'];
        $t2 = $o2['Time'];

        // All-day events start at 12:00 AM
        if( $t1 == 'All Day' )
            $t1 = '12:00 AM';

        if( $t2 == 'All Day' )
            $t2 = '12:00 AM';

        $u1 = strtotime( str_replace( '-', '/', "$d1 $t1" ) );
        $u2 = strtotime( str_replace( '-', '/', "$d2 $t2" ) );

        return $u1 - $u2;
    }

    /*
     * Gets an array of iCal events from an iCal URL.
     *
     * Params:
     *   $paramUrl : string - the URL of the iCal whose events should be retrieved.
     * Returns:
     *   <<an array of events>>
     */
    function ics_to_array( $paramUrl )
    {
        // Read the URL as a text file
        $icsFile = file_get_contents( $paramUrl );

        // Tokenize what we just read - each token is an event
        $icsData = explode( 'BEGIN:', $icsFile );

        // Tokenize each event to get each event's data
        foreach( $icsData as $key => $value )
            $icsDatesMeta[$key] = explode( "\n", $value );

        foreach( $icsDatesMeta as $key => $value )
        {
            foreach( $value as $subKey => $subValue )
            {
                if( $subValue != '' )
                {
                    // Format events for further processing by get_ics_events()
                    if( $key != 0 && $subKey == 0 )
                        $icsDates[$key]['BEGIN'] = $subValue;
                    else
                    {
                        $subValueArr                     = explode( ':', $subValue, 2 );
                        $icsDates[$key][$subValueArr[0]] = isset( $subValueArr[1] ) ? $subValueArr[1] : '';
                    }
                }
            }
        }

        return $icsDates;
    }

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
					$timeZone    = new DateTimeZone( 'UTC' );
				}
				else if( isset( $value['DTSTART;VALUE=DATE'] ) )
				{
					$currDateStr = $value['DTSTART;VALUE=DATE'];
					$currTimeStr = 'All Day';
					$timeZone    = new DateTimeZone( 'America/New_York' );
				}
				else if( isset( $value['DTSTART;TZID=America/New_York'] ) )
				{
					$currDateStr = substr( $value['DTSTART;TZID=America/New_York'], 0, 8 );
					$currTimeStr = substr( $value['DTSTART;TZID=America/New_York'], 9 );
					$timeZone    = new DateTimeZone( 'America/New_York' );
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
