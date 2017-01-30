<?
    function delete_member_music_genres( $member )
    {
        $query = <<<SQL
delete from tb_member_music_genre
      where member = ?member?
SQL;

        $params = [ 'member' => $member ];
        $delete = query_execute( $query, $params );

        return query_success( $delete );
    }
?>
