<?
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
        global $webroot;

        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "$webroot/common/php/db_lib/$arg.php" );
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
        global $subroot;

        $args = func_get_args();

        foreach( $args as $arg )
            echo "<script src=\"$subroot/common/js/$arg.js\"></script>";
    }

    /*
     * Includes a ical_lib function.
     *
     * Params:
     *   Any number of ical_lib function names (in common/ical_lib). Do not include
     *   the ".php" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function ical_include()
    {
        global $webroot;

        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "$webroot/common/php/ical_lib/$arg.php" );
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
        global $webroot;

        require( "$webroot/common/ui/$ui_file.php" );
    }
?>
