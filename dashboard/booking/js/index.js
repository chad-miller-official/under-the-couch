$( document ).ready( index_initialize );

var class_file = 'GetPerformanceBookingRequestsPaginator';
var limit      = 15;

function index_initialize()
{
    pagination_init(
        class_file,
        limit,
        populate_booking_requests_table
    );
}

function populate_booking_requests_table( data, pagination )
{
    var booking_requests_body = $( '#booking_requests_tbody' );

    booking_requests_body.empty();

    $.each( data, function( i, booking_request ) {
        var booking_request_pk_val           = booking_request['booking_request'];
        var booking_request_status_rgb_color = booking_request['booking_request_status_rgb_color'];

        var booking_request_modal_link = $( '<a>' )
            .text( booking_request['additional_information']['band_name'] )
            .prop(
                'href',
                '/dashboard/booking/modal_performance_booking_request.php?booking_request=' + booking_request_pk_val
            )
            .attr( 'data-featherlight', 'ajax' );

        var booking_request_pk     = $( '<td>' ).text( booking_request_pk_val );
        var band_name              = $( '<td class="text-cell">' ).append( booking_request_modal_link );
        var contact_name           = $( '<td class="text-cell">' ).text( booking_request['contact_name'] );
        var contact_email_address  = $( '<td class="text-cell">' ).text( booking_request['contact_email_address'] );
        var date_requested         = $( '<td class="text-cell">' ).text( booking_request['date_requested'] );
        var created                = $( '<td class="text-cell">' ).text( booking_request['created'] );
        var booking_request_status = $( '<td class="text-cell">' ).text( booking_request['booking_request_status'] );

        var row = $( '<tr>' ).css( 'background-color', 'rgba(' + booking_request_status_rgb_color + ',0.4)' );

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
