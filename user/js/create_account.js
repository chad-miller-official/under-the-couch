$( document ).ready( create_account_initialize );

function create_account_initialize()
{
    $( '#create_account_form' ).validate({
        rules : {
            first_name     : "required",
            last_name      : "required",
            gatech_email   : { email_is_gatech : true },
            password       : "required",
            password_again : { passwords_match : true }
        }
    });

    $.validator.addMethod(
        'passwords_match',
        passwords_match,
        'Passwords do not match.'
    );

    $( '#create_account_form' ).submit( send_create_account_request );
}

function passwords_match( value, element )
{
    var password = $( '#password' ).val();
    return value == password;
}

function send_create_account_request( event )
{
    event.preventDefault();

    var first_name   = $( '#first_name' ).val();
    var last_name    = $( '#last_name' ).val();
    var gatech_email = $( '#gatech_email' ).val();
    var password     = $( '#password' ).val();

    var data = {
        'first_name'           : first_name,
        'last_name'            : last_name,
        'gatech_email_address' : gatech_email,
        'password'             : password
    };

    var url = '/common/php/ajax/create_member.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            perform_login( gatech_email, password );
        else
            alert( 'Error creating account: ' + response['message'] );
    }, 'json' );
}

function perform_login( gatech_email, password )
{
    var data = {
        'gatech_email_address' : gatech_email,
        'password'             : password
    };

    var url = '/common/php/ajax/login.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        window.location = '/index.php';
    }, 'json' );
}
