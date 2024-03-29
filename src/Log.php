<?php

namespace FL;

class Log {
    /*
     * add message to file
     *
     * @param string $msg String to register
     */

    static function add($msg, $type="info") {
        $backtrace = debug_backtrace();
        $caller = $backtrace[0];
        $fromphpfile = $caller['file'];
        $fromline = $caller['line'];

        $root =  $_SERVER['DOCUMENT_ROOT'] . "/";

        $y = date('Y');
        $m = date('m');
        $d = date('d');
        $fileDest = $root . "logs/{$y}/{$m}/{$d}/";
        if (!file_exists($fileDest)) {
            $dir = mkdir($fileDest, 0775, true);
        }
        if (is_array($msg)) {
            $msg = json_encode($msg);
        }
        if (is_object($msg)) {
            $msg = json_encode($msg);
        }
        $datatowrite = "[" . date('Y-m-d H:i:s') . "] " . $msg . " [" . $fromphpfile . "/" . $fromline . "]" . " \r\n";
        if (is_array($msg) || is_object($msg)) {
            $datatowrite = "[" . date('Y-m-d H:i:s') . "] " . var_export($msg, true) . " [" . $fromphpfile . "/" . $fromline . "]" . " \r\n";
        }

        return file_put_contents($fileDest . $type . ".log", $datatowrite, FILE_APPEND);
    }
}