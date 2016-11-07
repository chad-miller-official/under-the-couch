<?
    db_include( 'create_member' );

    $first_name           = $_REQUEST['first_name'];
    $last_name            = $_REQUEST['last_name'];
    $gatech_email_address = $_REQUEST['gatech_email_address'];
    $password             = $_REQUEST['password'];

    $retval = [ 'success' => false ];

    if( empty( $gatech_email_address ) )
        $retval['message'] = 'No email address entered.';
    elseif( empty( $password ) )
        $retval['message'] = 'No password entered.';
    elseif( empty( $first_name ) )
        $retval['message'] = 'No first name entered.';
    elseif( empty( $last_name ) )
        $retval['message'] = 'No last name entered.';
    else
    {
        $member_pk = create_member( $gatech_email_address, $first_name, $last_name, $password );

        if( $member_pk )
            $retval['success'] = true;
        else
            $retval['message'] = "An account with the GATech email address $gatech_email_address already exists.";
    }

    ajax_return_and_exit( $retval );
?>
