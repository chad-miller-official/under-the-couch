<?
    function get_role( $role )
    {
        $get_role_info_query = <<<SQL
SELECT *
  FROM tb_role
 WHERE role = ?role?
SQL;

        $params = [ 'role' => $role ];
        $result = query_execute( $get_role_info_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
