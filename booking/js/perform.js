$( document ).ready( perform_initialize );

function perform_initialize()
{
    $( '#perform_booking_form' ).submit( validate_perform_booking_request );

    $( '#contact_name' ).change( reset_validation );
    $( '#email' ).change( reset_validation );
    $( '#date' ).change( reset_validation );
    $( '#band_name' ).change( reset_validation );
}

function validate_perform_booking_request( event )
{
    event.preventDefault();

    var contact_name = $( '#contact_name' );
    var email        = $( '#email' );
    var date         = $( '#date' );
    var band_name    = $( '#band_name' );

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
        validate_error( email, 'Email address is invalid.' );
        return;
    }

    if( !band_name.val() )
    {
        validate_error( band_name, 'Band name is required.' );
        return;
    }

    if( !date.val() )
    {
        validate_error( date, 'Date requested is required.' );
        return;
    }

    var comments = $( '#comments' ).val();
    var phone    = $( '#phone' ).val();
    var style    = $( '#style' ).val();
    var website  = $( '#website' ).val();

    var form_data = {
        'contact_name'          : contact_name.val(),
        'contact_email_address' : email.val(),
        'contact_phone_number'  : phone,
        'date_requested'        : date.val(),
        'comments'              : comments,
        'band_name'             : band_name.val(),
        'style_of_music'        : style,
        'band_website'          : website
    };

    send_perform_booking_request( form_data );
}

function send_perform_booking_request( data )
{
    var url = '/common/php/ajax/create_performance_booking_request.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Your booking request was successfully submitted. Please allow several days for us to respond to your request.' );
            location.reload();
        }
        else
            js_error( 'Booking request was not submitted.', PERFORM_BOOKING_REQUEST_SUBMIT_FAILURE );
    }, 'json' )
    .fail( js_generic_error );
}
