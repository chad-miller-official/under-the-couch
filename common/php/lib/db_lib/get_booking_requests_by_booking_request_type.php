<?
    function get_booking_requests_by_booking_request_type( $booking_request_type )
    {
        $get_booking_requests = <<<SQL
  select br.booking_request,
         br.contact_name,
         br.contact_email_address,
         br.contact_phone_number,
         br.date_requested,
         br.comments,
         br.additional_information,
         to_char( br.created, 'YYYY-MM-DD' ) as created,
         brs.label as booking_request_status,
         brt.label as booking_request_type
    from tb_booking_request br
    join tb_booking_request_status brs
   using ( booking_request_status )
    join tb_booking_request_type brt
   using ( booking_request_type )
   where br.booking_request_type = ?booking_request_type?
order by br.created
SQL;

        $params = [ 'booking_request_type' => $booking_request_type ];
        $result = query_execute( $get_booking_requests, $params );

        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
