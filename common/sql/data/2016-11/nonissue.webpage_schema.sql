--requires: nonissue.member_schema.sql

/* TB_BLOG_POST */

create sequence sq_pk_tb_blog_post;
create table tb_blog_post
(
    blog_post integer      primary key default nextval( 'sq_pk_tb_blog_post'::regclass ),
    creator   integer      not null references tb_member ( member ),
    created   timestamp    not null default now(),
    title     varchar(100) not null,
    body      text         not null,
    editor    integer      references tb_member ( member ),
    edited    timestamp
);

/* TB_WEBPAGE */

-- If a webpage is not in this table, assume access is allowed for all roles.
create sequence sq_pk_tb_webpage;
create table tb_webpage
(
    webpage                   integer      primary key default nextval( 'sq_pk_tb_webpage'::regclass ),
    base_uri_glob             varchar(300) not null unique,
    access_allowed_by_default boolean      default true
);

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
dashboard/booking/index.php,false
dashboard/calendar/index.php,true
fonts/%,false
info/%,true
media/%,true
ui/footer.php,true
ui/header.php,true
ui/sidebar.php,true
user/%,true
404.php,true
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

/* TB_ROLE_WEBPAGE */

create sequence sq_pk_tb_role_webpage;
create table tb_role_webpage
(
    role_webpage   integer primary key default nextval( 'sq_pk_tb_role_webpage'::regclass ),
    role           integer not null references tb_role ( role ),
    webpage        integer not null references tb_webpage ( webpage ),
    access_allowed boolean not null,
    unique( role, webpage )
);

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
