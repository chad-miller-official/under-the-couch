<?
    db_include( 'create_member' );

    $first_name           = $_REQUEST['first_name'];
    $last_name            = $_REQUEST['last_name'];
    $gatech_email_address = $_REQUEST['gatech_email_address'];
    $password             = $_REQUEST['password'];

    $member_pk = create_member( $gatech_email_address, $first_name, $last_name, $password );
    $success   = $member_pk !== false;

    $retval = [ 'success' => $success ];

    ajax_return_and_exit( $retval );
?>
