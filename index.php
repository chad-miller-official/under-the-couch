<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Under the Couch</title>
        <link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <link rel="stylesheet" type="text/css" href="/pagination.css" />
        <?
            js_common_include();
            js_include(
                'pagination',
                'pagination_lib.js'
            );
        ?>
        <script src="/index.js"></script>
    </head>
    <body>
        <? ui_insert( 'header' ); ?>
        <div class="container">
            <? ui_insert( 'sidebar' ); ?>
            <section class="focus-content">
                <? if( access_allowed( 'blog/write_blog_post.php' ) ): ?>
                    <a href="/blog/write_blog_post.php" class="clean-button" style="float:right">Write Blog Post</a>
                <? endif; ?>
                <div id="blog_posts"></div>
            </section>
            <div id="pagination_controls" class="paginationjs paginationjs-big" style="float:right"></div>
        </div>
        <? ui_insert('footer'); ?>
    </body>
</html>
