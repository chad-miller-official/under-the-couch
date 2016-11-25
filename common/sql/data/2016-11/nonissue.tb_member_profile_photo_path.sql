--requires: nonissue.member_schema.sql

alter table tb_member
    add column profile_photo_path varchar( 200 );
