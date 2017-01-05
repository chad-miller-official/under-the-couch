<?
    function get_roles()
    {
        $query = <<<SQL
  select role,
         name,
         abbreviation,
         rank,
         is_admin
    from tb_role
order by role;
SQL;

        $result = query_execute( $query );
        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
