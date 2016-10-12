create or replace function fn_get_page_permissions_for_role
(
    in_role integer
)
returns table ( webpage integer, access_allowed boolean )  as
 $_$
with tt_role_webpage_table as
(
        select *
          from (
                 select r.role
                   from tb_role r
               ) r
    cross join (
                  select w.webpage,
                         w.access_allowed_by_default
                    from tb_webpage w
               ) w
)
   select tt.webpage,
          coalesce( rw.access_allowed, tt.access_allowed_by_default )
     from tt_role_webpage_table tt
left join tb_role_webpage rw
    using ( role, webpage )
    where tt.role = in_role;
 $_$
language sql;
