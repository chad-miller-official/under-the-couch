<?
    db_include(
        'update_member',
        'delete_member_instruments',
        'delete_member_music_genres',
        'create_member_instruments',
        'create_member_music_genres'
    );

    $optional_fields = [
        'display_email_address',
        'personal_website',
        'is_available_for_collaboration',
        'biography',
        'password'
    ];

    $member = $_REQUEST['member'];

    $instruments  = isset( $_REQUEST['instruments'] )  ? $_REQUEST['instruments']  : false;
    $music_genres = isset( $_REQUEST['music_genres'] ) ? $_REQUEST['music_genres'] : false;

    $member_params = [];

    foreach( $optional_fields as $optional_field )
    {
        if( isset( $_REQUEST[$optional_field] ) )
            $member_params[$optional_field] = $_REQUEST[$optional_field];
    }

    begin_transaction();

    $update_success = true;

    if( count( $member_params ) > 0 )
        $update_success = $update_success && update_member( $member, $member_params );

    if( is_array( $instruments ) )
    {
        $update_success = $update_success
                       && delete_member_instruments( $member )
                       && create_member_instruments( $member, $instruments );
    }

    if( is_array( $music_genres ) )
    {
        $update_success = $update_success
                       && delete_member_music_genres( $member )
                       && create_member_music_genres( $member, $music_genres );
    }

    if( !$update_success )
        rollback_transaction();
    else
        commit_transaction();

    ajax_return_and_exit( [ 'success' => $update_success ] );
?>
