<?
    /*
     * Checks if the user is currently logged in.
     *
     * Params:
     *   None.
     * Returns:
     *   <<true>> if the user is currently logged in;
     *   <<false>> otherwise.
     */
    function is_logged_in()
    {
        return isset( $_SESSION['member_pk'] );
    }

    /*
     * Logs the user in.
     *
     * Params:
     *   $member_pk : integer - the PK of the member that the user should be logged in as.
     * Returns:
     *   <<true>> if the user was successfully logged in;
     *   <<false>> otherwise.
     */
    function login( $member_pk )
    {
        if( is_logged_in() )
            return false;

        $_SESSION['member_pk'] = $member_pk;
        return true;
    }

    /*
     * Logs the user out. This function implicitly destroys the current session.
     *
     * Params:
     *   None.
     * Returns:
     *   <<true>> if the user was successfully logged out;
     *   <<false>> otherwise.
     */
    function logout()
    {
        if( !is_logged_in() )
            return false;

        unset( $_SESSION['member_pk'] );
        session_destroy();
        return true;
    }

    /*
     * Checks if the user currently logged in is an admin.
     *
     * Params:
     *   None.
     * Returns:
     *   <<true>> if the user currently logged in is an admin.
     *   <<false>> otherwise.
     */
    function is_admin()
    {
        global $session_member;

        return $session_member['is_admin'];
    }
?>
