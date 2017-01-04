<?
    db_include( 'remove_member' );

    $member_pk = $_REQUEST['member'];

    $success = remove_member( $member_pk );
    $retval  = [ 'success' => $success ];

    ajax_return_and_exit( $retval );
?>
