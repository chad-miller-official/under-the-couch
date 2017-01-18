$( document ).ready( edit_role_initialize );

function edit_role_initialize()
{
    $( '#edit_role_form' ).submit( validate_edit_role_request );

    $( '#add_role' ).change( reset_validation );
    $( '#remove_role' ).change( reset_validation );
}

function validate_edit_role_request( event )
{
    event.preventDefault();

    var add_role    = $( '#add_role' );
    var remove_role = $( '#remove_role' );
    var member_pk   = $( '#member_pk' ).val(); /* Probably this look less hacky */

    if( add_role.val() == '--' && remove_role.val() == '--' )
    {
        validate_error( add_role, 'Must select roles to add or remove.' );
        return;
    }

    var form_data = {
        'member' : member_pk,
        'add'    : add_role.val(),
        'remove' : remove_role.val()
    };

    send_edit_role_request( form_data );
}

function send_edit_role_request( data ) {
    if( data['add'] == '--' )
        delete data['add'];

    if( data['remove'] == '--' )
        delete data['remmove'];

    var url = '/common/php/ajax/change_member_roles.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Role(s) have been changed.' );
            location.reload(); /* TODO: Get pagination reload working */
        }
        else
            js_error( response['error'], MODIFY_ROLES_ERROR );
    }, 'json' )
    .fail( js_generic_error );
}
