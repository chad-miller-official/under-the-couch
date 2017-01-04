$( document ).ready( login_initialize );

function login_initialize()
{
    $( '#login_form' ).submit( validate_login_request );

    $( '#gatech_email' ).change( reset_validation );
    $( '#password' ).change( reset_validation );
}

function validate_login_request( event )
{
    event.preventDefault();

    var gatech_email = $( '#gatech_email' );
    var password     = $( '#password' );

    if( !gatech_email.val() )
    {
        validate_error( gatech_email, 'Email is required.' );
        return;
    }
    else if( !email_is_gatech( gatech_email.val() ) )
    {
        validate_error( gatech_email, 'Please log in using your @gatech.edu email address.' );
        return;
    }

    if( !password.val() )
    {
        validate_error( password, 'Password is required.' );
        return;
    }

    var form_data = {
        'gatech_email_address' : gatech_email.val(),
        'password'             : password.val()
    };

    send_login_request( form_data );
}

function send_login_request( data )
{
    var url = '/common/php/ajax/login.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            window.location = '/index.php';
        else
            alert( "Email address or password is incorrect." );
    }, 'json' )
    .fail( js_generic_error );
}
