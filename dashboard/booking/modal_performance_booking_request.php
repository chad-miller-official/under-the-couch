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
    $hex_rgba               = $booking_request['booking_request_status_hex_rgb'];

    $additional_information = json_decode( $booking_request['additional_information'], true );
    $band_name              = $additional_information['band_name'];
    $style_of_music         = $additional_information['style_of_music'];
    $band_website           = $additional_information['band_website'];

    $hex_rgb = substr($hex_rgba, 0, strpos($hex_rgba, "0.4")) . "1)";
?>
<div class="modal">
    <div class="modal-column">
        <h3><span id="led" style="color: <?= $hex_rgb ?>; text-shadow: 0px 0px 1px black, 0px 1px 16px <?= $hex_rgb ?>;">
            &#9679;</span><?= $status ?> Request</h3>
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
        Contact Email: <a href="mailto:<?= $contact_email_address ?>"><?= $contact_email_address ?></a>
        <br />
        <? if( $contact_phone_number ): ?>
            Contact Phone Number: <?= $contact_phone_number ?>
            <br />
        <? endif; ?>
        <br />
        Request Submitted: <?= $created ?>
    </div>
    <div class="modal-column">
        <? if ( $comments ): ?>
            Additional Comments:
            <p id="booking-comments">
                <?= $comments ?>
            </p>
        <? endif; ?>
        <br />
        <br />
    </div>
    <hr />
    <form id="performance_booking_response">
        <fieldset class="no-style">
            <h3>Respond to this request</h3>
            <p>
                <label class="nowidth" for="email_text">Email text: </label>
                <textarea class="wide" name="email_text" id="email_text" />
            </p>
            <input type="submit" class="submit-button"></input>
        </fieldset>
    </div>
</div>
