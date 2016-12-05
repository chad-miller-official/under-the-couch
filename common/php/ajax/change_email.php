<?
    db_include('change_email');

    $member_pk              = $_REQUEST['member'];
    $display_email_address  = $_REQUEST['display_email_address'];

    $change_email_success = change_display_email($member_pk, $display_email_address);

    $retval['success'] = $change_email_success;
    if (!$change_email_success)
        $retval['message'] = 'An error has occured - please contact support.';

    ajax_return_and_exit($retval);
?>
