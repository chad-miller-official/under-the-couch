<?
    function create_member( $gatech_email, $first_name, $last_name, $password )
    {
        db_include( 'get_member_by_gatech_email' );

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
                              $1,
                              $2,
                              $3,
                              $3,
                              $4
                            )
SQL;

            $params = [
                $first_name,
                $last_name,
                $gatech_email,
                $password_hash
            ];

            pg_query_params( $insert_member, $params );
            $retval = get_member_by_gatech_email( $gatech_email );
            return $retval['member'];
        }
        else
            return 0;
    }
?>
