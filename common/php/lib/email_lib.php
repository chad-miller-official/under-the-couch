<?

    function send_html_email( $to, $subject, $body )
    {
        $sender   = is_array( $to ) ? implode( ', ' , $to ) : $to;
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= 'From: Webmaster <' . EMAIL_WEBMASTER . ">\r\n";

        return mail( $sender, $subject, $body, $headers );
    }

?>
