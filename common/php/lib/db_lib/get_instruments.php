<?
    function get_instruments()
    {
        $query = <<<SQL
select instrument,
       name
  from tb_instrument
SQL;

        $result = query_execute( $query );
        return query_success( $result ) ? query_fetch_all( $result ) : false;
    }
?>
