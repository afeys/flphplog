<?php

namespace FL;

class Log {
    /*
     * add message to file
     *
     * @param string $msg String to register
     */

    static function add($msg, $type="info") {

        $root = Config::getInstance()->get(Config::BASEPATH) . "/";

        $y = date('Y');
        $m = date('m');
        $fileDest = $root . "logs/{$y}/{$m}/";
        if (!file_exists($fileDest)) {
            $dir = mkdir($fileDest, 0775, true);
        }
        $datatowrite = "[" . date('Y-m-d H:i:s') . "] " . $msg . " \r\n";
        if (is_array($msg) || is_object($msg)) {
            $datatowrite = "[" . date('Y-m-d H:i:s') . "] " . var_export($msg, true) . " \r\n";
        }

        return file_put_contents($fileDest . $type . ".log", $datatowrite, FILE_APPEND);
    }
}