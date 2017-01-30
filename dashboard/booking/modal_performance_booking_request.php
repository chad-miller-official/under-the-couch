<?
    db_include(
        'get_booking_request',
        'get_booking_request_status_transitions_by_booking_request'
    );

    $booking_request_pk = $_REQUEST['booking_request'];
    $booking_request    = get_booking_request( $booking_request_pk );

    $contact_name           = $booking_request['contact_name'];
    $contact_email_address  = $booking_request['contact_email_address'];
    $contact_phone_number   = $booking_request['contact_phone_number'];
    $date_requested         = $booking_request['date_requested'];
    $comments               = $booking_request['comments'];
    $created                = $booking_request['created'];
    $status                 = $booking_request['booking_request_status_label'];
    $status_pk              = $booking_request['booking_request_status'];
    $hex_rgb                = $booking_request['booking_request_status_rgb_color'];

    $additional_information = json_decode( $booking_request['additional_information'], true );
    $band_name              = $additional_information['band_name'];
    $style_of_music         = $additional_information['style_of_music'];
    $band_website           = $additional_information['band_website'];

    $booking_request_next_statuses = get_booking_request_status_transitions_by_booking_request( $booking_request_pk );

    js_common_include();
    js_include(
        'qtip',
        'validate_lib.js'
    );
?>
<link rel="stylesheet" type="text/css" href="/jquery.qtip.min.css" />
<script src="/dashboard/booking/js/modal_performance_booking_request.js"></script>
<div class="modal">
    <div class="modal-column">
        <h3>
            <span id="led"
                  style="color: rgba(<?= $hex_rgb ?>,1); text-shadow: 0px 0px 1px black, 0px 1px 16px rgba(<?= $hex_rgb ?>,1);"
            >
                &#9679;
            </span>
            Booking Request - <?= $status ?>
        </h3>
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
    <p>
        <?
            switch( $status_pk ):
                case BOOKING_REQUEST_STATUS_NOT_STARTED:
        ?>
                    This booking request has not been started.
                    <br />
                    Please use the booking officer email to begin correspondence.
        <?
                    break;
                case BOOKING_REQUEST_STATUS_IN_PROGRESS:
        ?>
                    This booking request has already been replied to.
                    <br />
                    Please use the booking officer email to continue correspondence.
        <?
                    break;
                case BOOKING_REQUEST_STATUS_CLOSED:
        ?>
                    This booking request has been closed.
                    <br />
                    No more actions can be performed on it.
        <?
                    break;
            endswitch;
        ?>
    </p>
    <? if( $status_pk != BOOKING_REQUEST_STATUS_CLOSED ): ?>
        <br />
        <div>
            <form id="booking_request_status_change_form">
                <label class="nowidth">Change the status of this booking request:</label>
                <fieldset class="no-style">
                    <select id="new_booking_request_status">
                        <? foreach( $booking_request_next_statuses as $status ): ?>
                            <option value="<?= $status['booking_request_status'] ?>">
                                <?= $status['label'] ?>
                            </option>
                        <? endforeach; ?>
                    </select>
                    <input type="hidden" name="booking_request_pk" id="booking_request_pk" value="<?= $booking_request_pk ?>" />
                    <input type="submit" class="submit-button" id="submit_booking_request_status_change"></input>
                </fieldset>
            </form>
        </div>
    <? endif; ?>
</div>
