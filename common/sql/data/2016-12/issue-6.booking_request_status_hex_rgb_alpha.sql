alter table tb_booking_request_status
    alter column hex_rgb type varchar(24);

create temp table tt_hex_rgbs
(
    old varchar,
    new varchar
);

insert into tt_hex_rgbs ( old,       new                   )
                 values ( '#FF4D4D', 'rgba(255,77,77,0.4)' ),
                        ( '#D8B858', 'rgba(216,184,88,0.4)' ),
                        ( '#5878D9', 'rgba(88,120,217,0.4)' ),
                        ( '#40CC54', 'rgba(64,204,84,0.4)' );

update tb_booking_request_status brs
   set hex_rgb = tt.new
  from tt_hex_rgbs tt
 where brs.hex_rgb = tt.old;
