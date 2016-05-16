<?
	db_include( 'create_or_update_blog_post' );
	lib_include( 'email_lib' );

	if( !is_admin() )
	{
		header( 'HTTP/1.0 403 Forbidden' );
		$display_message = 'Access forbidden!';
		$redirect        = '/index.php';
	}
	else
	{
		$params = [
			'title'  => $_POST['title'],
			'body'   => $_POST['body'],
			'author' => $GLOBALS['session_member']['member']
		];

		$posted = create_or_update_blog_post( $params );

		if( $posted )
		{
			$display_message = 'Wrote post! <br />';
			$redirect        = "../blog.php?id=$posted";

			if( isset( $_POST['sendemail'] ) && $_POST['sendemail'] )
			{
				$sent_mail = send_html_email(
					'MusiciansNetwork@groupspaces.com',
					$_POST['title'],
					$_POST['body']
				);

				$display_message .= $sent_email ? 'Sent email!' : 'Failed to send email!';
			}
		}
		else
		{
			$display_message           = 'Failed to write post!';
			$redirect                  = '../writeblog.php';
			$_POST['blog_fail_return'] = true;
		}
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Under the Couch - Posting Blog Post...</title>
		<meta http-equiv="refresh" content="3;url=<?= $redirect ?>" />
		<link rel="stylesheet" type="text/css" href="/styles.css">
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<br />

		<article>
			<?= $display_message ?>
		</article>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
