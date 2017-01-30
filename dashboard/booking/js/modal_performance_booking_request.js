$( document ).ready( initialize );

function initialize()
{
    $( '#booking_request_status_change_form' ).submit( validate_status_change );
}

function validate_status_change( event )
{
    event.preventDefault();

    var booking_request_pk = $( '#booking_request_pk' ).val();
    var new_status_pk      = $( '#new_booking_request_status' ).val();

    var form_data = {
        'booking_request'        : booking_request_pk,
        'booking_request_status' : new_status_pk
    }

    send_status_change_request( form_data );
}

function send_status_change_request( data )
{
    var url = '/common/php/ajax/update_booking_request_status.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response[ 'success' ])
            window.location.reload();
        else
            alert( response['message'] );
    })
    .fail( js_generic_error );
}
