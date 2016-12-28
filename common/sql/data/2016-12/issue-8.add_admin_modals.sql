insert into tb_webpage
(
    base_uri_glob,
    access_allowed_by_default
)
values
(
    'dashboard/admin/modal_edit_role.php',
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
   and w.base_uri_glob = 'dashboard/admin/modal_edit_role.php';

   insert into tb_webpage
   (
       base_uri_glob,
       access_allowed_by_default
   )
   values
   (
       'dashboard/admin/modal_send_message.php',
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
      and w.base_uri_glob = 'dashboard/admin/modal_send_message.php';

      insert into tb_webpage
      (
          base_uri_glob,
          access_allowed_by_default
      )
      values
      (
          'dashboard/admin/modal_update_info.php',
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
         and w.base_uri_glob = 'dashboard/admin/modal_update_info.php';
