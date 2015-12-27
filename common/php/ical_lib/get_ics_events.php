<?
	function get_ics_events( $icsEvents, $startDateTime, $endDateTime )
	{
		foreach( $icsEvents as $key => $value )
		{
			if( strpos( $value['BEGIN'], 'VEVENT' ) === 0 )
			{
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

				if( $currTimeStr != 'All Day' )
					$currDateTime = DateTime::createFromFormat( 'YmdGis', $currDateStr . $currTimeStr, $timeZone );
				else
					$currDateTime = DateTime::createFromFormat( 'Ymd', $currDateStr, $timeZone );

				if( $currDateTime->getTimezone()->getName() == 'UTC' )
					$currDateTime = $currDateTime->sub( new DateInterval('PT5H') );

				if( $startDateTime <= $currDateTime && $currDateTime <= $endDateTime )
				{
					$events[$key]['Date'] = $currDateTime->format( 'n-j-Y' );

					if( $currTimeStr != 'All Day' )
						$events[$key]['Time'] = $currDateTime->format( 'g:i A' );
					else
						$events[$key]['Time'] = $currTimeStr;

					$events[$key]['Summary'] = $value['SUMMARY'];
				}
			}
		}

		return $events;
	}
?>
