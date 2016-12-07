$( document ).ready( index_initialize );

var offset = 0;
var limit  = 15;

function index_initialize()
{
    var booking_requests_body = $( '#booking_requests_tbody' );
    var next = $( '#next' );
    var prev = $( '#prev' );

    next.click( function( event ) {
        event.preventDefault();
        prev.css( 'display', '' );

        offset += limit;

        booking_requests_body.empty();
        send_get_performance_booking_requests_request();
    });

    prev.click( function( event ) {
        event.preventDefault();
        next.css( 'display', '' );

        offset -= limit;

        booking_requests_body.empty();
        send_get_performance_booking_requests_request();
    });

    send_get_performance_booking_requests_request();
}

function send_get_performance_booking_requests_request()
{
    var url = '/common/php/ajax/get_performance_booking_requests.php';

    var data = {
        'limit'  : limit,
        'offset' : offset
    };

    $.get( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            var response_data = response['data'];
            var data_count    = response['count'];
            var total_count   = response['total'];

            if( data_count > 0 )
                populate_booking_requests_table( response_data );

            if( offset >= total_count - 1 || data_count == total_count )
                $( '#next' ).css( 'display', 'none' );
            else if( offset <= 0 )
                $( '#prev' ).css( 'display', 'none' );
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
    var booking_requests_body = $( '#booking_requests_tbody' );

    $.each( data, function( i, booking_request ) {
        var booking_request_status_hex_rgb = booking_request['booking_request_status_hex_rgb'];

        var booking_request_pk     = $( '<td>' ).text( booking_request['booking_request'] );
        var contact_name           = $( '<td>' ).text( booking_request['contact_name'] );
        var contact_email_address  = $( '<td>' ).text( booking_request['contact_email_address'] );
        var contact_phone_number   = $( '<td>' ).text( booking_request['contact_phone_number'] );
        var date_requested         = $( '<td>' ).text( booking_request['date_requested'] );
        var created                = $( '<td>' ).text( booking_request['created'] );
        var booking_request_status = $( '<td>' ).text( booking_request['booking_request_status'] );

        var row = $( '<tr>' ).css( 'background-color', booking_request_status_hex_rgb );

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
