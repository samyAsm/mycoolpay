<?php


class Status
{
    private const STATUS = [
        'SUCCESS' => "SUCCESS",
        'ERROR' => "ERROR",
        'FAILED' => "FAILED",
    ];

    /**
     * @return string
     */
    public static function success(): string
    {
        return self::STATUS['SUCCESS'];
    }

    /**
     * @return string
     */
    public static function error(): string
    {
        return self::STATUS['ERROR'];
    }

    /**
     * @return string
     */
    public static function failed(): string
    {
        return self::STATUS['FAILED'];
    }
}