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
