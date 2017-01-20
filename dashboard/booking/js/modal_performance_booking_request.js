$( document ).ready( initialize );

function initialize()
{
    var booking_request_pk = $( '#booking_request_pk' ).val();
    var status_pk = $( '#status_pk' ).val() * 1;

    data_back = {
        'booking_request' : booking_request_pk,
        'status'          : (status_pk - 1)
    }

    data_forward = {
        'booking_request' : booking_request_pk,
        'status'          : (status_pk + 1)
    }

    //$( '#performance_booking_response' ).submit( validate_booking_request_email );
    //$( '#email_text' ).change( reset_validation );
    $( '#booking_request_back' ).click( data_back, status_change );
    $( '#booking_request_forward' ).click( data_forward, status_change );
}

function status_change( event )
{
    booking_request_pk = event.data[ 'booking_request' ];
    status_pk          = event.data[ 'status' ];

    alert( booking_request_pk + ", " + status_pk );

    var form_data = {
        'booking_request'        : booking_request_pk,
        'booking_request_status' : status_pk
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
