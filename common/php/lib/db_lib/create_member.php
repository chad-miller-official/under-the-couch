<?
    /*
     * Inserts a new member into the database.
     *
     * Params:
     *   $gatech_email : string - the new member's @gatech.edu email address
     *   $first_name   : string - the new member's first name
     *   $last_name    : string - the new member's last name
     *   $password     : string - the new member's password
     * Returns:
     *   <<the newly-inserted member's integer PK>> if insertion was successful;
     *   <<false>> otherwise.
     */
    function create_member( $gatech_email, $first_name, $last_name, $password )
    {
        $insert_member = <<<SQL
insert into tb_member
            (
              first_name,
              last_name,
              gatech_email_address,
              display_email_address,
              password_hash
            )
     values (
              ?first_name?,
              ?last_name?,
              ?gatech_email?,
              ?gatech_email?,
              crypt( ?password?, gen_salt( 'bf' ) )
            )
  returning member
SQL;

        $params = [
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'gatech_email'  => $gatech_email,
            'password'      => $password
        ];

        begin_transaction();

        $insert = query_execute( $insert_member, $params );

        if( query_success( $insert ) )
        {
            $member_created = query_fetch_one( $insert );
            $member_pk      = $member_created['member'];

            $insert_role = <<<SQL
insert into tb_member_role
            (
              member,
              role
            )
     values (
              ?member?,
              ?role?
            )
SQL;

            $params = [
                'member' => $member_pk,
                'role'   => ROLE_MEMBER
            ];

            $result = query_execute( $insert_role, $params );

            if( query_success( $result ) )
            {
                commit_transaction();
                return $member_pk;
            }
        }

        rollback_transaction();
        return false;
    }
?>
