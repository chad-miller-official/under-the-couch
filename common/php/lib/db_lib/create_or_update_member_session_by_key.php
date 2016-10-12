<?
    /*
     * Inserts a new member session into the database or updates an existing member session.
     *
     * Params:
     *   $param_map : [ string => scalar ] - an array that contains the columns of
                                             tb_member_session and their intended values.
     *
     * Returns:
     *   <<the inserted/updated member session's PK>> if insertion was successful;
     *   <<false>> otherwise.
     */
     function create_or_update_member_session_by_key( $key, $param_map )
     {
         $query = <<<SQL
 select fn_insert_or_update_row
        (
          'tb_member_session',
          ?param_json?::json,
          array[ 'key' ]
        ) as member_session
SQL;

        $param_map['key'] = $key;
        $param_json       = json_encode( $param_map );
        $params           = [ 'param_json' => $param_json ];

        $upsert = query_execute( $query, $params );

        if( query_success( $upsert ) )
        {
            $retval = query_fetch_one( $upsert );
            return $retval['member_session'];
        }
        else
            return false;
     }
?>
