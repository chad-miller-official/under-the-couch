<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Booking Dashboard</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <? js_common_include(); ?>
        <script src="/dashboard/booking/js/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <center>
                <a href="#" id="prev" class="clean-button" style="float:left; display:none">Prev</a>
                <a href="#" id="next" class="clean-button" style="float:right">Next</a>
                <table class="dynamic-data" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Contact Name</th>
                            <th>Contact Email</th>
                            <th>Contact Phone</th>
                            <th>Date Requested</th>
                            <th>Request Submitted</th>
                            <th>Request Status</th>
                        </tr>
                    </thead>
                    <tbody id="booking_requests_tbody">
                        <!-- Populated via JS -->
                    </tbody>
                </table>
            </center>
        </div>
        <? ui_insert( 'footer' ); ?>
    </body>
</html>
