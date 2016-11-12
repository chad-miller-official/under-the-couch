$( document ).ready( login_initialize );

function login_initialize()
{
    $( '#login_form' ).validate({
        rules : {
            gatech_email : { email_is_gatech : true },
            password     : 'required'
        }
    });

    $( '#login_form' ).submit( send_login_request );
}

function send_login_request( event )
{
    event.preventDefault();

    var gatech_email = $( '#gatech_email' ).val();
    var password     = $( '#password' ).val();

    var data = {
        'gatech_email_address' : gatech_email,
        'password'             : password
    };

    var url = '/common/php/ajax/login.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            window.location = '/index.php';
        else
            alert( "Email address or password is incorrect." );
    }, 'json' )
    .fail( function() {
        alert( 'An error has occurred - please contact support.' );
    });
}
