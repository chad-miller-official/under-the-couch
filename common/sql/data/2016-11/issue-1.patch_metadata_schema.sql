--ignore

create sequence sq_pk_applied_patch;
create table tb_applied_patch
(
    applied_patch integer      primary key default nextval( 'sq_pk_applied_patch'::regclass ),
    patch_folder  varchar(30)  not null,
    patch_file    varchar(200) not null,
    is_function   boolean      default false,
    checksum      varchar(32),
    first_applied timestamp    not null default now(),
    reapplied     timestamp,
    unique( patch_folder, patch_file ),
    check( checksum is not null or is_function is true )
);
