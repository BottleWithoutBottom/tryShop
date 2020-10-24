<?php

namespace local\core;

class Helper {
    public static function generateKeysFromMask($string, $stringPattern, $mask, $maskPattern) {
        if (preg_match($maskPattern, $mask, $maskMatches)) {
            foreach ($maskMatches as $key => $match) {
                $keys[] = ltrim($match, ':');
            }
            if (preg_match($stringPattern, $string, $stringMatches)) {
                if (count($keys)) {
                    foreach ($keys as $key => $value) {
                        $result[$value] = trim($stringMatches[$key], '/');
                    }
                    return $result;
                }
            }
        }
        return [];
    }

    public static function getWordForm($count, $forms) {
        $wordWormX10 = $count % 10;
        $wordWormX100 = $count % 100;

        if ($wordWormX10 >= 2 && $wordWormX10 < 5) {
            return $forms[1];
        } else if($wordWormX10 === 1) {
            return $forms[0];
        } else {
            return $forms[2];
        }
    }
}