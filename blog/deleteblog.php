<?
	db_include( 'delete_blog_post' );

	if( !is_admin() )
	{
		header( 'HTTP/1.0 403 Forbidden' );
		$display_message = 'Access forbidden!';
	}
	else
	{
		$deleted         = delete_blog_post( $_GET['id'] );
		$display_message = $deleted ? 'Deleted from table!' : "Could not delete post {$_GET['id']}!";
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Deleting post...</title>
		<meta http-equiv="refresh" content="3;url=../index.php" />
		<link rel="stylesheet" type="text/css" href="../styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<article>
			<?= $display_message ?>
		</article>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
