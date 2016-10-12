create sequence sq_pk_tb_member_role;

create table tb_member_role
(
    member_role integer not null unique default nextval( 'sq_pk_tb_member_role'::regclass ),
    member      integer not null references tb_member ( member ),
    role        integer not null references tb_role ( role ),
    unique( member, role )
);
