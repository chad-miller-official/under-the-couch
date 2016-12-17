<?
    function get_booking_request( $booking_request )
    {
        $get_booking_request_query = <<<SQL
select br.booking_request,
       br.contact_name,
       br.contact_email_address,
       br.contact_phone_number,
       br.date_requested,
       br.comments,
       br.additional_information,
       to_char( br.created, 'YYYY-MM-DD' ) as created,
       br.booking_request_status as booking_request_status,
       brs.label as booking_request_status_label,
       brs.rgb_color as booking_request_status_rgb_color,
       brt.label as booking_request_type
  from tb_booking_request br
   join tb_booking_request_status brs
  using ( booking_request_status )
   join tb_booking_request_type brt
  using ( booking_request_type )
  where br.booking_request = ?booking_request?
SQL;

        $params = [ 'booking_request' => $booking_request ];
        $result = query_execute( $get_booking_request_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
