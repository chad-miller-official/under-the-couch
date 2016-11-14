$( document ).ready( record_initialize );

function record_initialize()
{
    $( '#record_booking_form' ).submit( validate_record_booking_request );

    $( '#contact_name' ).change( reset_validation );
    $( '#email' ).change( reset_validation );
    $( '#date' ).change( reset_validation );
}

function validate_record_booking_request( event )
{
    event.preventDefault();

    var contact_name = $( '#contact_name' );
    var email        = $( '#email' );
    var date         = $( '#date' );

    if( !contact_name.val() )
    {
        validate_error( contact_name, 'Contact name is required.' );
        return;
    }

    if( !email.val() )
    {
        validate_error( email, 'Email address is required.' );
        return;
    }
    else if( !is_email( email.val() ) )
    {
        validate_error( email, 'Email address is not valid.' );
        return;
    }

    if( !date.val() )
    {
        validate_error( date, 'Date requested is required.' );
        return;
    }

    var phone    = $( '#phone' ).val();
    var comments = $( '#comments' ).val();

    var form_data = {
        'contact_name'          : contact_name.val(),
        'contact_email_address' : email.val(),
        'contact_phone_number'  : phone,
        'date_requested'        : date.val(),
        'comments'              : comments
    };

    send_record_booking_request( form_data );
}

function send_record_booking_request( data )
{
    var url = '/common/php/ajax/create_recording_booking_request.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Your booking request was successfully submitted. Please allow several days for us to respond to your request.' );
            location.reload();
        }
        else
            alert( 'An error has occurred - please contact support.' );
    }, 'json' )
    .fail( function() {
        alert( 'An error has occurred - please contact support.' );
    });
}
