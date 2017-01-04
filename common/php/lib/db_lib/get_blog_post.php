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
          to_char( bp.created, 'Day, Month DD, YYYY HH:MI AM' ) as created,
          m.first_name || ' ' || m.last_name                    as author,
          me.first_name || ' ' || me.last_name                  as editor,
          to_char( bp.edited, 'Day, Month DD, YYYY HH:MI AM' )  as edited
     from tb_blog_post bp
     join tb_member m
       on bp.creator = m.member
left join tb_member me
       on bp.editor = me.member
    where bp.blog_post = ?blog_post?
SQL;

        $params = [ 'blog_post' => $blog_post ];
        $result = query_execute( $get_blog_post_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
