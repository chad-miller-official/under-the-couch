<?
    /*
     * Gets an array of officer info from the database by role PK.
     *
     * Officer info is represented as a hash with the following fields:
     *   member                : integer - the PK of the officer's tb_member entry.
     *   officer_name          : string  - the officer's first and last name.
     *   display_email_address : string  - the email address displayed in the officer's profile.
     *
     * Params:
     *   $short_name : string - the @gatech.edu email address of the officer to be retrieved.
     * Returns:
     *   <<an array of officer info as hashes>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_officer_info( $role )
    {
        $get_officer_info_query = <<<SQL
            select m.member,
                   m.first_name || ' ' || m.last_name as officer_name,
                   m.display_email_address
              from tb_member m
              join tb_member_role mr
                on m.member = mr.member
              join tb_role r
                on mr.role = r.role
             where r.role = ?role?
SQL;

        $params = [ 'role' => $role ];
        $result = query_prepare_select( $get_officer_info_query, $params );

        // query_fetch_all because there may be more than one officer per position
        return is_resource( $result ) ? query_fetch_all( $result ) : false;
    }
?>
