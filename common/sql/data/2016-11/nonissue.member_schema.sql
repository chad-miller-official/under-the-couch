--requires: nonissue.tb_role.sql

/* TB_MEMBER */

create sequence sq_pk_tb_member;
create table tb_member
(
    member                integer      primary key default nextval( 'sq_pk_tb_member'::regclass ),
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

insert into tb_member
(
    member,
    first_name,
    last_name,
    gatech_email_address,
    password_hash
)
values
(
    -1,
    'Guest',
    'User',
    '',
    ''
);

/* TB_MEMBER_SESSION */

create sequence sq_pk_tb_member_session;
create table tb_member_session
(
    member_session integer   primary key default nextval( 'sq_pk_tb_member_session'::regclass ),
    member         integer   not null references tb_member ( member ),
    accessed       timestamp not null default now(),
    key            varchar   not null unique,
    value          text      not null
);

/* TB_MEMBER_ROLE */

create sequence sq_pk_tb_member_role;
create table tb_member_role
(
    member_role integer primary key default nextval( 'sq_pk_tb_member_role'::regclass ),
    member      integer not null references tb_member ( member ),
    role        integer not null references tb_role ( role ),
    unique( member, role )
);
