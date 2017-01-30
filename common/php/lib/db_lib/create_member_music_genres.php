<?
    function create_member_music_genres( $member, $music_genres )
    {
        $query  = 'insert into tb_member_music_genre ( member, music_genre ) values ';
        $member = pg_escape_literal( $member );

        foreach( $music_genres as $music_genre )
        {
            $music_genre = pg_escape_literal( $music_genre );
            $query      .= "( $member, $music_genre ), ";
        }

        $query  = preg_replace( '/, $/', '', $query );
        $result = query_execute( $query );

        return query_success( $result );
    }
?>
