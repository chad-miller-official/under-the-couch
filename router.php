<?
    /*
     * EVERY PHP REQUEST GOES THROUGH THIS FILE (see .htaccess in webroot)
     * PLEASE BE VERY CAREFUL WHEN MAKING CHANGES
     */

    // Require the necessary includes
    // Note that constants, include_lib, and session_lib are implicitly included in every PHP file
    require_once( 'common/php/constants.php' );
    require_once( 'common/php/functions/db_lib.php' );
    require_once( 'common/php/functions/include_lib.php' );
    require_once( 'common/php/functions/session_lib.php' );

    // Set the webroot
    if( isset( $_SERVER['CONTEXT_DOCUMENT_ROOT'] ) && $_SERVER['CONTEXT_DOCUMENT_ROOT'] )
        $GLOBALS['webroot'] = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
    else if( preg_match( '/(\/var\/www\/dev.underthecouch.org\/[^\/]+)\//', __FILE__, $matches ) == 1 )
        $GLOBALS['webroot'] = $matches[1];

    // Initialize the database connection
    if( !isset( $GLOBALS['db_conn'] ) )
        $GLOBALS['db_conn'] = pg_connect( PSQL_CONNECT_STRING );

    // Set session variables
    session_start();

    if( is_logged_in() )
    {
        db_include( 'get_member' );

        $GLOBALS['session_member']         = get_member( $_SESSION['member_pk'] );
        $GLOBALS['session_member']['name'] = "{$session_member['first_name']} {$session_member['last_name']}";
    }
    else
    {
        $session_member = [
            'name'     => 'guest',
            'is_admin' => false
        ];
    }

    // Finally load the requested page
    if( isset( $_REQUEST['file'] ) && file_exists( $_REQUEST['file'] ) )
        require_once( $_REQUEST['file'] );

    exit();
?>
