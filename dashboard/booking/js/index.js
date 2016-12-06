$( document ).ready( index_initialize );

function index_initialize()
{
    send_get_performance_booking_requests_request();
}

function send_get_performance_booking_requests_request()
{
    var url = '/common/php/ajax/get_performance_booking_requests.php';

    $.get( url, null, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            var response_data = response['data'];
            populate_booking_requests_table( response_data );
        }
        else
            alert( 'Failed to load booking requests.' );
    }, 'json' )
    .fail( function() {
        alert( 'An error has occurred - please contact support.' );
    });
}

function populate_booking_requests_table( data )
{
    var booking_requests_body = $( '#booking_requests_table > tbody:last-child' );

    $.each( data, function( i, booking_request ) {
        var booking_request_status_hex_rgb = booking_request['booking_request_status_hex_rgb'];

        var booking_request_pk     = $( '<td>' ).text( booking_request['booking_request'] );
        var contact_name           = $( '<td>' ).text( booking_request['contact_name'] );
        var contact_email_address  = $( '<td>' ).text( booking_request['contact_email_address'] );
        var contact_phone_number   = $( '<td>' ).text( booking_request['contact_phone_number'] );
        var date_requested         = $( '<td>' ).text( booking_request['date_requested'] );
        var created                = $( '<td>' ).text( booking_request['created'] );
        var booking_request_status = $( '<td>' ).text( booking_request['booking_request_status'] );

        var row = $( '<tr>' ).attr( 'style', 'background-color:' + booking_request_status_hex_rgb );

        row.append(
            booking_request_pk,
            contact_name,
            contact_email_address,
            contact_phone_number,
            date_requested,
            created,
            booking_request_status
        );

        booking_requests_body.append( row );
    });
}
