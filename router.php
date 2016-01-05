<?
    /*
     * EVERY PHP REQUEST GOES THROUGH THIS FILE (see .htaccess in webroot)
     * PLEASE BE VERY CAREFUL WHEN MAKING CHANGES
     */

    // Require the necessary includes
    // Note that constants, include_lib, and session_lib are implicitly included in every PHP file
    require_once( 'common/php/constants.php' );
    require_once( 'common/php/functions/include_lib.php' );
    require_once( 'common/php/functions/session_lib.php' );

    // Set the webroot
    global $webroot;
    global $subroot;

    if( isset( $_SERVER['CONTEXT_DOCUMENT_ROOT'] ) && $_SERVER['CONTEXT_DOCUMENT_ROOT'] )
        $webroot = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
    else if( preg_match( '/(\/var\/www\/html\/[^\/]+)\//', __FILE__, $matches ) == 1 )
        $webroot = $matches[1];

    // Get the rest of the directory we're in after the webroot
    $subroot = str_replace( $webroot, '', $_SERVER['SCRIPT_FILENAME'] );
    $end_dir = strrpos( $subroot, '/' );
    $subroot = substr( $subroot, 0, $end_dir );
    
    $webroot .= $subroot;

    // Initialize the database connection
    global $db_conn;

    $connection_str = 'host='     . SQL_POSTGRESQL_HOST
                    .' port='     . SQL_POSTGRESQL_PORT
                    .' dbname='   . SQL_POSTGRESQL_DB
                    .' user='     . SQL_POSTGRESQL_USER
                    .' password=' . SQL_POSTGRESQL_PASS;
    $db_conn = pg_connect( $connection_str );

    // Set session variables
    session_start();

    global $session_member;

    if( is_logged_in() )
    {
        db_include( 'get_member' );

        $session_member         = get_member( $_SESSION['member_pk'] );
        $session_member['name'] = "{$session_member['first_name']} {$session_member['last_name']}";
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
