create sequence sq_pk_tb_role_webpage;

create table tb_role_webpage
(
    role_webpage   integer not null unique default nextval( 'sq_pk_tb_role_webpage'::regclass ),
    role           integer not null references tb_role ( role ),
    webpage        integer not null references tb_webpage ( webpage ),
    access_allowed boolean not null,
    unique( role, webpage )
);
