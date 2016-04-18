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
     *   <<0>> if a member with the specified email address already exists;
     *   <<the newly-inserted member's integer PK>> if insertion was successful;
     *   <<false>> otherwise.
     */
    function create_member( $gatech_email, $first_name, $last_name, $password )
    {
        db_include( 'get_member_by_gatech_email' );

        // Check to see if the member exists
        if( !get_member_by_gatech_email( $gatech_email ) )
        {
            $password_hash = hash( 'sha512', $password );

            $insert_member = <<<SQL
                INSERT INTO tb_member
                            (
                              first_name,
                              last_name,
                              gatech_email_address,
                              display_email_address,
                              password_hash
                            )
                     VALUES (
                              ?first_name?,
                              ?last_name?,
                              ?gatech_email?,
                              ?password_hash?
                            )
SQL;

            $params = [
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'gatech_email'  => $gatech_email,
                'password_hash' => $password_hash
            ];

            $insert = query_insert( $insert_member, $params );

            if( is_int( $insert ) && $insert > 0 )
            {
                $retval = get_member_by_gatech_email( $gatech_email );
                return $retval['member'];
            }
            else
                return false;
        }
        else
            return 0;
    }
?>
