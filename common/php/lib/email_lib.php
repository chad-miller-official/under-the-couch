<?
    function send_html_email( $to, $subject, $body )
    {
        $sender        = is_array( $to ) ? implode( ', ' , $to ) : $to;
        $in_production = getenv( 'HTTP_PRODUCTION_ENVIRONMENT' );

        if( !$in_production )
            $sender = SessionLib::get( 'user_member.gatech_email_address' );

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= 'From: Webmaster <' . EMAIL_WEBMASTER . ">\r\n";

        return mail( $sender, $subject, $body, $headers );
    }
?>
