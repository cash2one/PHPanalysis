#!/bin/bash
today=`date +%F`
php ./script_paylog.php >> ./paylog_$today.log