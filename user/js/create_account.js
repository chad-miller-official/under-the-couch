$( document ).ready( create_account_initialize );

var password       = $( '#password' );
var password_again = $( '#password_again' );

function create_account_initialize()
{
    $( '#create_account_form' ).submit( validate_create_account_request );

    $( '#first_name' ).change( reset_validation );
    $( '#last_name' ).change( reset_validation );
    $( '#gatech_email' ).change( reset_validation );

    password.change( reset_password_validation );
    password.change( reset_password_validation );
}

function reset_password_validation()
{
    reset_validation.call( password );
    reset_validation.call( password_again );
}

function validate_create_account_request( event )
{
    event.preventDefault();

    var first_name   = $( '#first_name' );
    var last_name    = $( '#last_name' );
    var gatech_email = $( '#gatech_email' );

    if( !first_name.val() )
    {
        validate_error( first_name, 'First name is required.' );
        return;
    }

    if( !last_name.val() )
    {
        validate_error( last_name, 'Last name is required.' );
        return;
    }

    if( !gatech_email.val() )
    {
        validate_error( gatech_email, 'Email is required.' );
        return;
    }
    else if( !email_is_gatech( gatech_email.val() ) )
    {
        validate_error( gatech_email, 'Please use your @gatech.edu email address.' );
        return;
    }

    if( !password.val() || !password_again.val() )
    {
        validate_error( [ password, password_again ], 'Password is required.' );
        return;
    }
    else if( password.val() !== password_again.val() )
    {
        validate_error( password_again, 'Passwords do not match.' );
        return;
    }

    var form_data = {
        'first_name'           : first_name.val(),
        'last_name'            : last_name.val(),
        'gatech_email_address' : gatech_email.val(),
        'password'             : password.val()
    };

    send_create_account_request( form_data );
}

function send_create_account_request( data )
{
    var url = '/common/php/ajax/create_member.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
        {
            var login_data = {
                'gatech_email_address' : data['gatech_email_address'],
                'password'             : data['password']
            };

            perform_login( data );
        }
        else
            alert( 'An account with the GATech email address ' + data['gatech_email_address'] + ' already exists.' );
    }, 'json' )
    .fail( js_generic_error );
}

function perform_login( data )
{
    var url = '/common/php/ajax/login.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        window.location = '/index.php';
    }, 'json' )
    .fail( function() {
        alert( 'Account created - please log in.' );
        window.location = '/user/login.php';
    });
}
