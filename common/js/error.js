var DELETE_BLOG_POST_FAILURE     = 1;
var EDIT_BLOG_POST_FAILURE       = 2;
var BLOG_POST_EMAIL_SEND_FAILURE = 3;
var BLOG_POST_SUBMIT_FAILURE     = 4;

var GT_ORG_BOOKING_REQUEST_SUBMIT_FAILURE  = 11;
var PERFORM_BOOKING_REQUEST_SUBMIT_FAILURE = 12;
var RECORD_BOOKING_REQUEST_SUBMIT_FAILURE  = 13;

var PAGINATION_FAILURE = 21;

var LOAD_MEMBERS_FAILURE = 31;
var MODIFY_ROLES_ERROR   = 32;

var SEND_BOOKING_REQUEST_EMAIL_ERROR = 41;

var GENERIC_ERROR      = 300;
var PAGINATION_FAILURE = 301;

function lpad( error_code )
{
    var str    = '' + error_code;
    var pad    = '0000';
    var retval = pad.substring( 0, pad.length - str.length ) + str;
    return retval;
}

function js_error( message, error_code )
{
    alert( message + ' (Error Code: ' + lpad( error_code ) + ')' );
}

function js_generic_error( page_url )
{
    js_error( 'An error has occurred - please contact support.', GENERIC_ERROR );
}
