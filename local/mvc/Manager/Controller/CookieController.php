<?php

namespace local\mvc\Manager\Controller;

class CookieController {

    public static function setCookie(string $name, string $value, int $time): bool {
        if (empty($value) && empty($name)) return false;

        setCookie($name, $value, $time, g_ROOT);

        return true;
    }

    public static function getCookie(string $name): string {
        if (!isset($_COOKIE[$name])) return false;

        return $_COOKIE[$name];
    }

    public static function getCookieName(string $name): string {
        if (empty($name) || !isset($_COOKIE[$name])) return false;

        return $name;
    }

    public static function removeCookie(string $name): bool {
        if (!isset($_COOKIE[$name])) return false;
        setCookie($name, '', time() - 1, g_ROOT);

        return true;
    }
}