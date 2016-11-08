$( document ).ready( initialize );

function initialize()
{
    $( '#logout' ).click( logout );
}

function logout()
{
    var url = '/common/php/ajax/logout.php';

    $.post( url, null, function( response, textStatus, jqXHR ) {
        alert( 'You have been logged out.' );
        window.location = '/index.php';
    }, 'json' );
}
