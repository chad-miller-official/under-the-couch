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
    function create_or_update_blog_post( $title="", $body="", $update_pk=0 )
    {
        // Presence of $update_pk means we're updating, not inserting
        if( $update_pk )
        {
            $query = <<<SQL
                UPDATE tb_blog_post
                   SET editor = $1,
                       edited = now()
SQL;

            $params = [ $GLOBALS['session_member']['member'] ];
            $i = 2; // Keep track of which variable number we're on

            // Update the title if we've been given one
            if( $title )
            {
                // $i is used to keep track of the variables we substitute in
                $query .= ", title = \${$i}";
                $i++;
                array_push( $params, $title );
            }

            // Update the body if we're given one
            if( $body )
            {
                $query .= ", body = \${$i}";
                $i++;
                array_push( $params, $body );
            }

            $query .= "WHERE blog_post = \${$i}";
            array_push( $params, $update_pk );
            return pg_query_params( $query, $params ) ? true : false;
        }
        else
        {
            // Reject an insertion if we're missing a title or a body
            if( !$title || !$body )
                return false;

            $query = <<<SQL
                INSERT INTO tb_blog_post
                            (
                              author,
                              created,
                              title,
                              body
                            )
                     VALUES (
                              $1,
                              now(),
                              $2,
                              $3
                            )
SQL;

            $params = [
                $GLOBALS['session_member']['member'],
                $title,
                $body
            ];

            if( pg_query_params( $query, $params ) )
            {
                $query = "SELECT currval( 'sq_pk_blog_post' ) AS retval";
                pg_prepare( '', $query );
                $result = pg_execute( '', [] );
                $retval = pg_fetch_assoc( $result );

                return $retval['retval'];
            }
            else
                return false;
        }
    }
?>
