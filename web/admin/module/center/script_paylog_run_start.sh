#!/bin/bash
today=`date +%F`
php /data/sgclient/web/admin/module/center/script_paylog.php >> /data/center/paylog_$today.log