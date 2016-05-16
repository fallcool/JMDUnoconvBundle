<?php

namespace JMD\UnoconvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Unoconv\Unoconv;

class ConvertCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('jmd:unoconv:convert')
            ->addArgument('format', InputArgument::REQUIRED, 'Convertation format')
            ->addArgument('input_file', InputArgument::REQUIRED, 'File for convertation')
            ->addOption('output_file', 'o', InputOption::VALUE_OPTIONAL, 'Output file', null)
            ->setDescription('Convert file to another format this unoconv');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArguments();
        $outputFile = $input->getOption('output_file');

        /** @var Unoconv $unoconv */
        $unoconv = $this->getContainer()->get('jmd_unoconv');

        if (null === $outputFile) {
            $outputFile = $arguments['input_file'] . '.' . $arguments['format'];
        }

        try {
            $unoconv->transcode($arguments['input_file'], $arguments['format'], $outputFile);

            $output->writeln(
                sprintf(
                    'File "%s" was converted to "%s". Format: "%s"',
                    $arguments['input_file'],
                    $outputFile,
                    $arguments['format']
                )
            );
        } catch (\Exception $e) {
            $output->writeln('ERROR: '.$e->getMessage());
        }
    }
}
