$( document ).ready( validation_initialize );

function validation_initialize()
{
    $.validator.addMethod(
        "email_is_gatech",
        email_is_gatech,
        "Must be a @gatech.edu email address."
    );
}

function email_is_gatech( value, element )
{
    var email = value.replace( /\s/g, '' );

    if( email == '' )
        return false;

    return email.match( /^[\w\.]+@gatech\.edu$/g );
}
