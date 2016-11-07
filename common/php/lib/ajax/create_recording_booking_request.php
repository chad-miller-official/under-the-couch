<?
    db_include( 'create_booking_request' );

    $contact_name          = $_REQUEST['contact_name'];
    $contact_email_address = $_REQUEST['contact_email_address'];
    $contact_phone_number  = $_REQUEST['contact_phone_number'];
    $date_requested        = $_REQUEST['date_requested'];
    $comments              = $_REQUEST['comments'];

    $map = [
        'contact_name'           => $contact_name,
        'contact_email_address'  => $contact_email_address,
        'contact_phone_number'   => $contact_phone_number,
        'date_requested'         => $date_requested,
        'comments'               => $comments
    ];

    $success         = false;
    $booking_request = create_booking_request( BOOKING_REQUEST_TYPE_RECORDING, $map );

    if( $booking_request )
        $success = true;

    $retval = [
        'success'         => $success,
        'booking_request' => $booking_request
    ];

    ajax_return_and_exit( $retval );
?>
