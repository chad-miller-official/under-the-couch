create sequence sq_pk_tb_member;
create table tb_member
(
    member                integer      not null unique default nextval( 'sq_pk_tb_member'::regclass ),
    first_name            varchar(50)  not null,
    last_name             varchar(50)  not null,
    gatech_email_address  varchar(200) not null unique,
    display_email_address varchar(200),
    password_hash         varchar(60)  not null,
    paid_dues_date        timestamp,
    paid_locker_date      timestamp,
    paid_practice_date    timestamp,
    locker_months         integer,
    locker_number         integer
);

create table tb_role
(
    role             integer     not null unique,
    parent           integer     references tb_role ( role ),
    name             varchar(40) not null unique,
    abbreviation     varchar(10) not null unique,
    description_html text,
    rank             integer     not null unique,
    is_admin         boolean     default false
);

create sequence sq_pk_tb_member_role;
create table tb_member_role
(
    member_role integer not null unique default nextval( 'sq_pk_tb_member_role'::regclass ),
    member      integer not null references tb_member ( member ),
    role        integer not null references tb_role ( role ),
    unique( member, role )
);

create sequence sq_pk_tb_blog_post;
create table tb_blog_post
(
    blog_post integer      not null unique default nextval( 'sq_pk_tb_blog_post'::regclass ),
    creator   integer      not null references tb_member ( member ),
    created   timestamp    not null default now(),
    title     varchar(100) not null,
    body      text         not null,
    editor    integer      references tb_member ( member ),
    edited    timestamp
);

-- If a webpage is not in this table, assume access is allowed for all roles.
create sequence sq_pk_tb_webpage;
create table tb_webpage
(
    webpage                   integer      not null unique default nextval( 'sq_pk_tb_webpage'::regclass ),
    base_uri_glob             varchar(300) not null unique,
    access_allowed_by_default boolean      default true
);

create sequence sq_pk_tb_role_webpage;
create table tb_role_webpage
(
    role_webpage   integer not null unique default nextval( 'sq_pk_tb_role_webpage'::regclass ),
    role           integer not null references tb_role ( role ),
    webpage        integer not null references tb_webpage ( webpage ),
    access_allowed boolean not null,
    unique( role, webpage )
);
