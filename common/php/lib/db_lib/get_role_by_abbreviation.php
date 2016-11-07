<?
    /*
     * Gets officer position info from the database by its abbreviation.
     *
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
    function get_role_by_abbreviation( $abbreviation )
    {
        $description_query = <<<SQL
select *
  from tb_role
 where lower( abbreviation ) = lower( ?abbreviation? )
SQL;

        $params = [ 'abbreviation' => $abbreviation ];
        $result = query_execute( $description_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
