<?
    function get_officer_info_by_position_short_name( $short_name )
    {
        $get_officer_info_query = <<<SQL
            SELECT m.member							  AS member,
                   m.first_name || ' ' || m.last_name AS officer_name,
                   m.display_email_address            AS display_email_address,
                   p.name                             AS position_name,
                   p.short_name                       AS short_name
              FROM tb_member m
              JOIN tb_officer o
                ON o.member = m.member
              JOIN tb_position p
                ON p.position = o.position
             WHERE p.short_name = $1
SQL;
        pg_prepare( '', $get_officer_info_query );
        $result = pg_execute( '', [ $short_name ] );
        return pg_fetch_all( $result );
    }
?>
