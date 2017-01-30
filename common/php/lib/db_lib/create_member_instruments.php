<?
    function create_member_instruments( $member, $instruments )
    {
        $query  = 'insert into tb_member_instrument ( member, instrument ) values ';
        $member = pg_escape_literal( $member );

        foreach( $instruments as $instrument )
        {
            $instrument = pg_escape_literal( $instrument );
            $query     .= "( $member, $instrument ), ";
        }

        $query  = preg_replace( '/, $/', '', $query );
        $result = query_execute( $query );

        return query_success( $result );
    }
?>
