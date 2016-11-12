<?
	db_include( 'get_blog_post' );

    $blog_post_pk = $_REQUEST['id'];
	$blog_post   = get_blog_post( $blog_post_pk );

    $title   = $blog_post['title'];
    $author  = $blog_post['author'];
    $created = $blog_post['created'];
    $body    = $blog_post['body'];

    $editor      = $blog_post['editor'];
    $editor_role = $blog_post['editor_role'];
    $edited      = $blog_post['edited'];
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - <?= $title ?></title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <? js_common_include(); ?>
        <script src="/blog/js/blog_post.js"></script>
	</head>
	<body>
		<? ui_insert( 'header' ); ?>
        <div class="container">
    		<article class="blog-post-individual">
    			<h3><?= $title ?></h3>
    			Author: <?= $author ?>
    			<br />
    			Posted: <?= $created ?>
    			<br />
    			<? if( access_allowed( 'blog/edit_blog_post.php' ) ): ?>
    				<a href="javascript:void(0)" id="delete_blog">[Delete]</a>
                    <a href="/blog/edit_blog_post.php?id=<?= $blog_post_pk ?>">[Edit]</a>
                <? endif; ?>
    			<hr />
    			<?= $body ?>
    			<? if( $editor != NULL ): ?>
    				<i>Last edited by: <?= "$editor ($editor_role)" ?> at <?= $edited ?></i>
    				<br />
    			<? endif; ?>
                <input type="hidden" id="blog_post_pk" name="blog_post_pk" value="<?= $blog_post_pk ?>" />
    		</article>
		</div>
        <br />
		<? ui_insert( 'footer' ); ?>
	</body>
</html>
