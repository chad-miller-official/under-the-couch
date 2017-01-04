<?
    class GetMembersPaginator extends Paginator
    {
        protected function getData()
        {
            db_include( 'get_members_by_last_name' );

            $data = get_members_by_last_name( $this->limit, $this->offset );
            return $data;
        }
    }
?>
