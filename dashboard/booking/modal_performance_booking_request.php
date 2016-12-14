<?
    db_include( 'get_booking_request' );

    $booking_request_pk = $_REQUEST['booking_request'];
    $booking_request    = get_booking_request( $booking_request_pk );

    $contact_name           = $booking_request['contact_name'];
    $contact_email_address  = $booking_request['contact_email_address'];
    $contact_phone_number   = $booking_request['contact_phone_number'];
    $date_requested         = $booking_request['date_requested'];
    $comments               = $booking_request['comments'];
    $created                = $booking_request['created'];
    $status                 = $booking_request['booking_request_status'];

    $additional_information = json_decode( $booking_request['additional_information'], true );
    $band_name              = $additional_information['band_name'];
    $style_of_music         = $additional_information['style_of_music'];
    $band_website           = $additional_information['band_website'];
?>
<div class="modal">
    <h3><?= $status ?> Request</h3>
    Band Name: <?= $band_name ?>
    <? if( $band_website ): ?>
        (<a href="<?= $band_website ?>" target="_blank">Website</a>)
    <? endif; ?>
    <br />
    <? if( $style_of_music ): ?>
        Style of Music: <?= $style_of_music ?>
        <br />
    <? endif; ?>
    Date Requested: <?= $date_requested ?>
    <br />
    <br />
    Contact Name: <?= $contact_name ?>
    <br />
    Contact Email: <?= $contact_email_address ?>
    <br />
    <? if( $contact_phone_number ): ?>
        Contact Phone Number: <?= $contact_phone_number ?>
        <br />
    <? endif; ?>
    <br />
    Request Submitted: <?= $created ?>
</div>
