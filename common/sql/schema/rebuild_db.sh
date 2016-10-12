#!/bin/sh

# SQL credentials
user="postgres"
db_user="gtmn"
db="gtmn"
db_temp="gtmn_temp"

# Directories
sql_dir="$(dirname $(readlink -f $0))"
sql_dir="$sql_dir/.."

tables="$sql_dir/schema/tables/*.sql"
data="$sql_dir/schema/data/*.sql"
funcs="$sql_dir/functions/*.sql"

echo "Creating new database..."
dropdb -e --if-exists -U "$user" -w "$db_temp"
createdb -e -U "$user" -w "$db_temp"

echo "\nCreating tables..."

for table in $(ls -1 $tables | sort -n); do
    psql -w -U "$user" -d "$db_temp" -f "$table" -1
done

echo "\nPopulating tables..."

for rows in $(ls -1 $data | sort -n); do
    psql -w -U "$user" -d "$db_temp" -f "$rows" -1
done

echo "\nCreating functions..."

for func in $(ls -1 $funcs | sort -n); do
    psql -w -U "$user" -d "$db_temp" -f "$func" -1
done

echo "\nDropping old database..."
dropdb -e --if-exists -U "$user" -w "$db"

echo "\nRenaming new database..."
psql -w -U "$user" -w -c "alter database $db_temp rename to $db"

echo "\nGranting permissions..."
psql -w -U "$user" -c "grant usage on schema public to $db_user"
psql -w -U "$user" -c "alter default privileges in schema public grant all on tables to $db_user"
psql -w -U "$user" -c "grant connect on database $db to $db_user"
psql -w -U "$user" -d "$db" -c "grant usage on schema public to $db_user"
psql -w -U "$user" -d "$db" -c "grant all on all sequences in schema public to $db_user"
psql -w -U "$user" -d "$db" -c "grant all on all tables in schema public to $db_user"
