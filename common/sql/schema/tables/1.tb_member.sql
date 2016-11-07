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
