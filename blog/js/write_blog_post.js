$( document ).ready( initialize );

function initialize()
{
    $( '#create_blog_post_form' ).submit( create_blog_post );
}

function create_blog_post( event )
{
    event.preventDefault();

    var title                = $( '#title' ).val();
    var body                 = $( '#body' ).val();
    var send_to_mailing_list = $( '#send_email:checked' ).val() === 'on';

    var data = {
        'title'                : title,
        'body'                 : body,
        'send_to_mailing_list' : send_to_mailing_list
    };

    var url = '/common/php/lib/ajax/create_blog_post.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['blog_post_success'] )
        {
            var created_blog_post = response['blog_post'];

            if( send_to_mailing_list && !response['sent_email_success'] )
                alert( 'Blog post successful, but email was not sent - please contact support.' );

            window.location = '/blog/blog_post.php?id=' + created_blog_post;
        }
        else
            alert( 'An error has occurred - please contact support.' );
    }, 'json' );
}
