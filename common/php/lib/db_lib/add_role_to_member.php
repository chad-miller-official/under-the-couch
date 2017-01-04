<?
    /*
     * Adds a role to a member by the PK of both.
     *
     * Params:
     *  $member_pk  :   integer     The PK of the member in question
     *  $role_pk    :   integer     The PK of the role to be added to this member
     *
     * Returns:
     *  <true> if the transaction is successful
     *  <false> otherwise
     */
    function add_role_to_member( $member_pk, $role_pk ) {
        $query = <<<SQL
INSERT INTO tb_member_role
(
    member,
    role
)
VALUES
(
    ?member?,
    ?role?
)
SQL;

        $params = [
            'member' => $member_pk,
            'role'   => $role_pk
        ];

        $result = query_execute( $query, $params );
        return query_success( $result );
    }
?>
