<?php

namespace SandFox\ComposerYaml\Commands;

use SandFox\ComposerYaml\Helpers\JsonHelper;
use SandFox\ComposerYaml\Helpers\YamlHelper;

class CreateCommand extends RecodeCommand
{
    protected function configure()
    {
        $this->setName('yaml:create');
        $this->setDescription('Create composer.yml from composer.json');

        parent::configure();
    }

    protected function recode($value)
    {
        return YamlHelper::encode(JsonHelper::decode($value));
    }

    protected function defaultInputFilename()
    {
        return 'composer.json';
    }

    protected function defaultOutputFilename()
    {
        return 'composer.yml';
    }
}
