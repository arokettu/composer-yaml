<?php

namespace SandFox\ComposerYaml\Helpers;

use Symfony\Component\Yaml\Yaml;

/**
 * @internal
 */
final class YamlHelper
{
    /**
     * @param mixed $value
     * @return string
     */
    public static function encode($value)
    {
        if (function_exists('yaml_emit')) {
            // use ext-yaml
            return yaml_emit($value, YAML_UTF8_ENCODING);
        } else {
            // fall back to symfony/yaml
            return Yaml::dump($value);
        }
    }

    /**
     * @param string $value
     * @return mixed
     */
    public static function decode($value)
    {
        if (function_exists('yaml_parse')) {
            // use ext-yaml
            return yaml_parse($value);
        } else {
            // fall back to symfony/yaml
            return Yaml::parse($value);
        }
    }
}
