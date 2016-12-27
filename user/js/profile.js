$( document ).ready( profile_initialize );

var upload_file;

function profile_initialize()
{
    // Profile photo init
    var input_upload_profile_photo = $( '#input_upload_profile_photo' );
    var form_upload_profile_photo  = $( '#form_upload_profile_photo' );

    form_upload_profile_photo.submit( perform_upload_profile_photo );

    $( '#upload_profile_photo' ).click( function( event ) {
        event.preventDefault();
        input_upload_profile_photo.trigger( 'click' );
    });

    input_upload_profile_photo.change( function( event ) {
        upload_file = event.target.files[0];
        form_upload_profile_photo.submit();
    });

    // Email address init
    $('#change-email-form').submit(validate_change_email);

    $( '#disp-email' ).change(reset_validation);
    $( '#disp-email-again' ).change(reset_validation);

    $("#change-email-link").click(function() {
        $('#change-email').css("display", "block");
    });

    $("#cancel-email").click(function() {
        reset_email_validation();

        $('#change-email').css("display", "none");
        $('.textbox').val("");
    });
}

function perform_upload_profile_photo( event )
{
    event.preventDefault();

    var url = '/common/php/ajax/upload_member_profile_photo.php';

    var data = new FormData();

    data.append( 'member', $( '#member_pk' ).val() );
    data.append( 'profile_photo', upload_file, upload_file['name'] );

    $.ajax( {
        'url'         : url,
        'type'        : 'POST',
        'data'        : data,
        'cache'       : false,
        'dataType'    : 'json',
        'processData' : false,
        'contentType' : false,
        'success'     : function( response, textStatus, jqXHR ) {
            if( response['success'] )
                $( '#profile_photo' ).attr( 'src', response['file_path'] );
            else
                alert( response['message'] );
        },
        'fail' : function() {
            alert( 'An error has occurred - please contact support. (Error Code: 0014)' );
        }
    });
}

function reset_email_validation()
{
    $( '#disp-email' ).removeClass( error_border );
    $( '#disp-email-again' ).removeClass( error_border );
}

function validate_change_email(event) {
    event.preventDefault();

    var disp_email          = $('#disp-email');
    var disp_email_again    = $('#disp-email-again');

    if( !disp_email.val() || !disp_email_again.val() ||
        !is_email(disp_email.val()) || !is_email(disp_email_again.val()))
    {
        validate_error( [ disp_email, disp_email_again ], 'Email is required.' );
        return;
    }

    if( disp_email.val() !== disp_email_again.val() )
    {
        validate_error( disp_email_again, 'Emails do not match.' );
        return;
    }

    var form_data = {
        'member'                :   $('#member_pk').val(),
        'display_email_address' :   disp_email.val()
    };

    send_change_email_request(form_data);
}

function send_change_email_request(data) {
    var url = '/common/php/ajax/update_member_display_email_address.php';

    $.post(url, data, function(response, textStatus, jqXHR) {
        if( response['success'] )
        {
            var new_email_address = response['display_email_address'];
            $( '#change-email-link' ).text( new_email_address );

            $('#change-email').css("display", "none");
            $('.textbox').val("");
        }
    }, 'json')
    .fail(function(){
        alert( 'An error has occurred - please contact support. (Error Code: 0015)' );
    });
}
