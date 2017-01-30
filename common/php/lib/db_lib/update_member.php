<?
    function update_member( $member, $fields )
    {
        $update_query = 'update tb_member set ';

        foreach( $fields as $field => $value )
        {
            if( $field == 'password' )
                $update_query .= "password_hash = crypt( ?password?, gen_salt( 'bf' ) ), ";
            else
                $update_query .= "$field = ?$field?, ";
        }

        $update_query     = preg_replace( '/, $/', ' where member = ?member?', $update_query );
        $fields['member'] = $member;
        $result           = query_execute( $update_query, $fields );

        return query_success( $result );
    }
?>
