$( document ).ready( initialize );

function initialize()
{
    $( '#delete_blog' ).click( delete_blog_post );
}

function delete_blog_post()
{
    var perform_delete = confirm( 'Are you sure you want to delete this blog post? This action cannot be undone.' );

    if( perform_delete )
    {
        var blog_post = $( '#blog_post_pk' ).val();
        var data      = { 'blog_post' : blog_post };

        var url = '/common/php/ajax/delete_blog_post.php';

        $.post( url, data, function( response, textStatus, jqXHR ) {
            if( response['success'] )
                window.location = '/index.php';
            else
                js_error( 'Unable to delete blog post.', DELETE_BLOG_POST_FAILURE );
        }, 'json' )
        .fail( js_generic_error );
    }
}
