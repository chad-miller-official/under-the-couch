<?
    /*
     * EVERY PHP REQUEST GOES THROUGH THIS FILE (see .htaccess in webroot)
     * PLEASE BE VERY CAREFUL WHEN MAKING CHANGES
     */

    // Set the webroot
    if( isset( $_SERVER['CONTEXT_DOCUMENT_ROOT'] ) && $_SERVER['CONTEXT_DOCUMENT_ROOT'] )
        $GLOBALS['webroot'] = $_SERVER['CONTEXT_DOCUMENT_ROOT'];

    // Require the necessary includes
    require_once( 'common/php/constants.php' );
    require_once( 'common/php/include.php' );

    lib_include( 'db_lib' );
    lib_include( 'session_lib' );

    db_include( 'access_allowed' );

    // Initialize the database connection
    get_or_connect_to_db();

    // Start a session
    set_session_save_handler();
    SessionLib::startSession();
    SessionLib::registerSession();

    // Make sure we can access the page we want
    $requested_page = $_REQUEST['file'];

    if( isset( $requested_page ) && file_exists( $requested_page ) )
    {
        if( preg_match( '/^common\/php\/ajax\/.+\.php$/', $requested_page ) )
        {
            // Always permit AJAX requests
            lib_include( 'ajax_lib' );
            require_once( $requested_page );
        }
        elseif( access_allowed( $requested_page ) )
            require_once( $requested_page );
        else
            require_once( '404.php' );
    }
    else
        require_once( '404.php' );

    exit();
?>
