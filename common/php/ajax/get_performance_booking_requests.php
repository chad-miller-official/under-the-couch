<?
    db_include( 'get_booking_requests_by_booking_request_type' );

    $data    = get_booking_requests_by_booking_request_type( BOOKING_REQUEST_TYPE_PERFORMANCE );
    $success = $data !== false;

    $retval = [
        'success' => $success,
        'data'    => $data
    ];

    if( $success )
    {
        foreach( $data as $index => $booking_request )
        {
            $additional_information                 = $booking_request['additional_information'];
            $data[$index]['additional_information'] = json_decode( $additional_information, true );
        }
    }

    ajax_return_and_exit( $retval );
?>
