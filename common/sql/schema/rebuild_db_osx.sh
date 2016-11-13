#!/bin/sh

# SQL credentials
user="postgres"
db_user="gtmn"
db="gtmn"
db_temp="gtmn_temp"

# Directories
sql_dir="$(dirname $(greadlink -f $0))"
sql_dir="$sql_dir/.."

tables="$sql_dir/schema/tables/*.sql"
data="$sql_dir/schema/data/*.sql"
funcs="$sql_dir/functions/*.sql"

pg_cmd () {
    # $1 = command to run
    # $2 = database name (optional)

    if [ -z $2 ]; then
        psql -w -U "$user" -c "$1"
    else
        psql -w -U "$user" -d "$2" -c "$1"
    fi
}

pg_file () {
    # $1 = file to run
    # $2 = database name

    psql -w -U "$user" -d "$2" -f "$1" -1
}

echo "Creating new database..."
dropdb -e --if-exists -U "$user" -w "$db_temp"
createdb -e -U "$user" -w "$db_temp"

echo "\nCreating tables..."

for table in $(ls -1v $tables); do
    pg_file "$table" "$db_temp"
done

echo "\nPopulating tables..."

for rows in $(ls -1v $data); do
    pg_file "$rows" "$db_temp"
done

echo "\nCreating functions..."

for func in $(ls -1v $funcs); do
    pg_file "$func" "$db_temp"
done

echo "\nDropping old database..."
dropdb -e --if-exists -U "$user" -w "$db"

echo "\nRenaming new database..."
pg_cmd "alter database $db_temp rename to $db"

echo "\nGranting permissions..."
pg_cmd "grant usage on schema public to $db_user"
pg_cmd "alter default privileges in schema public grant all on tables to $db_user"
pg_cmd "grant connect on database $db to $db_user"

pg_cmd "grant usage on schema public to $db_user" "$db"
pg_cmd "grant all on all sequences in schema public to $db_user" "$db"
pg_cmd "grant all on all tables in schema public to $db_user" "$db"

echo "\nCreating extensions..."
pg_cmd "create extension pgcrypto" "$db"

exit 0
