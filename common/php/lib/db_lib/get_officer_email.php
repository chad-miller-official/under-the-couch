<?
    /*
     * Gets an officer's email address from the database.
     *
     * Params:
     *   The role of the officer whose email should be retrieved.
     * Returns:
     *   The officer's email address.
     */
    function get_officer_email($role)
    {
        $email_query = <<<SQL
select m.display_email_address
  from tb_member m
  join tb_member_role mr
    on m.member = mr.member
  join tb_role r
    on mr.role = r.role
 where r.role = ?role?
SQL;

        $params = [ 'role' => $role ];
        $result = query_execute( $email_query, $params );

        if( query_success( $result ) )
        {
            $row = query_fetch_one( $result );
            return $row['display_email_address'];
        }
        else
            return false;
    }
?>
