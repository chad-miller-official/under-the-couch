create sequence sq_pk_tb_member_session;

create table tb_member_session
(
    member_session integer   not null unique default nextval( 'sq_pk_tb_member_session'::regclass ),
    member         integer   not null references tb_member ( member ),
    accessed       timestamp not null default now(),
    key            varchar   not null unique,
    value          text      not null
);
