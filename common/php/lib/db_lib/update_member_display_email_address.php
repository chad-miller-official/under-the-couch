<?
    function update_member_display_email_address( $member_pk, $display_email_address )
    {
        $query = <<<SQL
update tb_member
   set display_email_address = ?display_email_address?
 where member = ?member?
SQL;

        $params = [
            'display_email_address' => $display_email_address,
            'member'                => $member_pk
        ];

        $result = query_execute( $query, $params );
        return query_success( $result );
    }
?>
