<?
    db_include (
        'get_member',
        'get_member_roles',
        'get_role_info'
    );

    $member_pk                  = $_REQUEST[ 'member' ];
    $member                     = get_member( $member_pk );
    $member_current_roles       = get_member_roles( $member_pk );

    $member_name                = $member[ 'name' ];
    $member_roles_list          = [1];

    js_common_include();
    js_include(
        'validate_lib.js',
        'ext/featherlight.min.js'
    );
?>
<script src="/dashboard/admin/js/modal_edit_role.js"></script>
<div class="modal">
    <h3>Edit role for <?= $member_name ?></h3>
    <div>
        <strong>Current role(s):</strong>
        <br />
        <? if (count( $member_current_roles ) == 1): ?>
            None
            <br />
        <? else: ?>
            <? foreach ($member_current_roles as $current_role): ?>
                <?
                    $current_role_pk    = $current_role[ 'role' ];
                    if ( $current_role_pk > 1 ) {
                        array_push($member_roles_list, $current_role_pk);
                        $current            = get_role_info( $current_role_pk );
                        echo( $current[ 'name' ] );
                        echo( '<br />' );
                    }
                ?>
            <? endforeach; ?>
        <? endif; ?>
    </div>
    <hr>
    <div>
        <strong>Add/remove roles</strong>
        <form class="admin" method="post" id="edit_role_form" action="/">
            <fieldset class="no-style">
                <p>
                    <label class="nowidth" for="add_role">Add Role:</label>
                    <select id="add_role" name="add_role">
                        <option value="none">--</option>
                        <? for ($i = 2; $i < 14; $i++):
                            $current = get_role_info( $i );
                            if (!in_array( $i, $member_roles_list )): ?>
                                <option value="<?= $current[ 'abbreviation' ] ?>"><?= $current[ 'name' ] ?></option>
                            <? endif; ?>
                        <? endfor; ?>
                    </select>
                </p>
                <p>
                    <label class="nowidth" for="remove_role">Remove Role:</label>
                    <select id="remove_role" name="remove_role">
                        <option value="none">--</option>
                        <? foreach ($member_roles_list as $current_role_pk):
                            if ( $current_role_pk > 1 ):
                                $current = get_role_info( $current_role_pk );
                                ?> <option value="<?= $current[ 'abbreviation' ] ?>"><?= $current[ 'name' ]?></option>
                            <? endif; ?>
                        <? endforeach; ?>
                    </select>
                </p>
                <input id="member_pk" type="text" value="<?= $member_pk ?>" style="display:none;"></input>
                <input type="submit" class="submit-button" id="submit-edit-roles"></input>
            </fieldset>
        </form>
    </div>
</div>
