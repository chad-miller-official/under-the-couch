<?
    function create_or_update_blog_post( $title=0, $body=0, $update_pk=0 )
    {
        global $session_member;

        if( $update_pk )
        {
            $query = <<<SQL
                UPDATE tb_blog_post
                   SET editor = $1,
                       edited = now()
SQL;

            $params = [ $session_member['member'] ];
            $i = 2;

            if( $title )
            {
                $query .= ", title = \${$i}";
                $i++;
                array_push( $params, $title );
            }

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
            if( !$title || !$body )
                return 0;

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
                $session_member['member'],
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
