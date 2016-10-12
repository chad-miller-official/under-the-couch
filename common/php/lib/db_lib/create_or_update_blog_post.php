<?
    /*
     * Inserts a new blog post into the database or updates an existing blog post.
     *
     * Params:
     *   $param_map : [ string => scalar ] - an array that contains the columns of
                                             tb_blog_post and their intended values.
     *
     * Returns:
     *   <<the inserted/updated blog post's PK>> if insertion was successful;
     *   <<false>> otherwise.
     */
    function create_or_update_blog_post( $param_map )
    {
        $query = <<<SQL
select fn_insert_or_update_row
       (
         'tb_blog_post',
         ?param_json?::json,
         array[ 'blog_post' ]
       ) as blog_post
SQL;

        $param_json = json_encode( $param_map );
        $params     = [ 'param_json' => $param_json ];
        ];

        $upsert = query_execute( $query, $params );

        if( query_success( $upsert ) )
        {
            $retval = query_fetch_one( $upsert );
            return $retval['blog_post'];
        }
        else
            return false;
    }
?>
