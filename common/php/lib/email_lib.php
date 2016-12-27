<?
    function __send_email( $to, $from, $subject, $body, $additional_params = [] )
    {
        $transport = Swift_SendmailTransport::newInstance( '/usr/sbin/sendmail -bs' );
        $mailer    = Swift_Mailer::newInstance( $transport );

        $in_production = getenv( GTMN_IN_PRODUCTION );

        if( !$in_production )
            $to = SessionLib::get( 'user_member.gatech_email_address' );

        $message = Swift_Message::newInstance()
            ->setSubject( $subject )
            ->setFrom( $from )
            ->setTo( $to );

        if( isset( $additional_params['mime_type'] ) )
            $message->setBody( $body, $additional_params['mime_type'] );
        else
            $message->setBody( $body );

        $sent_count = $mailer->send( $message );
        return is_scalar( $to ) ? $sent_count > 0 : $sent_count == count( $to );
    }

    function send_text_email( $to, $from, $subject, $body )
    {
        return __send_email( $to, $from, $subject, $body );
    }

    function send_html_email( $to, $from, $subject, $body )
    {
        return __send_email( $to, $from, $subject, $body, [ 'mime_type' => 'text/html' ] );
    }
?>
