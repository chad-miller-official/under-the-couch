$( document ).ready( edit_role_initialize );

function edit_role_initialize() {
    $( '#edit_role_form' ).submit( validate_edit_role_request );

    $( '#add_role' ).change( reset_validation );
    $( '#remove_role' ).change( reset_validation );
}

function validate_edit_role_request( event ) {
    event.preventDefault();

    var add_role      = $( '#add_role' );
    var remove_role   = $( '#remove_role' );
    var member_pk     = $( '#member_pk' ).val(); /* Probably this look less hacky */

    if ( add_role.val() == 'none' && remove_role.val() == 'none' ) {
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
    var url = '/common/php/ajax/change_member_roles.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            alert( 'Role(s) have been changed.' );
            close_current_modal();
            location.reload(); /* TODO: Get pagination reload working */
        }
        else
            alert( response['error'] );
    }, 'json' )
    .fail( function() {
        alert( 'An error has occurred - please contact support.' );
    });
}
