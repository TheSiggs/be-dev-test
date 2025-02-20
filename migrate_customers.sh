#!/bin/sh

# Load database credentials from Laravel's .env file
DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2)
DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASS=$(grep DB_PASSWORD .env | cut -d '=' -f2)
DB_HOST=0.0.0.0
DB_PORT=$(grep DB_PORT .env | cut -d '=' -f2)

CSV_FILE="data/customers.csv"
BATCH_SIZE=100

if [ ! -f "$CSV_FILE" ]; then
    echo "Error: CSV file not found at $CSV_FILE"
    exit 1
fi

INSERT_QUERY="INSERT INTO customers (first_name, last_name, email, gender, ip_address, company, city, title, website) VALUES"
VALUES=""

COUNT=0
while IFS=',' read -r id first_name last_name email gender ip_address company city title website; do
    # Skip header row
    if [[ "$id" == "id" ]]; then
        continue
    fi

    # Escape single quotes for SQL safety
    first_name=${first_name//\'/\'\'}
    last_name=${last_name//\'/\'\'}
    email=${email//\'/\'\'}
    gender=${gender//\'/\'\'}
    ip_address=${ip_address//\'/\'\'}
    company=${company//\'/\'\'}
    city=${city//\'/\'\'}
    title=${title//\'/\'\'}
    website=${website//\'/\'\'}

    VALUES="$VALUES ('$first_name', '$last_name', '$email', '$gender', '$ip_address', '$company', '$city', '$title', '$website'),"

    ((COUNT++))

    # When batch size is reached, execute INSERT and reset VALUES
    if ((COUNT % BATCH_SIZE == 0)); then
        mysql -u"$DB_USER" -p"$DB_PASS" -h"$DB_HOST" -P"$DB_PORT" "$DB_NAME" -e "${INSERT_QUERY} ${VALUES%,};"
        VALUES=""
    fi
done < <(tail -n +2 "$CSV_FILE") # Skip header row

# Insert remaining rows (if any)
if [ -n "$VALUES" ]; then
    mysql -u"$DB_USER" -p"$DB_PASS" -h"$DB_HOST" -P"$DB_PORT" "$DB_NAME" -e "${INSERT_QUERY} ${VALUES%,};"
fi
