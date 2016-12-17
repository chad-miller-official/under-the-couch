<?
    function send_text_email( $to, $from, $subject, $body )
    {
        $transport = Swift_SendmailTransport::newInstance( '/usr/sbin/sendmail -bs' );
        $mailer    = Swift_Mailer::newInstance( $transport );

        $in_production = getenv( GTMN_IN_PRODUCTION );

        if( !$in_production )
            $to = SessionLib::get( 'user_member.gatech_email_address' );

        $message = Swift_Message::newInstance()
            ->setSubject( $subject )
            ->setFrom( $from )
            ->setTo( $to )
            ->setBody( $body );

        $sent_count = $mailer->send( $message );

        if( is_scalar( $to ) )
            return $sent_count > 0;
        else
            return $sent_count == count( $to );
    }

    function send_html_email( $to, $from, $subject, $body )
    {
        $transport = Swift_SendmailTransport::newInstance( '/usr/sbin/sendmail -bs' );
        $mailer    = Swift_Mailer::newInstance( $transport );

        $in_production = getenv( GTMN_IN_PRODUCTION );

        if( !$in_production )
            $to = SessionLib::get( 'user_member.gatech_email_address' );

        $message = Swift_Message::newInstance()
            ->setSubject( $subject )
            ->setFrom( $from )
            ->setTo( $to )
            ->setBody( $body, 'text/html' );

        $sent_count = $mailer->send( $message );

        if( is_scalar( $to ) )
            return $sent_count > 0;
        else
            return $sent_count == count( $to );
    }
?>
