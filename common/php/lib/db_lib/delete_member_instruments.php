<?
    function delete_member_instruments( $member )
    {
        $query = <<<SQL
delete from tb_member_instrument
      where member = ?member?
SQL;

        $params = [ 'member' => $member ];
        $delete = query_execute( $query, $params );

        return query_success( $delete );
    }
?>
