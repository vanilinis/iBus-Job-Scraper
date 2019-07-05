<?php

namespace App\CLI;

use App\Scrape\Scrape;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends Command
{
    protected function configure()
    {
        $this->setName('scrapeIbus');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Starting to scrape IbusMedia job offers',
            '============',
            '',
        ]);

        $scraper = New Scrape();

        $scraper->scrapeIbusJobs();
    }
}