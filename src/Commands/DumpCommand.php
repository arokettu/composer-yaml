<?php

namespace SandFox\ComposerYaml\Commands;

use SandFox\ComposerYaml\Helpers\JsonHelper;
use SandFox\ComposerYaml\Helpers\YamlHelper;

class DumpCommand extends RecodeCommand
{
    protected function configure()
    {
        $this->setName('yaml:dump');
        $this->setDescription('Create composer.json from composer.yml');

        parent::configure();
    }

    protected function recode($value)
    {
        return JsonHelper::encode(YamlHelper::decode($value));
    }

    protected function defaultInputFilename()
    {
        // discovery
        foreach (['composer.yml', 'composer.yaml'] as $file) {
            if (file_exists($file)) {
                return $file;
            }
        }

        // fall back
        return 'composer.yml';
    }

    protected function defaultOutputFilename()
    {
        return 'composer.json';
    }
}
