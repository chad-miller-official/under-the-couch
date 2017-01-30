<?
    function update_booking_request_status( $booking_request, $booking_request_status )
    {
        db_include( 'get_booking_request' );

        $error_message        = 'An error has occurred - please contact support.';
        $booking_request_data = get_booking_request( $booking_request );

        $params = [
            'booking_request' => $booking_request,
            'modifier'        => SessionLib::get( 'user_member.member' )
        ];

        switch( $booking_request_data['booking_request_status'] )
        {
            case BOOKING_REQUEST_STATUS_NOT_STARTED:
                switch( $booking_request_status )
                {
                    case BOOKING_REQUEST_STATUS_IN_PROGRESS:
                        $params['booking_request_status'] = $booking_request_status;
                        break;
                    case BOOKING_REQUEST_STATUS_CLOSED:
                        return 'Cannot move booking request from Not Started to Closed.';
                    default:
                        return $error_message;
                }
                break;
            case BOOKING_REQUEST_STATUS_IN_PROGRESS:
                switch( $booking_request_status )
                {
                    case BOOKING_REQUEST_STATUS_NOT_STARTED:
                    case BOOKING_REQUEST_STATUS_CLOSED:
                        $params['booking_request_status'] = $booking_request_status;
                        break;
                    default:
                        return $error_message;
                }
                break;
            case BOOKING_REQUEST_STATUS_CLOSED:
                return 'Cannot move booking request out of Closed.';
            default:
                return $error_message;
        }

        $query = <<<SQL
update tb_booking_request
   set booking_request_status = ?booking_request_status?,
       modified               = now(),
       modifier               = ?modifier?
 where booking_request = ?booking_request?
SQL;

        $result = query_execute( $query, $params );
        return query_success( $result ) ? true : $error_message;
    }
?>
