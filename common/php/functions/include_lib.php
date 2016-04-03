<?
    function lib_include()
    {
        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "{$GLOBALS['webroot']}/common/php/functions/$arg.php" );
    }

    /*
     * Includes a db_lib function.
     *
     * Params:
     *   Any number of db_lib function names (in common/db_lib). Do not include
     *   the ".php" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function db_include()
	{
        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "{$GLOBALS['webroot']}/common/php/db_lib/$arg.php" );
	}

    /*
     * Includes a Javascript plugin.
     *
     * Params:
     *   Any number of Javascript plugin names (in common/js). Do not include
     *   the ".js" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function js_include()
    {
        $args = func_get_args();

        foreach( $args as $arg )
            echo "<script src=\"/common/js/$arg.js\"></script>";
    }

    /*
     * Inserts a UI component exactly where this function is called.
     *
     * Params:
     *   $ui_file : string - the UI component to be included (in common/ui). Do
     *                       not include the ".php" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function ui_insert( $ui_file )
    {
        require( "{$GLOBALS['webroot']}/common/ui/$ui_file.php" );
    }
?>
