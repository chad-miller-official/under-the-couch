<?
    /*
     * Gets officer position info from the database by its associated short name.
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
     *   position    : integer - the PK of the officer position info.
     *   name        : string  - the officer position's full name.
     *   short_name  : string  - the officer position's short name.
     *   description : string  - the officer position's description.
     *
     * Params:
     *   $short_name : string - the @gatech.edu email address of the member to be retrieved.
     * Returns:
     *   <<an array of officer info as hashes>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_position_by_short_name( $short_name )
    {
        $description_query = <<<SQL
            SELECT *
              FROM tb_position
             WHERE short_name = $1
SQL;

        pg_prepare( '', $description_query );
        $result = pg_execute( '', [ $short_name ] );
        return $result ? pg_fetch_assoc( $result ) : false;
    }
?>
