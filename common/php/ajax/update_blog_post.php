<?
	db_include( 'create_or_update_blog_post' );

    $blog_post = $_REQUEST['blog_post'];
    $title     = $_REQUEST['title'];
    $body      = $_REQUEST['body'];

	$params = [
		'title'     => $title,
		'body'      => $body,
		'editor'    => SessionLib::get( 'user_member.member' ),
		'edited'    => 'now()',
		'blog_post' => $blog_post
	];

	$success = create_or_update_blog_post( $params );

    ajax_return_and_exit( [ 'success' => $success ] );
?>
