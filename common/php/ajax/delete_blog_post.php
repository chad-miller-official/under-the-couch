<?
    db_include( 'delete_blog_post' );

    $blog_post = $_REQUEST['blog_post'];
    $success   = delete_blog_post( $blog_post );

    ajax_return_and_exit( [ 'success' => $success ] );
?>
