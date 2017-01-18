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

    js_include( 'chosen' );
?>
<script src="/user/js/modal_edit_profile.js"></script>
<div>
    <!-- TODO -->
    <h2>Edit Profile Info</h2>
    <form id="update_member_form" style="padding-right:10px">
        <fieldset class="no-style">
            <div>
                <h4>Personal Info</h4>
                <p>
                    <label class="nowidth">Display Email Address:</label>
                    <input class="textbox" type="text" name="display_email_address" id="display_email_address" />
                </p>
                <p>
                    <label class="nowidth">Personal Website:</label>
                    <input class="textbox" type="text" name="personal_website" id="personal_website" />
                </p>
                <p>
                    <label class="nowidth">Biography:</label>
                    <textarea name="biography" id="biography"> </textarea>
                </p>
            </div>
            <hr>
            <div>
                <h4>Music Info</h4>
                <p>
                    <label class="nowidth">Instruments:</label>
                    <select multiple id="instruments_menu">
                        <?
                            foreach ( $instruments as $instrument ):
                                $instrument_pk   = $instrument[ 'instrument' ];
                                $instrument_name = $instrument[ 'name' ];
                        ?>
                        <option value="<?= $instrument_pk ?>"><?= $instrument_name ?></option>
                        <? endforeach; ?>
                    </select>
                </p>
                <p>
                    <label class="nowidth">Available for Collaboration:</label><br>
                    <input type="radio" name="is_available_for_collaboration" id="is_available_for_collaboration" value="true">Yes<br>
                    <input type="radio" name="is_available_for_collaboration" id="is_available_for_collaboration" value="false">No
                </p>
            </div>
            <hr> <!-- Password -->
            <div>
                <p>
                    <label class="nowidth">Password:</label>
                    <input class="textbox" type="text" name="password" id="password" />
                </p>
                <p>
                    <label class="nowidth">Confirm Password:</label>
                    <input class="textbox" type="text" name="password_again" id="password_again" />
                </p>
            </div>
            <hr>
            <div style="text-align:right">
                <input type="submit" class="submit-button"></input>
            </div>
        </fieldset>
    </form>
</div>
