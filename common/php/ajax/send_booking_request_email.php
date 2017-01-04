<?
    lib_include( 'email_lib' );
    db_include(
        'get_booking_request',
        'update_booking_request_status'
    );

    $booking_request_pk = $_REQUEST['booking_request'];
    $email_text         = $_REQUEST['email_text'];

    $success = false;
    $error   = 'An error has occurred - please contact support.';

    begin_transaction();

    $update_success = update_booking_request_status(
        $booking_request_pk,
        BOOKING_REQUEST_STATUS_IN_PROGRESS
    );

    if( $update_success )
    {
        $booking_request = get_booking_request( $booking_request_pk );

        $email_success = send_text_email(
            $booking_request['contact_email_address'],
            EMAIL_BOOKING,
            "Under the Couch Booking Request for {$booking_request['date_requested']}",
            $email_text
        );

        if( $email_success )
        {
            commit_transaction();
            $success = true;
        }
        else
        {
            rollback_transaction();
            $error = 'Failed to send email.';
        }
    }
    else
    {
        rollback_transaction();
        $error = 'Failed to update booking request status.';
    }

    $retval = [
        'success' => $success,
        'error'   => $error
    ];

    ajax_return_and_exit( $retval );
?>
