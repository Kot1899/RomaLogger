<?php


namespace RomanenkoLogger;

use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    public $logFile;
    public $save;

    public function __construct($logFile, $save)
    {
        $this->logFile = $logFile;
        $this->storage = $_SERVER['DOCUMENT_ROOT'] . '/' . $save;
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - Emergency
     */
    public function emergency ($message, array $context=[])
    {
        $this ->log(LogLevel::EMERGENCY, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - alert
     */
    public function alert ($message, array $context=[])
    {
        $this ->log(LogLevel::ALERT, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - critical
     */
    public function critical ($message, array $context=[])
    {
        $this ->log(LogLevel::CRITICAL, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - error
     */
    public function error ($message, array $context=[])
    {
        $this ->log(LogLevel::ERROR, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - warning
     */
    public function warning ($message, array $context=[])
    {
        $this ->log(LogLevel::WARNING, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - notice
     */
    public function notice ($message, array $context=[])
    {
        $this ->log(LogLevel::NOTICE, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - info
     */
    public function info ($message, array $context=[])
    {
        $this ->log(LogLevel::INFO, $message,$context);
    }

    /**
     * @param $message
     * @param array $context
     * @return void
     * description - debug
     */
    public function debug ($message, array $context=[])
    {
        $this ->log(LogLevel::DEBUG, $message,$context);
    }

    public function log($level, $message, array $context = array())
    {
        $save= $this->save;
        $logfile = $this->logFile;
        $handle = fopen($save . '/' . $logfile . '.log', 'a+') or die("ALL IS CRASHED");
        $context = implode(',', $context);
        $time = date('Y-m-d h:i:s');
        $message = "=====\nLevel: {$level}\nMessage: {$message}\nContext: {$context}\n\n{$time}\n=====\n\n";
        fwrite($handle, $message);
        fclose($handle);
    }
}