<?
    function create_booking_request( $type, $map )
    {
        $insert_booking_request = <<<SQL
insert into tb_booking_request
(
    booking_request_type,
    contact_name,
    contact_email_address,
    contact_phone_number,
    date_requested,
    comments,
    additional_information
)
values
(
    ?booking_request_type?,
    ?contact_name?,
    ?contact_email_address?,
    ?contact_phone_number?,
    ?date_requested?,
    ?comments?,
    ?additional_information?
)
returning booking_request
SQL;
        $map['booking_request_type']   = $type;

        if( isset( $map['additional_information'] ) )
            $map['additional_information'] = json_encode( $map['additional_information'] );
        else
            $map['additional_information'] = null;

        $insert = query_execute( $insert_booking_request, $map );

        return query_success( $insert ) ? query_fetch_one( $insert ) : false;
    }
?>
