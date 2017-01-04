<?
    /*
     * Removes a role from a member by the PK of both.
     *
     * Params:
     *  $member_pk  :   integer     The PK of the member in question
     *  $role_pk    :   integer     The PK of the role to be removed from this member
     *
     * Returns:
     *  <true> if the transaction is successful
     *  <false> otherwise
     */
    function remove_role( $member_pk, $role_pk ) {
        $query = <<<SQL
DELETE FROM tb_member_role
    WHERE member = ?member?
    AND role = ?role?
SQL;

        $params = [
            'member' => $member_pk,
            'role'   => $role_pk
        ];

        $result = query_execute( $query, $params );

        return query_success( $result );
    }
?>
