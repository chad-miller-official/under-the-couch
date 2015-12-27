<?
    function get_position_by_short_name( $short_name )
    {
        $description_query = <<<SQL
            SELECT *
              FROM tb_position
             WHERE short_name = $1
SQL;

        pg_prepare( '', $description_query );
        $result = pg_execute( '', [ $short_name ] );
        return pg_fetch_assoc( $result );
    }
?>
