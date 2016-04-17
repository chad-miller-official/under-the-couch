<?
    /*
     * Prepare a query for pg_prepare().
     * First, this finds all question mark-escaped params in $query and builds
     * an array of their equivalent values corresponding to index.
     * Next, this replaces all question-mark escaped params in $query with
     * $counters.
     * Finally, this returns the query and param array we built.
     *
     * Example query: SELECT *
     *                  FROM tb_blog_post
     *                 WHERE blog_post = ?num?
     *                    OR title     = ?title?
     *                    OR member    = ?num?
     * Example params: [ 'title' => 'Test Title', 'num' => 30 ]
     *
     * The first step builds an array like this:
     *   [ 30, 'Test Title', 30 ]
     * The second step turns the query into this:
     *   SELECT *
     *     FROM tb_blog_post
     *    WHERE blog_post = $1
     *       OR title     = $2
     *       OR member    = $3
     * And the modified query and constructed param array are returned.
     *
     * The resulting return query and return params are suitable for use with
     * pg_prepare().
     */
    function __query_prep_params( $query, $params )
    {
        $param_regex  = '/\?(.+?)\?/';  // Matches anything in between two question marks
        $params_array = [];

        preg_match_all( $param_regex, $query, $matches );
        $matches     = $matches[1];     // Matches[0] is each "?param?" that was matched
        $match_count = count( $matches );

        // Build the param array by pushing on each corresponding param value
        for( $i = 0; $i < $match_count; $i++ )
            array_push( $params_array, $params[$matches[$i]] );

        // Replace each ?param? with a $counter
        $query_prepped = preg_replace_callback(
            $param_regex,
            function( $matches )
            {
                // First time this function is called, "$1" is returned
                // Second time, "$2" is returned, and so forth
                STATIC $i = 0;
                return '$' . ++$i;
            },
            $query
        );

        return [ $query, $params_array ];
    }

    function query_prepare( $query, $params=false )
    {
        if( $params )
        {
            list( $query_prepped, $params_array ) = __query_prep_params( $query, $params );
            return pg_query_params( $query_prepped, $params_array );
        }
        else
            return pg_query( $query );
    }

    function query_fetch_one( $query_prepare_retval )
    {
        return pg_fetch_assoc( $query_prepare_retval );
    }

    function query_fetch_all( $query_prepare_retval )
    {
        return pg_fetch_all( $query_prepare_retval );
    }
?>
