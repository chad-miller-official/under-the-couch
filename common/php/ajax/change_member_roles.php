<?
    db_include(
         'add_role_to_member',
         'remove_role_from_member',
         'get_role_by_abbreviation'
    );

    $member_pk      = isset( $_REQUEST['member'] ) ? $_REQUEST['member'] : false;
    $role_to_add    = isset( $_REQUEST['add'] )    ? $_REQUEST['add']    : false;
    $role_to_remove = isset( $_REQUEST['remove'] ) ? $_REQUEST['remove'] : false;

    $error = null;

    if( $role_to_add !== false )
    {
        $current_role = get_role_by_abbreviation( $role_to_add );
        $add_role_retval = add_role_to_member( $member_pk, $current_role['role'] );
    }
    else
        $add_role_retval = true;

    if( $role_to_remove !== false )
    {
        $current_role      = get_role_by_abbreviation( $role_to_remove );
        $remove_role_retval = remove_role_from_member( $member_pk, $current_role['role'] );
    }
    else
        $remove_role_retval = true;

    if( $add_role_retval === false )
        $error = 'Failed to add role.';
    elseif( $remove_role_retval === false )
        $error = 'Failed to remove role.';

    $retval = [
        'success' => ( $add_role_retval && $remove_role_retval ),
        'error'   => $error
    ];

    ajax_return_and_exit( $retval );
?>
