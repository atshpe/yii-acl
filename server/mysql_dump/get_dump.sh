#!/bin/bash
echo 'Creating dump file...'
docker exec yii-mariadb mysqldump -u root --password=yiipass yii_acl > yii_acl_dump.sql
echo 'Dump created successfuly!'
