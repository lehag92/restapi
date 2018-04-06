<?php

namespace Guz\Rest\Log;

class Logger
{
    /**
     * Writes message to error log file
     * @param string $message
     */
    public static function write($message)
    {
        $name = date('d-m-Y') . '.log';
        $logDir = ROOT . "Logs/";

        //Creates logs dir
        if (!file_exists($logDir)) {
            mkdir($logDir, 0655, true);
        }
        //Creates lof file
        if (!file_exists($name)) {
            touch($logDir . $name);
        }

        file_put_contents(
            $logDir . $name,
            '[' . date('d-m-Y H:i:s') .'] ' . $message . "\n",
            FILE_APPEND
        );
    }
}