<?
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
						$subValueArr = explode( ':', $subValue, 2 );
						$icsDates[$key][$subValueArr[0]] = isset( $subValueArr[1] ) ? $subValueArr[1] : '';
					}
				}
			}
		}

		return $icsDates;
	}
?>
