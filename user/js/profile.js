$( document ).ready( profile_initialize );

var upload_file;

function profile_initialize()
{
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
            alert( 'An error has occurred - please contact support.' );
        }
    });
}
