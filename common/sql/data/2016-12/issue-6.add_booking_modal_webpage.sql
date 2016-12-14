insert into tb_webpage
(
    base_uri_glob,
    access_allowed_by_default
)
values
(
    'dashboard/booking/modal_performance_booking_request.php',
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
   and w.base_uri_glob = 'dashboard/booking/modal_performance_booking_request.php';
