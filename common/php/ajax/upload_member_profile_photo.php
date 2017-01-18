<?
    db_include( 'update_member_profile_photo_path' );

    $member_pk        = $_REQUEST['member'];
    $upload_file_info = $_FILES['profile_photo'];
    $upload_success   = true;

    $max_file_size = 500000;

    if( $upload_file_info['error'] == UPLOAD_ERR_INI_SIZE || $upload_file_info['size'] > $max_file_size )
    {
        $upload_success = false;
        $message        = 'File too large - please choose a smaller file.';
    }

    $upload_file_type = preg_replace( '/^image\//', '', $upload_file_info['type'] );

    if( !( $upload_file_type == 'jpeg' || $upload_file_type == 'png' ) )
    {
        $upload_success = false;
        $message        = 'File type not allowed; allowed types: JPEG, PNG.';
    }

    if( $upload_success )
    {
        do
        {
            $upload_file_dest = '/media/profile/' . uniqid() . ".$upload_file_type";
        } while( file_exists( $upload_file_dest ) );

        move_uploaded_file( $upload_file_info['tmp_name'], $GLOBALS['webroot'] . $upload_file_dest );
        $old_profile_photo_path = update_member_profile_photo_path( $member_pk, $upload_file_dest );

        if( $old_profile_photo_path === false )
        {
            $upload_success = false;
            $message        = 'An error has occured - please contact support.';
        }
        elseif( !is_null( $old_profile_photo_path ) )
            unlink( $GLOBALS['webroot'] . $old_profile_photo_path );
    }

    $retval = [ 'success' => $upload_success ];

    if( !$upload_success )
        $retval['message'] = $message;
    else
        $retval['file_path'] = $upload_file_dest;

    ajax_return_and_exit( $retval );
?>
