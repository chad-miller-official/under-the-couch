<?
    /*
     * Gets a member session from the database.
     * A member session is represented as a hash with the following fields:
     *   member_session : integer - the PK of the member session.
     *   member         : string  - the member session's owning member.
     *   accessed       : string  - the date the member session was last accessed.
     *   value          : string  - the member session's stored data.
     *
     * Params:
     *   $key : string - the member session's PHP-generated identifying key.
     * Returns:
     *   <<the member session as a hash>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_member_session_by_key( $key )
    {
        $get_session_query = <<<SQL
select member_session,
       member,
       accessed,
       value,
       extract( epoch from now() - accessed ) as age_seconds
  from tb_member_session
 where key = ?key?
SQL;

        $params = [ 'key' => $key ];
        $result = query_execute( $get_session_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
