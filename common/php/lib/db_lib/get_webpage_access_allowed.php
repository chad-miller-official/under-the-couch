<?
    function get_webpage_access_allowed( $page_name )
    {
        $session_member = SessionLib::get( 'user_member.member' );
        $params         = [ 'page_name' => $page_name ];

        if( $session_member == -1 )
        {
            $get_access_query = <<<SQL
select access_allowed_by_default as access_allowed
  from tb_webpage
 where ?page_name? ilike base_uri_glob
SQL;
        }
        else
        {
            $get_access_query = <<<SQL
select tt.access_allowed
  from tb_member_role rm,
       fn_get_page_permissions_for_role( rm.role ) tt
  join tb_webpage w
 using ( webpage )
 where rm.member = ?member?
   and ?page_name? ilike w.base_uri_glob
SQL;

            $params['member'] = $session_member;
        }

        $result = query_execute( $get_access_query, $params );

        if( query_success( $result ) )
        {
            $row = query_fetch_one( $result );
            return $row['access_allowed'] == 't';
        }

        return false;
    }
?>
