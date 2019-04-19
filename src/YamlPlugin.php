<?php

namespace SandFox\ComposerYaml;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

class YamlPlugin implements PluginInterface, Capable
{
    public function getCapabilities()
    {
        return [
            CommandProvider::class => YamlCommandProvider::class,
        ];
    }

    public function activate(Composer $composer, IOInterface $io)
    {
        //
    }
}
