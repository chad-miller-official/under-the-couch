<!--
    TODO:
        - Need to add interface to add music genres
        - Need to add interface to add instruments
-->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Admin Dashboard</title>
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
        <script src="/dashboard/admin/js/index.js"></script>
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
                            <th class="text-cell">Last Name</th>
                            <th class="text-cell">First Name</th>
                            <th class="email-cell">Gatech Email Address</th>
                            <th class="email-cell">Display Email Address</th>
                            <th class="text-cell">Paid Dues Date</th>
                            <th class="text-cell">Paid Practice Fee Date</th>
                            <th class="text-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin_tbody"></tbody>
                </table>
            </center>
        </div>
        <? ui_insert( 'footer' ); ?>
    </body>
</html>
