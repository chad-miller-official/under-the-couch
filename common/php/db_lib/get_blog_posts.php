<?
    /*
     * Gets an array of blog posts from the database.
     * A blog post is represented as a hash with the following fields:
     *   blog_post       : integer - the PK of the blog post.
     *   title           : string  - the title of the blog post.
     *   body            : string  - the body of the blog post.
     *   created         : string  - the blog post's creation time.
     *   author          : string  - the first and last name of the blog post's author.
     *   position        : string  - the officer position of the blog post's author.
     *   editor          : string  - the first and last name of the last person to edit
     *                               the blog post, or NULL if it was never edited.
     *   edited          : string  - the blog post's edit time, or NULL if it was never edited.
     *   editor_position : string  - the officer position of the blog post's last editor,
     *                               or NULL if it was never edited.
     *
     * Params:
     *   $max_num_posts : integer - the maximum number of blog posts to return.
     *   $offset        : integer - the number of blog posts to skip before the first
     *                              blog post in the array (default 0).
     * Returns:
     *   <<an array of blog posts hashes>> if retrieval was successful;
     *   <<false>> otherwise.
     */
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
        return $result ? pg_fetch_all( $result ) : false;
    }
?>
