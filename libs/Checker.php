<?php

class Checker {

    public static function areSetFields (...$fields) {
        for ($i = 0; $i < count($fields); $i++) {
            if (! isset($fields[$i])) return false;
        }
        return true;
    }

    public static function areValidStrings(...$strings) {
        for ($i = 0; $i < count($strings); $i++) {
            if (preg_match('/[^a-z_@.\-0-9]/i', $strings[$i])) {
                return false;
            }
        }
        return true;
    }

}


?>