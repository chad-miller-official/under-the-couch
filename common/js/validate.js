// Requires: jquery-validation-1.13.0/jquery.validate.min
$.validator.addMethod(
    "email_is_gatech",
    function( value, element, params ) {
        var email = $( "#email" ).val().replace( /\s/g, '' );
        return ( email != '' && email.match( /[\w\.]+@gatech\.edu/g ) )
    },
    "Must be a @gatech.edu email address."
);
