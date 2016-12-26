<?
    class GetPerformanceBookingRequestsPaginator extends Paginator
    {
        public function getData()
        {
            db_include( 'get_booking_requests_by_booking_request_type' );

            $data = get_booking_requests_by_booking_request_type(
                BOOKING_REQUEST_TYPE_PERFORMANCE,
                $this->limit,
                $this->offset
            );

            if( $data !== false )
            {
                foreach( $data as $index => $booking_request )
                {
                    $additional_information                 = $booking_request['additional_information'];
                    $data[$index]['additional_information'] = json_decode( $additional_information, true );
                }
            }

            return $data;
        }
    }
?>
