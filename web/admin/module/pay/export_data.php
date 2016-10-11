<?php
	define('IN_DATANG_SYSTEM',false);
	include_once('../../../../config/config.key.php');
	include_once('../../../../config/config.inc.php');
	include_once('../../../../config/config.server.php');
	ini_set("max_execution_time", "180");//避免数据量过大，导出不全的情况出现。
	$CheckKey = "DT_Exp_Key";
	$InPutKey = $_GET['key'];
	$OpStr = $_GET ['op'];
	$TableName = $_GET['tablename'];
	if($CheckKey != $InPutKey){
	 	die($InPutKey."bad arg.");
	}
	if(empty($TableName)){
	 	die($TableName."bad arg.");
	}
	switch($OpStr){
		case "excel":
			export_excel($TableName);
    	break;
    	case "mysql":
    		export_mysql($TableName);
    	break;
    	default:
    	break;
    }

function export_excel($tablename){
	global    $dbConfig, $AGENT_NAME, $AGENT_ID, $GAME_SERVER;
	$user = $dbConfig['user'];
	$passwd = $dbConfig['passwd'];
	$host = $dbConfig['host'];
	$dbname = $dbConfig['dbname'];
	$agentStr = $AGENT_NAME[$AGENT_ID];
	$serverStr = "S".$GAME_SERVER;
	$savename = $agentStr."_".$serverStr."_".date("Ymd")."_".$tablename;
	$Connect = @mysql_connect($host, $user, $passwd) or die("Couldn't connect.");
        mysql_query("Set Names 'utf-8'");
        $file_type = "vnd.ms-excel";
        $file_ending = "xls";
                
        header("Content-Type: application/$file_type;charset=utf-8");
        header("Content-Disposition: attachment; filename=".$savename.".$file_ending");
        //header("Pragma: no-cache");

        $now_date = date("Ymd");
        $title = "数据库名:$dbname,数据表:$tablename,备份日期:$now_date";

        $sql = "Select * from $tablename";
        $ALT_Db = @mysql_select_db($dbname, $Connect) or die("Couldn't select database");
        $result = @mysql_query($sql,$Connect) or die(mysql_error());

        echo(mb_convert_encoding($title,"gb2312","utf-8")."\n");
        $sep = "\t";
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            echo mysql_field_name($result,$i) . "\t";
        }
        print("\n");
      //  $i = 0;
        while($row = mysql_fetch_row($result)) {
            $schema_insert = "";
            for($j=0; $j< mysql_num_fields($result);$j++) {
                if(!isset($row[$j]))
                    $schema_insert .= "NULL".$sep;
                else if ($row[$j] != "")
                    $schema_insert .= mb_convert_encoding($row[$j],"gb2312","utf-8").$sep;
                else
                    $schema_insert .= "".$sep;
            }
            $schema_insert = str_replace($sep."$", "", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
           // $i++;
        }
        return (true);
}

function export_mysql($tablename){
	global    $dbConfig, $AGENT_NAME, $AGENT_ID, $GAME_SERVER;
	$username = $dbConfig['user'];
	$passw = $dbConfig['passwd'];
	$host = $dbConfig['host'];
	$dbname = $dbConfig['dbname'];
	
	$agentStr = $AGENT_NAME[$AGENT_ID];
	$serverStr = "S".$GAME_SERVER;
	$savename = $agentStr."_".$serverStr."_".date("Ymd")."_".$tablename;
	
	$filename=$savename.".sql";
    header("Content-disposition:filename=".$filename);//所保存的文件名
    header("Content-type:application/octetstream");
    header("Pragma:no-cache");
    header("Expires:0");

//备份数据
    $i   =   0;
    $crlf="\r\n";
	global     $dbconn;
    $dbconn   =   mysql_connect($host,$username,$passw);//数据库主机，用户名，密码
    $db   =   mysql_select_db($dbname,$dbconn);
	mysql_query("SET NAMES 'utf8'");
    $tables =mysql_list_tables($dbname,$dbconn);
    $num_tables   =   @mysql_numrows($tables);
    print   "-- filename=".$filename;
    while($i   <   $num_tables)
    {
      $table=mysql_tablename($tables,$i);
	  if($table == $tablename){
		  print   $crlf;
		  echo   get_table_structure($dbname,   $table,   $crlf).";$crlf$crlf";
		  //echo   get_table_def($dbname,   $table,   $crlf).";$crlf$crlf";
		  echo   get_table_content($dbname,   $table,   $crlf);
		}
      $i++;
   }
}

/*新增的获得详细表结构*/
function get_table_structure($db,$table,$crlf)
{
global   $drop;

     $schema_create   =   "";
     if(!empty($drop)){ $schema_create   .=   "DROP TABLE IF EXISTS `$table`;$crlf";}
    $result   =mysql_db_query($db,   "SHOW CREATE TABLE $table");
    $row=mysql_fetch_array($result);
    $schema_create   .= $crlf."-- ".$row[0].$crlf;
    $schema_create   .= $row[1].$crlf;
    Return $schema_create;
}


//获得表内容
function   get_table_content($db, $table,   $crlf)
{
          $schema_create   =   "";
          $temp   =   "";
          $result   =   mysql_db_query($db,   "SELECT   *   FROM   $table");
          $i   =   0;
          while($row   =   mysql_fetch_row($result))
          {
                  $schema_insert   =   "INSERT INTO `$table` VALUES   (";
                  for($j=0;   $j<mysql_num_fields($result);$j++)
                  {
                          if(!isset($row[$j]))
                                  $schema_insert   .=   " NULL,";
                          elseif($row[$j]   !=   "")
                                  $schema_insert   .=   " '".addslashes($row[$j])."',";
                          else
                                  $schema_insert   .=   " '',";
                  }
                  $schema_insert   =   ereg_replace(",$", "",$schema_insert);
                  $schema_insert   .=   ");$crlf";
                  $temp   =   $temp.$schema_insert   ;
                  $i++;
          }
          return   $temp;
}
?>