<?
    function is_logged_in()
    {
        return isset( $_SESSION['member_pk'] );
    }

    function login( $member_pk )
    {
        if( is_logged_in() )
            return false;

        $_SESSION['member_pk'] = $member_pk;
        return true;
    }

    // This function implicitly destroys the current session
    function logout()
    {
        if( !is_logged_in() )
            return false;

        unset( $_SESSION['member_pk'] );
        session_destroy();
        return true;
    }

    function is_admin()
    {
        global $session_member;

        return $session_member['is_admin'];
    }
?>
