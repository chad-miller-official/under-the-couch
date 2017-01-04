<?
    function remove_member( $member )
    {
        begin_transaction();

        $remove_mr = <<<SQL
DELETE FROM tb_member_role
      WHERE member = ?member?
SQL;

        $remove_m = <<<SQL
DELETE FROM tb_member
      WHERE member = ?member?
SQL;

        $params = [ 'member' => $member ];

        $result_mr = query_execute( $remove_mr, $params );
        $result_m  = query_execute( $remove_m,  $params );

        if( query_success( $result_mr ) && query_success( $result_m ) )
        {
            commit_transaction();
            return true;
        }
        else
        {
            rollback_transaction();
            return false;
        }
    }
?>
