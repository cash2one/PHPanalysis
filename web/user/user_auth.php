<?php
if (!$_SESSION['account_name'] || $_SESSION['timestamp'] < 0) {
	header('location:'.OFFICIAL_WEBSITE);
	exit('Access Denied.');
}