<?
    $email    = $_REQUEST['gatech_email_address'];
    $password = $_REQUEST['password'];
    $success  = login( $email, $password );

    ajax_return_and_exit( [ 'success' => $success ] );
?>
