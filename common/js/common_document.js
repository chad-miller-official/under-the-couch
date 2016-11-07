$( document ).ready( initialize );

function initialize()
{
    $( '#logout' ).click( logout );
}

function logout()
{
    var url = '/common/php/lib/ajax/logout.php';

    $.post( url, null, function( response, textStatus, jqXHR ) {
        alert( 'You have been logged out.' );
        location.reload();
    }, 'json' );
}
