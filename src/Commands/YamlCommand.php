<?php

namespace SandFox\ComposerYaml\Commands;

use Composer\Command\BaseCommand;
use RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class YamlCommand
 * @package SandFox\ComposerYaml\Commands
 *
 * Global command that wraps all calls to use composer.yml
 * Code is inspired by `composer global` command
 */
class YamlCommand extends BaseCommand
{
    private $tmpComposer = null;

    protected function configure()
    {
        $this->setName('yaml');
        $this->setDescription('Use configuration from composer.yml');
        $this->setDefinition(array(
            new InputArgument('command-name', InputArgument::REQUIRED, ''),
            new InputArgument('args', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, ''),
        ));
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        /* <code from composer global> */

        // extract real command name
        $tokens = preg_split('{\s+}', $input->__toString());
        $args = array();
        foreach ($tokens as $token) {
            if ($token && $token[0] !== '-') {
                $args[] = $token;
                if (count($args) >= 2) {
                    break;
                }
            }
        }

        // show help for this command if no command was found
        if (count($args) < 2) {
            return parent::run($input, $output);
        }

        /* </code from composer global> */

        $this->backupComposerJson();

        try {
            $dumper = new DumpCommand();
            $dumper->run(new StringInput(''), $output);

            /* <code from composer global> */
            // create new input without "yaml" command prefix
            $input = new StringInput(preg_replace('{\by(?:a(?:m(?:l?)?)?)?\b}', '', $input->__toString(), 1));
            $this->getApplication()->resetComposer();
            $this->getApplication()->setAutoExit(false);

            $code = $this->getApplication()->run($input, $output);

            $this->getApplication()->setAutoExit(true);
            /* </code from composer global> */
        } finally {
            if (file_exists('composer.json')) {
                unlink('composer.json');
            }

            $this->restoreComposerJson();
        }

        return $code;
    }

    public function isProxyCommand()
    {
        return true;
    }

    private function backupComposerJson()
    {
        if (file_exists('composer.json')) {
            $this->tmpComposer = uniqid('composer.json.');

            if (file_exists($this->tmpComposer)) {
                throw new RuntimeException('Unable to backup existing composer.json: name conflict');
            }

            $result = rename('composer.json', $this->tmpComposer);

            if (!$result) {
                throw new RuntimeException('Unable to backup existing composer.json: rename failure');
            }
        }
    }

    private function restoreComposerJson()
    {
        if ($this->tmpComposer) {
            $result = rename($this->tmpComposer, 'composer.json');

            if (!$result) {
                throw new RuntimeException('Unable to restore existing composer.json: rename failure');
            }
        }
    }
}
