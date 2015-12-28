<?
    /*
     * Gets the equipment manager's email address from the database.
     *
     * Params:
     *   None.
     * Returns:
     *   The equipment manager's email address.
     */
    function get_equipment_manager_email()
    {
        $email_query = <<<SQL
            SELECT m.display_email_address
              FROM tb_member m
              JOIN tb_officer o
                ON o.member = m.member
              JOIN tb_position p
                ON p.position = o.position
             WHERE p.position = $1
SQL;

        pg_prepare( '', $email_query );
        $result = pg_execute( '', [ EQUIPMENT_MANAGER ] );
        $row    = pg_fetch_array( $result );
        return $row[0];
    }
?>
