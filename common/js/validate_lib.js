var error_border = 'required-is-empty';

function is_email( value )
{
    var email = value.replace( /\s/g, '' );

    if( email == '' )
        return false;

    return email.match( /^[\w\.]+\@[\w]+\.[\w]+/ );
}

function email_is_gatech( value )
{
    var email = value.replace( /\s/g, '' );

    if( email == '' )
        return false;

    return email.match( /^[\w\.]+@gatech\.edu$/ );
}

function validate_error( element, message )
{
    alert( message );

    if( Array.isArray( element ) )
    {
        for( var i = 0; i < element.length; i++ )
            element[i].addClass( error_border );
    }
    else
        element.addClass( error_border );
}

function reset_validation()
{
    $( this ).removeClass( error_border );
}
