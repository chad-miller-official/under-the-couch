<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Booking Dashboard</title>
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
        <script src="/dashboard/booking/js/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <center>
                <div id="pagination_controls" class="paginationjs paginationjs-big"></div>
                <br />
                <table class="dynamic-data" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Band Name</th>
                            <th>Contact Name</th>
                            <th>Contact Email</th>
                            <th>Date Requested</th>
                            <th>Request Submitted</th>
                            <th>Request Status</th>
                        </tr>
                    </thead>
                    <tbody id="booking_requests_tbody"></tbody>
                </table>
            </center>
        </div>
        <? ui_insert( 'footer' ); ?>
    </body>
</html>
