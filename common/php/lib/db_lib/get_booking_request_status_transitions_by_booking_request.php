<?
    function get_booking_request_status_transitions_by_booking_request( $booking_request )
    {
        $query = <<<SQL
select nbrs.booking_request_status,
       nbrs.label,
       nbrs.rgb_color
  from tb_booking_request br
  join tb_booking_request_status_transition brst
    on br.booking_request_status = brst.booking_request_status
  join tb_booking_request_status nbrs
    on brst.next_booking_request_status = nbrs.booking_request_status
 where br.booking_request = ?booking_request?
SQL;

        $params = [ 'booking_request' => $booking_request ];
        $result = query_execute( $query, $params );

        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
