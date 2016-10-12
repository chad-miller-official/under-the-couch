<?
    /*
     * EVERY PHP REQUEST GOES THROUGH THIS FILE (see .htaccess in webroot)
     * PLEASE BE VERY CAREFUL WHEN MAKING CHANGES
     */

    // Set the webroot
    if( isset( $_SERVER['CONTEXT_DOCUMENT_ROOT'] ) && $_SERVER['CONTEXT_DOCUMENT_ROOT'] )
        $GLOBALS['webroot'] = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
    else if( preg_match( '/(\/var\/www\/dev.underthecouch.org\/[^\/]+)\//', __FILE__, $matches ) == 1 )
        $GLOBALS['webroot'] = $matches[1];

    // Require the necessary includes
    require_once( 'common/php/constants.php' );
    require_once( 'common/php/include.php' );

    lib_include( 'db_lib' );
    lib_include( 'session_lib' );

    db_include( 'get_webpage_access_allowed' );

    // Initialize the database connection
    get_or_connect_to_db();

    // Start a session
    set_session_save_handler();
    SessionLib::startSession();
    SessionLib::registerSession();

    // Make sure we can access the page we want
    $requested_page = $_REQUEST['file'];

    if( !get_webpage_access_allowed( $requested_page ) )
        require_once( '404.php' );
    else
    {
        // Finally load the requested page
        if( isset( $requested_page ) && file_exists( $requested_page ) )
            require_once( $requested_page );
    }

    exit();
?>
