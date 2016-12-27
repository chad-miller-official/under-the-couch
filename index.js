$( document ).ready( index_initialize );

var class_file = 'GetBlogPostsPaginator';
var limit      = 5;

function index_initialize()
{
    pagination_init(
        class_file,
        limit,
        populate_blog_posts_div
    );
}

function populate_blog_posts_div( data, pagination )
{
    var blog_posts_div = $( '#blog_posts' );

    blog_posts_div.empty();

    var line_break      = $( '<br>' );
    var horizontal_rule = $( '<hr>' );

    $.each( data, function( i, blog_post_data ) {
        var blog_post_pk = blog_post_data['blog_post'];

        var title = $( '<h3>' ).append(
            $( '<a>' )
                .text( blog_post_data['title'] )
                .prop(
                    'href',
                    '/blog/blog_post.php?id=' + blog_post_pk
                )
        );

        var author = 'Author: ' + blog_post_data['author'];
        var posted = 'Posted: ' + blog_post_data['created'];
        var body   = blog_post_data['body'];

        var blog_post = $( '<article>' ).addClass( 'blog-post' );

        blog_post.append(
            title,
            author,
            '<br />',
            posted,
            '<br />',
            '<hr />',
            body
        );

        if( blog_post_data['editor'] != null )
        {
            var editor = $( '<i>' ).text(
                'Last edited by ' + blog_post_data['editor'] + ' on ' + blog_post_data['edited']
            );

            blog_post.append(
                editor,
                '<br />'
            );
        }

        blog_post.append( '<br />' );

        blog_posts_div.append( blog_post );
    });
}
