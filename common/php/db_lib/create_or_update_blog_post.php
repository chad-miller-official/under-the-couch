<?
    /*
     * Inserts a new blog post into the database or updates an existing blog post.
     *
     * Params:
     *   $title     : string  - the title the post should have (default empty)
     *   $body      : string  - the body the post should have (default empty)
     *   $update_pk : integer - the PK of the existing blog post, if updating instead of inserting (default 0)
     * Returns:
     *   If updating:
     *     <<true>> if update was successful;
     *     <<false>> otherwise.
     *   If inserting:
     *     <<the newly-inserted blog post's PK>> if insertion was successful;
     *     <<false>> otherwise.
     */
    function create_or_update_blog_post( $title='', $body='', $update_pk=0 )
    {
        // Presence of $update_pk means we're updating, not inserting
        if( $update_pk )
        {
            $query = <<<SQL
                update tb_blog_post
                   set editor = ?editor?,
                       edited = now()
SQL;

            $params = [
                'editor' => $GLOBALS['session_member']['member']
            ];

            // Update the title if we've been given one
            if( $title )
            {
                $query .= ', title = ?title?';
                $params['title'] = $title;
            }

            // Update the body if we're given one
            if( $body )
            {
                $query .= ', body = ?body?';
                $params['body'] = $body;
            }

            $query .= 'where blog_post = ?blog_post?';
            $params['blog_post'] = $update_pk;

            $update = query_update( $query, $params );
            return is_int( $update ) && $update > 0;
        }
        else
        {
            // Reject an insertion if we're missing a title or a body
            if( !$title || !$body )
                return false;

            $query = <<<SQL
                insert into tb_blog_post
                            (
                              author,
                              created,
                              title,
                              body
                            )
                     values (
                              ?author?,
                              now(),
                              ?title?,
                              ?body?
                            )
SQL;

            $params = [
                'author' => $GLOBALS['session_member']['member'],
                'title'  => $title,
                'body'   => $body
            ];

            $insert = query_insert( $query, $params );

            if( is_int( $insert ) && $insert > 0 )
            {
                $query  = "select currval( 'sq_pk_blog_post' ) as retval";
                $result = query_prepare_select( $query );
                $retval = query_fetch_one( $result );

                return $retval['retval'];
            }
            else
                return false;
        }
    }
?>
