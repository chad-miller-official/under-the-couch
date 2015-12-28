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

        $u1 = strtotime( "$d1 $t1" );
        $u2 = strtotime( "$d2 $t2" );

        return $u1 - $u2;
    }
?>
