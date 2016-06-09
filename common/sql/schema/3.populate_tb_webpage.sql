create temp table tt_webpage
(
    base_uri_glob varchar(300),
    access_allowed_by_default boolean
);

\copy tt_webpage from stdin with csv;
blog/proc/%,false
blog/deleteblog.php,false
blog/editblog.php,false
blog/writeblog.php,false
blog/blog.php,true
booking/%,true
contacts/%,true
fonts/%,false
info/%,true
media/%,true
user/%,true
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
     from tt_webpage
returning webpage;

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
            ) w
  returning role_webpage;
