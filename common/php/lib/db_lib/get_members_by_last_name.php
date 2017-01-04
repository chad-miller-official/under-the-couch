<?
    function get_members_by_last_name( $limit=0, $offset=null )
    {
        $get_members = <<<SQL
WITH tt_member_role as
(
      SELECT m.member as member,
             max(mr.role) as role
        FROM tb_member m
        JOIN tb_member_role mr
          ON m.member = mr.member
    GROUP BY m.member
)
  SELECT count(*) over () as total,
         m.member,
         m.last_name,
         m.first_name,
         m.gatech_email_address,
         m.display_email_address,
         m.paid_dues_date,
         m.paid_practice_date,
         r.role
    FROM tt_member_role tt
    JOIN tb_member m
      ON tt.member = m.member
    JOIN tb_role r
      ON tt.role = r.role
   WHERE m.member > 0
ORDER BY m.last_name
        LIMIT ?limit?
        OFFSET ?offset?
SQL;

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        $result = query_execute( $get_members, $params );
        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
