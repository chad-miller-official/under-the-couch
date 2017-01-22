$( document ).ready( initialize );

function initialize()
{
    $( '#booking_request_status_change_form' ).submit( validate_status_change );
}

function validate_status_change( event )
{
    event.preventDefault();

    var booking_request_pk = $( '#booking_request_pk' ).val();
    var current_status_pk  = $( '#current_status_pk' ).val();
    var new_status_pk      = $( '#new_booking_request_status' ).val();

    var status_not_started = $( '#status_not_started' ).val();
    var status_in_progress = $( '#status_in_progress' ).val();
    var status_closed      = $( '#status_closed' ).val();

    var error_message = current_status_pk + " -> " + new_status_pk + ": Invalid status change."

    alert( booking_request_pk + ":\n" + current_status_pk + " -> " + new_status_pk);

    switch( current_status_pk )
    {
        case( status_not_started ):
            if( new_status_pk == status_not_started || new_status_pk == status_closed )
            {
                alert( error_message );
                return;
            }
            else
                break;
        case( status_in_progress ):
            if( new_status_pk == status_in_progress )
            {
                alert( error_message );
                return;
            }
            else
                break;
        case( status_closed ):
            if( new_status_pk == status_not_started || new_status_pk == status_closed )
            {
                alert( error_message );
                return;
            }
            else
                break;
    }

    var form_data = {
        'booking_request'        : booking_request_pk,
        'booking_request_status' : new_status_pk
    }

    send_status_change_request( form_data );
}

function send_status_change_request( data )
{
    var url = '/common/php/ajax/update_booking_request_status.php';

    $.post( url, data, function (response, textStatus, jqXHR )
        {
            if( response[ 'success' ])
            {
                alert( '>:]\n\tnice' );
                window.location.reload();
            }
            else
                js_generic_error ( window.location.href );
        }
    )
    .fail( js_generic_error );
}

/*
function validate_booking_request_email( event )
{
    event.preventDefault();

    var email_text = $( '#email_text' );

    if( !email_text.val() )
    {
        validate_error( email_text, 'Email body is required.' );
        return;
    }

    var form_data = {
        'booking_request' : $( '#booking_request_pk' ).val(),
        'email_text'      : email_text.val()
    };

    send_booking_request_email_request( form_data );
}

function send_booking_request_email_request( data )
{
    var url = '/common/php/ajax/send_booking_request_email.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Email sent!' );
            window.location.reload();
        }
        else
            js_error( response['error'], SEND_BOOKING_REQUEST_EMAIL_ERROR );
    }, 'json' )
    .fail( js_generic_error );
}
*/
