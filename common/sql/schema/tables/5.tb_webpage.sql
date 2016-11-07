-- If a webpage is not in this table, assume access is allowed for all roles.

create sequence sq_pk_tb_webpage;

create table tb_webpage
(
    webpage                   integer      primary key default nextval( 'sq_pk_tb_webpage'::regclass ),
    base_uri_glob             varchar(300) not null unique,
    access_allowed_by_default boolean      default true
);
