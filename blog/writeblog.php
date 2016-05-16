<?
	if( !is_admin() )
	{
		header( 'HTTP/1.0 403 Forbidden' );
		echo( 'Access is forbidden!' );
		exit();
	}

	if( isset( $_POST['blog_fail_return'] ) && $_POST['blog_fail_return'] )
	{
		$title = $_POST['title'];
		$body  = $_POST['body'];
	}
	else
	{
		$title = '';
		$body  = '';
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Write Blog Post</title>
		<link rel="stylesheet" type="text/css" href="/styles.css" />

		<? js_include( 'tinymce/tinymce.min' ); ?>

		<script>
			tinymce.init({
				selector : 'textarea',
				width    : 600,
				toolbar  : 'undo redo '
				         . '| styleselect '
						 . '| bold italic underline strikethrough '
						 . '| alignleft aligncenter alignright alignjustify '
						 . '| bullist numlist '
						 . '| link image'
			});
		</script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<form method="post" action="proc/writeblog.php">
			<fieldset>
				<legend>Write Blog Post</legend>
				<p>
					<label for="title">Post Title:</label>
					<input type="text" name="title"><?= $title ?></input>
				</p>
				<center>
					<textarea name="body"><?= $body ?></textarea>
				</center>
				<p>
					<label class="nowidth" for="sendemail">Email to mailing list?</label>
					<input type="checkbox" name="sendemail" id="sendemailbox" />
				</p>
				<input type="submit" />
			</fieldset>
		</form>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
