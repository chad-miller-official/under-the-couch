<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Booking Dashboard</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <?
            js_common_include();
            js_include( 'ext/pagination.min.js' );
        ?>
        <script src="/dashboard/booking/js/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <center>
                <div class="paginationjs paginationjs-big" id="pagination-controls"></div>
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
