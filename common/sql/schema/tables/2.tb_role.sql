create table tb_role
(
    role             integer     primary key,
    parent           integer     references tb_role ( role ),
    name             varchar(40) not null unique,
    abbreviation     varchar(10) not null unique,
    description_html text,
    rank             integer     not null unique,
    is_admin         boolean     default false
);
