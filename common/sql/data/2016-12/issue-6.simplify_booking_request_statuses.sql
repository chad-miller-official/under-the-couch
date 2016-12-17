update tb_booking_request_status
   set label = 'Not Started'
 where booking_request_status = 1;

update tb_booking_request_status
   set label = 'In Progress'
 where booking_request_status = 2;

delete from tb_booking_request_status
      where booking_request_status = 3;

update tb_booking_request_status
   set booking_request_status = 3
 where booking_request_status = 4;
