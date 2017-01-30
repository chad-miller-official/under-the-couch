<?
    require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/session_lib/SessionLib.php" );
    require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/session_lib/GTMNSessionHandler.php" );

    db_include( 'get_member_by_login_credentials' );

    function set_session_save_handler()
    {
        static $handler_set = false;

        if( !$handler_set )
        {
            $session_handler = new GTMNSessionHandler();
            session_set_save_handler( $session_handler, true );
            $handler_set = true;
        }
    }

    function is_logged_in()
    {
        return SessionLib::get( 'user_member.member' ) != -1;
    }

    function login( $email, $password )
    {
        $member = get_member_by_login_credentials( $email, $password );

        if( is_array( $member ) && count( $member ) == 1 )
        {
            SessionLib::set( 'user_member.member', $member['member'] );
            SessionLib::closeSession();

            return true;
        }

        return false;
    }

    function logout()
    {
        SessionLib::destroySession();
    }
?>
