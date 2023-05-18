<?php

namespace utility;

use Session;

class UtilsFunctions
{
    public static function checkParams(array $params): bool
    {
        return UtilsFunctions::validateParams($params);
    }

    private static function validateParams(array $params): bool
    {
        $filtered = array_filter($params, 'strlen');
        return count($filtered) === count($params);
    }

    public static function checkResponse($response): bool
    {
        return is_int($response) && $response > 0;
    }

    public static function issetSessionId(): bool
    {
        return isset($_SESSION["Id"]);
    }

    public static function checkExistence($value): bool
    {
        return isset($value);
    }
}