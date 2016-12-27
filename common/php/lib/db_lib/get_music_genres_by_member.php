<?
    function get_music_genres_by_member( $member )
    {
        $query = <<<SQL
select mg.music_genre,
       mg.name
  from tb_music_genre mg
  join tb_member_music_genre mmg
    on mg.music_genre = mmg.music_genre
 where mmg.member = ?member?
SQL;

        $params = [ 'member' => $member ];
        $result = query_execute( $query, $params );

        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
