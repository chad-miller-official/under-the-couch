<?

    db_include( 'create_or_update_blog_post' );
    lib_include( 'email_lib' );

    $title                = $_REQUEST['title'];
    $body                 = $_REQUEST['body'];
    $send_to_mailing_list = $_REQUEST['send_to_mailing_list'] === 'true';
    $blog_post_success    = false;
    $sent_email_success   = NULL;

    $params = [
        'title'   => $title,
        'body'    => $body,
        'creator' => SessionLib::get( 'user_member.member' )
    ];

    $created_blog_post_pk = create_or_update_blog_post( $params );

    if( $created_blog_post_pk )
    {
        $blog_post_success = true;

        if( $send_to_mailing_list )
        {
            $sent_email_success = send_html_email(
                EMAIL_MAILING_LIST,
                EMAIL_WEBMASTER,
                $title,
                $body
            );
        }
    }

    $retval = [
        'blog_post_success'  => $blog_post_success,
        'sent_email_success' => $sent_email_success,
        'blog_post'          => $created_blog_post_pk
    ];

    ajax_return_and_exit( $retval );
?>
