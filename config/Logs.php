<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/11/13
 * Time: 15:54
 */

class Logs {

    public static function write($str)
    {
        $data = debug_backtrace();
        $data = $data[0];
        $file = $data['file'];
        $line = $data['line'];
        $time = date('Y-m-d H:i:s',time());
        $content = var_export($data['args'][0],true);

        $str = "---------------------------------------------------------------------------\r\n"
            ."file[$file] line[$line] time[$time] log[$content]\r\n";

        $log = self::isBak();
        $fp = fopen($log, "ab");
        fwrite($fp, $str);
        fclose($fp);
    }

    public static function isBak()
    {
        $log = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR. 'phpMsg_' . date('Y_m_d__H') . ".log";
        if(!file_exists($log)){
            touch($log);
        }
        return $log;
    }
} 