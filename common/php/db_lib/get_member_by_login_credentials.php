<?
    /*
     * Gets a member from the database by their @gatech.edu email address and
     * MD5-hashed password.
     * A member is represented as a hash with the following fields:
     *   member                : integer - the PK of the member.
     *   first_name            : string  - the member's first name.
     *   last_name             : string  - the member's last name.
     *   gatech_email_address  : string  - the member's @gatech.edu email address.
     *   display_email_address : string  - the email address displayed in the user's profile.
     *   password_hash         : string  - the user's password as its computed MD5 hash.
     *   paid_dues_date        : string  - the date the user paid dues (may be NULL).
     *   paid_locker_date      : string  - the date the user paid locker fees (may be NULL).
     *   paid_practice_date    : string  - the date the user paid practice fees (may be NULL).
     *   locker_months         : integer - the number of months the user has their locker for (may be NULL).
     *   locker_number         : integer - the locker the user has (may be NULL).
     *   is_admin              : boolean - true if the user is an officer; false otherwise.
     *
     * Params:
     *   $gatech_email  : string - the @gatech.edu email address of the member to be retrieved.
     *   $password_hash : string - the user's associated MD5-hashed password.
     * Returns:
     *   <<the user as a hash>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_member_by_login_credentials( $gatech_email, $password_hash )
    {
        $get_member_query = <<<SQL
                 select m.member
                   from tb_member m
              left join tb_officer o
                     on m.member = o.member
                  where m.gatech_email_address = ?gatech_email?
                    and m.password_hash        = ?password_hash?
SQL;

        $params = [
            'gatech_email'  => $gatech_email,
            'password_hash' => $password_hash
        ];

        $result = query_prepare_select( $get_member_query, $params );
        return is_resource( $result ) ? query_fetch_one( $result ) : false;
    }
?>
