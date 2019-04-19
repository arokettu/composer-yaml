<?php

namespace SandFox\ComposerYaml\Commands;

use Composer\Command\BaseCommand;
use RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class RecodeCommand extends BaseCommand
{
    protected function configure()
    {
        $this->addOption('input',  'i', InputOption::VALUE_REQUIRED, 'Override input file name');
        $this->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'Override output file name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile  = $input->getOption('input')  ?: $this->defaultInputFilename();
        $outputFile = $input->getOption('output') ?: $this->defaultOutputFilename();

        if (!file_exists($inputFile)) {
            throw new RuntimeException('Input file does not exist');
        }

        $data = file_get_contents($inputFile);

        if ($data === false) {
            throw new RuntimeException(sprintf('Unable to read input file "%s"', $inputFile));
        }

        $recoded = $this->recode($data);

        $result = file_put_contents($outputFile, $recoded);

        if ($result === false) {
            throw new RuntimeException(sprintf('Unable to write to output file "%s"', $outputFile));
        }
    }

    abstract protected function defaultInputFilename();
    abstract protected function defaultOutputFilename();
    abstract protected function recode($value);
}
