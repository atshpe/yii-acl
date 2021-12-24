#!/bin/bash
echo 'Inserting data...'
docker exec yii-mariadb mysqldump -u root --password=yiipass yii_acl < yii_acl_dump.sql
echo 'Data inserted successfuly!'
