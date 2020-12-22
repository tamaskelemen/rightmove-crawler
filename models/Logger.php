<?php

namespace Models;

class Logger
{
    private const LOG_DEFAULT = __DIR__ . '/../log.txt';

    /**
     * @param $msg
     * @param string $level
     * @return false|int
     */
    public static function info($msg, $level = "INFO")
    {
        $text = date("Y-m-d H:i:s") . " -- " . $level . " -- " . $msg;

        return self::write(self::LOG_DEFAULT, $text);
    }

    /**
     * @param $msg
     * @param string $level
     * @return false|int
     */
    public static function error($msg, $level = "ERROR")
    {
        $text = date("Y-m-d H:i:s") . " -- " . $level . " -- " . $msg;

        return self::write(self::LOG_DEFAULT, $text);
    }
    /**
     * Writes msg to give file.
     * @param $file
     * @param $msg
     * @return false|int
     */
    private static function write($file, $msg)
    {
        $msg .= "\n";
        return file_put_contents($file, $msg, FILE_APPEND | LOCK_EX);
    }

}
