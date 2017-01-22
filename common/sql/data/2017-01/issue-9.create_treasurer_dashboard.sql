insert into tb_webpage
(
    base_uri_glob,
    access_allowed_by_default
)
values
(
    'dashboard/treasurer/index.php',
    false
);

insert into tb_role_webpage
(
    role,
    webpage,
    access_allowed
)
select r.role,
       w.webpage,
       true
  from tb_role r,
       tb_webpage w
 where r.role <> 1
   and w.base_uri_glob = 'dashboard/treasurer/index.php';
