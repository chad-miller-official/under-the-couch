create temp table tt_webpage
(
    base_uri_glob varchar(300),
    access_allowed_by_default boolean
);

\copy tt_webpage from stdin with csv;
blog/edit_blog_post.php,false
blog/write_blog_post.php,false
blog/blog_post.php,true
booking/gt_org.php,true
booking/perform.php,true
booking/record.php,true
common/%,false
contacts/%,true
dashboard/booking/requests.php,false
fonts/%,false
info/%,true
media/%,true
ui/footer.php,true
ui/header.php,true
ui/sidebar.php,true
user/%,true
404.php,true
calendar.php,true
index.php,true
router.php,true
\.

insert into tb_webpage
(
    base_uri_glob,
    access_allowed_by_default
)
   select base_uri_glob,
          access_allowed_by_default
     from tt_webpage;

insert into tb_role_webpage
(
    role,
    webpage,
    access_allowed
)
     select *
       from (
              select role
                from tb_role
               where name <> 'Member'
            ) r
 cross join (
              select webpage,
                     true
                from tb_webpage
               where access_allowed_by_default is false
            ) w;