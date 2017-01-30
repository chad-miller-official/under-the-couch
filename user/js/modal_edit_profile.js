$( document ).ready( modal_edit_profile_initialize );

var display_email_address = $( '#display_email_address' );
var password              = $( '#password' );
var password_again        = $( '#password_again' );

var instruments  = $( '#instruments' );
var music_genres = $( '#music_genres' );

var fields_changed = [];

function modal_edit_profile_initialize()
{
    instruments.chosen();
    music_genres.chosen();

    $( '#update_member_form' ).submit( validate_update_member_request );

    display_email_address.change( handle_display_email_address_input_change );
    password.change( handle_password_input_change );
    password_again.change( handle_password_input_change );

    $( '#personal_website' ).change( handle_field_change );
    $( 'input[name=is_available_for_collaboration]' ).change( handle_field_change );
    $( '#biography' ).change( handle_field_change );

    instruments.change( handle_field_change );
    music_genres.change( handle_field_change );
}

function handle_display_email_address_input_change()
{
    reset_validation.call( display_email_address );
    handle_field_change.call( display_email_address );
}

function handle_password_input_change()
{
    reset_validation.call( password );
    reset_validation.call( password_again );
    handle_field_change.call( password );
}

function handle_field_change()
{
    var self = $( this );
    var name;

    if( self.attr( 'type' ) == 'radio' )
    {
        name = self.attr( 'name' );
        self = $( 'input[name=' + name + ']:checked');
    }
    else
        name = self.attr( 'id' );

    fields_changed[name] = self.val();
}

function validate_update_member_request( event )
{
    event.preventDefault();

    if( Object.keys( fields_changed ).length == 0 )
    {
        window.location.reload();
        return;
    }

    var member_pk = $( '#member_pk' ).val();

    if( display_email_address.val() && !is_email( display_email_address.val() ) )
    {
        validate_error( display_email_address, 'Display email address must be a valid email address.' );
        return;
    }

    if(
           ( password.val() || password_again.val() )
        && password.val() !== password_again.val()
      )
    {
        validate_error( [ password, password_again ], 'Passwords do not match.' );
        return;
    }

    var member_form_data = $.extend( { 'member' : member_pk }, fields_changed );
    send_update_member_request( member_form_data );
}

function send_update_member_request( data )
{
    var url    = '/common/php/ajax/update_member.php';
    var retval = false;

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( !response['success'] )
            js_error( 'Unable to update profile.', UPDATE_MEMBER_PROFILE_ERROR );
        else
            window.location.reload();
    }, 'json' )
    .fail( js_generic_error );

    return retval;
}
