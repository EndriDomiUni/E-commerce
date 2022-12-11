<?php

class StringHelper
{
    /**
     * It takes a value and returns a JSON representation of that value
     * 
     * @param value The value to be encoded. Can be any type except a resource.
     * 
     * @return string, json
     */
    public function toJson($value)
    {
        return json_encode($value);
    }

    /**
     * It takes a string, and returns a PHP object
     * 
     * @param value The value to be converted.
     * 
     * @return value of the json_decode function.
     */
    public function fromJson($value)
    {
        return json_decode($value);
    }
}
