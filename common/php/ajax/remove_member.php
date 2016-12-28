<?
    db_include( 'remove_member' );

    $member_pk = isset( $_REQUEST['member'] ) ? $_REQUEST['member'] : false;

    $no_data = isset( $_REQUEST['_no_data'] ) && $_REQUEST['_no_data'];

    $data       = remove_member ( $member_pk );
    $success    = $data !== false;

    $retval = [
        'success' => $success,
    ];

    if( $success && !$no_data )
    {
        $retval['data'] = $data;
    }

    ajax_return_and_exit( $retval );
?>
