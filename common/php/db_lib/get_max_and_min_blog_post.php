<?
    /*
     * Gets the max and min blog post IDs from the database as a hash with the
     * following entries:
     *   max : integer - the max blog post ID.
     *   min : integer - the min blog post ID.
     *
     * Params:
     *   None.
     * Returns:
     *   A hash containing the max and min blog post IDs.
     */
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
