<?
    class ICalEntry
    {
        const EVENT_ALL_DAY = 'All Day';

        private $date;
        private $time;
        private $is_all_day;
        private $description;

        public function __construct( $date, $time, $description )
        {
            $this->time       = $time;
            $this->is_all_day = false;

            // All-day events start at 12:00 AM
            if( $this->time == self::EVENT_ALL_DAY )
            {
                $this->time       = '12:00 AM';
                $this->is_all_day = true;
            }

            $this->date        = $date;
            $this->description = $description;
        }

        public function getTimestamp()
        {
            $time_str = str_replace( '-', '/', "$this->date $this->time" );
            return strtotime( $time_str );
        }

        public function getDate()
        {
            return $this->date;
        }

        public function getTime()
        {
            return $this->is_all_day ? self::EVENT_ALL_DAY : $this->time;
        }

        public function getDescription()
        {
            $max_len = 40;
            $retval  = $this->description;

            if( strlen( $retval ) >= $max_len )
                $retval = substr( $retval, 0, $max_len ) . '...';

            return $retval;
        }
    }

    /*
     * Compares two iCal events by their event date.
     *
     * Params:
     *   $o1 : an ICalEntry object - the first event.
     *   $o2 : an ICalEntry object - the second event.
     * Returns:
     *   <<a positive integer>> if $o1 > $o2;
     *   <<zero>> if $o1 == $o2;
     *   <<a negative integer> if $o1 < o2.
     */
    function compare_ical_entries( $o1, $o2 )
    {
        $u1 = $o1->getTimestamp();
        $u2 = $o2->getTimestamp();
        return $u1 - $u2;
    }

    /*
     * Gets an array of iCal events from an iCal URL.
     *
     * Params:
     *   $ics_url : string - the URL of the iCal whose events should be retrieved.
     * Returns:
     *   <<an array of events>>
     */
    function ics_to_array( $ics_url )
    {
        // Read the URL as a text file
        $ics_file = @file_get_contents( $ics_url );

        if( $ics_file === false )
            return [];

        $ics_file = str_replace( "\r\n ", '', $ics_file );

        // Tokenize what we just read - each token is an event
        $ics_data       = explode( 'BEGIN:', $ics_file );
        $ics_event_data = [];

        // Tokenize each event to get each event's data
        foreach( $ics_data as $ics_event )
            $ics_event_data[] = explode( "\r\n", $ics_event );

        $ics_dates = [];

        foreach( $ics_event_data as $index => $value )
        {
            foreach( $value as $sub_index => $sub_value )
            {
                if( $sub_value != '' )
                {
                    // Format events for further processing by get_ics_events()
                    if( $index != 0 && $sub_index == 0 )
                        $ics_dates[$index]['BEGIN'] = $sub_value;
                    else
                    {
                        $ics_data_pair = explode( ':', $sub_value, 2 );
                        $ics_data_key  = $ics_data_pair[0];

                        $ics_dates[$index][$ics_data_key] = isset( $ics_data_pair[1] ) ? $ics_data_pair[1] : '';
                    }
                }
            }
        }

        return $ics_dates;
    }

	/*
	 * Gets an array of iCal events given a date range.
	 *
	 * Params:
	 *   $ics_array     : array of iCal events from ics_to_array() - a list of iCal
	 *                    events.
	 *   $start : date - a date that no returned events should begin earlier than.
	 *   $end   : date - a date that no returned events should begin later than.
	 * Returns:
	 *   <<an array of events with the given date range>>
	 */
	function ics_array_to_ical_events( $ics_array, $start, $end )
	{
        $events = [];

		foreach( $ics_array as $key => $value )
		{
			// If the event's "BEGIN" value begins with "VEVENT", it is a valid event
			if( preg_match( '/^VEVENT$/', $value['BEGIN'] ) )
			{
				// Get the time zone for the event
				if( isset( $value['DTSTART'] ) )
				{
					$current_date = substr( $value['DTSTART'], 0, 8 );
					$current_time = substr( $value['DTSTART'], 9, 6 );
					$time_zone    = new DateTimeZone( 'UTC' );
				}
				else if( isset( $value['DTSTART;VALUE=DATE'] ) )
				{
					$current_date = $value['DTSTART;VALUE=DATE'];
					$current_time = ICalEntry::EVENT_ALL_DAY;
					$time_zone    = new DateTimeZone( 'America/New_York' );
				}
				else if( isset( $value['DTSTART;TZID=America/New_York'] ) )
				{
					$current_date = substr( $value['DTSTART;TZID=America/New_York'], 0, 8 );
					$current_time = substr( $value['DTSTART;TZID=America/New_York'], 9 );
					$time_zone    = new DateTimeZone( 'America/New_York' );
				}
				else
					error_log( 'Unexpected value for DSTART! ' . print_r( $value, true ) );

				$current_date = trim( $current_date );
				$current_time = trim( $current_time );

				// Construct the datetime string
				if( $current_time != ICalEntry::EVENT_ALL_DAY )
					$current = DateTime::createFromFormat( 'YmdGis', $current_date . $current_time, $time_zone );
				else
					$current = DateTime::createFromFormat( 'Ymd', $current_date, $time_zone );

				if( $current->getTimezone()->getName() == 'UTC' )
					$current = $current->sub( new DateInterval( 'PT5H' ) );

				// Insert the event into the events list if it is within the date range
				if( $start <= $current && $current <= $end )
				{
					// Get the date part of the datetime
					$date = $current->format( 'n-j-Y' );

					// Get the time part of the datetime
					if( $current_time != ICalEntry::EVENT_ALL_DAY )
						$time = $current->format( 'g:i A' );
					else
						$time = $current_time;

					// Get the event description
					$description = $value['SUMMARY'];
                    $events[]    = new ICalEntry( $date, $time, $description );
				}
			}
		}

		return $events;
	}
?>
