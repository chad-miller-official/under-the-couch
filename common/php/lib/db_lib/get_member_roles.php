<?
    /*
     * Gets all roles of one member.
     */

     function get_member_roles ( $member ) {

         $get_member_roles_query = <<<SQL
     SELECT mr.role
            FROM tb_member_role mr
            WHERE mr.member = ?member?
            ORDER BY mr.role
SQL;

        $params = [ 'member' => $member ];

        $result = query_execute( $get_member_roles_query, $params );
        return query_success( $result ) ? query_fetch_all( $result ) : false;
     }
?>
