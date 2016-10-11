<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

	$server_name = trim($_REQUEST['server']);
	$account_name = trim($_REQUEST['qid']);
	$event = trim($_REQUEST['event']);
	$time = time();

	if($event=='beforeloadflash')
	{
        $version = trim($_REQUEST['version']);
        $resolution = trim($_REQUEST['resolution']);
        $brower = trim($_REQUEST['brower']);
		$record_sql = "select * FROM `t_log_game_event2` where account_name = '{$account_name}'";
		$record_result = $db->fetchAll($record_sql);

		if(empty($record_result))
		{
			$sql = 'INSERT INTO `'.$dbConfig['dbname'].'`.`t_log_game_event2` (`id`, `account_name`, `datetime`, `event`, `server_name`, `version`, `resolution`, `brower`) VALUES ' .
				'(NULL, \'' .
				$account_name .
				'\', \'' .
				$time .
				'\', \'' .
				$event .
				'\', \'' .
				$server_name .
				'\', \'' .
				$version .
				'\', \'' .
				$resolution .
				'\', \'' .
				$brower .
				'\');'; 
		}
		else
		{
			$sql = 'REPLACE INTO `'.$dbConfig['dbname'].'`.`t_log_game_event2` (`id`, `account_name`, `datetime`, `event`, `server_name`, `version`, `resolution`, `brower`) VALUES ' .
				'(' .
				$record_result[0]['id'] .
				', \'' .
				$account_name .
				'\', \'' .
				$time .
				'\', \'' .
				$event .
				'\', \'' .
				$server_name .
				'\', \'' .
				$version .
				'\', \'' .
				$resolution .
				'\', \'' .
				$brower .
				'\');';
		}
	}
	else
	{
		$record_sql = "select * FROM `t_log_game_event2` where account_name = '{$account_name}'";
		$record_result = $db->fetchAll($record_sql);
        //var_dump($record_result);exit;
		if(empty($record_result))
		{
            $sql = "INSERT INTO {$dbConfig['dbname']}.t_log_game_event2 (account_name, datetime, event, server_name) VALUES ('{$account_name}', {$time}, '{$event}', '{$server_name}')";
		}
		else
		{
            $sql = "UPDATE {$dbConfig['dbname']}.t_log_game_event2 SET version = '{$record_result[0]['version']}',resolution='{$record_result[0]['resolution']}',brower='{$record_result[0]['brower']}' WHERE id={$record_result[0]['id']}";

		}
	}
    //echo $sql;exit;
	$db->query($sql);

echo 1;
die();