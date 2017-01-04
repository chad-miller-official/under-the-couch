<?
    function get_music_genres()
    {
        $query = <<<SQL
select music_genre,
       name
  from tb_music_genre
SQL;

        $result = query_execute( $query );
        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
