<?
    function get_member_by_gatech_email( $gatech_email )
    {
        $get_member_query = <<<SQL
               SELECT m.*,
                      o.officer IS NOT NULL AS is_admin
                 FROM tb_member m
            LEFT JOIN tb_officer o
                   ON m.member = o.member
                WHERE m.gatech_email_address = $1
SQL;

        pg_prepare( '', $get_member_query );
        $result = pg_execute( '', [ $gatech_email ] );

        return pg_fetch_assoc( $result );
    }
?>
