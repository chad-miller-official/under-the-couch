<?
    class GetBlogPostsPaginator extends Paginator
    {
        protected function getData()
        {
            db_include( 'get_blog_posts' );

            $data = get_blog_posts( $this->limit, $this->offset );
            return $data;
        }
    }
?>
