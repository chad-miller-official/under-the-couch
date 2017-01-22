<?
    db_include( 'get_member' );

    $member_pk = $_REQUEST[ 'member' ];
    $member    = get_member( $member_pk );

    $member_name = $member[ 'name' ];
?>
<div>
    <h3>Edit Payments for <?= $member_name ?></h3>
</div>
