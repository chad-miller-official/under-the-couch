<?
    class GetBlogPostsPaginator extends Paginator
    {
        public function getData()
        {
            db_include( 'get_blog_posts' );

            $data = get_blog_posts( $this->limit, $this->offset );
            return $data;
        }
    }
?>
