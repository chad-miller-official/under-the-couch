$( document ).ready( index_initialize );

var limit       = 15;
var data_source = '/common/php/ajax/get_performance_booking_requests.php';

function index_initialize()
{
    var total_count = get_total_performance_booking_requests_count();

    $( '#pagination-controls' ).pagination( {
        'dataSource'  : data_source,
        'locator'     : 'data',
        'totalNumber' : total_count,
        'pageSize'    : limit,
        'callback'    : populate_booking_requests_table,
        'className'   : 'paginationjs'
    });
}

function get_total_performance_booking_requests_count()
{
    var data = {
        'pageSize'   : 1,
        'pageNumber' : 1,
        '_no_data'   : true
    };

    var total_count = 0;

    $.ajax( {
        'type'     : 'GET',
        'url'      : data_source,
        'data'     : data,
        'dataType' : 'json',
        'async'    : false,
    })
    .done( function( response, textStatus, jqXHR ) {
        if( response['success'] )
            total_count = response['total'];
        else
            alert( 'Failed to load booking requests.' );
    })
    .fail( function() {
        alert( 'An error has occurred - please contact support.' );
    });

    return total_count;
}

function populate_booking_requests_table( data, pagination )
{
    var booking_requests_body = $( '#booking_requests_tbody' );

    booking_requests_body.empty();

    $.each( data, function( i, booking_request ) {
        var booking_request_pk_val         = booking_request['booking_request'];
        var booking_request_status_hex_rgb = booking_request['booking_request_status_hex_rgb'];

        var booking_request_modal_link = $( '<a>' )
            .text( booking_request['additional_information']['band_name'] )
            .prop(
                'href',
                '/dashboard/booking/modal_performance_booking_request.php?booking_request=' + booking_request_pk_val
            )
            .attr( 'data-featherlight', '' );

        var booking_request_pk     = $( '<td>' ).text( booking_request_pk_val );
        var band_name              = $( '<td>' ).append( booking_request_modal_link );
        var contact_name           = $( '<td>' ).text( booking_request['contact_name'] );
        var contact_email_address  = $( '<td>' ).text( booking_request['contact_email_address'] );
        var date_requested         = $( '<td>' ).text( booking_request['date_requested'] );
        var created                = $( '<td>' ).text( booking_request['created'] );
        var booking_request_status = $( '<td>' ).text( booking_request['booking_request_status'] );

        var row = $( '<tr>' ).css( 'background-color', booking_request_status_hex_rgb );

        row.append(
            booking_request_pk,
            band_name,
            contact_name,
            contact_email_address,
            date_requested,
            created,
            booking_request_status
        );

        booking_requests_body.append( row );
    });
}
