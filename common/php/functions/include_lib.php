<?
    function db_include()
	{
        global $webroot;

        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "$webroot/common/php/db_lib/$arg.php" );
	}

    function js_include()
    {
        global $subroot;

        $args = func_get_args();

        foreach( $args as $arg )
        {
            echo <<<HTML
                <script src="$subroot/common/js/$arg.js"></script>
HTML;
        }
    }

    function ical_include()
    {
        global $webroot;

        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "$webroot/common/php/ical_lib/$arg.php" );
    }

    function ui_insert( $ui_file )
    {
        global $webroot;

        require_once( "$webroot/common/ui/$ui_file.php" );
    }
?>
