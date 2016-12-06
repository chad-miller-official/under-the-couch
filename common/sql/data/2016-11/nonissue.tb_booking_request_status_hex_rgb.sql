--requires: nonissue.booking_schema.sql

alter table tb_booking_request_status
    add column hex_rgb varchar(7);

update tb_booking_request_status
   set hex_rgb = '#FF4D4D'
 where booking_request_status = 1; -- Unreviewed

update tb_booking_request_status
   set hex_rgb = '#D8B858'
 where booking_request_status = 2; -- Reviewed

update tb_booking_request_status
   set hex_rgb = '#5878D9'
 where booking_request_status = 3; -- Replied

update tb_booking_request_status
   set hex_rgb = '#40CC54'
 where booking_request_status = 4; -- Closed

alter table tb_booking_request_status
    alter column hex_rgb set not null;
