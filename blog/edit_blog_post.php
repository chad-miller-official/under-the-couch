<?
	db_include( 'get_blog_post' );

    $blog_post_pk = $_REQUEST['id'];
    $blog_post    = get_blog_post( $blog_post_pk );

    $title = $blog_post['title'];
    $body  = $blog_post['body'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Edit Blog Post</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <?
            js_common_include();
            js_include(
                'validate_lib.js',
                'tinymce'
            );
        ?>
        <script src="/blog/js/edit_blog_post.js"></script>
		<script>
			tinymce.init( {
				selector : 'textarea',
				width    : 600,
				toolbar  :   'undo redo '
				         + '| styleselect '
						 + '| bold italic underline strikethrough '
						 + '| alignleft aligncenter alignright alignjustify '
						 + '| bullist numlist '
						 + '| link image'
			} );
		</script>
	</head>
	<body>
		<? ui_insert( 'header' ); ?>
		<form method="post" id="edit_blog_post_form" action="/">
			<fieldset>
				<legend>Edit Blog Post</legend>
				<p>
					<label for="body">Post Title:</label>
					<input type="text" name="title" id="title" value="<?= $title ?>" />
				</p>
				<center>
					<textarea name="body" id="body"><?= $body ?></textarea>
				</center>
				<input type="hidden" name="blog_post_pk" id="blog_post_pk" value="<?= $blog_post_pk ?>" />
				<br />
				<input type="submit" />
			</fieldset>
		</form>
		<? ui_insert( 'footer' ); ?>
	</body>
</html>
