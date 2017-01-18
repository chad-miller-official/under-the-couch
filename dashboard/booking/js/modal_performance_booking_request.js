$( document ).ready( initialize );

function initialize()
{
    $( '#performance_booking_response' ).submit( validate_booking_request_email );
    $( '#email_text' ).change( reset_validation );
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
