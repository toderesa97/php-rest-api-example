<?php

class Checker {

    public static function areSetAndValidFields (...$fields) {
        for ($i = 0; $i < count($fields); $i++) {
            if (!isset($fields[$i])) return false;
            if (!self::isValidString($fields[$i])) return false;
        }
        //die(self::isValidString("amisadai@gmail_.com"));
        return true;
    }

    private static function isValidString($string) {
        preg_match('/[^A-Za-z0-9.:\-@_ ]/i', $string, $output);
        return empty($output);
    }

}


?>