$( document ).ready( initialize );

function initialize()
{
    $( '#edit_blog_post_form' ).submit( edit_blog_post );
}

function edit_blog_post( event )
{
    event.preventDefault();

    var blog_post = $( '#blog_post_pk' ).val();
    var title     = $( '#title' ).val();
    var body      = $( '#body' ).val();

    var data = {
        'blog_post' : blog_post,
        'title'     : title,
        'body'      : body
    };

    var url = '/common/php/lib/ajax/update_blog_post.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            window.location = '/blog/blog_post.php?id=' + blog_post;
        else
            alert( 'An error has occurred - please contact support.' );
    }, 'json' );
}
