<?
    db_include('update_member_display_email_address');

    $member_pk              = $_REQUEST['member'];
    $display_email_address  = $_REQUEST['display_email_address'];

    $change_email_success = update_member_display_email_address($member_pk, $display_email_address);

    $retval['success'] = $change_email_success;
    if (!$change_email_success)
        $retval['message'] = 'An error has occured - please contact support.';
    else
        $retval['display_email_address'] = $display_email_address;

    ajax_return_and_exit( $retval );
?>
