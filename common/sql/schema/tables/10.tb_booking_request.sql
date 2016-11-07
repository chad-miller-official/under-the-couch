create sequence sq_pk_booking_request;

create table tb_booking_request
(
    booking_request        integer        primary key default nextval( 'sq_pk_booking_request'::regclass ),
    booking_request_type   integer        not null references tb_booking_request_type ( booking_request_type ),
    booking_request_status integer        not null references tb_booking_request_status ( booking_request_status ) default 1,
    contact_name           varchar( 250 ) not null,
    contact_email_address  varchar( 250 ) not null,
    contact_phone_number   varchar( 10 ),
    date_requested         date           not null,
    comments               text,
    additional_information json,
    created                timestamp      not null default now(),
    modified               timestamp      not null default now(),
    modifier               timestamp
);
