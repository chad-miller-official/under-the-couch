$( document ).ready( gt_org_initialize );

function gt_org_initialize()
{
    $( '#gt_org_booking_form' ).submit( validate_gt_org_booking_request );

    $( '#org_name' ).change( reset_validation );
    $( '#contact_name' ).change( reset_validation );
    $( '#email' ).change( reset_validation );
    $( '#date' ).change( reset_validation );
    $( '#start' ).change( reset_validation );
    $( '#end' ).change( reset_validation );
    $( '#description' ).change( reset_validation );
    $( '#attendees' ).change( reset_validation );
}

function validate_gt_org_booking_request( event )
{
    event.preventDefault();

    var org_name     = $( '#org_name' );
    var contact_name = $( '#contact_name' );
    var email        = $( '#email' );
    var date         = $( '#date' );
    var start        = $( '#start' );
    var end          = $( '#end' );
    var description  = $( '#description' );
    var attendees    = $( '#attendees' );

    if( !org_name.val() )
    {
        validate_error( org_name, 'Organization name is required.' );
        return;
    }

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

    if( !start.val() )
    {
        validate_error( start, 'Start time is required.' );
        return;
    }

    if( !end.val() )
    {
        validate_error( end, 'End time is required.' );
        return;
    }

    if( !description.val() )
    {
        validate_error( description, 'Description is required.' );
        return;
    }

    if( !attendees.val() )
    {
        validate_error( attendees, 'Expected number of attendees is required.' );
        return;
    }

    var phone    = $( '#phone' ).val();
    var comments = $( '#comments' ).val();

    var form_data = {
        'contact_name'          : contact_name.val(),
        'contact_email_address' : email.val(),
        'contact_phone_number'  : phone,
        'date_requested'        : date.val(),
        'comments'              : comments,
        'organization_name'     : org_name.val(),
        'start_time'            : start.val(),
        'end_time'              : end.val(),
        'description'           : description.val(),
        'attendee_count'        : attendees.val()
    };

    send_gt_org_booking_request( form_data );
}

function send_gt_org_booking_request( data )
{
    var url = '/common/php/ajax/create_gt_org_booking_request.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Your booking request was successfully submitted. Please allow several days for us to respond to your request.' );
            location.reload();
        }
        else
            js_error( 'Booking request was not submitted.', GT_ORG_BOOKING_REQUEST_SUBMIT_FAILURE );
    }, 'json' )
    .fail( js_generic_error );
}
