<?php

namespace App\CLI;

use JsonSchema\Validator as Validator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends Command
{
    protected function configure()
    {
        $this->setName('validateJson');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Starting Json validator',
            '============',
            '',
        ]);

        $schema = file_get_contents('./schema.json');
        $data = file_get_contents('var/jobs/results.json');

        $validator = new Validator();
        $validator->check(json_decode($data), json_decode($schema));
        if ($validator->isValid()) {
            echo "The supplied JSON validates against the schema.\n";
        } else {
            echo "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                echo sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
        }
    }
}