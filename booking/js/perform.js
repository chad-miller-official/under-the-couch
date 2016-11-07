$( document ).ready( perform_initialize );

function perform_initialize()
{
    $( "#perform_booking_form" ).validate( {
        rules           : {
            contact_name : "required",
            email        : {
                required : true,
                email    : true
            },
            band_name : "required",
            date      : "required"
        }
    });

    $( '#perform_booking_form' ).submit( send_perform_booking_request );
}

function send_perform_booking_request( event )
{
    event.preventDefault();

    var contact_name = $( '#contact_name' ).val();
    var email        = $( '#email' ).val();
    var phone        = $( '#phone' ).val();
    var date         = $( '#date' ).val();
    var comments     = $( '#comments' ).val();

    var band_name = $( '#band_name' ).val();
    var style     = $( '#style' ).val();
    var website   = $( '#website' ).val();

    var data = {
        'contact_name'          : contact_name,
        'contact_email_address' : email,
        'contact_phone_number'  : phone,
        'date_requested'        : date,
        'comments'              : comments,
        'band_name'             : band_name,
        'style_of_music'        : style,
        'band_website'          : website
    };

    var url = '/common/php/lib/ajax/create_performance_booking_request.php';

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
