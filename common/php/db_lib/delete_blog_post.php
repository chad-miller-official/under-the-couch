<?
    /*
     * Deletes a new blog post from the database.
     *
     * Params:
     *   $blog_post : integer - the PK of the blog post to delete.
     * Returns:
     *   <<true>> if deletion was successful;
     *   <<false>> otherwise.
     */
    function delete_blog_post( $blog_post )
    {
        $delete_blog_post_query = <<<SQL
            DELETE FROM tb_blog_post
                  WHERE blog_post = $1
SQL;

        return pg_query_params( $delete_blog_post_query, [ $blog_post ] ) ? true : false;
    }
?>
