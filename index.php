<?
    db_include(
        'get_blog_posts',
        'get_max_and_min_blog_post'
    );

    $offset = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : 0;
    $prev   = $offset - 1;
    $next   = $offset + 1;

    $max_min = get_max_and_min_blog_post();
    $all_max = $max_min['max'];
    $all_min = $max_min['min'];

    $blog_posts = get_blog_posts( 7, $offset );
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
        <section>
            <? ui_insert( 'sidebar' ); ?>
            <section>
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

                            if( !isset( $curr_min ) )
                                $curr_min = $blog_post_pk;

                            $curr_max = $blog_post_pk;
                        ?>
                        <article>
                            <h3><a href="/blog/blog_post.php?id=<?= $blog_post_pk ?>"> <?= $title ?> </a></h3>
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
                <?
                    if( !isset( $curr_min ) )
                        $curr_min = $all_min;

                    if( !isset( $curr_max ) )
                        $curr_max = $all_max;
                ?>
            </section>
            <? ui_insert('footer'); ?>
        </section>
    </body>
</html>
