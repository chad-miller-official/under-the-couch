<?
    /*
     * Deletes member sessions older than one week.
     *
     * Params:
     *   $seconds - the maximum number of seconds before PHP recognizes a session has expired.
     * Returns:
     *   <<true>> if deletion was successful;
     *   <<false>> otherwise.
     */
    function delete_stale_member_sessions( $seconds )
    {
        $delete_query = <<<SQL
delete from tb_member_session
      where accessed < now() - interval '?seconds? seconds'
SQL;

        $params = [ 'seconds' => $seconds ];
        $delete = query_execute( $delete_blog_post_query, $params );

        return query_success( $delete );
    }
?>
