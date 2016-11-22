<?
    db_include(
        'get_blog_posts',
        'get_max_and_min_blog_post'
    );

    $limit  = 7;
    $offset = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : 0;
    $prev   = $offset + 1;
    $next   = $offset - 1;

    $blog_posts  = get_blog_posts( $limit, $offset );
    $display_min = $blog_posts[0]['blog_post'];
    $display_max = $blog_posts[$limit - 1]['blog_post'];

    $max_min = get_max_and_min_blog_post();
    $all_max = $max_min['max'];
    $all_min = $max_min['min'];
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <? js_common_include(); ?>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>

        <div class="container">
            <? ui_insert( 'sidebar' ); ?>
            <section class="focus-content">
                <? if( access_allowed( 'blog/write_blog_post.php' ) ): ?>
                    <a href="/blog/write_blog_post.php" class="clean-button" style="float:right">Write Blog Post</a>
                <? endif; ?>
                <? if( is_array( $blog_posts ) ): ?>
                    <? foreach( $blog_posts as $blog_post ): ?>
                        <?
                            $blog_post_pk = $blog_post['blog_post'];
                            $title        = $blog_post['title'];
                            $author       = $blog_post['author'];
                            $role         = $blog_post['role'];
                            $created      = $blog_post['created'];
                            $body         = $blog_post['body'];

                            $editor      = $blog_post['editor'];
                            $editor_role = $blog_post['editor_role'];
                            $edited      = $blog_post['edited'];
                        ?>
                        <article class="blog-post">
                            <h3><a href="/blog/blog_post.php?id=<?= $blog_post_pk ?>"><?= $title ?></a></h3>
                            Author: <?= $author ?> (<?= $role ?>)
                            <br />
                            Posted: <?= $created ?>
                            <br />
                            <hr />
                            <?= $body ?>
                            <? if( $editor != NULL ): ?>
                                <i>Last edited by: <?= "$editor ($editor_role)" ?> at <?= $edited ?></i>
                                <br />
                            <? endif; ?>
                        </article>
                        <br />
                    <? endforeach; ?>
                <? endif; ?>
                <? if( $display_min > $all_min ): ?>
                    <a href="index.php?page=<?= $prev ?>" style="float:left; padding-left:12px"><< Previous Page </a>
                <? endif; ?>
                <? if( $display_max < $all_max ): ?>
                    <a href="/index.php?page=<?= $next ?>" style="float:right; padding-right:12px">Next Page >></a>
                <? endif; ?>
            </section>
        </div>
        <br />
        <? ui_insert('footer'); ?>
    </body>
</html>
