<?
    function get_member_by_login_credentials( $email_address, $password_hash )
    {
        $get_member_query = <<<SQL
                 SELECT m.member
                   FROM tb_member m
              LEFT JOIN tb_officer o
                     ON m.member = o.member
                  WHERE m.gatech_email_address = $1
                    AND m.password_hash        = $2
SQL;

        pg_prepare( '', $get_member_query );
        $result = pg_execute( '', [ $email_address, $password_hash ] );

        return pg_fetch_assoc( $result );
    }
?>
