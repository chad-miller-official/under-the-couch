<?
    db_include( 'get_booking_requests_by_booking_request_type' );
    $booking_requests = get_booking_requests_by_booking_request_type( BOOKING_REQUEST_TYPE_PERFORMANCE );
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch - Booking Dashboard</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <? js_common_include(); ?>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>

        <div class="container">
            <table class="dynamic-data">
                <tr>
                    <th>Request ID</th>
                    <th>Contact Name</th>
                    <th>Contact Email</th>
                    <th>Contact Phone</th>
                    <th>Date Requested</th>
                    <th>Created</th>
                    <th>Type</th>
                </tr>
                <?
                    if( is_array( $booking_requests ) )
                    {
                        foreach( $booking_requests as $booking_request )
                        {
                            $booking_request_pk    = $booking_request['booking_request'];
                            $contact_name          = $booking_request['contact_name'];
                            $contact_email_address = $booking_request['contact_email_address'];
                            $contact_phone_number  = $booking_request['contact_phone_number'];
                            $date_requested        = $booking_request['date_requested'];
                            $created               = $booking_request['created'];
                            $booking_request_type  = $booking_request['booking_request_type'];
                ?>
                    <tr>
                        <td><?= $booking_request_pk ?></td>
                        <td><?= $contact_name ?></td>
                        <td><?= $contact_email_address ?></td>
                        <td><?= $contact_phone_number ?></td>
                        <td><?= $date_requested ?></td>
                        <td><?= $created ?></td>
                        <td><?= $booking_request_type ?></td>
                    </tr>
                <?
                        }
                    }
                ?>
            </table>
            <br />
            <? ui_insert('footer'); ?>
        </div>
    </body>
</html>
