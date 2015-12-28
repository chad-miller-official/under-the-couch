<?
    /*
     * Gets an array of officer info from the database by its associated short name.
     * Valid short names are:
     *   president      => President
     *   vicepresident  => Vice President
     *   generalmanager => General Manager
     *   treasurer      => Treasurer
     *   secretary      => Secretary
     *   it             => IT Officer
     *   openmic        => Open Mic Officer
     *   booking        => Booking Agent
     *   equipment      => Equipment Manager
     *   advertising    => Advertising Officer(s)
     *   historian      => Historian
     *   mop            => Minister of Propaganda
     * Officer info is represented as a hash with the following fields:
     *   member                : integer - the PK of the officer's tb_member entry.
     *   officer_name          : string  - the officer's first and last name.
     *   display_email_address : string  - the email address displayed in the officer's profile.
     *   position_name         : string  - the full position name of the officer.
     *   short_name            : string  - the short position name of the officer.
     *
     * Params:
     *   $short_name : string - the @gatech.edu email address of the member to be retrieved.
     * Returns:
     *   <<an array of officer info as hashes>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_officer_info_by_position_short_name( $short_name )
    {
        $get_officer_info_query = <<<SQL
            SELECT m.member							  AS member,
                   m.first_name || ' ' || m.last_name AS officer_name,
                   m.display_email_address            AS display_email_address,
                   p.name                             AS position_name,
                   p.short_name                       AS short_name
              FROM tb_member m
              JOIN tb_officer o
                ON o.member = m.member
              JOIN tb_position p
                ON p.position = o.position
             WHERE p.short_name = $1
SQL;
        pg_prepare( '', $get_officer_info_query );
        $result = pg_execute( '', [ $short_name ] );

        // pg_fetch_all because there may be more than one officer per position
        return $result ? pg_fetch_all( $result ) : false;
    }
?>
