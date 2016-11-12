$( document ).ready( gt_org_initialize );

function gt_org_initialize()
{
    $( "#gt_org_booking_form" ).validate( {
        rules : {
            org_name     : "required",
            contact_name : "required",
            email        : {
                required : true,
                email    : true
            },
            date        : "required",
            start       : "required",
            end         : "required",
            description : "required",
            attendees   : "required"
        }
    });

    $( '#gt_org_booking_form' ).submit( send_gt_org_booking_request );
}

function send_gt_org_booking_request( event )
{
    event.preventDefault();

    var org_name     = $( '#org_name' ).val();
    var contact_name = $( '#contact_name' ).val();
    var email        = $( '#email' ).val();
    var phone        = $( '#phone' ).val();
    var date         = $( '#date' ).val();

    var start       = $( '#start' ).val();
    var end         = $( '#end' ).val();
    var description = $( '#description' ).val();
    var attendees   = $( '#attendees' ).val();
    var comments    = $( '#comments' ).val();

    var data = {
        'contact_name'          : contact_name,
        'contact_email_address' : email,
        'contact_phone_number'  : phone,
        'date_requested'        : date,
        'comments'              : comments,
        'organization_name'     : org_name,
        'start_time'            : start,
        'end_time'              : end,
        'description'           : description,
        'attendee_count'        : attendees,
    }

    var url = '/common/php/ajax/create_gt_org_booking_request.php';

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
