<?
    /*
     * Gets a blog post from the database.
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
     *   $blog_post : integer - the PK of the blog post to be retrieved.
     * Returns:
     *   <<the blog post as a hash>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_blog_post( $blog_post )
    {
        $get_blog_post_query = <<<SQL
                select bp.blog_post,
                       bp.title,
                       bp.body,
                       to_char( bp.created, 'Day, Month DD, YYYY HH:MI:SS AM' ) as created,
                       m.first_name || ' ' || m.last_name as author,
                       p.name as position,
                       case when bp.editor is not null
                            then e.first_name || ' ' || e.last_name
                            else null
                       end as editor,
                       case when bp.editor is not null
                            then to_char( bp.edited, 'Day, Month DD, YYYY HH:MI:SS AM' )
                            else null
                       end as edited,
                       case when bp.editor is not null
                            then pe.name
                            else null
                       end as editor_position
                  from tb_blog_post bp
            inner join tb_member m
                    on bp.author = m.member
             left join tb_officer o
                    on o.member = m.member
             left join tb_position p
                    on o.position = p.position
             left join tb_member e
                    on bp.editor = e.member
             left join tb_officer oe
                    on oe.member = e.member
             left join tb_position pe
                    on oe.position = pe.position
                 where bp.blog_post = ?blog_post?
SQL;

        $params = [ 'blog_post' => $blog_post ];
        $result = query_prepare_select( $get_blog_post_query, $params );

        return is_resource( $result ) ? query_fetch_one( $result ) : false;
    }
?>
