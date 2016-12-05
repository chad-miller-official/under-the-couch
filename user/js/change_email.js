$(document).ready(change_email_initialize);

function change_email_initialize() {
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
    })
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
    var url = '/common/php/ajax/change_email.php';

    $.post(url, data, function(response, textStatus, jqXHR) {
        window.location.reload();
    }, 'json')
    .fail(function(){
        alert('An error has occurred - please contact support.');
        //window.location.reload();
    });
}
