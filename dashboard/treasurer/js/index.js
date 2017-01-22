$( document ).ready( index_initialize );

var limit       = 15;
var data_source = 'GetMembersPaginator';

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
    var treasurer_body = $( '#treasurer_tbody' );

    treasurer_body.empty();

    $.each( data, function( i, member )
        {
            var member_pk_val = member[ 'member' ];
            var member_fees_due = !member[ 'paid_dues_date' ] && !member[ 'paid_practice_date' ];

            var member_last_first = $( '<a>' )
                .text( member[ 'last_name' ] + ", " + member[ 'first_name' ] )
                .prop(
                    'href',
                    '/dashboard/treasurer/modal_treasurer.php?member=' + member_pk_val
                )
                .attr( 'data-featherlight', 'ajax' );

            var last_first         = $( '<td class="text-cell">' ).append( member_last_first );
            var paid_dues_date     = $( '<td class="text-cell">' ).text( member[ 'paid_dues_date' ] );
            var paid_practice_date = $( '<td class="text-cell">' ).text( member[ 'paid_practice_date' ] );
            var locker_number      = $( '<td class="text-cell">' ).text( member[ 'locker_number' ] );
            var paid_locker_date   = $( '<td class="text-cell">' ).text( member[ 'paid_locker_date' ] );
            var locker_months      = $( '<td class="text-cell">' ).text( member[ 'locker_months' ] );

            var row = $( '<tr> ');

            if( member_fees_due )
                row.css( 'background-color', 'rgba(255, 77, 77, 0.4)' );

            row.append(
                last_first,
                paid_dues_date,
                paid_practice_date,
                locker_number,
                paid_locker_date,
                locker_months
            );

            treasurer_body.append( row );
        }
    );
}
