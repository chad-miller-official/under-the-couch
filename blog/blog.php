<?
	db_include( 'get_blog_post' );

	$blog_post = get_blog_post( $_GET['id'] );
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - Blog Post #<?= $_GET['id'] ?></title>
		<link rel="stylesheet" type="text/css" href="../styles.css" />
	</head>

	<body>
		<? ui_insert( 'header' ); ?>

		<article>
			<h3> <?= $blog_post['title'] ?> </h3>
			Author: <?= $blog_post['author'] ?>
			<br />
			Posted: <?= $blog_post['created'] ?>
			<br />

			<? if( is_admin() ): ?>
				<a href="deleteblog.php?id=<?= $blog_post['blog_post'] ?>">[Delete]</a>
				<a href="editblog.php?id=<?= $blog_post['blog_post'] ?>">[Edit]</a>
			<? endif; ?>

			<hr />

			<?= $blog_post['body'] ?>

			<? if( $blog_post['editor'] != NULL ): ?>
				<i>Last edited by: <?= "{$blog_post['editor']} ({$blog_post['editor_position']}) at {$blog_post['edited']}" ?></i>
				<br />
			<? endif; ?>
		</article>
		<br />

		<? ui_insert( 'footer' ); ?>
	</body>
</html>
