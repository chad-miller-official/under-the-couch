<?
    db_include(
        'get_member',
        'get_instruments_by_member',
        'get_music_genres_by_member',
        'get_instruments',
        'get_music_genres'
    );

    $member_pk = $_REQUEST['member'];

    $member_info = get_member( $member_pk );

    $member_instruments  = get_instruments_by_member( $member_pk );
    $member_music_genres = get_music_genres_by_member( $member_pk );

    $instruments  = get_instruments();
    $music_genres = get_music_genres();
?>
<div>
    <!-- TODO -->
</div>
