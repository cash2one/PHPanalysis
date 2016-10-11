#!/bin/bash
today=`date +%F`
php /data/sgclient/web/admin/module/center/script_gm_complaint.php >> /data/center/gm_complaint_$today.log
