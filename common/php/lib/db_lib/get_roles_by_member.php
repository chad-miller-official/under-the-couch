<?
    function get_roles_by_member( $member )
    {
        $query = <<<SQL
  select r.role,
         r.name,
         r.abbreviation,
         r.rank,
         r.is_admin
    from tb_role r
    join tb_member_role mr
      on r.role = mr.role
   where mr.member = ?member?
order by r.rank
SQL;

        $params = [ 'member' => $member ];
        $result = query_execute( $query, $params );

        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
