<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Treasurer Dashboard</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <link rel="stylesheet" type="text/css" href="/pagination.css" />
        <link rel="stylesheet" type="text/css" href="/featherlight.min.css" />
        <?
            js_common_include();
            js_include(
                'pagination',
                'featherlight',
                'pagination_lib.js'
            );
        ?>
        <script src="/dashboard/treasurer/js/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <center>
                <div class="paginationjs paginationjs-big" id="pagination_controls"></div>
                <br />
                <table class="dynamic-data" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-cell">Name</th>
                            <th class="text-cell">Paid Dues Date</th>
                            <th class="text-cell">Paid Practice Fee Date</th>
                            <th class="text-cell">Locker Number</th>
                            <th class="text-cell">Paid Locker Fee Date</th>
                            <th class="text-cell">Locker Expiration Date</th> <!-- TODO: come up with better names for this stuff -->
                        </tr>
                    </thead>
                    <tbody id="treasurer_tbody"></tbody>
                </table>
            </center>
        </div>
        <? ui_insert( 'footer' ); ?>
    </body>
</html>
