<?php

namespace SandFox\ComposerYaml;

use Composer\Plugin\Capability\CommandProvider;

class YamlCommandProvider implements CommandProvider
{
    public function getCommands()
    {
        return [
            new Commands\CreateCommand(),
            new Commands\DumpCommand(),
        ];
    }
}
