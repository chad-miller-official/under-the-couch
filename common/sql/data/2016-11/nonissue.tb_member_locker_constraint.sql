--requires: nonissue.member_schema.sql

alter table tb_member
    add constraint locker_info_valid check (
         ( paid_locker_date is null and locker_months is null and locker_number is null )
      or ( paid_locker_date is not null and locker_months is not null and locker_number is not null )
    );
