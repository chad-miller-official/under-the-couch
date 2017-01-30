<?
    db_include( 'update_booking_request_status' );

    $booking_request_pk        = $_REQUEST[ 'booking_request' ];
    $booking_request_status_pk = $_REQUEST[ 'booking_request_status' ];

    $update_booking_request_status_retval = update_booking_request_status(
        $booking_request_pk,
        $booking_request_status_pk
    );

    if( $update_booking_request_status_retval !== true )
    {
        $retval['success'] = false;
        $retval['message'] = $update_booking_request_status_retval;
    }
    else
        $retval['success'] = true;

    ajax_return_and_exit( $retval );
?>
