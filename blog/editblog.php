<?
	db_include( 'get_blog_post' );

	if( !is_admin() )
	{
		header( 'HTTP/1.0 403 Forbidden' );
		echo( 'Access is forbidden!' );
		exit();
	}

	if( !isset( $_GET['id'] ) )
		$message = 'No post ID specified!';
	else
	{
		if( isset( $_POST['blog_fail_return'] ) && $_POST['blog_fail_return'] )
		{
			$title = $_POST['title'];
			$body  = $_POST['body'];
		}
		else
		{
			$blog_post = get_blog_post( $_GET['id'] );

			if( !$blog_post )
				$message = 'Invalid post ID specified!';
			else
			{
				$title = $blog_post['title'];
				$body  = $blog_post['body'];
			}
		}
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Edit Blog Post</title>
		<link rel="stylesheet" type="text/css" href="/styles.css" />

		<? js_include( 'tinymce/tinymce.min' ); ?>

		<? if( !isset( $message ) ): ?>
			<script>
				tinymce.init( {
					selector : 'textarea',
					width    : 600,
					toolbar  : 'undo redo '
					         . '| styleselect '
							 . '| bold italic underline strikethrough '
							 . '| alignleft aligncenter alignright alignjustify '
							 . '| bullist numlist '
							 . '| link image'
				} );
			</script>
		<? else: ?>
			<?= $message ?>
		<? endif; ?>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<form method="post" action="/blog/proc/editblog.php">
			<fieldset>
				<legend>Edit Blog Post</legend>
				<p>
					<label for="body">Post Title:</label>
					<input type="text" name="title" value="<?= $title ?>" />
				</p>
				<center>
					<textarea name="body"><?= $body ?></textarea>
				</center>
				<input type="hidden" name="postid" value="<?= $_GET['id'] ?>" />
				<br />
				<input type="submit" />
			</fieldset>
		</form>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
