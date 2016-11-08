<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Write Blog Post</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />

		<?
            js_common_include();
            js_include( 'ext/tinymce/tinymce.min.js' );
        ?>
        <script src="/blog/js/write_blog_post.js"></script>

		<script>
			tinymce.init({
				selector : 'textarea',
				width    : 600,
				toolbar  :   'undo redo '
				         + '| styleselect '
						 + '| bold italic underline strikethrough '
						 + '| alignleft aligncenter alignright alignjustify '
						 + '| bullist numlist '
						 + '| link image'
			});
		</script>
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<form method="post" action="/" id="create_blog_post_form">
			<fieldset>
				<legend>Write Blog Post</legend>
				<p>
					<label for="title">Post Title:</label>
					<input type="text" name="title" id="title"></input>
				</p>
				<center>
					<textarea name="body" id="body"></textarea>
				</center>
				<p>
					<label class="nowidth" for="send_email">Send post to mailing list?</label>
					<input type="checkbox" name="send_email" id="send_email" />
				</p>
				<input type="submit" />
			</fieldset>
		</form>

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
