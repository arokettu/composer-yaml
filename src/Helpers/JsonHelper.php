<?php

namespace SandFox\ComposerYaml\Helpers;

use RuntimeException;

final class JsonHelper
{
    /**
     * @param mixed $value
     * @return string
     */
    public static function encode($value)
    {
        if (defined('JSON_THROW_ON_ERROR')) {
            // PHP 7.3+
            return json_encode($value,  JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        } else {
            $data = json_encode($value,  JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException(json_last_error_msg());
            }
            return $data;
        }
    }

    /**
     * @param string $value
     * @return mixed
     */
    public static function decode($value)
    {
        if (defined('JSON_THROW_ON_ERROR')) {
            // PHP 7.3+
            return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        } else {
            // older PHP
            $data = json_decode($value, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException(json_last_error_msg());
            }
            return $data;
        }
    }
}
