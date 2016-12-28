<?
    db_include(
         'change_member_roles',
         'get_role_by_abbreviation'
    );

    $member_pk      = isset( $_POST[ 'member' ] ) ? $_POST[ 'member' ] : false;
    $role_to_add    = isset( $_POST[ 'add' ] ) ? $_POST[ 'add' ] : 'none';
    $role_to_remove = isset( $_POST[ 'remove' ] ) ? $_POST[ 'remove' ] : 'none';

    //echo ( $member_pk . "\n" . $role_to_add . "\n" . $role_to_remove . "\n" );

    $error = null;

    if( $role_to_add !== 'none' ) {
        $current_role = get_role_by_abbreviation( $role_to_add );

        $add_role_retval = add_role ( $member_pk, $current_role[ 'role' ] );
    } else {
        $add_role_retval = true;
    }

    if( $role_to_remove !== 'none' ) {
        $current_role = get_role_by_abbreviation( $role_to_remove );

        $remove_role_retval = remove_role ( $member_pk, $current_role[ 'role' ] );
    } else {
        $remove_role_retval = true;
    }

    if ( $add_role_retval === false ) {
        $error = 'Failed to add role.';
    } elseif ( $remove_role_retval === false ) {
        $error = 'Failed to remove role.';
    }

    $retval = [
        'success' => ($add_role_retval && $remove_role_retval),
        'error'   => $error
    ];

    ajax_return_and_exit( $retval );
?>
