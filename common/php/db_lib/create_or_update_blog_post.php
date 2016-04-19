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
        $param_json = json_encode( $param_map );
        $query      = <<<SQL
            select fn_create_or_update_row
                   (
                     ?table?,
                     ?param_json,
                     array[ ?pk_column? ]
                   ) as blog_post
SQL;

        params = [
            'table'      => 'tb_blog_post',
            'param_json' => "'$param_json'::json",
            'pk_column'  => 'blog_post'
        ];

        $upsert = query_prepare_select( $query, $params );

        if( is_resource( $upsert ) )
        {
            $retval = query_fetch_one( $upsert );
            return $retval['blog_post'];
        }
        else
            return false;
    }
?>
