$( document ).ready( initialize );

function initialize()
{
    $( '#edit_blog_post_form' ).submit( validate_blog_post );

    $( '#title' ).change( reset_validation );
    $( '#body' ).change( reset_validation );
}

function validate_blog_post( event )
{
    event.preventDefault();

    var title = $( '#title' );
    var body  = $( '#body' );

    if( !title.val() )
    {
        validate_error( title, 'Title is required.' );
        return;
    }

    if( !body.val() )
    {
        validate_error( body, 'Body is required.' );
        return;
    }

    var blog_post = $( '#blog_post_pk' ).val();

    var form_data = {
        'blog_post' : blog_post,
        'title'     : title.val(),
        'body'      : body.val()
    };

    edit_blog_post( form_data );
}

function edit_blog_post( data )
{
    var url = '/common/php/ajax/update_blog_post.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['success'] )
            window.location = '/blog/blog_post.php?id=' + data['blog_post'];
        else
            alert( 'Unable to edit blog post. (Error Code: 0003)' );
    }, 'json' )
    .fail( function() {
        alert( 'An error has occurred - please contact support. (Error Code: 0004)' );
    });
}
