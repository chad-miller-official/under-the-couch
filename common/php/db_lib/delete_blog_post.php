<?
    function delete_blog_post( $blog_post )
    {
        $delete_blog_post_query = <<<SQL
            DELETE FROM tb_blog_post
                  WHERE blog_post = $1
SQL;

        $retval = pg_query_params( $delete_blog_post_query, [ $blog_post ] );
        return $retval;
    }
?>
