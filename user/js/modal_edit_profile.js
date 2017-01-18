$( document ).ready( modal_edit_profile_initialize );

function modal_edit_profile_initialize()
{
    $( '#update_member_form' ).submit( validate_update_member_request );

    $( '#display_email_address' ).change( reset_validation );
    $( '#password' ).change( reset_password_validation );
    $( '#password_again' ).change( reset_password_validation );
}

function reset_password_validation()
{
    $( '#password' ).removeClass( error_border );
    $( '#password_again' ).removeClass( error_border );
}

function validate_update_member_request( event )
{
    event.preventDefault();

    // display_email_address (validation: must be an email address)
    // password
    // password_again
    // personal_website
    // is_available_for_collaboration
    // biography

    var form_data ={
        // TODO
    };

    send_update_member_request( form_data );
}

function send_update_member_request( data )
{
    var url = '/common/php/ajax/update_member.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            window.location.reload();
        else
            js_error( 'Unable to update profile.', UPDATE_MEMBER_PROFILE_ERROR );
    }, 'json' )
    .fail( js_generic_error );
}
