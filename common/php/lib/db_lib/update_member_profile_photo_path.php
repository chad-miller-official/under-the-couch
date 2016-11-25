<?
    db_include( 'get_member' );

    function update_member_profile_photo_path( $member_pk, $profile_photo_path )
    {
        $old_profile_photo_path = get_member( $member_pk )['profile_photo_path'];

        $query = <<<SQL
update tb_member
   set profile_photo_path = ?profile_photo_path?
 where member = ?member?
SQL;

        $params = [
            'profile_photo_path' => $profile_photo_path,
            'member'             => $member_pk
        ];

        $result = query_execute( $query, $params );
        return query_success( $result ) ? $old_profile_photo_path : false;
    }
?>
