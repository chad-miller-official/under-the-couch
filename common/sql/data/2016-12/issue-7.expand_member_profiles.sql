insert into tb_role
(
    role,
    name,
    abbreviation,
    rank
)
values
(
    14,
    'Musician',
    'MUS',
    900
);

alter table tb_member
    add column personal_website               varchar(300),
    add column is_available_for_collaboration boolean default true,
    add column biography                      text;

create sequence sq_pk_tb_instrument;
create table tb_instrument
(
    instrument integer      primary key default nextval( 'sq_pk_tb_instrument'::regclass ),
    name       varchar(100) not null unique
);

create sequence sq_pk_tb_music_genre;
create table tb_music_genre
(
    music_genre integer primary key default nextval( 'sq_pk_tb_music_genre'::regclass ),
    name        varchar(100) not null unique
);

create sequence sq_pk_tb_member_instrument;
create table tb_member_instrument
(
    member_instrument integer primary key default nextval( 'sq_pk_tb_member_instrument'::regclass ),
    member            integer not null references tb_member( member ),
    instrument        integer not null references tb_instrument( instrument ),
    can_teach         boolean,
    unique ( member, instrument )
);

create sequence sq_pk_tb_member_music_genre;
create table tb_member_music_genre
(
    member_music_genre integer primary key default nextval( 'sq_pk_tb_member_music_genre'::regclass ),
    member             integer not null references tb_member( member ),
    music_genre        integer not null references tb_music_genre( music_genre ),
    unique ( member, music_genre )
);
