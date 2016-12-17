alter table tb_booking_request_status
    drop column hex_rgb;

alter table tb_booking_request_status
    add column rgb_color varchar(11);

create temp table tt_rgbs
(
    label varchar,
    rgb   varchar
);

insert into tt_rgbs ( label,        rgb          )
             values ( 'Unreviewed', '255,77,77'  ),
                    ( 'Reviewed',   '216,184,88' ),
                    ( 'Replied',    '88,120,217' ),
                    ( 'Closed',     '64,204,84'  );

update tb_booking_request_status brs
   set rgb_color = tt.rgb
  from tt_rgbs tt
 where brs.label = tt.label;
