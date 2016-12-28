<?
    db_include( 'get_members_by_last_name' );

    $limit = $_REQUEST['pageSize'];
    $offset = ( $_REQUEST['pageNumber'] - 1 ) * $limit;

    $no_data = isset( $_REQUEST['_no_data'] ) && $_REQUEST['_no_data'];

    $data       = get_members_by_last_name ( $limit, $offset );
    $success    = $data !== false;
    $count      = $success ? count($data) : 0;
    $total      = $success && $count > 0 ? $data[0]['total'] : 0;

    $retval = [
        'success' => $success,
        'count'   => $count,
        'total'   => $total
    ];

    if( $success && !$no_data )
    {
        $retval['data'] = $data;
    }

    ajax_return_and_exit( $retval );
?>
