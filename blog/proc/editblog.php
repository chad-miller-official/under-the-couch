<?
	db_include( 'create_or_update_blog_post' );

	if( !is_admin() || !isset( $_POST['postid'] ) || !isset( $_POST['body'] ) || !isset( $_POST['title'] ) )
	{
		$edit     = isset( $_POST['postid'] ) ? 'edit' : '';
		$message  = 'No changes made!';
		$redirect = "../{$edit}blog.php?id={$_POST['postid']}";
	}
	else
	{
		$params = [
			'title'     => $_POST['title'],
			'body'      => $_POST['body'],
			'editor'    => $GLOBALS['session_member']['member'],
			'edited'    => 'now()'
			'blog_post' => $_POST['postid']
		];

		$did_update = create_or_update_blog_post( $params );

		if( !$did_update )
		{
			$message                   = 'Failed to update blog post!';
			$edit                      = 'edit';
			$_POST['blog_fail_return'] = true;
		}
		else
		{
			$message  = 'Updated blog post!';
			$edit     = '';
		}

		$redirect = "../{$edit}blog.php?id={$_POST['postid']}";
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Updating Post...</title>
		<link rel="stylesheet" type="text/css" href="/styles.css" />
		<meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<article>
			<?= $message ?>
		</article>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
