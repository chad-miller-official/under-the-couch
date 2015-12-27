<?
    function get_max_and_min_blog_post()
    {
        $get_max_min_query = <<<SQL
            SELECT max( blog_post ) AS max,
                   min( blog_post ) AS min
              FROM tb_blog_post
SQL;

        pg_prepare( '', $get_max_min_query );
        $result = pg_execute( '', [] );

        return pg_fetch_assoc( $result );
    }
?>
