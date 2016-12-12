<?
    db_include( 'get_booking_requests_by_booking_request_type' );

    $limit  = $_REQUEST['pageSize'];
    $offset = ( $_REQUEST['pageNumber'] - 1 ) * $limit;

    $no_data = isset( $_REQUEST['_no_data'] ) && $_REQUEST['_no_data'];

    $data    = get_booking_requests_by_booking_request_type( BOOKING_REQUEST_TYPE_PERFORMANCE, $limit, $offset );
    $success = $data !== false;
    $count   = $success ? count( $data )    : 0;
    $total   = $success ? $data[0]['total'] : 0;

    $retval = [
        'success' => $success,
        'count'   => $count,
        'total'   => $total
    ];

    if( $success && !$no_data )
    {
        foreach( $data as $index => $booking_request )
        {
            $additional_information                 = $booking_request['additional_information'];
            $data[$index]['additional_information'] = json_decode( $additional_information, true );
        }

        $retval['data'] = $data;
    }

    ajax_return_and_exit( $retval );
?>
