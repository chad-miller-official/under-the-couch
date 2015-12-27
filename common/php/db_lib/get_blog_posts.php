<?
    function get_blog_posts( $max_num_posts, $offset=0 )
    {
        $body_posts_query = <<<SQL
                 SELECT bp.blog_post                                                     AS blog_post,
                        bp.title                                                         AS title,
                        bp.body                                                          AS body,
                        to_char( bp.created, 'Day, Month DD, YYYY HH:MI:SS AM' )         AS created,
                        m.first_name || ' ' || m.last_name                               AS author,
                        p.name                                                           AS position,
                        CASE WHEN bp.editor IS NOT NULL
                             THEN e.first_name || ' ' || e.last_name
                             ELSE NULL
                        END                                                              AS editor,
                        CASE WHEN bp.editor IS NOT NULL
                            THEN to_char( bp.edited, 'Day, Month DD, YYYY HH:MI:SS AM' )
                            ELSE NULL
                        END                                                              AS edited,
                        CASE WHEN bp.editor IS NOT NULL
                            THEN pe.name
                            ELSE NULL
                        END                                                              AS editor_position
                  FROM tb_blog_post bp
                  JOIN tb_member m
                    ON bp.author = m.member
                  JOIN tb_officer o
                    ON o.member = m.member
                  JOIN tb_position p
                    ON o.position = p.position
             LEFT JOIN tb_member e
                    ON bp.editor = e.member
             LEFT JOIN tb_officer oe
                    ON oe.member = e.member
             LEFT JOIN tb_position pe
                    ON oe.position = pe.position
              ORDER BY bp.blog_post DESC
                 LIMIT $1
                OFFSET $2
SQL;

        pg_prepare( '', $body_posts_query );
        $result = pg_execute( '', [ $max_num_posts, $offset ] );

        return pg_fetch_all( $result );
    }
?>
