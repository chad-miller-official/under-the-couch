<?
    require_once( 'session_lib/SessionLib.php' );
    require_once( 'session_lib/GTMNSessionHandler.php' );

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

        if( $member )
        {
            $name = "{$member['first_name']} {$member['last_name']}";

            SessionLib::set( 'user_member.member',   $member['member']   );
            SessionLib::set( 'user_member.name',     $name               );
            SessionLib::set( 'user_member.is_admin', $member['is_admin'] );

            SessionLib::closeSession();

            return [ 'Successfully logged in!', '/index.php' ];
        }
        else
            return [ 'Incorrect email or password provided!', '/user/login.php' ];

        return [ 'Failed to log in!', '/user/login.php' ];
    }

    function logout()
    {
        SessionLib::destroySession();
    }
?>
