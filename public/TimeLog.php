<?php
/*
 * This file is part of the jinyPHP package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class TimeLog
{
    public static $START;
    public static $Logs=[];

    /**
     * 
     */
    public static function init()
    {
        self::$START = microtime();
        array_push(self::$Logs, microtime()."=START");
    }


    /**
     * 
     */
    public static function time()
    {
        $sec = explode(" ", microtime());
        return $sec[0];
    }


    /**
     * 
     */
    public static function set($msg=NULL)
    {
        // $END = microtime(true)-self::$START;
        array_push(self::$Logs, microtime()."=".$msg);
        //self::$Logs= microtime()."=".$msg;
    }


    /**
     * 
     */
    public static function print()
    {
        echo "<pre>";
        print_r(TimeLog::$Logs);
        echo "</pre>";
    }


    /**
     * 
     */
    public static function monitor()
    {
        echo "<script>";
        
        list($mt, $msg) = explode("=", self::$Logs[0]);
        list($usec, $sec) = explode(" ", $mt);
        $start = ((float)$usec + (float)$sec);
        echo "console.log(\"$msg\");";
      
        for ($i=1;$i<count(self::$Logs);$i++) {
            list($mt, $msg) = explode("=", self::$Logs[$i]);
            list($usec, $sec) = explode(" ", $mt);
            $end = ((float)$usec + (float)$sec);
            $end = $end - $start;
            $msg = $end."=".$msg;
            echo "console.log(\"$msg\");";
        }
        echo "</script>";
    }


    /**
     * 
     */
    public static function concole($msg)
    {
        echo "<script>console.log(\"$msg\");</script>";
    }

}