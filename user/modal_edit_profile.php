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

    $display_email_address          = $member_info['display_email_address'];
    $personal_website               = $member_info['personal_website'];
    $biography                      = $member_info['biography'];
    $is_available_for_collaboration = $member_info['is_available_for_collaboration'] == 't';

    $member_instruments  = get_instruments_by_member( $member_pk );
    $member_music_genres = get_music_genres_by_member( $member_pk );

    $instrument_pks = array_map( function( $record ) {
        return $record['instrument'];
    }, $member_instruments );

    $music_genre_pks = array_map( function( $record ) {
        return $record['music_genre'];
    }, $member_music_genres );

    $instruments  = get_instruments();
    $music_genres = get_music_genres();

    js_include(
        'chosen',
        'validate_lib.js'
    );
?>
<script src="/user/js/modal_edit_profile.js"></script>
<link rel="stylesheet" type="text/css" href="/chosen.min.css" />
<div>
    <h2>Edit Profile Info</h2>
    <form id="update_member_form" style="padding-right:10px">
        <fieldset class="no-style">
            <div>
                <h4>Personal Info</h4>
                <p>
                    <label class="nowidth">Display Email Address:</label>
                    <input class="textbox"
                           type="text"
                           name="display_email_address"
                           id="display_email_address"
                           value="<?= $display_email_address ?>"
                    />
                </p>
                <p>
                    <label class="nowidth">Personal Website:</label>
                    <input class="textbox"
                           type="text"
                           name="personal_website"
                           id="personal_website"
                           value="<?= $personal_website ?>"
                    />
                </p>
                <p>
                    <label class="nowidth">Biography:</label>
                    <textarea name="biography" id="biography"><?= $biography ?></textarea>
                </p>
            </div>
            <hr>
            <div>
                <h4>Music Info</h4>
                <p>
                    <label class="nowidth">Instruments:</label>
                    <select multiple name="instruments" id="instruments">
                        <?
                            foreach ( $instruments as $instrument ):
                                $instrument_pk   = $instrument[ 'instrument' ];
                                $instrument_name = $instrument[ 'name' ];
                        ?>
                            <option value="<?= $instrument_pk ?>"
                                <? if( in_array( $instrument_pk, $instrument_pks ) ): ?>
                                    selected
                                <? endif; ?>
                            >
                                <?= $instrument_name ?>
                            </option>
                        <? endforeach; ?>
                    </select>
                </p>
                <p>
                    <label class="nowidth">Music Genres:</label>
                    <select multiple name="music_genres" id="music_genres">
                        <?
                            foreach ( $music_genres as $music_genre ):
                                $music_genre_pk   = $music_genre[ 'music_genre' ];
                                $music_genre_name = $music_genre[ 'name' ];
                        ?>
                            <option value="<?= $music_genre_pk ?>"
                                <? if( in_array( $music_genre_pk, $music_genre_pks ) ): ?>
                                    selected
                                <? endif; ?>
                            >
                                <?= $music_genre_name ?>
                            </option>
                        <? endforeach; ?>
                    </select>
                </p>
                <p>
                    <label class="nowidth">Available for Collaboration:</label><br>
                    <input type="radio"
                           name="is_available_for_collaboration"
                           value="true"
                           <?= $is_available_for_collaboration ? 'checked="checked"' : '' ?>
                    >
                        Yes
                    </input>
                    <br />
                    <input type="radio"
                           name="is_available_for_collaboration"
                           value="false"
                           <?= !$is_available_for_collaboration ? 'checked="checked"' : '' ?>
                    >
                        No
                    </input>
                </p>
            </div>
            <hr> <!-- Password -->
            <div>
                <p>
                    <label class="nowidth">New Password:</label>
                    <input class="textbox" type="password" name="password" id="password" />
                </p>
                <p>
                    <label class="nowidth">Confirm New Password:</label>
                    <input class="textbox" type="password" name="password_again" id="password_again" />
                </p>
            </div>
            <hr>
            <input type="hidden" name="member_pk" id="member_pk" value="<?= $member_pk ?>" />
            <div style="text-align:right">
                <input type="submit" class="submit-button"></input>
            </div>
        </fieldset>
    </form>
</div>
