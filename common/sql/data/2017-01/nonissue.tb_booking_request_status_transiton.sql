create sequence sq_pk_booking_request_status_transition;

create table tb_booking_request_status_transition
(
    booking_request_status_transition integer primary key default nextval( 'sq_pk_booking_request_status_transition' ),
    booking_request_status            integer not null references tb_booking_request_status ( booking_request_status ),
    next_booking_request_status       integer not null references tb_booking_request_status ( booking_request_status ),
    unique ( booking_request_status, next_booking_request_status )
);

insert into tb_booking_request_status_transition ( booking_request_status, next_booking_request_status )
                                          values ( 1,                      2 ),
                                                 ( 2,                      1 ),
                                                 ( 2,                      3 );
