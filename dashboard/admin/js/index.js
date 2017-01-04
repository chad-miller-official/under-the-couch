$( document ).ready( index_initialize );

var limit       = 15;
var data_source = 'GetMembersPaginator';
var rm_source   = '/common/php/ajax/remove_member.php';

function index_initialize()
{
    pagination_init(
        data_source,
        limit,
        populate_member_table
    );
}

function populate_member_table( data, pagination )
{
    var admin_body = $( '#admin_tbody' );

    admin_body.empty();

    $.each( data, function( i, member ) {
        var member_pk_val   = member[ 'member' ];
        var member_is_admin = member[ 'role' ] > 1;
        var member_fees_due = !member[ 'paid_dues_date' ] && !member[ 'paid_practice_date' ];

        var edit_role_modal_link = $( '<a>' )
            .append( '<img src="/media/icons/edit_role.gif" />' )
            .prop(
                'href',
                '/dashboard/admin/modal_edit_role.php?member=' + member_pk_val
            )
            .attr( 'data-featherlight', 'ajax' )
            .css( 'display', 'inline' );

        var send_message_modal_link = $( '<a>' )
            .append( '<img src="/media/icons/send_message.gif" />' )
            .prop(
                'href',
                '/dashboard/admin/modal_send_message.php?member=' + member_pk_val
            )
            .attr( 'data-featherlight', 'ajax' )
            .css( 'display', 'inline' );

        var update_info_modal_link = $( '<a>' )
            .append( '<img src="/media/icons/update_info.gif" />' )
            .prop(
                'href',
                '/user/modal_edit_profile.php?member=' + member_pk_val
            )
            .attr( 'data-featherlight', 'ajax' )
            .css( 'display', 'inline' );

        var last_name             = $( '<td class="text-cell">' ).text( member[ 'last_name' ] );
        var first_name            = $( '<td class="text-cell">' ).text( member[ 'first_name' ] );
        var gatech_email_address  = $( '<td class="email-cell">' ).text( member[ 'gatech_email_address' ] );
        var display_email_address = $( '<td class="email-cell">' ).text( member[ 'display_email_address' ] );
        var paid_dues_date        = $( '<td class="text-cell">' ).text( member[ 'paid_dues_date' ] );
        var paid_practice_date    = $( '<td class="text-cell">' ).text( member[ 'paid_practice_date' ] );

        var delete_member = $( '<a id="delete_member_' + member_pk_val + '" href="javascript:void(0);"> ')
            .append( '<img src="/media/icons/delete_member.gif" />' ).css( 'display', 'inline' );

        var actions_cell = $( '<td>' )
            .append(
                edit_role_modal_link,
                send_message_modal_link,
                update_info_modal_link,
                delete_member
            );

        var row = $( '<tr> ');

        if( member_is_admin && member_fees_due )
            row.css( 'background-color', 'rgba(192, 64, 192, 0.4)' );
        else if( member_is_admin )
            row.css( 'background-color', 'rgba(84, 64, 204, 0.3)' );
        else if( member_fees_due )
            row.css( 'background-color', 'rgba(255, 77, 77, 0.4)' );

        row.append(
            last_name,
            first_name,
            gatech_email_address,
            display_email_address,
            paid_dues_date,
            paid_practice_date,
            actions_cell
        );

        admin_body.append( row );

        $( '#delete_member_' + member_pk_val ).click( function () {
            if( remove_member( data, i ) )
                alert( 'Member ' + member[ 'first_name' ] + ' ' + member[ 'last_name' ] + ' removed successfully.' );
        });
    });
}

function remove_member( data, index )
{
    if( data[ index ][ 'role' ] > 1 )
        alert( 'Cannot remove officers.' );
    else
    {
        if(
            confirm(
                  'Are you sure you want to remove '
                + data[ index ][ 'first_name' ] + ' ' + data[ index ][ 'last_name' ]
                + ' from Under the Couch?'
            )
        )
        {
            var params               = { 'member' : data[index][ 'member' ] };
            var deleted_successfully = false;

            $.post( url, params, function( response, textStatus, jqXHR ) {
                if( response['success'] )
                    deleted_successfully = true;
                else
                    js_error( 'Failed to load members.', LOAD_MEMBERS_FAILURE );
            }, 'json' )
            .fail( js_generic_error );

            return deleted_successfully;
        }
    }
}
