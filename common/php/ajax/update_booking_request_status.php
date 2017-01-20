<?
    db_include( 'update_booking_request_status' );

    $booking_request_pk        = $_REQUEST[ 'booking_request' ];
    $booking_request_status_pk = $_REQUEST[ 'booking_request_status' ];

    $update_booking_request_status_success = update_booking_request_status(
            $booking_request_pk,
            $booking_request_status_pk
        );

    $retval[ 'success' ] = $update_booking_request_status_success;

    if( $update_booking_request_status_success )
        $retval[ 'booking_request_status' ] = $booking_request_status_pk;

    ajax_return_and_exit( $retval );
?>
