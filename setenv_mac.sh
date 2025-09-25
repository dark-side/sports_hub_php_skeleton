#!/bin/bash

cd src
cp .env.example .env
sed -i '.bak' 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/g' .env
sed -i '.bak' 's/# DB_HOST=127.0.0.1/DB_HOST=mysql/g' .env
sed -i '.bak' 's/# DB_PORT=3306/DB_PORT=3306/g' .env
sed -i '.bak' 's/# DB_DATABASE=laravel/DB_DATABASE=laraveldb/g' .env
sed -i '.bak' 's/# DB_USERNAME=root/DB_USERNAME=laravel/g' .env
sed -i '.bak' 's/# DB_PASSWORD=/DB_PASSWORD=secret/g' .env
