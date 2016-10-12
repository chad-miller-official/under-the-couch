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
select max( blog_post ) as max,
       min( blog_post ) as min
  from tb_blog_post
SQL;

        $result = query_execute( $get_max_min_query );
        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
