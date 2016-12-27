<?
    function get_instruments_by_member( $member )
    {
        $query = <<<SQL
select i.instrument,
       i.name,
       mi.can_teach
  from tb_instrument i
  join tb_member_instrument mi
    on i.instrument = mi.instrument
 where mi.member = ?member?
SQL;

        $params = [ 'member' => $member ];
        $result = query_execute( $query, $params );

        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
