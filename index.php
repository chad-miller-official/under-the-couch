<?
    db_include(
        'get_blog_posts',
        'get_max_and_min_blog_post'
    );

    $offset = isset( $_GET['page'] ) ? $_GET['page'] : 0;
    $prev = $offset - 1;
    $next = $offset + 1;

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
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>

    <body>
        <? ui_insert( 'header' ); ?>

        <div class="container">
            <? ui_insert( 'sidebar' ); ?>

            <div class="primary">
                <?
                    if( is_array( $blog_posts ) )
                    {
                        global $session_member;

                        foreach( $blog_posts as $blog_post )
                        {
                            if( !isset( $curr_min ) )
                                $curr_min = $blog_post['blog_post'];

                            $curr_max = $blog_post['blog_post'];
                ?>
                            <article>
                                <h3><a href="blog/blog.php?id=<?= $blog_post['blog_post']?>"> <?= $blog_post['title'] ?> </a></h3>
                                Author: <?= $blog_post['author'] ?> (<?= $blog_post['position'] ?>)
                                <br />
                                Posted: <?= $blog_post['created'] ?>
                                <br />

                                <? if( is_admin() ): ?>
                                    <a href="blog/deleteblog.php?id=<?= $blog_post['blog_post']?>">[Delete]</a>
                                    <a href="blog/editblog.php?id=<?= $blog_post['blog_post']?>">[Edit]</a>
                                <? endif; ?>

                                <hr />

                                <?= $blog_post['body'] ?>

                                <? if( $blog_post['editor'] != NULL ): ?>
                                    <i>Last edited by: <?= "{$blog_post['editor']} ({$blog_post['editor_position']}) at {$blog_post['edited']}" ?></i>
                                    <br />
                                <? endif; ?>
                            </article>

                            <br />
                <?
                        }
                    }

                    if( !isset( $curr_min ) )
                        $curr_min = $all_min;

                    if( !isset( $curr_max ) )
                        $curr_max = $all_max;
                ?>
            </div>

            <div class="pagenav">
                <div class="prev">
                    <? if( $curr_min > $all_min ): ?>
                        <a href="index.php?page=<?= $prev ?>"><< Previous Page</a>
                    <? endif; ?>
                </div>

                <div class="next">
                    <? if( $curr_max < $all_max ): ?>
                        <a href="index.php?page=<?= $next ?>">Next Page >></a>
                    <? endif; ?>
                </div>

                <br />
            </div>

            <? ui_insert('footer'); ?>
        </div>
    </body>
</html>
