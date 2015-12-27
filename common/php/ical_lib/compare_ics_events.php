<?
    function compare_ics_events( $o1, $o2 )
    {
        $d1 = $o1['Date'];
        $d2 = $o2['Date'];
        $t1 = $o1['Time'];
        $t2 = $o2['Time'];

        if( $t1 == 'All Day' )
            $t1 = '12:00 AM';

        if( $t2 == 'All Day' )
            $t2 = '12:00 AM';

        $u1 = strtotime( "$d1 $t1" );
        $u2 = strtotime( "$d2 $t2" );

        return $u1 - $u2;
    }
?>
