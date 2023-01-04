<?php

namespace utility;

class Utils
{
    public static function checkParams(array $params): bool
    {
        return Utils::validateParams($params);
    }

    private static function validateParams(array $params): bool
    {
        $filtered = array_filter($params, 'strlen');
        return count($filtered) === count($params);
    }

    public static function checkResponse($response): bool
    {
        return is_int($response);
    }

    public static function issetSessionId(): bool
    {
        return isset($_SESSION["Id"]);
    }
}