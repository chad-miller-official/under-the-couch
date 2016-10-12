<?
    /*
     * Deletes a member session from the database by its key.
     *
     * Params:
     *   $key : integer - the key of the member_session to delete.
     * Returns:
     *   <<true>> if deletion was successful;
     *   <<false>> otherwise.
     */
    function delete_member_session_by_key( $key )
    {
        $delete_blog_post_query = <<<SQL
delete from tb_member_session
      where key = ?key?
SQL;

        $params = [ 'key' => $key ];
        $delete = query_execute( $delete_blog_post_query, $params );

        return query_success( $delete );
    }
?>
