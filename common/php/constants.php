<?
    // SQL constants
    define( 'PSQL_HOST',           'localhost' );
    define( 'PSQL_PORT',           '5432'      );
    define( 'PSQL_DB'  ,           'gtmn'      );
    define( 'PSQL_USER',           'gtmn'      );
    define( 'PSQL_CONNECT_STRING', ' host='   . PSQL_HOST
                                 . ' port='   . PSQL_PORT
                                 . ' dbname=' . PSQL_DB
                                 . ' user='   . PSQL_USER );

    // Primary keys
    define( 'ROLE_MEMBER',                 1  );
    define( 'ROLE_IT_OFFICER',             2  );
    define( 'ROLE_PRESIDENT',              3  );
    define( 'ROLE_VICE_PRESIDENT',         4  );
    define( 'ROLE_TREASURER',              5  );
    define( 'ROLE_SECRETARY',              6  );
    define( 'ROLE_MINISTER_OF_PROPAGANDA', 7  );
    define( 'ROLE_ADVERTISING_OFFICER',    8  );
    define( 'ROLE_BOOKING_AGENT',          9  );
    define( 'ROLE_OPEN_MIC_OFFICER',       10 );
    define( 'ROLE_GENERAL_MANAGER',        11 );
    define( 'ROLE_EQUIPMENT_MANAGER',      12 );
    define( 'ROLE_SOCIAL_CHAIR',           13 );

    define( 'BOOKING_REQUEST_TYPE_GT_ORGANIZATION', 1 );
    define( 'BOOKING_REQUEST_TYPE_PERFORMANCE',     2 );
    define( 'BOOKING_REQUEST_TYPE_RECORDING',       3 );

    define( 'BOOKING_REQUEST_STATUS_NOT_STARTED', 1 );
    define( 'BOOKING_REQUEST_STATUS_IN_PROGRESS', 2 );
    define( 'BOOKING_REQUEST_STATUS_CLOSED',      3 );

    // URL constants
    define( 'URL_ICAL_BOOKING', 'http://www.google.com/calendar/ical/kcbafbo67qe33jpj8s10b1ltk0@group.calendar.google.com/public/basic.ics');
    define( 'URL_CALENDAR',     'https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=600&amp;'
                              . 'wkst=1&amp;bgcolor=%23FFFFFF&amp;src=c15nvehc365iejl19oedqf59ao%40group.calendar.google.com&amp;'
                              . 'color=%236B3304&amp;src=blq0j50tj034hu67u4gdltn8lc%40group.calendar.google.com&amp;color=%232952A3&amp;'
                              . 'src=2cn9iaf49hbdnbaddsect2rmks%40group.calendar.google.com&amp;color=%238C500B&amp;'
                              . 'src=iiailan4hmunsuiru1s3tr0bvs%40group.calendar.google.com&amp;color=%232952A3&amp;'
                              . 'src=kcbafbo67qe33jpj8s10b1ltk0%40group.calendar.google.com&amp;color=%23875509&amp;'
                              . 'src=d9mfbr5rbro76mgsg8829htjmo%40group.calendar.google.com&amp;color=%232F6309&amp;'
                              . 'src=utcbooking%40gmail.com&amp;color=%231B887A&amp;'
                              . 'src=soacojivunh8bo6rvnfi9nngk8%40group.calendar.google.com&amp;color=%232F6309&amp;'
                              . 'src=qcolb7go6s8oouldedrpa45d48%40group.calendar.google.com&amp;color=%235229A3&amp;'
                              . 'ctz=America%2FNew_York' );

    // Email constants
    define( 'EMAIL_WEBMASTER',    'webmaster@gtmn.org' );
    define( 'EMAIL_BOOKING',      'utcbooking@gmail.com' );
    define( 'EMAIL_MAILING_LIST', 'MusiciansNetwork@groupspaces.com' );

    // Globals
    define( 'WEBROOT',   'webroot'   );
    define( 'DB_HANDLE', 'db_handle' );
?>
