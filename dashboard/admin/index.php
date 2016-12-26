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
                'featherlight'
            );
        ?>
        <script src="/dashboard/admin/js/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>

        <div class="container">
            <div style="position:relative; left:138px">
                <div class="paginationjs paginationjs-big" id="pagination-controls"></div>
                <br />
                <table class="dynamic-data" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Gatech Email Address</th>
                            <th>Display Email Address</th>
                            <th>Paid Dues Date</th>
                            <th>Paid Practice Fee Date</th>
                        </tr>
                    </thead>
                    <tbody id="admin_tbody"></tbody>
                </table>
            </div>
        </div>

        <? ui_insert( 'footer' ); ?>
    </body>
</html>
