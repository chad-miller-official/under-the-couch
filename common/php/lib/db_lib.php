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
     *
     * Params:
     *   $query  : string                    - the query to prepare
     *   $params : array[ string => scalar ] - the parameters the query uses
     * Returns:
     *   [
     *     0 => The prepared query
     *     1 => The prepared parameters array
     *   ]
     */
    function __query_prep_params( $query, $params )
    {
        $params_array = [];

        // Replace each ?param? with a $counter
        $query_prepped = preg_replace_callback(
            '/\?(.+?)\?/',
            function( $match ) use( &$params_array, &$params )
            {
                // First time this function is called, "$1" is returned
                // Second time, "$2" is returned, and so forth
                STATIC $i = 0;

                // At the same time, add the corresponding value to the params array
                array_push( $params_array, $params[$match[1]] );
                return '$' . ++$i;
            },
            $query
        );

        return [ $query_prepped, $params_array ];
    }

    /*
     * Alias for pg_query() or pg_query_params(). If parameters are present,
     * the query and parameters are prepped using __query_prep_params().
     *
     * Parameters:
     *   $query  : string                    - the query to execute
     *   $params : array[ string => scalar ] - the parameters the query uses (default false)
     * Returns:
     *   <<PG resource object>> on success,
     *   <<false>> otherwise.
     */
    function __query( $query, $params=false )
    {
        if( $params )
        {
            list( $query_prepped, $params_array ) = __query_prep_params( $query, $params );
            return pg_query_params( $query_prepped, $params_array );
        }
        else
            return pg_query( $query );
    }

    /*
     * Prepares a SELECT statement for use with query_fetch_one() or query_fetch_all().
     *
     * Parameters:
     *   $query  : string                    - the SELECT query to execute
     *   $params : array[ string => scalar ] - the parameters the query uses (default false)
     * Returns:
     *   <<PG resource object>> on success,
     *   <<error message as a string>> otherwise.
     */
    function query_prepare_select( $query, $params=false )
    {
        $result = __query( $query, $params );
        return $result ?: pg_result_error( $result );
    }

    /*
     * Wrapper for pg_fetch_assoc().
     *
     * Parameters:
     *   $resource : PG resource - the result of a successful query_prepare_select() call
     * Returns:
     *   <<an array mapping columns to values>> on success if there is a row left to fetch;
     *   <<false>> otherwise.
     */
    function query_fetch_one( $resource )
    {
        return pg_fetch_assoc( $resource );
    }

    /*
     * Wrapper for pg_fetch_all().
     *
     * Parameters:
     *   $resource : PG resource - the result of a successful query_prepare_select() call
     * Returns:
     *   <<an array of [arrays mapping columns to values]>> on success if there are rows to fetch;
     *   <<false>> otherwise.
     */
    function query_fetch_all( $resource )
    {
        return pg_fetch_all( $resource );
    }

    /*
     * Prepares an INSERT, UPDATE, or DELETE statement for use with query_fetch_one()
     * or query_fetch_all().
     *
     * Parameters:
     *   $query  : string                    - the SELECT query to execute
     *   $params : array[ string => scalar ] - the parameters the query uses (default false)
     * Returns:
     *   <<number of rows affected>> on success,
     *   <<error message as a string>> otherwise.
     */
    function __query_insert_update_delete( $query, $params=false )
    {
        $result = __query( $query, $params=false );
        return $result ? pg_affected_rows( $result ) : pg_result_error( $result );
    }

    /* The next three functions are aliases for __query_insert_update_delete() */

    function query_insert( $query, $params=false )
    {
        return __query_insert_update_delete( $query, $params );
    }

    function query_update( $query, $params=false )
    {
        return __query_insert_update_delete( $query, $params );
    }

    function query_delete( $query, $params=false )
    {
        return __query_insert_update_delete( $query, $params );
    }
?>
