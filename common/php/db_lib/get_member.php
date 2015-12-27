<?
    function get_member( $member )
    {
        $get_member_query = <<<SQL
               SELECT m.*,
                      CASE WHEN o.officer IS NOT NULL
                           THEN 1
                           ELSE 0
                      END AS is_admin
                 FROM tb_member m
            LEFT JOIN tb_officer o
                   ON m.member = o.member
                WHERE m.member = $1
SQL;

        pg_prepare( '', $get_member_query );
        $result = pg_execute( '', [ $member ] );

        return pg_fetch_assoc( $result );
    }
?>
