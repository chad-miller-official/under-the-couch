$( document ).ready( record_initialize );

function record_initialize()
{
    $( "#record_booking_form" ).validate( {
        rules : {
            contact_name : "required",
            email        : {
                required : true,
                email    : true
            },
            date : "required"
        }
    });

    $( '#record_booking_form' ).submit( send_record_booking_request );
}

function send_record_booking_request( event )
{
    event.preventDefault();

    var contact_name = $( '#contact_name' ).val();
    var email        = $( '#email' ).val();
    var phone        = $( '#phone' ).val();
    var date         = $( '#date' ).val();
    var comments     = $( '#comments' ).val();

    var data = {
        'contact_name'          : contact_name,
        'contact_email_address' : email,
        'contact_phone_number'  : phone,
        'date_requested'        : date,
        'comments'              : comments
    };

    var url = '/common/php/ajax/create_recording_booking_request.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Your booking request was successfully submitted. Please allow several days for us to respond to your request.' );
            location.reload();
        }
        else
            alert( 'An error has occurred - please contact support.' );
    }, 'json' );
}
